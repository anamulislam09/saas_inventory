<?php

namespace App\Http\Controllers\admin\expense;

use App\Models\ExpenseDetails;
use App\Models\ExpenseCategory;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseCategoryController extends Controller
{
    public function index()
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        if (Auth::guard('admin')->user()->client_id == 0) {
            $expense_categories = ExpenseCategory::where('client_id', Auth::guard('admin')->user()->id)->orderBy('id','desc')->get();
        } else {
            $expense_categories = ExpenseCategory::where('client_id', $client->id)->orderBy('id','desc')->get();
        }
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
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();

        if (Auth::guard('admin')->user()->client_id == 0) {
            $data['client_id'] = Auth::guard('admin')->user()->id;
        } else {
            $data['client_id'] = $client->id;
        }

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

