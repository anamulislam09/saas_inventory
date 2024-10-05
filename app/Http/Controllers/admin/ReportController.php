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
use App\Models\Sales;
use App\Models\Vendor;
use App\Models\VendorLedger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ReportController extends Controller
{
    public function collections(Request $request)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
    
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;
    
        // If POST method, handle the form submission
        if ($request->isMethod('post')) {
            $customer_id = $request->customer_id;
            $from_date = $request->from_date;
            $to_date = $request->to_date;
    
            // Base query for collections
            $collections = Collection::where('collections.client_id', $client_id)
                ->leftJoin('vendors', 'vendors.id', '=', 'collections.vendor_id')
                ->select('collections.*', 'vendors.name as vendor_name');
    
            // Apply date filters
            if ($from_date && $to_date) {
                $collections = $collections->whereDate('collections.date', '>=', $from_date)
                    ->whereDate('collections.date', '<=', $to_date);
            } elseif ($from_date) {
                $collections = $collections->whereDate('collections.date', '=', $from_date);
            }
    
            // Handle the case for specific customers
            if ($customer_id != 0) {
                // If a specific customer is selected
                $collections = $collections->where('collections.vendor_id', $customer_id);
                $data['collections'] = $collections->orderBy('collections.date', 'asc')->get();
            } else {
                // If "All Customers" is selected, handle both grouped and ungrouped collections
                $collectionsResult = $collections->get();
    
                // Group collections by vendor_id and sum total collections
                $collectionsWithVendor = $collectionsResult->whereNotNull('vendor_id')
                    ->groupBy('vendor_id')
                    ->map(function ($group) {
                        return [
                            'vendor_name' => $group->first()->vendor_name,
                            'total_collection' => $group->sum('total_collection'),
                            // 'total_collection_amount' => $group->sum('total_collection'),
                        ];
                    });
    
                // Handle collections without vendor_id
                $collectionsWithoutVendor = $collectionsResult->filter(function ($item) {
                    return is_null($item->vendor_id);
                });
    
                $data['collections_with_vendor'] = $collectionsWithVendor;
                $data['collections_without_vendor'] = $collectionsWithoutVendor;
            }
    
            // Add currency symbol
            $data['currency_symbol'] = BasicInfo::where('client_id', $client_id)->first()->currency_symbol;
            return response()->json($data, 200);
        }
    
        // GET request: Load customer list and render view
        $data['customers'] = Vendor::where('status', 1)
            ->orderBy('name', 'asc')
            ->get();
    
        // Fetch all collections for initial load (default data without filters)
        $collections = Collection::where('collections.client_id', $client_id)
            ->leftJoin('vendors', 'vendors.id', '=', 'collections.vendor_id')
            ->select('collections.*', 'vendors.name as vendor_name')
            ->orderBy('collections.date', 'asc')
            ->get();
    
        $data['collections'] = $collections;
    
        return view('admin.reports.collections', compact('data'));
    }
    
    
    

    public function purchase(Request $request)
    {
        $user = Auth::guard('admin')->user();
        $client = Admin::find($user->client_id);

        if ($request->isMethod('post')) {
            // Get currency symbol
            $data['currency_symbol'] = BasicInfo::where('client_id', ($user->client_id == 0) ? $user->id : $client->id)->first()->currency_symbol;

            // Start purchase query
            $supplier_id = $request->supplier_id;
            $from_date = $request->from_date;
            $to_date = $request->to_date;

            $purchase = Purchase::with(['supplier'])
                ->where('client_id', ($user->client_id == 0) ? $user->id : $client->id);

            // Filter by supplier if provided
            if ($supplier_id) {
                $purchase->where('supplier_id', $supplier_id);
            }

            // Filter by date range
            if ($from_date && $to_date) {
                $purchase->whereBetween('date', [$from_date, $to_date]);
            } elseif ($from_date) {
                $purchase->where('date', '=', $from_date);
            }

            // Fetch purchases
            $data['purchase'] = $purchase->get();

            return response()->json($data, 200);
        } else {
            // Fetch client suppliers
            $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
            if (Auth::guard('admin')->user()->client_id == 0) {
                $data['suppliers'] = Supplier::where('client_id', Auth::guard('admin')->user()->id)
                    ->where('status', 1)
                    ->orderBy('name', 'asc')
                    ->get();
            } else {
                $data['suppliers'] = Supplier::where('client_id', $client->id)
                    ->where('status', 1)
                    ->orderBy('name', 'asc')
                    ->get();
            }

            return view('admin.reports.purchase', compact('data'));
        }
    }


    public function sales(Request $request)
    {
        $user = Auth::guard('admin')->user();
        $client = Admin::find($user->client_id);

        if ($request->isMethod('post')) {
            // Fetch currency symbol
            $data['currency_symbol'] = BasicInfo::where('client_id', ($user->client_id == 0) ? $user->id : $client->id)->first()->currency_symbol;

            // Start sales query
            $vendor_id = $request->vendor_id;
            $from_date = $request->from_date;
            $to_date = $request->to_date;

            $sales = Sales::with(['vendor'])
                ->where('client_id', ($user->client_id == 0) ? $user->id : $client->id);

            // Filter by vendor if provided
            if ($vendor_id) {
                $sales->where('vendor_id', $vendor_id);
            }

            // Filter by date range
            if ($from_date && $to_date) {
                $sales->whereBetween('date', [$from_date, $to_date]);
            } elseif ($from_date) {
                $sales->where('date', '=', $from_date);
            }

            // Fetch sales data
            $data['sales'] = $sales->get();
            // dd($data);

            return response()->json($data, 200);
        } else {
            // Fetch client vendors
            $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
            if (Auth::guard('admin')->user()->client_id == 0) {
                $data['vendors'] = Vendor::where('client_id', Auth::guard('admin')->user()->id)
                    ->where('status', 1)
                    ->orderBy('name', 'asc')
                    ->get();
            } else {
                $data['vendors'] = Vendor::where('client_id', $client->id)
                    ->where('status', 1)
                    ->orderBy('name', 'asc')
                    ->get();
            }

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
        $user = Auth::guard('admin')->user();
        $client = Admin::find($user->client_id);
        $data['currency_symbol'] = BasicInfo::where('client_id', $user->client_id == 0 ? $user->id : $client->id)->first()->currency_symbol;
        $data['products'] = Product::where('client_id', $user->client_id == 0 ? $user->id : $client->id)->where('status', 1)
            ->orderBy('product_name', 'asc')
            ->get();
        return view('admin.reports.stocks', compact('data'));
        // }
    }

    public function ledger(Request $request)
    {
        $user = Auth::guard('admin')->user();
        $client = Admin::find($user->client_id);

        if ($request->isMethod('post')) {
            // Fetch currency symbol
            $data['currency_symbol'] = BasicInfo::where('client_id', ($user->client_id == 0) ? $user->id : $client->id)->first()->currency_symbol;

            // Start ledger query
            $from_date = $request->from_date;
            $to_date = $request->to_date;

            $sales = Sales::where('client_id', ($user->client_id == 0) ? $user->id : $client->id);

            // Filter by date range
            if ($from_date && $to_date) {
                $sales->whereBetween('date', [$from_date, $to_date]);
            } elseif ($from_date) {
                $sales->where('date', '=', $from_date);
            }

            // Fetch sales data
            $data['sales'] = $sales->get();

            return response()->json($data, 200);
        } else {
            return view('admin.reports.ledger');
        }
    }


    public function customerLedgers(Request $request)
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

        return view('admin.reports.customer-ledgers', compact('data'));
    }
}
