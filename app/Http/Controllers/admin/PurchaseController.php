<?php

namespace App\Http\Controllers\admin;

use App\Models\Purchase;
use App\Models\PurchaseRequisition;
use App\Models\BasicInfo;
use App\Models\PaymentMethod;
use App\Models\Payment;
use App\Models\Supplier;
use App\Models\Item;
use App\Models\PurchaseDetails;
use App\Models\StockHistory;
use App\Models\SupplierLedger;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Vendor;
use App\Models\VendorLedger;
use Illuminate\Http\Request;
use Auth;

class PurchaseController extends Controller
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
        if ($id) {
            $data['title'] = 'Edit';
            $data['products'] = Purchase::find($id);
        } else {
            $data['title'] = 'Create';
        }

        $data['currency_symbol'] = BasicInfo::first()->currency_symbol;

        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        if (Auth::guard('admin')->user()->client_id == 0) {
            $data['paymentMethods'] = PaymentMethod::where('client_id', Auth::guard('admin')->user()->id)->orderBy('title', 'asc')->get();
            $data['vendors'] = Vendor::where('client_id', Auth::guard('admin')->user()->id)->where('status', 1)->orderBy('name', 'asc')->get();
            $data['products'] = Product::where('client_id', Auth::guard('admin')->user()->id)->with('unit')->where('status', 1)->orderBy('product_name', 'asc')->get();
        } else {
            $data['paymentMethods'] = PaymentMethod::where('client_id', $client->id)->orderBy('title', 'asc')->get();
            $data['vendors'] = Vendor::where('client_id', $client->id)->where('status', 1)->orderBy('name', 'asc')->get();
            $data['products'] = Product::where('client_id', $client->id)->with('unit')->where('status', 1)->orderBy('product_name', 'asc')->get();
        }

        return view('admin.purchases.create-or-edit', compact('data'));
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

    public function store(Request $request)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();

        if (Auth::guard('admin')->user()->client_id == 0) {
            $client_id = Auth::guard('admin')->user()->id;
        } else {
            $client_id = $client->id;
        }

        $vendor_id = $request->vendor_id;
        $date = $request->date;
        $total = $request->total;
        $tax_amount = $request->tax_amount;
        $discount_amount = $request->discount_amount;
        $total_payable = $request->total_payable;
        $paid_amount = $request->paid_amount;
        $note = $request->note;
        $payment_id = $request->payment_method_id;

        $product_id = $request->product_id;
        $unit_price = $request->unit_price;
        $quantity = $request->quantity;

        $vouchar_no = $this->formatSrl(Purchase::latest()->limit(1)->max('vouchar_no') + 1);
        $created_by_id = Auth::guard('admin')->user()->id;

        //Purchase create*****
        $purchase = new Purchase();
        $purchase->client_id = $client_id;
        $purchase->vendor_id = $vendor_id;
        $purchase->vouchar_no = $vouchar_no;
        $purchase->date = $date;
        $purchase->total_price = $total;
        $purchase->vat_tax = $tax_amount;
        $purchase->discount = $discount_amount;
        $purchase->total_payable = $total_payable;
        $purchase->paid_amount = $paid_amount;
        $purchase->note = $note;
        $purchase->payment_status = ($total_payable == $paid_amount ? 1 : 0);
        $purchase->status = 1;
        $purchase->created_by_id = $created_by_id;
        $purchase->save();
        //End*****

        for ($i = 0; $i < count($product_id); $i++) {
            //Purchase Details create*****
            $purchaseDetails = new PurchaseDetails();
            $purchaseDetails->purchase_id = $purchase->id;
            $purchaseDetails->product_id = $product_id[$i];
            $purchaseDetails->quantity = $quantity[$i];
            $purchaseDetails->unit_price = $unit_price[$i];
            $purchaseDetails->total_amount = $unit_price[$i] * $quantity[$i];
            $purchaseDetails->save();
            //End*****

            //Item Stock Update****
            $stock = Stock::find($product_id[$i]);
            $stock->stock_quantity = $stock->stock_quantity + $quantity[$i];
            $stock->updated_date = date('Y-m-d');
            $stock->save();
            //End*****
        }

        //Supplier Ledger Purchase Create**********
        $vendorledger = new VendorLedger();
        $vendorledger->client_id = $client_id;
        $vendorledger->vendor_id = $vendor_id;
        $vendorledger->purchase_id = $purchase->id;
        $vendorledger->payment_id = $payment_id;
        $vendorledger->particular = 'Purchase';
        $vendorledger->date = $date;
        $vendorledger->credit_amount = $total_payable;
        $vendorledger->note = $note;
        $vendorledger->status = 1;
        $vendorledger->created_by_id = $created_by_id;
        $vendorledger->save();
        //End*****

        if ($paid_amount) {
            //Payment Create**********
            $payment = new Payment();
            $payment->client_id = $client_id;
            $payment->vendor_id = $vendor_id;
            $payment->payment_method_id = $request->payment_method_id;
            $payment->purchase_id = $purchase->id;
            $payment->date = $date;
            $payment->amount = $paid_amount;
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
            $vendorledger->debit_amount = $paid_amount;
            $vendorledger->note = $note;
            $vendorledger->status = 1;
            $vendorledger->created_by_id = $created_by_id;
            $vendorledger->save();
            //End*****
        }

        //Supplier Balance Update****
        $vendor = Vendor::find($vendor_id);
        $vendor->current_balance = $vendor->current_balance + ((float) $total_payable -  (float) $paid_amount);
        $vendor->save();
        //End*****

        return redirect()->route('purchases.index')->with('alert', ['messageType' => 'success', 'message' => 'Data Inserted Successfully!']);
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
    // public function purchaseRequisition($vouchar_no)
    // {
    //     $data = PurchaseRequisition::with(['prdetails.item.unit'])->where('vouchar_no', '=', $this->formatNumber($vouchar_no))->first();
    //     if ($data) {
    //         $data->toArray();
    //     }
    //     return response()->json($data, 200);
    // }
    // public function formatNumber($number)
    // {
    //     return str_pad($number, 7, '0', STR_PAD_LEFT);
    // }
}
