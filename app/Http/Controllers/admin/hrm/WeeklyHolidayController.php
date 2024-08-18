<?php

namespace App\Http\Controllers\admin\hrm;

use App\Models\WeeklyHoliday;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WeeklyHolidayController extends Controller
{
    public function index()
    {
        $weeklyHolidays = WeeklyHoliday::first();
        
        return view('admin.hrm.leaves.weekly-holidays.index', compact('weeklyHolidays'));
    }
    public function createOrEdit($id=null)
    {
        $data['title'] = 'Edit';
        $data['item'] = WeeklyHoliday::find($id);
        return view('admin.hrm.leaves.weekly-holidays.create-or-edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data['saturday'] = $request->saturday?1:0;
        $data['sunday'] = $request->sunday?1:0;
        $data['monday'] = $request->monday?1:0;
        $data['tuesday'] = $request->tuesday?1:0;
        $data['wednesday'] = $request->wednesday?1:0;
        $data['thursday'] = $request->thursday?1:0;
        $data['friday'] = $request->friday?1:0;
        WeeklyHoliday::find($id)->update($data);
        return redirect()->route('weekly-holidays.index')->with('alert',['messageType'=>'success','message'=>'Data Updated Successfully!']);
    }

    public function destroy($id)
    {
        WeeklyHoliday::destroy($id);
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>'Data Deleted Successfully!']);
    }
}
