<?php

namespace App\Http\Controllers\admin\hrm;

use App\Models\Division;
use App\Models\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index()
    {
        $divisions = Division::orderBy('id', 'desc')->get();
        return view('admin.hrm.departments.divisions.index', compact('divisions'));
    }

    public function createOrEdit($id=null)
    {
        if($id){
            $data['title'] = 'Edit';
            $data['item'] = Division::find($id);
        }else{
            $data['title'] = 'Create';
        }
        $data['departments'] = Department::get();
        return view('admin.hrm.departments.divisions.create-or-edit',compact('data'));
    }
    
    public function store(Request $request)
    {
        $data = $request->all();
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
        // if(!Item::where('unit_id',$unit->id)->count())
        //     return redirect()->back()->with('alert',['messageType'=>'warning','message'=>'Data Deletion Failed!']);
        Division::destroy($id);
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>'Data Deleted Successfully!']);
    }
}
