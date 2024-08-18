<?php

namespace App\Http\Controllers\admin\hrm;

use App\Models\LeaveType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LeaveTypeController extends Controller
{
    public function index()
    {
        $leaveTypes = LeaveType::orderBy('id', 'desc')->get();
        return view('admin.hrm.leaves.leave-types.index', compact('leaveTypes'));
    }

    public function createOrEdit($id=null)
    {
        if($id){
            $data['title'] = 'Edit';
            $data['item'] = LeaveType::find($id);
        }else{
            $data['title'] = 'Create';
        }
        return view('admin.hrm.leaves.leave-types.create-or-edit',compact('data'));
    }
    
    public function store(Request $request)
    {
        $data = $request->all();
        LeaveType::create($data);
        return redirect()->route('leave-types.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        LeaveType::find($id)->update($data);
        return redirect()->route('leave-types.index')->with('alert',['messageType'=>'success','message'=>'Data Updated Successfully!']);
    }

    public function destroy($id)
    {
        // LeaveType::destroy($id);
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>'Data Deleted Successfully!']);
    }

}