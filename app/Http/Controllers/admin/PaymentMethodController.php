<?php

namespace App\Http\Controllers\admin;

use App\Models\PaymentMethod;
use App\Models\Collection;
use App\Models\Payment;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        if (Auth::guard('admin')->user()->client_id == 0) {
            $paymentMethods = PaymentMethod::where('client_id', Auth::guard('admin')->user()->id)->orderBy('id', 'desc')->get();
        } else {
            $paymentMethods = PaymentMethod::where('client_id', $client->id)->orderBy('id', 'desc')->get();
        }
        return view('admin.payment-methods.index', compact('paymentMethods'));
    }

    public function createOrEdit($id = null)
    {
        if ($id) {
            $data['title'] = 'Edit';
            $data['item'] = PaymentMethod::find($id);
        } else {
            $data['title'] = 'Create';
        }
        return view('admin.payment-methods.create-or-edit', compact('data'));
    }

    public function store(Request $request)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $data = $request->all();
        if (Auth::guard('admin')->user()->client_id == 0) {
            $data['client_id'] =  Auth::guard('admin')->user()->id;
        } else {
            $data['client_id'] =  $client->id;
        }

        PaymentMethod::create($data);
        return redirect()->route('payment-methods.index')->with('alert', ['messageType' => 'success', 'message' => 'Data Inserted Successfully!']);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        PaymentMethod::find($id)->update($data);
        return redirect()->route('payment-methods.index')->with('alert', ['messageType' => 'success', 'message' => 'Data Updated Successfully!']);
    }

    public function destroy($id)
    {
        $isExistInCollections = Collection::where('payment_method_id', $id)->count();
        $isExistInPayment = Payment::where('payment_method_id', $id)->count();
        if ($isExistInCollections || $isExistInPayment)
            return redirect()->back()->with('alert', ['messageType' => 'warning', 'message' => 'Data Deletion Failed!']);
        PaymentMethod::destroy($id);
        return redirect()->back()->with('alert', ['messageType' => 'success', 'message' => 'Data Deleted Successfully!']);
    }
}
