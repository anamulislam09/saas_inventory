<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\BasicInfo;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Models\PurchaseReturn;
use App\Models\PurchaseReturnDetails;
use App\Models\Stock;
use App\Models\Vendor;
use App\Models\VendorLedger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseReturnController extends Controller
{
    public function index()
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        if (Auth::guard('admin')->user()->client_id == 0) {
            $data['purchases'] = Purchase::where('client_id', Auth::guard('admin')->user()->id)->with(['vendor', 'created_by'])->orderBy('id', 'desc')->get();
            $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
            $data['paymentMethods'] = PaymentMethod::where('client_id', Auth::guard('admin')->user()->id)->orderBy('title', 'asc')->get();
        } else {
            $data['purchases'] = Purchase::where('client_id', $client->id)->with(['vendor', 'created_by'])->orderBy('id', 'desc')->get();
            $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
            $data['paymentMethods'] = PaymentMethod::where('client_id', $client->id)->orderBy('title', 'asc')->get();
        }

        return view('admin.purchases.index', compact('data'));
    }

    public function createOrEdit($id = null)
    {
        $data['currency_symbol'] = BasicInfo::first()->currency_symbol;

        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        if (Auth::guard('admin')->user()->client_id == 0) {
            // $data['paymentMethods'] = PaymentMethod::where('client_id', Auth::guard('admin')->user()->id)->orderBy('title', 'asc')->get();
            $data['purchase'] = Purchase::where('client_id', Auth::guard('admin')->user()->id)->with(['purchase_details', 'supplier', 'created_by', 'payments'])->find($id);
        } else {
            // $data['purchase'] = PaymentMethod::where('client_id', $client->id)->orderBy('title', 'asc')->get();
            $data['purchase'] = Purchase::where('client_id', Auth::guard('admin')->user()->id)->with(['purchase_details', 'supplier', 'created_by', 'payments'])->find($id);
        }

        return view('admin.purchases.purchase_return_create', compact('data'));

    }
    public function vouchar($id, $print = null)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        if (Auth::guard('admin')->user()->client_id == 0) {
            $data['purchase'] = Purchase::where('client_id', Auth::guard('admin')->user()->id)->with(['purchase_details', 'vendor', 'created_by', 'payments'])->find($id);
        } else {
            $data['purchase'] = Purchase::where('client_id', $client->id)->with(['purchase_details', 'vendor', 'created_by', 'payments'])->find($id);
        }

        $data['basicInfo'] = BasicInfo::first();
        $data['currency_symbol'] = $data['basicInfo']->currency_symbol;
        $data['print'] = $print;
        return view('admin.purchases.view', compact('data'));
    }
    public function payment(Request $request)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();

        if (Auth::guard('admin')->user()->client_id == 0) {
            $client_id = Auth::guard('admin')->user()->id;
        } else {
            $client_id = $client->id;
        }

        $purchase_id = $request->purchase_id;
        $date = $request->date;
        $payment_method_id = $request->payment_method_id;
        $amount = $request->amount;
        $note = $request->note;
        $created_by_id = Auth::guard('admin')->user()->id;
        $purchase = Purchase::find($request->purchase_id);
        $vendor_id = $purchase->vendor_id;

        //Payment Create**********
        $payment = new Payment();
        $payment->client_id = $client_id;
        $payment->vendor_id = $vendor_id;
        $payment->payment_method_id = $payment_method_id;
        $payment->purchase_id = $purchase_id;
        $payment->date = $date;
        $payment->amount = $amount;
        $payment->note = $note;
        $payment->status = 1;
        $payment->created_by_id = $created_by_id;
        $payment->save();
        //End*****

        //Supplier Ledger Payment Create**********
        $vendorledger = new VendorLedger();
        $vendorledger->vendor_id = $vendor_id;
        $vendorledger->payment_id = $payment->id;
        $vendorledger->particular = 'Paid To Vendor';
        $vendorledger->date = $date;
        $vendorledger->debit_amount = $amount;
        $vendorledger->note = $note;
        $vendorledger->status = 1;
        $vendorledger->created_by_id = $created_by_id;
        $vendorledger->save();
        //End*****

        //Supplier Balance Update****
        $vendor = Vendor::find($vendor_id);
        $vendor->current_balance = $vendor->current_balance - $amount;
        $vendor->save();
        //End*****

        //Vouchar Update****
        $purchase->paid_amount = $purchase->paid_amount + $amount;
        $purchase->payment_status = ($purchase->total_payable <= $purchase->paid_amount) ? 1 : 0;
        $purchase->save();
        //End*****

        return redirect()->back()->with('alert', ['messageType' => 'success', 'message' => 'Data Inserted Successfully!']);
    }

    public function returnPurchase(Request $request)
    {
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : Admin::where('id', Auth::guard('admin')->user()->client_id)->first()->id;
        
        $purchase_id = $request->purchase_id;
        $purchase = Purchase::where('id', $purchase_id)->first();
        $date = $request->date;
        $note = $request->note;
        $total_return_amount = $request->total_return_amount;
        $refund_amount = $request->refund_amount;
        $created_by_id = Auth::guard('admin')->user()->id;
        $vouchar_no = $this->formatSrl(PurchaseReturn::latest()->limit(1)->max('vouchar_no') + 1);
    
        // Create Purchase Return Entry
        $purchaseReturn = new PurchaseReturn();
        $purchaseReturn->client_id = $client_id;
        $purchaseReturn->supplier_id = $purchase->supplier_id;
        $purchaseReturn->vouchar_no = $vouchar_no;
        $purchaseReturn->purchase_id = $purchase_id;
        $purchaseReturn->date = $date;
        $purchaseReturn->total_return_amount = $total_return_amount;
        $purchaseReturn->note = $note;
        $purchaseReturn->refund_amount = $refund_amount;
        $purchaseReturn->return_status = ($total_return_amount <= $refund_amount) ? 1 : 0;
        $purchaseReturn->created_by_id = $created_by_id;
        $purchaseReturn->save();
    
        // Loop through products and adjust stock
        foreach ($request->product_id as $index => $productId) {
            $originalQty = $request->original_quantity[$index];
            $returnQty = $request->return_quantity[$index];
            $remainingQty = $originalQty - $returnQty;
    
            // Create Purchase Return Details
            $purchaseReturnDetails = new PurchaseReturnDetails();
            $purchaseReturnDetails->purchase_return_id = $purchaseReturn->id;
            $purchaseReturnDetails->client_id = $client_id;
            $purchaseReturnDetails->product_id = $productId;
            $purchaseReturnDetails->quantity_returned = $returnQty;
            $purchaseReturnDetails->unit_price = $request->unit_price[$index];
            $purchaseReturnDetails->amount = $request->return_total[$index];
            $purchaseReturnDetails->created_by_id = Auth::guard('admin')->user()->id;
            $purchaseReturnDetails->save();
    
            // Update Purchase Details
            $purchaseDetail = PurchaseDetails::where('purchase_id', $purchase_id)->where('product_id', $productId)->first();
            $purchaseDetail->quantity = $remainingQty;
            $purchaseDetail->save();
    
            // Update Stock
            $stock = Stock::find($productId);
            $stock->stock_quantity -= $returnQty;
            $stock->save();
        }
    
        // Update Supplier Ledger, Supplier Balance, etc.
        // (additional code to handle refund and supplier balance update)
    
        return redirect()->route('purchases.index')->with('alert', ['messageType' => 'success', 'message' => 'Purchase Return Processed Successfully!']);
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
    public function destroy(Request $request)
    {
        $payment_id = $request->payment_id;
        $purchase_id = $request->purchase_id;
        $payment = Payment::find($payment_id);
        $vendor_id = $payment->vendor_id;

        //Vouchar Update****
        $purchase = Purchase::find($purchase_id);
        $purchase->paid_amount = $purchase->paid_amount - $payment->amount;
        $purchase->payment_status = ($purchase->total_payable <= $purchase->paid_amount) ? 1 : 0;
        $purchase->save();
        //End*****

        //Supplier Balance Update****
        $vendor = Vendor::find($vendor_id);
        $vendor->current_balance = $vendor->current_balance + $payment->amount;
        $vendor->save();
        //End*****

        //Supplier Ledger Payment Destroy**********
        VendorLedger::where('payment_id', $payment_id)->delete();
        //End*****

        //Payment Destroy**********
        $payment->delete();
        //End*****

        return redirect()->back()->with('alert', ['messageType' => 'success', 'message' => 'Data Deleted Successfully!']);
    }
}
