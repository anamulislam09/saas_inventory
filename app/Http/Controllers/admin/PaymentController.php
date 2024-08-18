<?php

namespace App\Http\Controllers\admin;

use App\Models\Purchase;
use App\Models\BasicInfo;
use App\Models\PaymentMethod;
use App\Models\Payment;
use App\Models\Supplier;
use App\Models\Item;
use App\Models\PurchaseDetails;
use App\Models\SupplierLedger;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $data['payments'] = Payment::orderBy('id', 'desc')->get();
        $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
        return view('admin.payments.index', compact('data'));
    }

    public function createOrEdit($id=null)
    {
        if($id){
            $data['title'] = 'Edit';
        }else{
            $data['title'] = 'Create';
        }
        $data['paymentMethods'] = PaymentMethod::orderBy('title','asc')->get();
        $data['suppliers'] = Supplier::orderBy('name','asc')->get();


        $data['purchases'] = Purchase::where('payment_status',0)->orderBy('date', 'asc')->get();
        $data['currency_symbol'] = BasicInfo::first()->currency_symbol;

        return view('admin.payments.create-or-edit',compact('data'));
    }

    public function store(Request $request)
    {
        $purchase_id = $request->purchase_id;
        $date = $request->date;
        $supplier_id = $request->supplier_id;
        $payment_method_id = $request->payment_method_id;
        $amount = $request->amount;
        $paid_in_advanced = $request->paid_in_advanced;
        $paid_amount = $request->paid_amount;
        $pay_it = $request->pay_it;
        $note = $request->note;
        $created_by_id = Auth::guard('admin')->user()->id;
        
        if(isset($purchase_id)){
            for ($i=0; $i < count($purchase_id); $i++) {
                if($paid_amount[$i]){
                    //Payment Create**********
                    $payment = new Payment();
                    $payment->supplier_id = $supplier_id;
                    $payment->payment_method_id = $payment_method_id;
                    $payment->purchase_id = $purchase_id[$i];
                    $payment->date = $date;
                    $payment->amount = $paid_amount[$i];
                    $payment->note = $note;
                    $payment->status = 1;
                    $payment->created_by_id = $created_by_id;
                    $payment->save();
                    //End*****

                    //Supplier Ledger Payment Create**********
                    $supplierLedger = new SupplierLedger();
                    $supplierLedger->supplier_id = $supplier_id;
                    $supplierLedger->payment_id = $payment->id;
                    $supplierLedger->particular = 'Paid To Supplier';
                    $supplierLedger->date = $date;
                    $supplierLedger->debit_amount = $paid_amount[$i];
                    $supplierLedger->note = $note;
                    $supplierLedger->status = 1;
                    $supplierLedger->created_by_id = $created_by_id;
                    $supplierLedger->save();
                    //End*****

                    //Supplier Balance Update****
                    $supplier = Supplier::find($supplier_id);
                    $supplier->current_balance = $supplier->current_balance - $paid_amount[$i];
                    $supplier->save();
                    //End*****
                    
                    //Vouchar Update****
                    $purchase = Purchase::find($purchase_id[$i]);
                    $purchase->paid_amount = $purchase->paid_amount + $paid_amount[$i];
                    $purchase->payment_status = ($purchase->total_payable <= $purchase->paid_amount)? 1 : 0;
                    $purchase->save();
                    //End*****
                }
            }
        }

        if($paid_in_advanced)
        {
            //Payment Create**********
            $payment = new Payment();
            $payment->supplier_id = $supplier_id;
            $payment->payment_method_id = $payment_method_id;
            $payment->date = $date;
            $payment->amount = $paid_in_advanced;
            $payment->note = $note;
            $payment->status = 1;
            $payment->created_by_id = $created_by_id;
            $payment->save();
            //End*****

            //Supplier Ledger Payment Create**********
            $supplierLedger = new SupplierLedger();
            $supplierLedger->supplier_id = $supplier_id;
            $supplierLedger->payment_id = $payment->id;
            $supplierLedger->particular = 'Paid In Advanced';
            $supplierLedger->date = $date;
            $supplierLedger->debit_amount = $paid_in_advanced;
            $supplierLedger->note = $note;
            $supplierLedger->status = 1;
            $supplierLedger->created_by_id = $created_by_id;
            $supplierLedger->save();
            //End*****
        }
        return redirect()->route('payments.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }
    public function dueVouchars(Request $request)
    {
        $data['purchases'] = Purchase::where(['payment_status'=>0, 'supplier_id'=> $request->supplier_id])->orderBy('date', 'asc')->get();
        $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
        return response()->json($data, 200);
    }

    public function update(Request $request,$id)
    {
        $data = $request->all();
        PaymentMethod::find($id)->update($data);
        return redirect()->route('payment-methods.index')->with('alert',['messageType'=>'success','message'=>'Data Updated Successfully!']);
    }
    
    public function destroy($id)
    {
        $isExistInCollections = Collection::where('payment_method_id', $id)->count();
        $isExistInPayment = Payment::where('payment_method_id', $id)->count();
        if($isExistInCollections || $isExistInPayment)
            return redirect()->back()->with('alert',['messageType'=>'warning','message'=>'Data Deletion Failed!']);
        PaymentMethod::destroy($id);
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>'Data Deleted Successfully!']);
    }
}
