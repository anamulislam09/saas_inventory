<?php

namespace App\Http\Controllers\admin\hrm;

use App\Models\Holiday;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HolidayController extends Controller
{
    public function index()
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        $holidays = Holiday::where('client_id', $client_id)->orderBy('date', 'asc')->get();
        return view('admin.hrm.leaves.holidays.index', compact('holidays'));
    }
    public function holidaysByDate(Request $request)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        $date = $request->date;
        $holidays = Holiday::where('client_id', $client_id)->where('date', 'like', "%$date%")->orderBy('date', 'asc')->get();
        return response()->json($holidays, 200);
    }

    public function createOrEdit($id = null)
    {
        if ($id) {
            $data['title'] = 'Edit';
            $data['item'] = Holiday::find($id);
        } else {
            $data['title'] = 'Create';
        }
        return view('admin.hrm.leaves.holidays.create-or-edit', compact('data'));
    }

    public function store(Request $request)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;


        $data = $request->all();

        foreach ($data['date'] as $key => $date) {
            $data2['date'] = $data['date'][$key];
            $data2['client_id'] = $client_id;
            $data2['occasion'] = $data['occasion'][$key];
            Holiday::create($data2);
        }

        return redirect()->route('holidays.index')->with('alert', ['messageType' => 'success', 'message' => 'Data Inserted Successfully!']);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        Holiday::find($id)->update($data);
        return redirect()->route('holidays.index')->with('alert', ['messageType' => 'success', 'message' => 'Data Updated Successfully!']);
    }

    public function destroy($id)
    {
        Holiday::destroy($id);
        return redirect()->back()->with('alert', ['messageType' => 'success', 'message' => 'Data Deleted Successfully!']);
    }
}
