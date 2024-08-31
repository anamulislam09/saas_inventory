<?php

namespace App\Http\Controllers\admin;

use App\Models\Order;
use App\Models\Collection;
use App\Models\BasicInfo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
        $data['pending_orders'] = Order::where('order_status',0)->count();
        $data['pending_collections'] = Order::where(['payment_status'=>0,'order_status'=>4])->count();
        $data['pending_orders_in_kit'] = Order::whereIn('order_status',[1,3])->count();
        $data['todays_orders'] = Order::where('created_at','like',"%". date('Y-m-d') ."%")->count();
        $data['my_orders'] = Order::where('created_by_id',Auth::guard('admin')->user()->id)->where('created_at','like',"%". date('Y-m-d') ."%")->count();
        $data['todays_collections'] = Collection::where('status',1)->where('created_at','like',"%". date('Y-m-d') ."%")->sum('total_collection');
        $data['weekly_collections'] = Collection::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                                        ->where('status',1)
                                        ->sum('total_collection');
        $data['monthly_collections'] = Collection::whereMonth('created_at', Carbon::now()->month)
                                        ->whereYear('created_at', Carbon::now()->year)
                                        ->where('status',1)
                                        ->sum('total_collection');
        $data['total_collections'] = Collection::where('status',1)
                                        ->sum('total_collection');
        return view('admin.index',compact('data'));
    }
    public function pendings()
    {
        $data['pending_orders'] = Order::where(['order_type' => 0,'order_status'=> 0])->count();
        $data['pending_collections'] = Order::where(['order_type' => 0, 'payment_status' => 0, 'order_status' => 4])->count();
        $data['pending_orders_in_kit'] = Order::whereIn('order_status', [1, 3])->count();
        $data['pending_in_pos'] = $data['pending_orders'] + $data['pending_collections'];

        $data['pending_orders'] = $data['pending_orders'] != 0? $data['pending_orders']:'';
        $data['pending_collections'] = $data['pending_collections'] != 0? $data['pending_collections']:'';
        $data['pending_orders_in_kit'] = $data['pending_orders_in_kit'] != 0? $data['pending_orders_in_kit']:'';
        $data['pending_in_pos'] = $data['pending_in_pos'] != 0? $data['pending_in_pos']:'';

        return response()->json($data, 200);
    }
}

