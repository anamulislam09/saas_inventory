<?php

namespace App\Http\Controllers\admin\hrm;

use App\Models\LeaveType;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveTypeController extends Controller
{
    public function index()
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        $leaveTypes = LeaveType::where('client_id', $client_id)->orderBy('id', 'desc')->get();
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