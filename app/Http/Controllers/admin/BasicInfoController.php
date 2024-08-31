<?php

namespace App\Http\Controllers\admin;

use App\Models\BasicInfo;
use App\Models\CurrencySymbol;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Auth;

class BasicInfoController extends Controller
{
    public function index()
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        if (Auth::guard('admin')->user()->client_id == 0) {
            $basicInfo = BasicInfo::where('client_id', Auth::guard('admin')->user()->id)->first();
        } else {
            $basicInfo = BasicInfo::where('client_id', $client->id)->first();
        }
        return view('admin.basic-infos.index', compact('basicInfo'));
    }

    public function create()
    {
        $currencys = CurrencySymbol::get();
        return view('admin.basic-infos.create', compact('currencys'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $currency = CurrencySymbol::find($data['currency_symbol_id']);
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();

        if (Auth::guard('admin')->user()->client_id == 0) {
            $data['client_id'] = Auth::guard('admin')->user()->id;
        } else {
            $data['client_id'] = $client->id;
        }

        if (isset($data['logo'])) {
            $fileName = 'logo-' . time() . '.' . $data['logo']->getClientOriginalExtension();
            $data['logo']->move(public_path('uploads/basic-info'), $fileName);
            $data['logo'] = $fileName;
        } 

        if (isset($data['favIcon'])) {
            $fileName = 'favIcon-' . time() . '.' . $data['favIcon']->getClientOriginalExtension();
            $data['favIcon']->move(public_path('uploads/basic-info/'), $fileName);
            $data['favIcon'] = $fileName;          
        } 

        if (isset($data['acceptPaymentType'])) {
            $fileName = 'apt-' . time() . '.' . $data['acceptPaymentType']->getClientOriginalExtension();
            $data['acceptPaymentType']->move(public_path('uploads/basic-info'), $fileName);
            $data['acceptPaymentType'] = $fileName;           
        } 

        $data['currency_code'] = $currency->code;
        $data['currency_symbol'] = $currency->symbol;
        BasicInfo::create($data);
        return redirect()->route('basic-infos.index')->with('alert', ['messageType' => 'warning', 'message' => 'Basic-Info created Successfully!']);
    }

    public function edit($id)
    {
        $basicInfo = BasicInfo::find($id);
        $currencys = CurrencySymbol::get();
        return view('admin.basic-infos.edit', compact('basicInfo', 'currencys'));
    }

    public function update(Request $request, $id)
    {
        $basicInfo = BasicInfo::find($id);
        $data = $request->all();
        $currency = CurrencySymbol::find($data['currency_symbol_id']);
        $data['currency_code'] = $currency->code;
        $data['currency_symbol'] = $currency->symbol;

        if (isset($data['logo'])) {
            $fileName = 'logo-' . time() . '.' . $data['logo']->getClientOriginalExtension();
            $data['logo']->move(public_path('uploads/basic-info'), $fileName);
            $data['logo'] = $fileName;

            $imagePath = public_path('uploads/basic-info/' . $basicInfo->logo);
            if ($basicInfo->logo) unlink($imagePath);
        } else unset($data['logo']);

        if (isset($data['favIcon'])) {
            $fileName = 'favIcon-' . time() . '.' . $data['favIcon']->getClientOriginalExtension();
            $data['favIcon']->move(public_path('uploads/basic-info/'), $fileName);
            $data['favIcon'] = $fileName;

            $imagePath = public_path('uploads/basic-info/' . $basicInfo->favIcon);
            if ($basicInfo->favIcon) unlink($imagePath);
        } else unset($data['favIcon']);

        if (isset($data['acceptPaymentType'])) {
            $fileName = 'apt-' . time() . '.' . $data['acceptPaymentType']->getClientOriginalExtension();
            $data['acceptPaymentType']->move(public_path('uploads/basic-info'), $fileName);
            $data['acceptPaymentType'] = $fileName;

            $imagePath = public_path('uploads/basic-info/' . $basicInfo->acceptPaymentType);
            if ($basicInfo->acceptPaymentType) unlink($imagePath);
        } else unset($data['acceptPaymentType']);

        $basicInfo->update($data);
        return redirect()->route('basic-infos.index')->with('alert', ['messageType' => 'warning', 'message' => 'Data Updated Successfully!']);
    }
}
