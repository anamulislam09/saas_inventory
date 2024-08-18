<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
}
