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
use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    public function collections(Request $request)
    {
        $user_ids = Collection::groupBy('created_by_id')->pluck('created_by_id');
        if($request->isMethod('post')){
            $created_by_id = $request->created_by_id;
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            $collections = Collection::query();
            if($from_date && $to_date){
                $collections = $collections->whereDate('collections.created_at','>=',$from_date)->whereDate('collections.created_at','<=',$to_date);
            }else if ($from_date) {
                $collections = $collections->whereDate('collections.created_at', '=', $from_date);
            }
            if($created_by_id!=0){
                $collections = $collections->where('created_by_id', $created_by_id);
                $data['collections'] = $collections->orderBy('order_no','asc')->get();
            }else{
                $data['collections'] = $collections->join('admins','admins.id','=', 'collections.created_by_id')->groupBy('created_by_id')
                                   ->select('admins.id','admins.name', DB::raw('SUM(`paid_amount`) as total_collection_amount'))
                                   ->get();
            }
            $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
            return response()->json($data, 200);

        }else{
            $data['users'] = Admin::whereIn('id', $user_ids)->where('status',1)->orderBy('name','asc')->get();
            return view('admin.reports.collections', compact('data'));
        }
    }
    public function purchase(Request $request)
    {
        if($request->isMethod('post')){
            $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
            $supplier_id = $request->supplier_id;
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            $purchase = Purchase::query();
            if($supplier_id){
                $purchase = $purchase->where('supplier_id', $supplier_id);
            }else{
                $purchase = $purchase->with(['supplier']);
            }
            if ($from_date && $to_date) {
                $purchase->whereBetween('date', [$from_date, $to_date]);
            } elseif ($from_date) {
                $purchase->where('date', '=', $from_date);
            }
            $data['purchase'] = $purchase->get();
            return response()->json($data, 200);
        }else{
            $data['suppliers'] = Supplier::where('status',1)->orderBy('name','asc')->get();
            return view('admin.reports.purchase', compact('data'));
        }
    }
    public function sales(Request $request)
    {
        if($request->isMethod('post')){
            $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
            $created_by_id = $request->created_by_id;
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            $orders = Order::where('order_status',5);
            if($created_by_id){
                $orders = $orders->where(['created_by_id'=> $created_by_id]);
            }else{
                $orders = $orders->with(['admin']);
            }
            if ($from_date && $to_date) {
                $orders = $orders->whereBetween('created_at', [$from_date, $to_date]);
            } elseif ($from_date) {
                $orders = $orders->whereDate('created_at', '=', $from_date);
            }
            $data['orders'] = $orders->get();
            return response()->json($data, 200);
        }else{
            $created_by_ids = Order::groupBy('created_by_id')->pluck('created_by_id')->toArray();
            $data['admins'] = Admin::whereIn('id', $created_by_ids)->where('status',1)->orderBy('name','asc')->get();
            return view('admin.reports.sales', compact('data'));
        }
    }


    public function stocks(Request $request)
    {
        if ($request->isMethod('post')) {
            $item_id = $request->item_id;
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            $data = [];

            if ($item_id != 0) {
                $stockHistory = StockHistory::query()->where('item_id', $item_id);

                if ($from_date && $to_date) {
                    $stockHistory->whereBetween('date', [$from_date, $to_date]);
                } elseif ($from_date) {
                    $stockHistory->where('date', '>=', $from_date);
                }

                $data['stockHistory'] = $stockHistory->orderBy('id', 'asc')->get();
                $data['unit'] = Item::find($item_id)->unit->title;
            } else {
                $data['stockHistory'] = Item::with('unit')
                    ->where('status', 1)
                    ->whereIn('cat_type_id', [1, 3])
                    ->orderBy('title', 'asc')
                    ->get();
            }
            return response()->json($data, 200);
        } else {
            $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
            $data['items'] = Item::where('status', 1)
                ->whereIn('cat_type_id', [1, 3])
                ->orderBy('title', 'asc')
                ->get();
            return view('admin.reports.stocks', compact('data'));
        }
    }

    public function supplierLedgers(Request $request)
    {
        if($request->isMethod('post')){
            $supplier_id = $request->supplier_id;
            $from_date = $request->from_date;
            $to_date = $request->to_date;
           if($supplier_id==0){
                $data['supplierLedger'] = Supplier::where('status',1)->get();
           }else{
                $data['previous_balance'] = 0;
                $supplierLedger = SupplierLedger::query()->where('supplier_id', $supplier_id);
                if($from_date && $to_date){
                    $supplierLedger = $supplierLedger->whereBetween('date',[$from_date,$to_date]);
                }else{
                    if($from_date){
                        $supplierLedger = $supplierLedger->where('date','>=',$from_date);
                    }
                }
                if($from_date){
                    $supplierLedger_previous = SupplierLedger::where('supplier_id', $supplier_id)->where('date','<',$from_date)->get();
                    $prev_debit = $supplierLedger_previous->sum('debit_amount');
                    $prev_credit = $supplierLedger_previous->sum('credit_amount');
                    $data['previous_balance'] = $prev_credit - $prev_debit;
                }
                $data['supplierLedger'] = $supplierLedger->with('purchase')->orderBy('id','asc')->get();
           }
           $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
           return response()->json($data, 200);
        }
        $data['suppliers'] = Supplier::where('status',1)->orderBy('name','asc')->get();
        return view('admin.reports.supplier-ledgers', compact('data'));
    }
}
