<?php

namespace App\Http\Controllers\admin;

use App\Models\Unit;
use App\Models\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::orderBy('id', 'desc')->get();
        return view('admin.units.index', compact('units'));
    }

    public function createOrEdit($id=null)
    {
        if($id){
            $data['title'] = 'Edit';
            $data['item'] = Unit::find($id);
        }else{
            $data['title'] = 'Create';
        }
        return view('admin.units.create-or-edit',compact('data'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $category = Unit::create($data);
        return redirect()->route('units.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }


    public function update(Request $request, $id)
    {
        $unit = Unit::find($id);
        $data = $request->all();
        $unit->update($data);
        return redirect()->route('units.index')->with('alert',['messageType'=>'success','message'=>'Data Updated Successfully!']);
    }
    
    public function destroy($id)
    {
        $unit = Unit::find($id);
        $data = Item::where('unit_id',$unit->id)->get();
        if(count($data)) return redirect()->back()->with('alert',['messageType'=>'warning','message'=>'Data Deletion Failed!']);
        $unit->delete();
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>'Data Deleted Successfully!']);
    }
}
