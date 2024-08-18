<?php

namespace App\Http\Controllers\admin;

use App\Models\Table;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $tables = Table::where('is_default','!=',1)->orderBy('title', 'asc')->get();
        return view('admin.tables.index', compact('tables'));
    }

    public function createOrEdit($id=null)
    {
        if($id){
            $data['title'] = 'Edit';
            $data['item'] = Table::find($id);
        }else{
            $data['title'] = 'Create';
        }
        return view('admin.tables.create-or-edit',compact('data'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        Table::create($data);
        return redirect()->route('tables.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }
    public function update(Request $request,$id)
    {
        $table = Table::find($id);
        $data = $request->all();
        $table->update($data);
        return redirect()->route('tables.index')->with('alert',['messageType'=>'success','message'=>'Data Updated Successfully!']);
    }
    public function destroy($id)
    {
        $table = Table::find($id);
        $order = Order::where('table_id',$table->id)->count();
        if(!($order || $table->is_default==1)){
            Table::destroy($id);
            return redirect()->back()->with('alert',['messageType'=>'success','message'=>'Data Deleted Successfully!']);
        }
        return redirect()->back()->with('alert',['messageType'=>'warning','message'=>'Data Deletion Faild!']);
    }
}
