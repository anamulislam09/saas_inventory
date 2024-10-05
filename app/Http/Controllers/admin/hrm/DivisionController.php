<?php

namespace App\Http\Controllers\admin\hrm;

use App\Models\Division;
use App\Models\Department;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DivisionController extends Controller
{
    public function index()
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        $divisions = Division::where('client_id', $client_id)->orderBy('id', 'desc')->get();
        return view('admin.hrm.departments.divisions.index', compact('divisions'));
    }

    public function createOrEdit($id=null)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        if($id){
            $data['title'] = 'Edit';
            $data['item'] = Division::find($id);
        }else{
            $data['title'] = 'Create';
        }
        $data['departments'] = Department::where('client_id', $client_id)->get();
        return view('admin.hrm.departments.divisions.create-or-edit',compact('data'));
    }
    
    public function store(Request $request)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        $data = $request->all();
        $data['client_id'] = $client_id;
        Division::create($data);
        return redirect()->route('divisions.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();
        Division::find($id)->update($data);
        return redirect()->route('divisions.index')->with('alert',['messageType'=>'success','message'=>'Data Updated Successfully!']);
    }

    public function destroy($id)
    {
        Division::destroy($id);
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>'Data Deleted Successfully!']);
    }
}
