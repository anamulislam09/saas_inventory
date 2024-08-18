<?php


namespace App\Http\Controllers\admin\hrm;

use App\Models\Designation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function index()
    {
        $designations = Designation::orderBy('id', 'desc')->get();
        return view('admin.hrm.hrm.designations.index', compact('designations'));
    }

    public function createOrEdit($id=null)
    {
        if($id){
            $data['title'] = 'Edit';
            $data['item'] = Designation::find($id);
        }else{
            $data['title'] = 'Create';
        }
        return view('admin.hrm.hrm.designations.create-or-edit',compact('data'));
    }
    
    public function store(Request $request)
    {
        $data = $request->all();
        Designation::create($data);
        return redirect()->route('designations.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();
        Designation::find($id)->update($data);
        return redirect()->route('designations.index')->with('alert',['messageType'=>'success','message'=>'Data Updated Successfully!']);
    }

    public function destroy($id)
    {
        // if(!Item::where('unit_id',$unit->id)->count())
        //     return redirect()->back()->with('alert',['messageType'=>'warning','message'=>'Data Deletion Failed!']);
        Designation::destroy($id);
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>'Data Deleted Successfully!']);
    }
}
