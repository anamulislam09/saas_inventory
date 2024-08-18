<?php

namespace App\Http\Controllers\admin;

use App\Models\Order;
use App\Models\BasicInfo;
use App\Models\OrderDetails;
use App\Models\Table;
use App\Models\Item;
use App\Models\Collection;
use App\Models\PaymentMethod;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class OrderController extends Controller
{
    public function index()
    {
        $data['orders'] = Order::with(['table'])
                            ->where(['created_by_id'=> Auth::guard('admin')->user()->id, 'payment_status'=>0, 'order_type'=>0])
                            ->whereIn('order_status',[0,1,3,4])
                            ->orderBy('id','desc')->get();
        $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
        return view('admin.orders.index', compact('data'));
    }

    public function pendingOrders()
    {
        $orders = Order::with(['table','order_details'])->where('order_status',0)->orderBy('id','asc')->get();
        return view('admin.orders.pending-orders', compact('orders'));
    }
    public function cancelledOrders()
    {
        $orders = Order::with(['table','order_details'])->where('order_status',2)->orderBy('id','desc')->get();
        return view('admin.orders.cancelled-orders', compact('orders'));
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
        if($id){
            $data['title'] = 'Edit';
            $data['order'] = Order::with('order_details')->find($id);
        }else{
            $data['title'] = 'Create';
        }
        $data['tables'] = Table::where('status',1)->orderBy('title','asc')->get();
        $data['items'] = Item::where('status',1)->whereIn('cat_type_id',[1,2])->orderBy('title','asc')->get();
        return view('admin.orders.create-or-edit',compact('data'));
    }


    public function invoice($order_id)
    {
        $data['order'] = Order::with(['table','order_details','orderCreatedBy'])->find($order_id);
        $data['payment'] = Collection::where('order_id', $order_id)->first();
        $data['paymentMethods'] = PaymentMethod::orderBy('title','asc')->get();
        $data['basicInfo'] = BasicInfo::first();
        return view('admin.orders.invoice', compact('data'));
    }

    public function store(Request $request)
    {
        $table = Table::find($request->table_id);
        if($table->is_default != 1) $table->update(['is_available'=>0]);
        $trade_price = 0;
        $vat = 0;
        foreach ($request->item_id as $key => $value){
            $item = Item::find($value);
            $trade_price +=  $item->cost * $request->quantity[$key];
            $vat += ($item->vat/100) * ($item->price * $request->quantity[$key]);
        }
        $net_bill = $request->total + $vat;
        $data = 
        [
            'table_id'=> $request->table_id,
            'order_no'=> OrderController::formatNumber(Order::max('order_no')+1),
            'trade_price'=> $trade_price,
            'mrp'=> $request->total,
            'vat'=> $vat,
            'net_bill'=> $net_bill,
            'note'=> $request->note,
            'payment_status'=> 0,
            'order_status'=> 0,
            'order_type'=> 0,
            'created_by_id'=> Auth::guard('admin')->user()->id,
            'created_at'=> date('Y-m-d h:i:s'),
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
        return redirect()->route('orders.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }


    public function update(Request $request,$id)
    {
        $order = Order::find($id);
        $orderDetails = OrderDetails::where('order_id',$order->id)->select('id')->get()->toArray();
        $oldOrderDetailsId = array_column($orderDetails, 'id');
        $newOrderDetailsId = $request->order_details_id;

        foreach ($oldOrderDetailsId as $oodikey => $oodi) {
            if(!in_array($oodi, $newOrderDetailsId)) OrderDetails::destroy($oodi);
        }
        
        foreach ($newOrderDetailsId as $nodikey => $nodi) {
            if($nodi){
                OrderDetails::find($nodi)->update(['quantity'=>$request->quantity[$nodikey],'unit_price'=>$request->unit_price[$nodikey]]);
            }else{
                $data = 
                [
                    'order_id'=>$order->id,
                    'item_id'=>$request->item_id[$nodikey],
                    'quantity'=>$request->quantity[$nodikey],
                    'unit_price'=>$request->unit_price[$nodikey],
                    'status'=>0,
                ];
                OrderDetails::create($data);
            }
        }

        $orderDetails = OrderDetails::where('order_id', $id)->get();

        
        $trade_price = 0;
        $vat = 0;
        foreach ($orderDetails as $key => $value){
            $item = Item::find($value->item_id);
            $trade_price +=  $item->cost * $value->quantity;
            $vat += ($item->vat/100) * ($item->price * $value->quantity);
        }
        $net_bill = $request->total + $vat;
        $order->trade_price = $trade_price;
        $order->vat = $vat;
        $order->net_bill = $net_bill;
        $order->mrp = $request->total;
        $order->note = $request->note;
        $order->order_status = 3;
        $order->save();

        return redirect()->route('orders.index')->with('alert',['messageType'=>'success','message'=>'Data Updated Successfully!']);
    }

    public function resume($id)
    {
        $order = Order::find($id);
        $table = Table::find($order->table_id);
        if($table->is_default != 1 && $table->is_available){
            $table->update(['is_available'=>0]);
        }else{
            $order->table_id = Table::where('is_default', 1)->first()->id;
        }
        $order->order_status = 1;
        $order->approved_at =  date('Y-m-d h:i:s');
        $order->approved_by_id =  Auth::guard('admin')->user()->id;
        $order->save();
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>'Data Resumed Successfully!']);
    }
    public function destroy($id)
    {
        Order::destroy($id);
        OrderDetails::where('order_id', $id)->delete();
        return redirect()->back()->with('alert',['messageType'=>'danger','message'=>'Data Deleted Successfully!']);
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
}
