<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\BasicInfo;
use App\Models\Purchase;
use App\Models\Vendor;
use App\Models\VendorLedger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function index()
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        if (Auth::guard('admin')->user()->client_id == 0) {
            $data['vendors'] = Vendor::where('client_id', Auth::guard('admin')->user()->id)->orderBy('id')->get();
            $data['currency_symbol'] = BasicInfo::where('client_id', Auth::guard('admin')->user()->id)->first()->currency_symbol;
        } else {
            $data['vendors'] = Vendor::where('client_id', $client->id)->orderBy('id')->get();
            $data['currency_symbol'] = BasicInfo::where('client_id', $client->id)->first()->currency_symbol;
        }
        return view('admin.vendors.index', compact('data'));
    }

    public function createOrEdit($id = null)
    {
        if ($id) {
            $data['title'] = 'Edit';
            $data['item'] = Vendor::find($id);
        } else {
            $data['title'] = 'Create';
        }
        return view('admin.vendors.create-or-edit', compact('data'));
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

        $data['created_by_id'] = Auth::guard('admin')->user()->id;
        $vendor = Vendor::create($data);

        return redirect()->route('vendors.index')->with('alert', ['messageType' => 'success', 'message' => 'Data Inserted Successfully!']);
    }


    public function update(Request $request, $id)
    {
        $vendor = Vendor::find($id);
        $data = $request->all();
        $data['updated_by_id'] = Auth::guard('admin')->user()->id;
        $vendor->update($data);
        return redirect()->route('vendors.index')->with('alert', ['messageType' => 'success', 'message' => 'Data Updated Successfully!']);
    }

    public function destroy($id)
    {
        $supplier = Vendor::find($id);
        $data = Purchase::where('supplier_id', $id)->get();
        if (count($data)) return redirect()->back()->with('alert', ['messageType' => 'warning', 'message' => 'Data Deletion Failed!']);
        $supplier->delete();
        return redirect()->back()->with('alert', ['messageType' => 'success', 'message' => 'Data Deleted Successfully!']);
    }
}
