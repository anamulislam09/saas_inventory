<?php

namespace App\Http\Controllers\admin\hrm;

use App\Models\Leave;
use App\Models\Employee;
use App\Models\LeaveType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class LeaveController extends Controller
{
    public function index()
    {
        $leaves = Leave::orderBy('id', 'desc')->get();
        return view('admin.hrm.leaves.leaves.index', compact('leaves'));
    }

    public function createOrEdit($id=null)
    {
        if($id){
            $data['title'] = 'Edit';
            $data['item'] = Leave::find($id);
        }else{
            $data['title'] = 'Create';
        }
        $data['employees'] = Employee::get();
        $data['leaveTypes'] = LeaveType::get();
        return view('admin.hrm.leaves.leaves.create-or-edit',compact('data'));
    }
    
    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_by_id'] = Auth::guard('admin')->user()->id;
        $data['approved_by_id'] = Auth::guard('admin')->user()->id;
        if(isset($data['image'])){
            $fileName = 'leave-app-'. time().'.'. $data['image']->getClientOriginalExtension();
            $data['image']->move(public_path('uploads/leave-application'), $fileName);
            $data['image'] = $fileName;
            $data['image'] = $fileName;
        }
        Leave::create($data);
        $employee = Employee::find($data['leave_taken_by_id']);
        $employee->remaining_leave = $employee->remaining_leave - $data['approved_days'];
        $employee->save();
        return redirect()->route('leaves.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $leave = Leave::find($id);
        // restoring Old remaining leave days & updating with new approved days...
        $employee = Employee::find($data['leave_taken_by_id']);
        $employee->remaining_leave = ($employee->remaining_leave + $leave->approved_days) - $data['approved_days'];
        $employee->save();
        if(isset($data['image'])){
            $fileName = 'leave-app-'. time().'.'. $data['image']->getClientOriginalExtension();
            $data['image']->move(public_path('uploads/leave-application'), $fileName);
            $data['image'] = $fileName;
            if($leave->image) unlink(public_path('uploads/leave-application/'.$leave->image));
        }
        $leave->update($data);
        return redirect()->route('leaves.index')->with('alert',['messageType'=>'success','message'=>'Data Updated Successfully!']);
    }

    public function destroy($id)
    {
        $leave = Leave::find($id);
        $employee = Employee::find($leave->leave_taken_by_id);
        $employee->remaining_leave = $employee->remaining_leave + $leave->approved_days;
        $employee->save();
        if($leave->image) unlink(public_path('uploads/leave-application/'.$leave->image));
        $leave->delete();
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>'Data Deleted Successfully!']);
    }
    
    public function reportIndex(Request $request)
    {
        if($request->isMethod('post')){
            $employee_id = $request->employee_id;
            $date = $request->date;
            if($employee_id>0){
                $data = $this->singleEmployee($employee_id, $date);
            }else{
                $data = $this->allEmployees($date);
            }
            return response()->json($data, 200);
        }else{
            $data['employees'] = Employee::get();
            return view('admin.hrm.leaves.reports.index', compact('data'));
        }
    }
    public function singleEmployee($employee_id, $date)
    {
        return Leave::with(['duty_handover_to','leave_type'])->where('leave_taken_by_id', $employee_id)->where('approved_start_date','like',"%$date%")->orderBy('id','asc')->get();
    }
    public function allEmployees($date)
    {
        return Leave::with(['leave_taken_by','duty_handover_to','leave_type'])->where('approved_start_date','like',"%$date%")->orderBy('id','asc')->get();
    }

}