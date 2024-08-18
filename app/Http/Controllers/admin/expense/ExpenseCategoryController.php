<?php

namespace App\Http\Controllers\admin\expense;

use App\Models\ExpenseDetails;
use App\Models\ExpenseCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ExpenseCategoryController extends Controller
{
    public function index()
    {
        $expense_categories = ExpenseCategory::orderBy('id','desc')->get();
        return view('admin.expenses.expense-categories.index', compact('expense_categories'));
    }

    public function createOrEdit($id=null)
    {
        if($id){
            $data['expense_category'] = ExpenseCategory::find($id);
            $data['title'] = 'Edit';
        }else{
            $data['title'] = 'Create';
        }
        return view('admin.expenses.expense-categories.create-or-edit',compact('data'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_by_id'] = Auth::guard('admin')->user()->id;
        ExpenseCategory::create($data);
        return redirect()->route('expense-categories.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $expenseHead = ExpenseCategory::find($id);
        $data['updated_by_id'] = Auth::guard('admin')->user()->id;
        $expenseHead->update($data);
        return redirect()->route('expense-categories.index')->with('alert',['messageType'=>'success','message'=>'Data Updated Successfully!']);
    }

    public function destroy($id)
    {
        $isExist = ExpenseDetails::where('expense_cat_id', $id)->exists();
        if($isExist) return redirect()->back()->with('alert',['messageType'=>'warning','message'=>'Data Deletion Failed!']);
        ExpenseCategory::find($id)->delete();
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>'Data Deleted Successfully!']);
    }
}

