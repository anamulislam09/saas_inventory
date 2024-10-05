<?php

namespace App\Http\Controllers\admin\hrm;

use App\Models\Loan;
use App\Models\LoanInstallment;
use App\Models\SalaryProcessTemp;
use App\Models\Employee;
use App\Models\AttendanceProcess;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\HRSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalaryProcessController extends Controller
{
    
    public function index(Request $request)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        if($request->isMethod('post')){
            SalaryProcessTemp::truncate();
            $hasBonus = $request->bonus;
            $date = explode('-', $request->date);
            $year = $date[0];
            $month = $date[1];
            $employees = Employee::where('client_id', $client_id)->where('status',1)->select('id','name','rate','bonus')->get();

            foreach ($employees as &$employee){
                $salaryProcessTemp = new SalaryProcessTemp;
                if($hasBonus=="true") $salaryProcessTemp->bonus = $employee->bonus;
                $salaryProcessTemp->employee_id = $employee->id;
                $salaryProcessTemp->year = $year;
                $salaryProcessTemp->month = $month;
                $salaryProcessTemp->basic_salary = $employee->rate;
                $salaryProcessTemp->client_id = $employee->client_id;
                $salaryProcessTemp->created_by_id = Auth::guard('admin')->user()->id;
                $salaryProcessTemp->save();
            }
            $salaryProcessTemp = SalaryProcessTemp::where('client_id', $client_id)->with('employee')->get();
            return response()->json($salaryProcessTemp, 200);
        }else{
            return view('admin.hrm.payrolls.salary-processes.index');
        }
    }

    public function proccess()
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        $salaryProcessTemp = SalaryProcessTemp::where('client_id', $client_id)->get();
        foreach ($salaryProcessTemp as &$salaryProcessTemp) {
            $attendanceProcess = AttendanceProcess::join('attendance_process_details', 'attendance_process_details.attendance_process_id','=','attendance_processes.id')
                                    ->where(['year'=> $salaryProcessTemp->year, 'month'=> $salaryProcessTemp->month])
                                    ->where('employee_id', $salaryProcessTemp->employee_id)
                                    ->first();
            $loan = Loan::join('loan_installments','loan_installments.loan_id','=','loans.id')
                        ->where(['year_month'=> $salaryProcessTemp->year .'-'. $salaryProcessTemp->month])
                        ->where('employee_id', $salaryProcessTemp->employee_id)
                        ->where('loan_installments.payment_status',1)
                        ->select('loan_installments.*')
                        ->first();
            $hrSettings = HRSetting::first();

            $total_working_days = $attendanceProcess->total_working_days;
            $late_to_absent_days = $attendanceProcess->late_to_absent_days;
            $absent_days = $attendanceProcess->absent_days;
            $overtime_hours = $attendanceProcess->overtime_hours;
            $total_working_hours = $attendanceProcess->total_working_hours;
            $basic_salary = $salaryProcessTemp->basic_salary;
            $bonus = $salaryProcessTemp->bonus;

            $salary_per_day = $basic_salary / $total_working_days;
            $salary_per_hour = $basic_salary / $total_working_hours;
            $salary_per_overtime_hour = $salary_per_hour * $hrSettings->overtime_rate;

            $absent_amount = $absent_days * $salary_per_day;
            $late_to_absent_amount = $late_to_absent_days * $salary_per_day;
            $overtime_amount = $overtime_hours * $salary_per_overtime_hour;
            $others = 0.00;
            $loan_amount = $loan ? $loan->amount : 0.00;
            $net_payable = ($basic_salary + $overtime_amount + $bonus) - ($absent_amount + $loan_amount + $late_to_absent_amount);

            $salaryProcessTemp->overtime = $overtime_amount;
            $salaryProcessTemp->others = $others;
            $salaryProcessTemp->absent = $absent_amount;
            $salaryProcessTemp->late = $late_to_absent_amount;
            $salaryProcessTemp->loan = $loan_amount;
            $salaryProcessTemp->net_payable = $net_payable;
            $salaryProcessTemp->save();
        }
        $salaryProcessTemp = SalaryProcessTemp::with('employee')->get();
        return response()->json($salaryProcessTemp, 200);
    }

    public function isAttendanceProcessed(Request $request)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        $attendanceProcess = AttendanceProcess::where('client_id', $client_id)->where('date',$request->date)->exists();
        return response()->json($attendanceProcess, 200);
    }
    public function isLoanProcessed(Request $request)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        $li = LoanInstallment::where('client_id', $client_id)->where(['payment_status'=>0 ,'year_month'=> $request->date])->exists();
        return response()->json((!$li), 200);
    }

}
