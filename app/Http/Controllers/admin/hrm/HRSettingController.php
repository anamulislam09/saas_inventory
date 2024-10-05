<?php

namespace App\Http\Controllers\admin\hrm;

use App\Models\HRSetting;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HRSettingController extends Controller
{
    public function index()
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        $isExist = HRSetting::where('client_id', $client_id)->exists();
        if ($isExist) {
            $hrsettings = HRSetting::where('client_id', $client_id)->first();
        } else {
            $hrsettings = HRSetting::where('client_id', 0)->first();
        }

        return view('admin.hrm.hrm.hrsettings.index', compact('hrsettings'));
    }

    public function createOrEdit($id)
    {
        $hrsettings = HRSetting::find($id);
        return view('admin.hrm.hrm.hrsettings.edit', compact('hrsettings'));
    }

    public function update(Request $request, $id)
    {
        // Get client information
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        // Prepare the data from the request
        $isClient = $request->client_id;
        $data = $request->all();
        $data['overtime_rate'] = $data['overtime_rate'] / 100;

        // Check if creating a new record or updating an existing one
        if ($isClient == 0) {
            $data['client_id'] = $client_id;

            // Create a new record if no client ID
            HRSetting::create($data);
        } else {
            // Check if the record exists before updating
            $hrSetting = HRSetting::find($id);
            if ($hrSetting) {
                // Update the existing record
                $hrSetting->update($data);
            } else {
                // Handle the case where the record is not found
                return redirect()->back()->with('alert', ['messageType' => 'error', 'message' => 'Record not found!']);
            }
        }

        // Redirect with success message
        return redirect()->route('hrsettings.index')->with('alert', ['messageType' => 'success', 'message' => 'Data Updated Successfully!']);
    }
}
