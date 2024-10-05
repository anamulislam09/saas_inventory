<?php

namespace App\Http\Controllers\admin\hrm;

use App\Models\Department;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function index()
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;
        
        $departments = Department::where('client_id', $client_id)->orderBy('id', 'desc')->get();
        return view('admin.hrm.departments.departments.index', compact('departments'));
    }

    public function createOrEdit($id=null)
    {
        if($id){
            $data['title'] = 'Edit';
            $data['item'] = Department::find($id);
        }else{
            $data['title'] = 'Create';
        }
        return view('admin.hrm.departments.departments.create-or-edit',compact('data'));
    }
    
    public function store(Request $request)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;
        
        $data = $request->all();
        $data['client_id'] = $client_id;
        Department::create($data);
        return redirect()->route('departments.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        Department::find($id)->update($data);
        return redirect()->route('departments.index')->with('alert',['messageType'=>'success','message'=>'Data Updated Successfully!']);
    }

    public function destroy($id)
    {
        Department::destroy($id);
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>'Data Deleted Successfully!']);
    }
}

