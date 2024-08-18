<?php

namespace App\Http\Controllers\admin;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Table;
use App\Models\BasicInfo;
use App\Models\Item;
use App\Models\Collection;
use App\Models\PaymentMethod;
use App\Models\StockHistory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class CollectionController extends Controller
{
    public function index()
    {
        $where = ['order_type' => 0, 'payment_status' => 0, 'order_status' => 4];
        $data['orders'] = Order::with(['table', 'order_details', 'orderCreatedBy'])
            ->where($where)
            ->orderBy('id', 'asc')
            ->paginate(6);
        $data['paymentMethods'] = PaymentMethod::orderBy('title', 'asc')->get();
        $data['currency_symbol'] = BasicInfo::first()->currency_symbol;

        $dateToday = date('Y-m-d');
        $data['total_collection'] = Collection::whereDate('created_at', $dateToday)->sum('paid_amount');
        $data['my_collection'] = Collection::whereDate('created_at', $dateToday)
            ->where('created_by_id', Auth::guard('admin')->user()->id)
            ->sum('paid_amount');
        $data['pending_collection'] = Order::where($where)->sum('mrp');
        $data['pending_orders'] = Order::where($where)->count();
        return view('admin.collections.index', compact('data'));

    }

    public function orderDetails($id)
    {
        $order = Order::with(['table','order_details'])->find($id);
        return response()->json($order, 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $order = Order::find($request->order_id);
        $orderDetails = OrderDetails::where('order_id',$order->id)->get();

        $order->discount = $request->discount_amount;
        $order->net_bill = $request->total_payable;
        $order->profit = $order->mrp - $order->trade_price - $order->discount;
        $order->paid_amount =  $order->net_bill;
        $order->save();

        foreach ($orderDetails as $key => $value){
            $catTypeId = Item::find($value->item_id)->cat_type_id;
            if(in_array($catTypeId,[1,3]))
            {
                //Item Stock Update...
                $item = Item::find($value->item_id);
                $item->current_stock = $item->current_stock - $value->quantity;
                $item->save();
                //Stock History Update
                $stockHistory = new StockHistory;
                $stockHistory->item_id = $value->item_id;
                $stockHistory->date = date('Y-m-d');
                $stockHistory->particular = 'Sales';
                // $stockHistory->stock_in_qty = ;
                $stockHistory->stock_out_qty = $value->quantity;
                $stockHistory->rate = $value->unit_price;
                $stockHistory->current_stock = $item->current_stock;
                $stockHistory->created_by_id = Auth::guard('admin')->user()->id;
                $stockHistory->save();
            }
        }

        $collections = 
        [
            'order_id'=> $order->id,
            'order_no'=> $order->order_no,
            'payment_method_id'=> $request->payment_method_id,
            'total_amount'=> $order->mrp,
            'discount'=> $order->discount_amount,
            'vat'=> $order->vat,
            'total_payable'=> $order->net_bill,
            'paid_amount'=> $order->paid_amount,
            'payment_status'=> 1,
            'created_by_id'=> Auth::guard('admin')->user()->id,
            'approved_by_id'=> Auth::guard('admin')->user()->id,
        ];

        Collection::create($collections);

        $order->order_status =  5;
        $order->completed_at =  date('Y-m-d h:i:s');
        $order->payment_status =  1;
        $order->save();
        
        Table::find($order->table_id)->update(['is_available'=>1]);
        return redirect()->route('collections.receipt',$order->id)->with('back_url',route('collections.index'));
    }

    public function receipt($order_id)
    {
        $data['order'] = Order::with(['table','order_details','orderCreatedBy'])->find($order_id);
        $data['payment'] = Collection::where('order_id', $order_id)->first();
        $data['paymentMethods'] = PaymentMethod::orderBy('title','asc')->get();
        $data['basicInfo'] = BasicInfo::first();
        return view('admin.collections.receipt', compact('data'));
    }
    public function checkNewCollections()
    {
        $data = false;
        $orders = Order::where(['order_type' => 0, 'payment_status' => 0, 'order_status' => 4,'collection_alert'=> 0])->get();
        if(count($orders)){
            $orders->toQuery()->update(['collection_alert'=>1]);
            $data = true;
        }
        return response()->json($data, 200);
    }
    public function orderStatus(Request $request)
    {
        $order = Order::find($request->id);
        $table_id = $order->table_id;
        $order->update(['order_status'=>$request->order_status,'approved_at'=> date('Y-m-d h:i:s'),'approved_by_id'=>Auth::guard('admin')->user()->id]);
        Table::find($table_id)->update(['is_available'=>1]);
        $msg = 'Order Cancelled Successfully!';
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>$msg]);
    }
}
