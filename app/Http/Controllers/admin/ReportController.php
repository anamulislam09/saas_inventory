<?php

namespace App\Http\Controllers\admin;

use App\Models\BasicInfo;
use App\Models\Collection;
use App\Models\Admin;
use App\Models\StockHistory;
use App\Models\Supplier;
use App\Models\SupplierLedger;
use App\Models\Item;
use App\Models\Unit;
use App\Models\Purchase;

use App\Models\Order;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\VendorLedger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ReportController extends Controller
{
    public function collections(Request $request)
    {
        $user_ids = Collection::groupBy('created_by_id')->pluck('created_by_id');
        if ($request->isMethod('post')) {
            $created_by_id = $request->created_by_id;
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            $collections = Collection::query();
            if ($from_date && $to_date) {
                $collections = $collections->whereDate('collections.created_at', '>=', $from_date)->whereDate('collections.created_at', '<=', $to_date);
            } else if ($from_date) {
                $collections = $collections->whereDate('collections.created_at', '=', $from_date);
            }
            if ($created_by_id != 0) {
                $collections = $collections->where('created_by_id', $created_by_id);
                $data['collections'] = $collections->orderBy('order_no', 'asc')->get();
            } else {
                $data['collections'] = $collections->join('admins', 'admins.id', '=', 'collections.created_by_id')->groupBy('created_by_id')
                    ->select('admins.id', 'admins.name', DB::raw('SUM(`paid_amount`) as total_collection_amount'))
                    ->get();
            }
            $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
            return response()->json($data, 200);
        } else {
            $data['users'] = Admin::whereIn('id', $user_ids)->where('status', 1)->orderBy('name', 'asc')->get();
            return view('admin.reports.collections', compact('data'));
        }
    }
    public function purchase(Request $request)
    {
        if ($request->isMethod('post')) {
            $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
            $vendor_id = $request->vendor_id;
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            $purchase = Purchase::query();
            if ($vendor_id) {
                $purchase = $purchase->where('vendor_id', $vendor_id);
            } else {
                $purchase = $purchase->with(['vendor']);
            }
            if ($from_date && $to_date) {
                $purchase->whereBetween('date', [$from_date, $to_date]);
            } elseif ($from_date) {
                $purchase->where('date', '=', $from_date);
            }
            $data['purchase'] = $purchase->get();
            return response()->json($data, 200);
        } else {
            $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
            if (Auth::guard('admin')->user()->client_id == 0) {
                $data['vendors'] = Vendor::where('client_id', Auth::guard('admin')->user()->id)->where('status', 1)->orderBy('name', 'asc')->get();
            } else {
                $data['vendors'] = Vendor::where('client_id', $client->id)->where('status', 1)->orderBy('name', 'asc')->get();
            }
            return view('admin.reports.purchase', compact('data'));
        }
    }
    public function sales(Request $request)
    {
        if ($request->isMethod('post')) {
            $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
            $created_by_id = $request->created_by_id;
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            $orders = Order::where('order_status', 5);
            if ($created_by_id) {
                $orders = $orders->where(['created_by_id' => $created_by_id]);
            } else {
                $orders = $orders->with(['admin']);
            }
            if ($from_date && $to_date) {
                $orders = $orders->whereBetween('created_at', [$from_date, $to_date]);
            } elseif ($from_date) {
                $orders = $orders->whereDate('created_at', '=', $from_date);
            }
            $data['orders'] = $orders->get();
            return response()->json($data, 200);
        } else {
            $created_by_ids = Order::groupBy('created_by_id')->pluck('created_by_id')->toArray();
            $data['admins'] = Admin::whereIn('id', $created_by_ids)->where('status', 1)->orderBy('name', 'asc')->get();
            return view('admin.reports.sales', compact('data'));
        }
    }


    public function stocks(Request $request)
    {
        // if ($request->isMethod('post')) {
        //     $product_id = $request->product_id;
        //     $from_date = $request->from_date;
        //     $to_date = $request->to_date;
        //     $data = [];

        //     if ($product_id != 0) {
        //         $stockHistory = StockHistory::query()->where('product_id', $product_id);

        //         if ($from_date && $to_date) {
        //             $stockHistory->whereBetween('date', [$from_date, $to_date]);
        //         } elseif ($from_date) {
        //             $stockHistory->where('date', '>=', $from_date);
        //         }

        //         $data['stockHistory'] = $stockHistory->orderBy('id', 'asc')->get();
        //         $data['unit'] = Product::find($product_id)->unit->title;
        //     } else {
        //         $data['stockHistory'] = Product::with('unit')
        //             ->where('status', 1)
        //             ->orderBy('product_name', 'asc')
        //             ->get();
        //     }
        //     return response()->json($data, 200);
        // } else {
        $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
        $data['products'] = Product::where('status', 1)
            ->orderBy('product_name', 'asc')
            ->get();
        return view('admin.reports.stocks', compact('data'));
        // }
    }

    public function vendorLedgers(Request $request)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        if ($request->isMethod('post')) {
            $vendor_id = $request->vendor_id;
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            if ($vendor_id == 0) {

                if (Auth::guard('admin')->user()->client_id == 0) {
                    $data['vendorLedger'] = Vendor::where('client_id', Auth::guard('admin')->user()->id)->where('status', 1)->get();
                } else {
                    $data['vendorLedger'] = Vendor::where('client_id', $client->id)->where('status', 1)->get();
                }
            } else {
                $data['previous_balance'] = 0;
                $vendorLedger = VendorLedger::query()->where('vendor_id', $vendor_id);
                if ($from_date && $to_date) {
                    $vendorLedger = $vendorLedger->whereBetween('date', [$from_date, $to_date]);
                } else {
                    if ($from_date) {
                        $vendorLedger = $vendorLedger->where('date', '>=', $from_date);
                    }
                }
                if ($from_date) {
                    $vendorLedger_previous = vendorLedger::where('vendor_id', $vendor_id)->where('date', '<', $from_date)->get();
                    $prev_debit = $vendorLedger_previous->sum('debit_amount');
                    $prev_credit = $vendorLedger_previous->sum('credit_amount');
                    $data['previous_balance'] = $prev_credit - $prev_debit;
                }
                $data['vendorLedger'] = $vendorLedger->with('purchase')->orderBy('id', 'asc')->get();
            }
            $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
            return response()->json($data, 200);
        }
        if (Auth::guard('admin')->user()->client_id == 0) {
            $data['vendors'] = Vendor::where('client_id', Auth::guard('admin')->user()->id)->where('status', 1)->orderBy('name', 'asc')->get();
        } else {
            $data['vendors'] = Vendor::where('client_id', $client->id)->where('status', 1)->orderBy('name', 'asc')->get();
        }

        return view('admin.reports.supplier-ledgers', compact('data'));
    }
}
