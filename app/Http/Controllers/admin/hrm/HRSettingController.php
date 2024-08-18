<?php

namespace App\Http\Controllers\admin\hrm;

use App\Models\HRSetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class HRSettingController extends Controller
{
    public function index()
    {
        $hrsettings = HRSetting::first();
        return view('admin.hrm.hrm.hrsettings.index', compact('hrsettings'));
    }

    public function createOrEdit($id)
    {
        $hrsettings = HRSetting::find($id);
        return view('admin.hrm.hrm.hrsettings.edit',compact('hrsettings'));
    }
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['overtime_rate'] = $data['overtime_rate']/100;
        HRSetting::find($id)->update($data);
        return redirect()->route('hrsettings.index')->with('alert',['messageType'=>'success','message'=>'Data Updated Successfully!']);
    }
}

