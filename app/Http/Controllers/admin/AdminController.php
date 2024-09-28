<?php

namespace App\Http\Controllers\admin;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Hash;

class AdminController extends Controller
{
    public function index()
    {
        $adminId = Auth::guard('admin')->user()->id;
        $admins = Admin::where('admins.id', $adminId)
            ->orWhere('admins.client_id', $adminId)
            ->join('roles', 'roles.id', '=', 'admins.type')
            ->where('roles.is_superadmin', 0)
            ->select('admins.*', 'roles.role')
            ->get();
        // $admins = Admin::where('id', $adminId)->where('is_client', 1)->whereIn('client_id', [0, $adminId])->join('roles', 'roles.id', '=', 'admins.type')->where('roles.is_superadmin', 0)->select('admins.*', 'roles.role')->get();
        return view('admin.admins.index', compact('admins'));
    }
    public function createOrEdit($id = null)
    {
        if ($id) {
            $data['title'] = 'Edit';
            $data['item'] = Admin::find($id);
        } else {
            $data['title'] = 'Create';
        }
        $data['roles'] = Role::where('roles.is_superadmin', 0)->orderBy('role', 'asc')->get();
        return view('admin.admins.create-edit', compact('data'));
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $admin = Admin::where('email', $data['email'])->first();
        if ($admin) {
            return redirect()->back()->with('alert', ['messageType' => 'danger', 'message' => 'This email is already exists!']);
        }
        $data['client_id'] = Auth::guard('admin')->user()->id;
        $data['password'] = Hash::make($data['password']);
        Admin::create($data);
        return redirect()->route('admins.index')->with('alert', ['messageType' => 'success', 'message' => 'User Inserted Successfully!']);
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);
        $data = $request->all();
        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $admin->update($data);
        return redirect()->route('admins.index')->with('alert', ['messageType' => 'success', 'message' => 'User Updated Successfully!']);
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);
        $admin->update(['status' => 0]);
        return redirect()->back()->with('alert', ['messageType' => 'success', 'message' => 'User Inactivated Successfully!']);
    }

    public function updateDetails(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (isset($data['image'])) {
                $image = 'admin-' . time() . '.' . $data['image']->getClientOriginalExtension();
                $data['image']->move(public_path('uploads/admin'), $image);
                $data['image'] = $image;
                if (Auth::guard('admin')->user()->image) {
                    unlink(public_path('uploads/admin/') . Auth::guard('admin')->user()->image);
                }
            }
            Admin::find($id)->update($data);
            return redirect()->back()->with('alert', ['messageType' => 'success', 'message' => 'Data Updated Successfully!']);
        }
        $adminType = Role::find(Auth::guard('admin')->user()->type)->role;
        return view('admin.settings.update-details', compact('adminType'));
    }
    public function updatePassword(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $data = Admin::find($id)->update(['password' => Hash::make($request->new_password)]);
            return response()->json($data, 200);
        }
        return view('admin.settings.update-password');
    }

    public function checkPassword(Request $request)
    {
        if (Hash::check($request->current_password, Auth::guard('admin')->user()->password)) {
            $data = true;
        } else {
            $data = false;
        }
        return response()->json($data, 200);
    }

    public function login(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('dashboard.index');
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'email' => 'required|email|max:255',
                'password' => 'required',
            ], [
                'email.email' => 'Please enter a valid email',
                'email.required' => 'Email is required',
                'password.required' => 'Password is required',
            ]);
            $credentials = $request->only('email', 'password');
            $credentials['status'] = 1;
            $remember = $request->filled('remember_me');
            if (Auth::guard('admin')->attempt($credentials, $remember)) {
                return redirect()->route('dashboard.index');
            } else {
                return redirect()->back()->withInput()->withErrors([
                    'email' => 'Invalid credentials or account not active.',
                ]);
            }
        }
        // $admins = Admin::join('roles', 'roles.id', '=', 'admins.type')->where('status', 1)->select('admins.*', 'roles.role')->get();
        return view('admin.auth.login');
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
