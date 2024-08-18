<?php

namespace App\Http\Controllers\admin;

use App\Models\Item;
use App\Models\Order;
use App\Models\Table;
use App\Models\BasicInfo;
use App\Models\OrderDetails;
use App\Models\StockHistory;
use App\Models\PaymentMethod;
use App\Models\Collection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ManualBillController extends Controller
{
    public function index()
    {
        $data['orders'] = Order::with(['table'])
                            ->where(['created_by_id'=> Auth::guard('admin')->user()->id,'order_type'=>1])
                            ->where('order_status','!=',5)
                            ->orderBy('id','desc')
                            ->get();

        $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
        return view('admin.manual-bills.index', compact('data'));
    }

    public function pendingOrders()
    {
        $orders = Order::with(['table','order_details'])->where('order_status',0)->orderBy('id','asc')->get();
        return view('admin.orders.pending-orders', compact('orders'));
    }

    public function orderStatus(Request $request)
    {
        $order = Order::find($request->id);
        $table_id = $order->table_id;
        $order->update(['order_status'=>$request->order_status,'approved_at'=> date('Y-m-d h:i:s'),'approved_by_id'=>Auth::guard('admin')->user()->id]);
        if($request->order_status==1){
            $msg = 'Order Approved Successfully!';
        }else{
            Table::find($table_id)->update(['is_available'=>1]);
            $msg = 'Order Cancelled Successfully!';
        }
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>$msg]);
    }

    public function createOrEdit($id=null)
    {
        $data['paymentMethods'] = PaymentMethod::orderBy('title','asc')->get();
        $data['currency_symbol'] = BasicInfo::first()->currency_symbol;

        if($id){
            $data['title'] = 'Edit';
            $data['order'] = Order::with('order_details')->find($id);
        }else{
            $data['title'] = 'Create';
        }
        $data['tables'] = Table::where('status',1)->orderBy('title','asc')->get();
        $data['items'] = Item::where('status',1)->whereIn('cat_type_id',[1,2])->orderBy('title','asc')->get();
        return view('admin.manual-bills.create-or-edit',compact('data'));
    }


    public function invoice($id, $print=null)
    {
        $order = Order::with(['order_details','user','shipping_country','billing_country'])->find($id);
        return view('admin.orders.invoice', compact('order','print'));
    }
    public function store(Request $request)
    {
        $trade_price = 0;
        foreach ($request->item_id as $key => $value) $trade_price += Item::find($value)->cost * $request->quantity[$key];
        $profit = $request->mrp - $trade_price - $request->discount_amount;

        $table = Table::find($request->table_id);
        if($table->is_default != 1) $table->update(['is_available'=>0]);

        $data = 
        [
            'table_id'=> $request->table_id,
            'order_no'=> ManualBillController::formatNumber(Order::max('order_no')+1),
            'trade_price'=> $trade_price,
            'mrp'=> $request->mrp,
            'discount'=> $request->discount_amount,
            'vat'=> $request->vat,
            'net_bill'=> $request->total_payable,
            'paid_amount'=> $request->total_payable,
            'profit'=> $profit,
            'note'=> $request->note,
            'payment_status'=> 1,
            'order_status'=> 1,
            'order_type'=> 1,
            'created_by_id'=> Auth::guard('admin')->user()->id,
            'created_at'=> date('Y-m-d h:i:s'),
            'approved_by_id'=> Auth::guard('admin')->user()->id,
            'approved_at'=> date('Y-m-d h:i:s'),
        ];

        $order = Order::create($data);

        for($i = 0; $i< count($request->item_id); $i++) {
            $data = 
            [
                'order_id'=>$order->id,
                'item_id'=>$request->item_id[$i],
                'quantity'=>$request->quantity[$i],
                'unit_price'=>$request->unit_price[$i],
                'status'=>0,
            ];
            OrderDetails::create($data);
        }

        $collection = 
        [
            'order_id'=> $order->id,
            'order_no'=> $order->order_no,
            'table_id'=> $order->table_id,
            'payment_method_id'=> $request->payment_method_id,
            'total_amount'=> $request->mrp,
            'discount'=> $request->discount_amount,
            'vat'=> $request->vat,
            'total_payable'=> $request->total_payable,
            'paid_amount'=> $request->total_payable,
            'payment_status'=> 1,
            'created_by_id'=> Auth::guard('admin')->user()->id,
            'approved_by_id'=> Auth::guard('admin')->user()->id,
        ];

        Collection::create($collection);
        return redirect()->route('collections.receipt',$order->id)->with('back_url',route('manual-bills.index'));
    }


    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $newOrderDetailsId = $request->order_details_id;
        //Destroying deleted Order Item
        OrderDetails::whereNotIn('id', $newOrderDetailsId)->where('order_id',$order->id)->delete();
        
        foreach ($newOrderDetailsId as $nodikey => $nodi) {
            if(!$nodi){
                $orderDetails = new OrderDetails;
                $orderDetails->order_id = $order->id;
                $orderDetails->item_id = $request->item_id[$nodikey];
                $orderDetails->quantity = $request->quantity[$nodikey];
                $orderDetails->unit_price = $request->unit_price[$nodikey];
                $orderDetails->status = 0;
                $orderDetails->save();
            }
        }
        $trade_price = 0;
        $orderDetails = OrderDetails::where('order_id', $id)->get();
        foreach ($request->item_id as $key => $value) $trade_price += Item::find($value)->cost * $request->quantity[$key];
        $profit = $request->mrp - $trade_price - $request->discount_amount;

        $order->trade_price = $trade_price;
        $order->mrp = $request->mrp;
        $order->discount = $request->discount_amount;
        $order->vat = $request->vat;
        $order->net_bill = $request->total_payable;
        $order->paid_amount = $request->total_payable;
        $order->profit = $profit;
        $order->note = $request->note;
        $order->payment_status = 1;
        $order->order_status = 3;
        $order->save();

        $collection = Collection::where('order_id', $order->id)->first();
        $collection->order_id = $order->id;
        $collection->order_no = $order->order_no;
        $collection->table_id = $order->table_id;
        $collection->payment_method_id = $request->payment_method_id;
        $collection->total_amount = $request->mrp;
        $collection->discount = $request->discount_amount;
        $collection->vat = $request->vat;
        $collection->total_payable = $request->total_payable;
        $collection->paid_amount = $request->total_payable;
        $collection->payment_status = 1;
        $collection->approved_by_id = Auth::guard('admin')->user()->id;
        $collection->save();
        return redirect()->route('manual-bills.index')->with('alert',['messageType'=>'success','message'=>'Data Updated Successfully!']);
    }
    public function formatNumber($srl)
    {
        switch(strlen($srl)){
            case 1:
                $zeros = '00000';
                break;
            case 2:
                $zeros = '0000';
                break;
            case 3:
                $zeros = '000';
                break;
            case 4:
                $zeros = '00';
                break;
            default:
                $zeros = '0';
            break;
        }
        return $zeros . $srl;
    }
    public function completeOrder($order_id)
    {
        $order = Order::find($order_id);
        $orderDetails = OrderDetails::where('order_id',$order_id)->get();
        foreach ($orderDetails as $key => $value){
            $item = Item::find($value->item_id);
            if(in_array($item->cat_type_id,[1,3]))
            {
                //Item Stock Update
                $item->current_stock = $item->current_stock - $value->quantity;
                $item->save();
                //Stock History Update
                $stockHistory = new StockHistory;
                $stockHistory->item_id = $value->item_id;
                $stockHistory->date = date('Y-m-d');
                $stockHistory->particular = 'Sales';
                $stockHistory->stock_out_qty = $value->quantity;
                $stockHistory->rate = $value->unit_price;
                $stockHistory->current_stock = $item->current_stock;
                $stockHistory->created_by_id = Auth::guard('admin')->user()->id;
                $stockHistory->save();
            }
        }
        Table::find($order->table_id)->update(['is_available'=>1]);
        $order->order_status = 5;
        $order->save();
        return response()->json(true, 200);
    }
}
