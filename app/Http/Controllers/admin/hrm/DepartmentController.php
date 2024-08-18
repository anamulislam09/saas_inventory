<?php

namespace App\Http\Controllers\admin\hrm;

use App\Models\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::orderBy('id', 'desc')->get();
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
        $data = $request->all();
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
        // if(!Item::where('unit_id',$unit->id)->count())
        //     return redirect()->back()->with('alert',['messageType'=>'warning','message'=>'Data Deletion Failed!']);
        Department::destroy($id);
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>'Data Deleted Successfully!']);
    }
}

