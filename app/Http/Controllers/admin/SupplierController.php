<?php

namespace App\Http\Controllers\admin;

use App\Models\Supplier;
use App\Models\BasicInfo;
use App\Models\SupplierLedger;
use App\Models\Purchase;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function index()
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        if (Auth::guard('admin')->user()->client_id == 0) {
            $data['suppliers'] = Supplier::where('client_id', Auth::guard('admin')->user()->id)->orderBy('id')->get();
        } else {
            $data['suppliers'] = Supplier::where('client_id', $client->id)->orderBy('id')->get();
        }

        $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
        return view('admin.suppliers.index', compact('data'));
    }

    public function createOrEdit($id = null)
    {
        if ($id) {
            $data['title'] = 'Edit';
            $data['item'] = Supplier::find($id);
        } else {
            $data['title'] = 'Create';
        }
        return view('admin.suppliers.create-or-edit', compact('data'));
    }

    public function store(Request $request)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        //Supplier Create**********
        $data = $request->all();

        if (Auth::guard('admin')->user()->client_id == 0) {
            $data['client_id'] = Auth::guard('admin')->user()->id;
        } else {
            $data['client_id'] = $client->id;
        }

        Supplier::create($data);
        return redirect()->route('suppliers.index')->with('alert', ['messageType' => 'success', 'message' => 'Data Inserted Successfully!']);
    }


    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);
        $data = $request->all();
        $data['updated_by_id'] = Auth::guard('admin')->user()->id;
        $supplier->update($data);
        return redirect()->route('suppliers.index')->with('alert', ['messageType' => 'success', 'message' => 'Data Updated Successfully!']);
    }

    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $data = Purchase::where('supplier_id', $id)->get();
        if (count($data)) return redirect()->back()->with('alert', ['messageType' => 'warning', 'message' => 'Data Deletion Failed!']);
        $supplier->delete();
        return redirect()->back()->with('alert', ['messageType' => 'success', 'message' => 'Data Deleted Successfully!']);
    }
}
