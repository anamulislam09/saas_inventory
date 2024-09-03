<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\BasicInfo;
use App\Models\Sales;
use App\Models\Sales_Details;
use App\Models\SalesReturn;
use App\Models\SalesReturnDetails;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesReturnController extends Controller
{
    public function index()
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        if (Auth::guard('admin')->user()->client_id == 0) {
            $data['salesReturns'] = SalesReturn::where('client_id', Auth::guard('admin')->user()->id)->with(['vendor', 'created_by'])->orderBy('id', 'desc')->get();
            $data['currency_symbol'] = BasicInfo::where('client_id', Auth::guard('admin')->user()->id)->first()->currency_symbol;
        } else {
            $data['salesReturns'] = SalesReturn::where('client_id', $client->id)->with(['vendor', 'created_by'])->orderBy('id', 'desc')->get();
            $data['currency_symbol'] = BasicInfo::where('client_id', $client->id)->first()->currency_symbol;
        }
        return view('admin.sales.sales_returns', compact('data'));
    }

    public function createOrEdit($id = null)
    {

        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        if (Auth::guard('admin')->user()->client_id == 0) {
            $data['sales'] = Sales::where('client_id', Auth::guard('admin')->user()->id)->with(['sales_details', 'created_by'])->find($id);
            $data['currency_symbol'] = BasicInfo::where('client_id', Auth::guard('admin')->user()->id)->first()->currency_symbol;
        } else {
            $data['sales'] = Sales::where('client_id', $client->id)->with(['sales_details', 'created_by'])->find($id);
            $data['currency_symbol'] = BasicInfo::where('client_id', $client->id)->first()->currency_symbol;
        }
        return view('admin.sales.sales_return_create', compact('data'));
    }

    public function vouchar($id, $print = null)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        if (Auth::guard('admin')->user()->client_id == 0) {
            $data['salesReturn'] = SalesReturn::where('client_id', Auth::guard('admin')->user()->id)->with(['sales_return_details', 'vendor', 'created_by'])->find($id);
            $data['basicInfo'] = BasicInfo::where('client_id', Auth::guard('admin')->user()->id)->first();
        } else {
            $data['salesReturn'] = SalesReturn::where('client_id', $client->id)->with(['sales_return_details', 'vendor', 'created_by'])->find($id);
            $data['basicInfo'] = BasicInfo::where('client_id', $client->id)->first();
        }
        $data['currency_symbol'] = $data['basicInfo']->currency_symbol;
        $data['print'] = $print;

        return view('admin.sales.sales_return_details', compact('data'));
    }

    public function returnsales(Request $request)
    {
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : Admin::where('id', Auth::guard('admin')->user()->client_id)->first()->id;

        $sales_id = $request->sales_id;
        $sales = Sales::where('id', $sales_id)->first();
        $date = $request->date;
        $note = $request->note;
        $total_return_amount = $request->total_return_amount;
        $refund_amount = $request->refund_amount;
        $created_by_id = Auth::guard('admin')->user()->id;
        $invoice_no = $this->formatSrl(SalesReturn::latest()->limit(1)->max('invoice_no') + 1);

        // Create Purchase Return Entry
        $salesReturn = new SalesReturn();
        $salesReturn->client_id = $client_id;
        $salesReturn->vendor_id = $sales->vendor_id;
        $salesReturn->invoice_no = $invoice_no;
        $salesReturn->sales_id = $sales_id;
        $salesReturn->date = $date;
        $salesReturn->total_amount = $total_return_amount;
        $salesReturn->note = $note;
        $salesReturn->refund_amount = $refund_amount;
        $salesReturn->return_status = ($total_return_amount <= $refund_amount) ? 1 : 0;
        $salesReturn->created_by_id = $created_by_id;
        $salesReturn->save();

        // Loop through products and adjust stock
        foreach ($request->product_id as $index => $productId) {
            $originalQty = $request->original_quantity[$index];
            $returnQty = $request->return_quantity[$index];
            $remainingQty = $originalQty - $returnQty;

            // Create Purchase Return Details
            $salesReturnDetails = new SalesReturnDetails();
            $salesReturnDetails->sales_return_id = $salesReturn->id;
            $salesReturnDetails->client_id = $client_id;
            $salesReturnDetails->product_id = $productId;
            $salesReturnDetails->quantity_returned = $returnQty;
            $salesReturnDetails->unit_price = $request->unit_price[$index];
            $salesReturnDetails->amount = $request->return_total[$index];
            $salesReturnDetails->created_by_id = Auth::guard('admin')->user()->id;
            $salesReturnDetails->save();

            // Update Purchase Details
            $purchaseDetail = Sales_Details::where('sales_id', $sales_id)->where('product_id', $productId)->first();
            $purchaseDetail->quantity = $remainingQty;
            $purchaseDetail->save();

            // Update Stock
            $stock = Stock::find($productId);
            $stock->stock_quantity += $returnQty;
            $stock->save();
        }
        return redirect()->route('sales-return.index')->with('alert', ['messageType' => 'success', 'message' => 'Sales Return Processed Successfully!']);
    }

    public function formatSrl($srl)
    {
        switch (strlen($srl)) {
            case 1:
                $zeros = '000000';
                break;
            case 2:
                $zeros = '00000';
                break;
            case 3:
                $zeros = '0000';
                break;
            case 4:
                $zeros = '000';
                break;
            case 5:
                $zeros = '00';
                break;
            default:
                $zeros = '0';
                break;
        }
        return $zeros . $srl;
    }

}
