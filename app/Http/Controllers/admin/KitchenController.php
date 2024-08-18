<?php

namespace App\Http\Controllers\admin;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\StockHistory;
use App\Models\Table;
use App\Models\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;

class KitchenController extends Controller
{
    public function index()
    {
        if(url()->previous() != url()->current()) Session::put('kitchen_back_url',url()->previous());
        return view('admin.kitchen.index');
    }
    public function updateStatus($indicator,$id)
    {
        //$indicator==1 'Item Marked As Ready';
        //$indicator==2 'Order Marked As Processing!';
        //$indicator==3 'Order Marked As Ready';
        if($indicator==1){
            $order_id = OrderDetails::find($id)->order_id;
            if(Order::find($order_id)->order_status != 3){
                Order::find($order_id)->update([
                    'order_status'=> 3,
                    'received_by_id'=> Auth::guard('admin')->user()->id,
                ]);
            }
            OrderDetails::find($id)->update(['status'=>1]);
            $notReadyItem = OrderDetails::where(['order_id'=>$order_id, 'status'=>0])->count();
            if(!$notReadyItem){
                $order = Order::find($order_id);
                // if($order->payment_status == 1){
                //     $order->order_status = 5;
                //     $order->completed_at = date('Y-m-d h:i:s');
                //     $this->freeTable($order->table_id);
                // }else{
                    $order->order_status = 4;
                // }
                $order->processed_at = date('Y-m-d h:i:s');
                $order->save();
            }
           $message = 'Item Marked As Ready';
        }else if($indicator==2){
            Order::find($id)->update([
                'order_status'=> 3,
                'received_by_id'=> Auth::guard('admin')->user()->id,
            ]);
            $message = 'Order Marked As Processing!';
        }else if($indicator==3){
            $order = Order::find($id);

            // if($order->payment_status == 1){
            //     $order->order_status = 5;
            //     $order->completed_at = date('Y-m-d h:i:s');
            //     $this->freeTable($order->table_id);
            //     $this->stockUpdate($order->id);
            // }else{
                // }
                
            $order->order_status = 4;
            $order->received_by_id = Auth::guard('admin')->user()->id;
            $order->processed_at = date('Y-m-d h:i:s');
            $order->save();
            OrderDetails::where(['order_id'=>$id, 'status'=>0])->update(['status'=>1]);
            $message = 'Order Marked As Ready';
        }
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>$message]);
    }
    public function freeTable($table_id)
    {
        Table::find($table_id)->update(['is_available'=>1]);
    }
    public function stockUpdate($order_id)
    {
        $order = Order::find($order_id);
        $orderDetails = OrderDetails::where('order_id',$order_id)->get();
        foreach ($orderDetails as $key => $value){
            $item = Item::find($value->item_id);
            if(in_array($item->cat_type_id,[1,3]))
            {
                //Item Stock Update...
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
    }
    public function orders()
    {
        $data['orders'] = Order::with(['table','order_details'])->whereIn('order_status',[1,3])->orderBy('id','desc')->get();
        $data['alert'] = false;
        $leftAlert = Order::whereIn('order_status',[1,3])->where('kitchen_alert',0)->count();
        if($leftAlert){
            $data['alert'] = true;
            Order::whereIn('order_status',[1,3])->where('kitchen_alert',0)->update(['kitchen_alert'=> 1]);
        }
        return response()->json($data, 200);
    }
}
