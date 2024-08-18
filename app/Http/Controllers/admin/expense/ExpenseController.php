<?php

namespace App\Http\Controllers\admin\expense;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\BasicInfo;
use App\Models\ExpenseDetails;
use App\Models\ExpenseHead;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

class ExpenseController extends Controller
{
    public function index()
    {
        $data['expenses'] = Expense::with(['admin'])->orderBy('id','desc')->get();
        $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
        return view('admin.expenses.expenses.index', compact('data'));
    }

    public function createOrEdit($id=null)
    {
        if($id){
            $data['title'] = 'Edit';
            $data['expense'] = Expense::find($id);
            $data['expense_detals'] = ExpenseDetails::with(['expense_head', 'expense_cat'])->where('expense_id', $id)->get();
        }else{
            $data['title'] = 'Create';  
        }
        $data['expenseheads'] = ExpenseHead::where('status',1)->get();
        $data['expense_categories'] = ExpenseCategory::where('status',1)->get();
        return view('admin.expenses.expenses.create-or-edit',compact('data'));
    }

    public function store(Request $request)
    {
        $total_expense = 0;
        for($i = 0; $i < count($request->expense_head_id); $i++) $total_expense += $request->amount[$i] * $request->quantity[$i];
        $data = $request->all();

        $data['expense_no'] = ExpenseController::formatNumber(Expense::max('expense_no')+1);
        $data['created_by_id'] = Auth::guard('admin')->user()->id;
        $expense = Expense::create($data);
        for($i = 0; $i < count($data['expense_head_id']); $i++) {
           $expenseDetails = 
            [
                'expense_id'=> $expense->id,
                'expense_cat_id'=> $data['expense_cat_id'][$i],
                'expense_head_id'=> $data['expense_head_id'][$i],
                'amount'=> $data['amount'][$i],
                'quantity'=> $data['quantity'][$i],
                'note'=> $data['note'][$i],
            ];
            ExpenseDetails::create($expenseDetails);
        }
        return redirect()->route('expenses.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }

    public function update(Request $request, $id)
    {
        // Expense
        $total_expense = 0;
        $expense = Expense::find($id);
        for($i = 0; $i < count($request->expense_head_id); $i++) $total_expense += $request->amount[$i] * $request->quantity[$i];
        $data = $request->all();
        $data['updated_by_id'] = Auth::guard('admin')->user()->id;
        $expense->update($data);
        ExpenseDetails::where('expense_id',$id)->delete();
        for($i = 0; $i < count($data['expense_head_id']); $i++) {
           $expenseDetails = 
            [
                'expense_id'=> $expense->id,
                'expense_cat_id'=> $data['expense_cat_id'][$i],
                'expense_head_id'=> $data['expense_head_id'][$i],
                'amount'=> $data['amount'][$i],
                'quantity'=> $data['quantity'][$i],
                'note'=> $data['note'][$i],
            ];
            ExpenseDetails::create($expenseDetails);
        }
        return redirect('admin/expense/expenses')->with('alert',['messageType'=>'success','message'=>'Data Updated Successfully!']);
    }
    public function details(Request $request)
    {
        $expense = Expense::with(['expense_details'])->find($request->expense_id);
        return response()->json($expense, 200);
    }
    public function destroy($id)
    {
        $expense = Expense::find($id);
        ExpenseDetails::where('expense_id',$expense->id)->delete();
        $expense->delete();
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>'Data Deleted Successfully!']);
    }
    public function reports(Request $request)
    {
        if($request->isMethod('post')){
            $expense_cat_id = $request->expense_cat_id;
            $expense_head_id = $request->expense_head_id;
            $date = $request->date;

            $exp = Expense::join('expense_details', 'expense_details.expense_id', '=', 'expenses.id')
                                    ->join('expense_categories', 'expense_details.expense_cat_id', '=', 'expense_categories.id')
                                    ->join('expense_heads', 'expense_details.expense_head_id', '=', 'expense_heads.id');
                                    
                if ($date) $exp = $exp->where('expenses.date', 'like', "%$date%");
                if($expense_cat_id==-1 || $expense_head_id == -1){
                    if ($expense_cat_id==-1) $exp = $exp->groupBy('expense_details.expense_cat_id');
                    if ($expense_head_id==-1) $exp = $exp->groupBy('expense_details.expense_head_id');
                    $exp = $exp->orderBy('expenses.date', 'asc')
                    ->select(DB::raw('sum(amount*quantity) as sub_total'), 'expense_categories.cat_name', 'expense_heads.title')
                    ->get();
                }else{
                    if ($expense_cat_id>0) $exp = $exp->where('expense_details.expense_cat_id', $expense_cat_id);
                    if ($expense_head_id>0) $exp = $exp->where('expense_details.expense_head_id', $expense_head_id);
                    $exp = $exp->orderBy('expenses.date', 'asc')
                            ->select('expenses.date', 'expense_details.*',DB::raw('expense_details.amount * expense_details.quantity as sub_total'), 'expense_categories.cat_name', 'expense_heads.title')
                            ->get();
                }
                

            
            $data['expenses'] = $exp;

            $data['currency_symbol'] = $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
            // if($request->expense_head_id==0){
            //     $data['expenses'] = Expense::with(['admin'])->where('date','like',"%$date%")->get();
            // }else{
            //     $data['expense_details'] = Expense::join('expense_details','expense_details.expense_id','=', 'expenses.id')->where('expense_details.expense_head_id', $expense_head_id)
            //                                 ->where('expenses.date','like',"%$date%")
            //                                 ->orderBy('expenses.date','asc')
            //                                 ->select('expenses.date','expenses.expense_no','expense_details.quantity','expense_details.amount')
            //                                 ->get();
            // }
            return response()->json($data, 200);
        }else{
            $data['expense_heads'] = ExpenseHead::where('status', 1)->get();
            $data['expense_categories'] = ExpenseCategory::where('status',1)->get();
            return view('admin.expenses.reports.index', compact('data'));
        }
    }
    



    public function formatNumber($srl)
    {
        switch(strlen($srl)){
            case 1:
                $zeros = '000000';
                break;
            case 2:
                $zeros = '00000';
                break;
            case 3:
                $zeros = '0000';
                break;
            case 4:
                $zeros = '000';
                break;
            case 5:
                $zeros = '00';
                break;
            default:
                $zeros = '0';
            break;
        }
        return $zeros . $srl;
    }
}
