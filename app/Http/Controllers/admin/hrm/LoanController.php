<?php

namespace App\Http\Controllers\admin\hrm;

use App\Models\Loan;
use App\Models\LoanInstallment;
use App\Models\Employee;
use App\Models\BasicInfo;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function index()
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        $data['loans'] = Loan::where('client_id', $client_id)->with('employee')->orderBy('id', 'desc')->get();
        $data['currency_symbol'] = $data['currency_symbol'] = BasicInfo::where('client_id', $client_id)->first()->currency_symbol;
        return view('admin.hrm.loans.loans.index', compact('data'));
    }

    public function createOrEdit($id=null)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        if($id){
            $data['title'] = 'Edit';
            $data['item'] = Loan::find($id);
        }else{
            $data['title'] = 'Create';
        }
        $data['employees'] = Employee::where('client_id', $client_id)->get();
        return view('admin.hrm.loans.loans.create-or-edit',compact('data'));
    }
    
    public function store(Request $request)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        $data = $request->all();
        $data['client_id'] = $client_id;
        $data['created_by_id'] = Auth::guard('admin')->user()->id;
        $data['approved_by_id'] = Auth::guard('admin')->user()->id;
        $loan = Loan::create($data);

        $payment_date = $data['repayment_from'];
        for ($i=0; $i < $data['installment_period']; $i++){
            $installment['loan_id'] = $loan->id;
            $installment['client_id'] = $client_id;
            $installment['amount'] = $data['installment'];
            $installment['year_month'] =  Carbon::parse($payment_date)->format('Y-m');
            $installment['payment_date'] = $payment_date;
            $payment_date = Carbon::createFromFormat('Y-m-d', $payment_date)->addMonth()->format('Y-m-d');
            LoanInstallment::create($installment);
        }

        return redirect()->route('loans.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }

    public function update(Request $request, $id)
    {
        $loan = Loan::find($id);
        $data = $request->all();
        $data['approved_by_id'] = Auth::guard('admin')->user()->id;
        $loan->update($data);
        LoanInstallment::where('loan_id', $id)->delete();

        $payment_date = $data['repayment_from'];
        for ($i=0; $i < $data['installment_period']; $i++){
            $installment['loan_id'] = $loan->id;
            $installment['amount'] = $data['installment'];
            $installment['year_month'] =  Carbon::parse($payment_date)->format('Y-m');
            $installment['payment_date'] = $payment_date;
            $payment_date = Carbon::createFromFormat('Y-m-d', $payment_date)->addMonth()->format('Y-m-d');
            LoanInstallment::create($installment);
        }

        return redirect()->route('loans.index')->with('alert',['messageType'=>'success','message'=>'Data Updated Successfully!']);
    }
    public function loanIndex(Request $request)
    {
        if($request->isMethod('post')){
            $year_month = $request->date;
            $loans = Loan::join('loan_installments', 'loan_installments.loan_id', '=', 'loans.id')
                ->join('employees','employees.id','=','loans.employee_id')
                ->where('loan_installments.year_month', $year_month)
                ->select('loan_installments.*','employees.name')
                ->get();
            return response()->json($loans, 200);
        }else{
            return view('admin.hrm.loans.loans-processes.index');
        }
    }

    public function loanProcess(Request $request)
    {
        $year_month = $request->date;
        $loans = Loan::join('loan_installments', 'loan_installments.loan_id', '=', 'loans.id')
                ->where('loan_installments.year_month', $year_month)
                ->where('loan_installments.payment_status',0)
                ->select('loans.*','loan_installments.id as loan_installment_id')
                ->get();
        foreach ($loans as $loan) {
            $tempLoan = Loan::find($loan->id);
            $tempLoan->paid_amount = $tempLoan->paid_amount + $tempLoan->installment;
            if($tempLoan->paid_amount == $tempLoan->repayment_total) $tempLoan->payment_status = 1;
            $tempLoan->save();
            LoanInstallment::find($loan->loan_installment_id)->update(['payment_status'=>1]);
        }
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>'Installment Processed Successfully!']);
    }
    public function destroy($id)
    {
        LoanInstallment::where('loan_id', $id)->delete();
        Loan::find($id)->delete();
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>'Data Deleted Successfully!']);
    }

}