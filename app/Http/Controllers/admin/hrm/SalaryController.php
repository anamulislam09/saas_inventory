<?php

namespace App\Http\Controllers\admin\hrm;

use App\Models\SalaryProcessTemp;
use App\Models\SalaryProcess;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalaryController extends Controller
{
    public function index(Request $request)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        if($request->isMethod('post')){
            $date = explode('-', $request->date);
            $year = $date[0];
            $month = $date[1];
            $salaryProcess = SalaryProcess::where('client_id', $client_id)->with('employee')->where(['year'=> $year, 'month'=> $month])->get();
            return response()->json($salaryProcess, 200);
        }else{
            return view('admin.hrm.payrolls.salary.index');
        }
    }
    public function store()
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        $salaryProcessTemp = SalaryProcessTemp::where('client_id', $client_id)->get();
        foreach ($salaryProcessTemp as $spt) {
            $salaryProcess = SalaryProcess::where(['year'=> $spt->year, 'month'=> $spt->month])->where('employee_id', $spt->employee_id)->first();
            unset($spt['id']);
            $spt = $spt->toArray();
            if(!$salaryProcess){
                $salaryProcess = SalaryProcess::create($spt);
            }else {
                $salaryProcess->update($spt);
            }
        }
        SalaryProcessTemp::truncate();
        return redirect()->route('salaries.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }

}
