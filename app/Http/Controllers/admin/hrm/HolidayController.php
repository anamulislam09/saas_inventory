<?php

namespace App\Http\Controllers\admin\hrm;

use App\Models\Holiday;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function index()
    {
        $holidays = Holiday::orderBy('date', 'asc')->get();
        return view('admin.hrm.leaves.holidays.index', compact('holidays'));
    }
    public function holidaysByDate(Request $request)
    {
        $date = $request->date;
        $holidays = Holiday::where('date','like',"%$date%")->orderBy('date', 'asc')->get();
        return response()->json($holidays, 200);
    }

    public function createOrEdit($id=null)
    {
        if($id){
            $data['title'] = 'Edit';
            $data['item'] = Holiday::find($id);
        }else{
            $data['title'] = 'Create';
        }
        return view('admin.hrm.leaves.holidays.create-or-edit',compact('data'));
    }
    
    public function store(Request $request)
    {
        $data = $request->all();

        foreach ($data['date'] as $key => $date) {
            $data2['date'] = $data['date'][$key];
            $data2['occasion'] = $data['occasion'][$key];
            Holiday::create($data2);
        }

        return redirect()->route('holidays.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        Holiday::find($id)->update($data);
        return redirect()->route('holidays.index')->with('alert',['messageType'=>'success','message'=>'Data Updated Successfully!']);
    }

    public function destroy($id)
    {
        Holiday::destroy($id);
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>'Data Deleted Successfully!']);
    }
}

