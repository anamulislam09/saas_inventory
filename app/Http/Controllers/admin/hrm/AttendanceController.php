<?php

namespace App\Http\Controllers\admin\hrm;

use App\Models\Attendance;
use App\Models\Holiday;
use App\Models\WeeklyHoliday;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\HRSetting;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;

use App\Models\Purchase;
use App\Models\BasicInfo;

class AttendanceController extends Controller
{
    public function index()
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        $attendances = Attendance::with('employee')->where('date', date('Y-m-d'))->orWhere('out_at',null)->where('client_id', $client_id)->orderBy('id', 'desc')->get();
        return view('admin.hrm.attendances.attendances.index', compact('attendances'));
    }   

    public function createOrEdit($id=null)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        if($id){
            $data['title'] = 'Edit';
            $data['item'] = Attendance::find($id);
        }else{
            $data['title'] = 'Create';
        }
        $data['employees'] = Employee::where('client_id', $client_id)->get();
        return view('admin.hrm.attendances.attendances.create-or-edit',compact('data'));
    }

    public function createOrEditMultiple($id=null)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        if($id){
            $data['title'] = 'Edit';
            $data['item'] = Attendance::find($id);
        }else{
            $data['title'] = 'Create';
        }
        $data['employees'] = Employee::where('client_id', $client_id)->get();
        return view('admin.hrm.attendances.attendances.create-or-edit-multiple',compact('data'));
    }
    
    public function attendanceByDate(Request $request)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        $date = $request->date;
        $HRSetting = HRSetting::where('client_id', $client_id)->first();
        
        $data['deafault_in_at'] = $HRSetting->office_start_at;
        $data['deafault_out_at'] = $HRSetting->office_end_at;
        $data['employees'] = Employee::where('client_id', $client_id)->orderBy('name','asc')->get();
        foreach ($data['employees'] as $key => &$employee) {
            $employee->attendance = Attendance::where('employee_id', $employee->id)->where('date','like',"%$date%")->first();
        }
        return response()->json($data, 200);
    }
    
    public function store(Request $request)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        $HRSetting = HRSetting::where('client_id', $client_id)->first();
        $default_work_time_hour = $HRSetting->daily_work_hour;
        $data = $request->all();
        $data['created_by_id'] = Auth::guard('admin')->user()->id;
        $data['client_id'] = $client_id;
        $isExist = Attendance::where(['employee_id'=> $data['employee_id'],'date'=> $data['date']])->where('client_id', $client_id)->count();
        if($isExist) return redirect()->back()->with('alert',['messageType'=>'warning','message'=>'Attendance Already Inserted!']);
        if($data['out_at']){
            $total_hours = round((strtotime($data['out_at']) - strtotime($data['in_at']))/3600, 1);
            $data['worked_hour'] = $total_hours > $default_work_time_hour ? $default_work_time_hour : $total_hours;
            $data['over_time_hour'] = $total_hours > $default_work_time_hour ? ($total_hours - $default_work_time_hour) : 0;
        }
        Attendance::create($data);
        return redirect()->route('attendances.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }

    public function storeOrUpdateMultiple(Request $request)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        $HRSetting = HRSetting::where('client_id', $client_id)->first();
        $default_work_time_hour = $HRSetting->daily_work_hour;
        $present_emp_id = $request->present_emp_id;
        $employee_ids = $request->employee_id;
        $date = $request->date;
        $in_at = $request->in_at;
        $out_at = $request->out_at;
        $note = $request->note;
        $attendance_id = $request->attendance_id;
        $present_emp_id = $request->present_emp_id;

        foreach ($employee_ids as $key => $employe_id) {
            if(in_array($employe_id,$present_emp_id)){
                $data['created_by_id'] = Auth::guard('admin')->user()->id;
                $data['employee_id'] = $employee_ids[$key];
                $data['date'] = $date;
                $data['in_at'] = $in_at[$key];
                $data['out_at'] = $out_at[$key];
                $data['note'] = $note[$key];
                if($data['out_at']){
                    $total_hours = round((strtotime($data['out_at']) - strtotime($data['in_at']))/3600, 1);
                    $data['worked_hour'] = $total_hours > $default_work_time_hour ? $default_work_time_hour : $total_hours;
                    $data['over_time_hour'] = $total_hours > $default_work_time_hour ? ($total_hours - $default_work_time_hour) : 0;
                }
                Attendance::updateOrCreate(['id'=>$attendance_id[$key]], $data);
            }else{
                $attendance = Attendance::where(['date'=>$date, 'employee_id'=> $employe_id])->delete();
            }
        }
        return redirect()->route('attendances.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }

    public function update(Request $request, $id)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        $data = $request->all();
        $HRSetting = HRSetting::where('client_id', $client_id)->first();
        $default_work_time_hour = $HRSetting->daily_work_hour;
        $total_hours = round((strtotime($data['out_at']) - strtotime($data['in_at']))/3600, 1);
        $data['worked_hour'] = $total_hours > $default_work_time_hour ? $default_work_time_hour : $total_hours;
        $data['over_time_hour'] = $total_hours > $default_work_time_hour ? ($total_hours - $default_work_time_hour) : 0;
        $attendance = Attendance::find($id)->update($data);
        return redirect()->route('attendances.index')->with('alert',['messageType'=>'success','message'=>'Data Updated Successfully!']);
    }

    public function destroy($id)
    {
        Attendance::destroy($id);
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>'Data Deleted Successfully!']);
    }

    public function reportIndex(Request $request)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        if ($request->isMethod('post')) {
            $employee_id = $request->employee_id;
            $date = $request->date;
            $HRSetting = HRSetting::where('client_id', $client_id)->first();
            $data = [
                'default_working_hour' => $HRSetting->daily_work_hour,
                'default_in_time' => $HRSetting->office_start_at,
                'office_end_at' => $HRSetting->office_end_at
            ];
    
            if ($employee_id == 0) {
                $data['employees'] = $this->getEmployeesAttendanceData($date, $data);
                $data['holidayDates'] = Holiday::where('client_id', $client_id)->where('date', 'like', "%$date%")
                    ->pluck('date')
                    ->toArray();
                $data['weeklyHoliday'] = WeeklyHoliday::where('client_id', $client_id)->first();
                return response()->json($data, 200);
            } elseif ($employee_id == -1) {
                $data = $this->employeeSummary($date, $data);
                return response()->json($data, 200);
            } else {
                $attendances = Attendance::where('employee_id', $employee_id)
                    ->where('date', 'like', "%$date%")
                    ->get();
                return response()->json($attendances, 200);
            }
        } else {
            $data['employees'] = Employee::where('client_id', $client_id)->get();
            return view('admin.hrm.attendances.attendances-reports.index', compact('data'));
        }
    }
    
    private function getEmployeesAttendanceData($date, $data)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        $employees = Employee::where('client_id', $client_id)->where('status', 1)->select('id', 'name')->get();
    
        foreach ($employees as &$employee) {
            $employee->presentDates = Attendance::where('employee_id', $employee->id)
                ->where('date', 'like', "%$date%")
                ->pluck('date')
                ->toArray();
    
            $employee->lateDates = Attendance::where('employee_id', $employee->id)
                ->where('date', 'like', "%$date%")
                ->where(function ($query) use ($data) {
                    $query->whereTime('in_at', '>', $data['default_in_time'])
                        ->orWhereTime('out_at', '<', $data['office_end_at']);
                })
                ->pluck('date')
                ->toArray();
    
            $leaveDates = Leave::where('leave_taken_by_id', $employee->id)
                ->where('approved_start_date', 'like', "%$date%")
                ->get()
                ->flatMap(function ($leave) {
                    $period = CarbonPeriod::create($leave->approved_start_date, $leave->approved_end_date);
                    return $period->map(function ($date) {
                        return $date->toDateString();
                    });
                })
                ->toArray();
    
            $employee->leaveDates = $leaveDates;
        }
        return $employees;
    }
    
    private function employeeSummary($date, $data)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;
        
        $employees = Employee::where('client_id', $client_id)->where('status', 1)->select('id', 'name')->get();
        $total_office_days = 19;
    
        foreach ($employees as &$employee) {
            $employee->presents = Attendance::where('employee_id', $employee->id)
                ->where('date', 'like', "%$date%")
                ->count();
    
            $employee->lates = Attendance::where('employee_id', $employee->id)
                ->where('date', 'like', "%$date%")
                ->where(function ($query) use ($data) {
                    $query->whereTime('in_at', '>', $data['default_in_time'])
                        ->orWhereTime('out_at', '<', $data['office_end_at']);
                })
                ->count();
    
            $leaveCount = Leave::where('leave_taken_by_id', $employee->id)
                ->where('approved_start_date', 'like', "%$date%")
                ->get()
                ->flatMap(function ($leave) use ($date) {
                    $period = CarbonPeriod::create($leave->approved_start_date, $leave->approved_end_date);
                    return $period->map(function ($period_date) use ($date) {
                        return $period_date->format('Y-m') == $date ? 1 : 0;
                    });
                })
                ->sum();
    
            $employee->leaves = $leaveCount;
            $employee->absents = $total_office_days - ($leaveCount + $employee->presents);
        }
        return $employees;
    }
    
}

