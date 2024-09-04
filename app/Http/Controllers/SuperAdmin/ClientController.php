<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Admin::where('is_client', 1)->where('client_id', 0)->get();
        return view('superadmin.client.index', compact('clients'));
    }
    public function create()
    {
        return view('superadmin.client.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $admin = Admin::where('email', $data['email'])->first();
        if ($admin) {
            return redirect()->back()->with('alert', ['messageType' => 'danger', 'message' => 'This email is already exists!']);
        }
        $data['type'] = 1;
        $data['client_id'] = 0;
        $data['password'] = Hash::make($data['password']);
        Admin::create($data);
        return redirect()->route('clients.index')->with('alert', ['messageType' => 'success', 'message' => 'Client Created Successfully!']);
    }

    // Customer edit 
    public function edit($id)
    {
            $data = Admin::findOrFail($id);
            $packages = Package::get();
            return view('superadmin.client.edit', compact('data', 'packages'));
    }

    // Customer update 
    public function update(Request $request)
    {
        $package_amount = Package::where('id', $request->package_id)->first();
        $data = array();
        $data['status'] = $request->status;
        $data['package_id'] = $request->package_id;
        $data['package_start_date'] = date('Y-m-d');
        $data['customer_balance'] = $package_amount->amount;
        Admin::where('id', $request->client_id)->update($data);

        return redirect()->route('clients.index')->with('alert', ['messageType' => 'success', 'message' => 'Client Updated Successfully!']);
    }

    // active status method 
    public function ClientActive($id)
    {
        $data = Admin::findOrFail($id);
        $data->update(['status' => 1]);
        return redirect()->back()->with('alert', ['messageType' => 'success', 'message' => 'Client Activated Successfully!']);
    }

    // not Active Status method 
    public function ClientNotActive($id)
    {
        $data = Admin::findOrFail($id);
        $data->update(['status' => 0]);
        return redirect()->back()->with('alert', ['messageType' => 'danger', 'message' => 'Client Not Activated']);
    }
}
