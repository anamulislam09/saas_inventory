<?php

namespace App\Http\Controllers\admin\hrm;

use App\Models\WeeklyHoliday;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeeklyHolidayController extends Controller
{
    public function index()
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        $isExist = WeeklyHoliday::where('client_id', $client_id)->exists();
        if ($isExist) {
            $weeklyHolidays = WeeklyHoliday::where('client_id', $client_id)->first();
        } else {
            $weeklyHolidays = WeeklyHoliday::where('client_id', 0)->first();
        }
        return view('admin.hrm.leaves.weekly-holidays.index', compact('weeklyHolidays'));
    }
    
    public function createOrEdit($id = null)
    {
        $data['title'] = 'Edit';
        $data['item'] = WeeklyHoliday::find($id);
        return view('admin.hrm.leaves.weekly-holidays.create-or-edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        // Get client information
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;
        
        $isClient = $request->client_id;
        // Check if creating a new record or updating an existing one
        $data['saturday'] = $request->saturday ? 1 : 0;
        $data['sunday'] = $request->sunday ? 1 : 0;
        $data['monday'] = $request->monday ? 1 : 0;
        $data['tuesday'] = $request->tuesday ? 1 : 0;
        $data['wednesday'] = $request->wednesday ? 1 : 0;
        $data['thursday'] = $request->thursday ? 1 : 0;
        $data['friday'] = $request->friday ? 1 : 0;

        if ($isClient == 0) {
            $data['client_id'] = $client_id;
            // Create a new record if no client ID
            WeeklyHoliday::create($data);
        } else {
            // Check if the record exists before updating
            $weeklyHolidays = WeeklyHoliday::find($id);
            if ($weeklyHolidays) {
                $weeklyHolidays->update($data);
            } else {
                // Handle the case where the record is not found
                return redirect()->back()->with('alert', ['messageType' => 'error', 'message' => 'Record not found!']);
            }
        }

        // Redirect with success message
        return redirect()->route('weekly-holidays.index')->with('alert', ['messageType' => 'success', 'message' => 'Data Updated Successfully!']);
    }

    public function destroy($id)
    {
        WeeklyHoliday::destroy($id);
        return redirect()->back()->with('alert', ['messageType' => 'success', 'message' => 'Data Deleted Successfully!']);
    }
}
