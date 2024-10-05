<?php

namespace App\Http\Controllers\admin\hrm;

use App\Models\Employee;
use App\Models\Benefit;
use App\Models\Country;
use App\Models\Department;
use App\Models\Designation;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index()
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        $employees = Employee::where('client_id', $client_id)->orderBy('id', 'desc')->get();
        return view('admin.hrm.hrm.employees.index', compact('employees'));
    }

    public function createOrEdit($id = null)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        if ($id) {
            $data['title'] = 'Edit';
            $data['item'] = Employee::find($id);
            $data['benefits'] = Benefit::where('employee_id', $id)->get();
        } else {
            $data['title'] = 'Create';
        }
        $data['countries'] = Country::where('status', 1)->get();
        $data['divisions'] = Department::where('client_id', $client_id)->with('divisions')->get();
        $data['designations'] = Designation::where('client_id', $client_id)->get();
        return view('admin.hrm.hrm.employees.create-or-edit', compact('data'));
    }

    public function store(Request $request)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        $client_id = Auth::guard('admin')->user()->client_id == 0 ? Auth::guard('admin')->user()->id : $client->id;

        $data = $request->all();
        $data['client_id'] = $client_id;
        if (isset($data['image'])) {
            $fileName = 'emp-' . time() . '.' . $data['image']->getClientOriginalExtension();
            $data['image']->move(public_path('uploads/employee'), $fileName);
            $data['image'] = $fileName;
        }
        $data['remaining_leave'] = $data['allocate_leave'];
        $employee = Employee::create($data);

        for ($i = 0; $i < count($data['code']); $i++) {
            $data2['employee_id'] = $employee->id;
            $data2['code'] = $data['code'][$i];
            $data2['description'] = $data['description'][$i];
            $data2['accrual_date'] = $data['accrual_date'][$i];
            $data2['status'] = $data['status'][$i];
            Benefit::create($data2);
        }
        return redirect()->route('employees.index')->with('alert', ['messageType' => 'success', 'message' => 'Data Inserted Successfully!']);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $employee = Employee::find($id);
        if (isset($data['image'])) {
            $fileName = 'emp-' . time() . '.' . $data['image']->getClientOriginalExtension();
            $data['image']->move(public_path('uploads/employee'), $fileName);
            $data['image'] = $fileName;
            if ($employee->image) unlink(public_path('uploads/employee/' . $employee->image));
        }
        $employee->update($data);
        for ($i = 0; $i < count($data['code']); $i++) {
            $data2['employee_id'] = $id;
            $benefit_id = isset($data['benefit_id'][$i]) ? $data['benefit_id'][$i] : null;
            $data2['code'] = $data['code'][$i];
            $data2['description'] = $data['description'][$i];
            $data2['accrual_date'] = $data['accrual_date'][$i];
            $data2['status'] = $data['benefit_status'][$i];
            Benefit::updateOrCreate(['id' => $benefit_id], $data2);
        }
        return redirect()->route('employees.index')->with('alert', ['messageType' => 'success', 'message' => 'Data Updated Successfully!']);
    }

    public function destroy($id)
    {
        Employee::destroy($id);
        return redirect()->back()->with('alert', ['messageType' => 'success', 'message' => 'Data Deleted Successfully!']);
    }
}
