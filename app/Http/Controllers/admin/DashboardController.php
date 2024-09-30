<?php

namespace App\Http\Controllers\admin;

use App\Models\Order;
use App\Models\Collection;
use App\Models\BasicInfo;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Expense;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseReturn;
use App\Models\Sales;
use App\Models\SalesReturn;
use App\Models\Supplier;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;

class DashboardController extends Controller
{
    public function index()
    {

        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();

        if (Auth::guard('admin')->user()->client_id == 0) {
            $client_id = Auth::guard('admin')->user()->id;
        } else {
            $client_id = $client->id;
        }

        $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
        $data['category'] = Category::where('client_id', $client_id)->count();
        $data['sub_category'] = Category::where('client_id', $client_id)->where('parent_cat_id', '!=', 0)->count();
        $data['product'] = Product::where('client_id', $client_id)->count();
        $data['customer'] = Vendor::where('client_id', $client_id)->count();
        $data['supplier'] = Supplier::where('client_id', $client_id)->count();
        $data['purchase'] = Purchase::where('client_id', $client_id)->sum('total_price');
        $data['purchase_return'] = PurchaseReturn::where('client_id', $client_id)->sum('total_return_amount');
        $data['sales'] = Sales::where('client_id', $client_id)->sum('sales_price');
        $data['sales_return'] = SalesReturn::where('client_id', $client_id)->sum('total_amount');
        $data['todaySales'] = Sales::where('client_id', $client_id)->where('date','like',"%". date('Y-m-d') ."%")->sum('sales_price');
        $data['todayPurchase'] = Purchase::where('client_id', $client_id)->where('date','like',"%". date('Y-m-d') ."%")->sum('total_price');
        $data['expense'] = Expense::where('client_id', $client_id)->sum('total_amount');

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

