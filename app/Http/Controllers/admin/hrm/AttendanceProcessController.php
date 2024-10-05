<?php

namespace App\Http\Controllers\admin\hrm;

use App\Models\Leave;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\HRSetting;
use App\Models\WeeklyHoliday;
use App\Models\Holiday;
use App\Models\AttendanceProcess;
use App\Models\AttendanceProcessDetails;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;

class AttendanceProcessController extends Controller
{
    
    public function index(Request $request)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;
        
        if($request->isMethod('post')){
            $data['attendanceProcess'] = AttendanceProcess::where('client_id', $client_id)->with('created_by')->where('date',$request->date)->first();
            $data['employees'] = Employee::where('client_id', $client_id)->where('status',1)->select('id','name')->get();
            if($data['attendanceProcess']){
                foreach ($data['employees'] as &$employee){
                    $apd = AttendanceProcessDetails::where('attendance_process_id',$data['attendanceProcess']->id)->where('employee_id',$employee->id)->first();
                    if($apd){
                        $employee->apd = $apd;
                    }else{
                        $employee->apd = false;
                    }
                }
            }
            return response()->json($data, 200);
        }else{
            return view('admin.hrm.attendances.attendances-processes.index');
        }
    }
    public function proccess(Request $request)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        $workingDayDates = [];
        $holidayDayDates = [];
        $explodedDate = explode('-',$request->date);
        $year = $explodedDate[0];
        $month = $explodedDate[1];
        $user_id = Auth::guard('admin')->user()->id;
        $hr_settings = HRSetting::where('client_id', $client_id)->first();
        $default_working_hours = $hr_settings->daily_work_hour;

        $thresHold = [
            'office_start_at'=>$hr_settings->office_start_at,
            'office_end_at'=>$hr_settings->office_end_at,
        ];

        $attendanceProcess = AttendanceProcess::where('client_id', $client_id)->where('year','=', $year)->where('month','=', $month)->first();

        $dates = $this->getAllDatesOfAMonth($request->date);
        $holidayDates = array_column(Holiday::where('client_id', $client_id)->where('date','like', "%{$request->date}%")->select('date')->get()->toArray(),'date');
        $weeklyHolidaysAll = WeeklyHoliday::where('client_id', $client_id)->select(['saturday','sunday','monday','tuesday','wednesday','thursday','friday'])->first()->toArray();

        $weeklyHolidays = array_keys(array_filter($weeklyHolidaysAll, function ($value) {return $value == 1;}, ARRAY_FILTER_USE_BOTH));

        foreach ($dates as $date) {
            if(!(in_array($this->getDayName($date), $weeklyHolidays) || in_array($date,$holidayDates))){
                $workingDayDates[] = $date;
            }else{
                $holidayDayDates[] = $date;
            }
        }
        $total_working_days = count($workingDayDates);
        $total_working_hours = $total_working_days * $default_working_hours;
        if($attendanceProcess){
            AttendanceProcessDetails::where('attendance_process_id',$attendanceProcess->id)->delete();
            $attendanceProcess->updated_by_id = $user_id;
        }else{
            $attendanceProcess = new AttendanceProcess;
            $attendanceProcess->created_by_id = $user_id;
        }
        $attendanceProcess->date = $request->date;
        $attendanceProcess->year = $year;
        $attendanceProcess->month = $month;
        $attendanceProcess->total_working_days = $total_working_days;
        $attendanceProcess->total_working_hours = $total_working_hours;
        $attendanceProcess->save();

        $employees_id = array_column(Employee::where('client_id', $client_id)->where('status',1)->select(['id'])->get()->toArray(),'id');

        foreach ($employees_id as $employee_id){

            $leave_days = count($this->leaveDates($employee_id, $request->date));
            $present_days = count($this->presentDates($employee_id, $request->date));
            $absent_days = $total_working_days - $leave_days - $present_days;

            $late_to_absent_days = floor(count($this->lateDates($employee_id, $request->date, $thresHold))/$hr_settings->equivalent_absences);
            $net_absent_days = $absent_days + $late_to_absent_days;
            $net_present_days = $leave_days + $present_days;

            $attendanceSums = Attendance::where('employee_id', $employee_id)->whereYear('date', $year)->whereMonth('date', $month)
                                ->selectRaw('SUM(worked_hour) as total_worked_hours, SUM(over_time_hour) as total_overtime_hours')
                                ->first();
            $regular_hours_worked = $attendanceSums->total_worked_hours;
            $overtime_hours = $attendanceSums->total_overtime_hours;
            $total_hours_worked = $regular_hours_worked + $overtime_hours;

            $regular_hours_worked = $regular_hours_worked ?? 0;
            $overtime_hours = $overtime_hours ?? 0;
            $total_hours_worked = $total_hours_worked ?? 0;

            $data = 
            [
                'attendance_process_id'=> $attendanceProcess->id,
                'employee_id'=> $employee_id,
                'absent_days'=> $absent_days,
                'late_to_absent_days'=> $late_to_absent_days,
                'net_absent_days'=> $net_absent_days,
                'present_days'=> $present_days,
                'leave_days'=> $leave_days,
                'net_present_days'=> $net_present_days,
                'regular_hours_worked'=> $regular_hours_worked,
                'overtime_hours'=> $overtime_hours, 
                'total_hours_worked'=> $total_hours_worked
            ];

            AttendanceProcessDetails::create($data);
        }
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }
    public function getAllDatesOfAMonth($date)
    {
        $date = explode('-',$date);
        $year = $date[0];
        $month = $date[1];
        $startDate = Carbon::createFromDate($year, $month, 1);
        $endDate = $startDate->copy()->endOfMonth();
        $dates = [];
        $periods = CarbonPeriod::create($startDate, $endDate);
        foreach ($periods as $period) {
            $dates[] = $period->format('Y-m-d');
        }
        return $dates;
    }
    public function getDayName($date)
    {
        return strtolower(Carbon::parse($date)->format('l'));
    }
    public function leaveDates($employee_id, $date)
    {
        $leaveDates = [];
        $leaves = Leave::where('leave_taken_by_id', $employee_id)->where('approved_start_date','like',"%$date%")->get();
        foreach ($leaves as $leave) {
            $period = [];
            $startDate = Carbon::parse($leave['approved_start_date']);
            $endDate = Carbon::parse($leave['approved_end_date']);
            $period = CarbonPeriod::create($startDate, $endDate);
            foreach ($period as $period_date) {
                $leaveDates[] = $period_date->format('Y-m-d');
            }
        }
        return $leaveDates;
    }
    public function lateDates($employee_id, $date, $thresHold)
    {
        $lateDates = Attendance::where('employee_id', $employee_id)
                        ->where('date','like',"%$date%")
                        ->where(function ($query) use ($thresHold) {
                            $query->whereTime('in_at', '>', $thresHold['office_start_at'])
                                ->orWhereTime('out_at', '<', $thresHold['office_end_at']);
                        })
                        ->select('date')
                        ->get()
                        ->toArray();
        return $lateDates = array_column($lateDates, 'date');
    }
    public function presentDates($employee_id, $date)
    {
        $presentDates = Attendance::where('employee_id', $employee_id)
                        ->where('date','like',"%$date%")
                        ->select('date')
                        ->get()
                        ->toArray();
        return $presentDates = array_column($presentDates, 'date');
    }

}

