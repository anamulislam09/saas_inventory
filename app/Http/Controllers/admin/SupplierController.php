<?php

namespace App\Http\Controllers\admin;

use App\Models\Supplier;
use App\Models\BasicInfo;
use App\Models\SupplierLedger;
use App\Models\Purchase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class SupplierController extends Controller
{
    public function index()
    {
        $data['suppliers'] = Supplier::orderBy('id', 'desc')->get();
        $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
        return view('admin.suppliers.index', compact('data'));
    }

    public function createOrEdit($id=null)
    {
        if($id){
            $data['title'] = 'Edit';
            $data['item'] = Supplier::find($id);
        }else{
            $data['title'] = 'Create';
        }
        return view('admin.suppliers.create-or-edit',compact('data'));
    }

    public function store(Request $request)
    {
        //Supplier Create**********
        $data = $request->all();
        $data['created_by_id'] = Auth::guard('admin')->user()->id;
        $data['current_balance'] = $data['opening_payable'] - $data['opening_receivable'];
        $supplier = Supplier::create($data);
        //End
        //Supplier Ledger Payment Create**********
        if($data['opening_payable']){
            $supplierLedger = new SupplierLedger();
            $supplierLedger->supplier_id = $supplier->id;
            $supplierLedger->particular = 'Opening Payable';
            $supplierLedger->date = date('Y-m-d');
            $supplierLedger->credit_amount = $data['opening_payable'];
            $supplierLedger->status = 1;
            $supplierLedger->created_by_id = Auth::guard('admin')->user()->id;
            $supplierLedger->save();
        }
        if($data['opening_receivable']){
            $supplierLedger = new SupplierLedger();
            $supplierLedger->supplier_id = $supplier->id;
            $supplierLedger->particular = 'Opening Receivable';
            $supplierLedger->date = date('Y-m-d');
            $supplierLedger->debit_amount = $data['opening_receivable'];
            $supplierLedger->status = 1;
            $supplierLedger->created_by_id = Auth::guard('admin')->user()->id;
            $supplierLedger->save();
        }
        //End
        return redirect()->route('suppliers.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }


    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);
        $data = $request->all();
        $data['supplier_by_id'] = Auth::guard('admin')->user()->id;
        $supplier->update($data);
        return redirect()->route('suppliers.index')->with('alert',['messageType'=>'success','message'=>'Data Updated Successfully!']);
    }
    
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $data = Purchase::where('supplier_id',$id)->get();
        if(count($data)) return redirect()->back()->with('alert',['messageType'=>'warning','message'=>'Data Deletion Failed!']);
        $supplier->delete();
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>'Data Deleted Successfully!']);
    }
}
