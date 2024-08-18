<?php

namespace App\Http\Controllers\admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Menu;
use App\Models\Privilege;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('admin')->where('is_superadmin',0)->orderBy('id','desc')->get();
        return view('admin.roles.index', compact('roles'));
    }
    public function createOrEdit($id=null)
    {
        if($id){
            $data['title'] = 'Edit';
            $data['items'] = Role::find($id);
            $data['items']->menu_ids = Privilege::where('role_id', $id)->get()->pluck(['menu_id'])->toArray();
        }else{
            $data['title'] = 'Create';
        }
        $data['menus'] = Menu::with('children.children.children')->where('parent_id',0)->orderBy('id','asc')->get();
        // $data['roles'] = Role::where('roles.is_superadmin',0)->orderBy('role','asc')->get();
        return view('admin.roles.create-edit',compact('data'));
    }

    // public function create()
    // {
    //     $menus = Menu::with('submenu')->where('parent_id',0)->get();
    //     return view('admin.roles.create',compact('menus'));
    // }

    public function store(Request $request)
    {
        $data['created_by'] = Auth::guard('admin')->user()->id;
        $data['role'] = $request->role;
        $role = Role::create($data);
        $menu_ids = $request->menu_id;

        if($menu_ids && (!in_array(1,$menu_ids))) $menu_ids[count($menu_ids)] = 1;

        foreach($menu_ids as $key => $menu_id){
            $data2['role_id'] = $role->id;
            $data2['menu_id'] = $menu_id;
            Privilege::create($data2);
        }
        return redirect()->route('roles.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }

    // public function edit($id)
    // {
    //     $role = Role::find($id);
    //     $menus = Menu::with('submenu')->where('parent_id',0)->get();
    //     $privileges = Privilege::where('role_id', $role->id)->get()->toArray();
    //     return view('admin.roles.edit',compact('role','menus','privileges'));
    // }


    public function update(Request $request,$id)
    {
        $role = Role::find($id);
        Privilege::where('role_id', $role->id)->delete();
        $data['created_by'] = Auth::guard('admin')->user()->id;
        $data['role'] = $request->role;
        $role->update($data);
        $menu_ids = $request->menu_id;
        if($menu_ids && (!in_array(1,$menu_ids))){
            $menu_ids[count($menu_ids)] = '1';
        }
        foreach ($menu_ids as $key => $menu_id){
            $data2['role_id'] = $role->id;
            $data2['menu_id'] = $menu_id;
            Privilege::create($data2);
        }
        return redirect()->route('roles.index')->with('alert',['messageType'=>'success','message'=>'Data Updated Successfully!']);
    }
    public function destroy($id)
    {
        $role = Role::find($id);
        $admin = Admin::where('type',$role->id)->get();
        if(!count($admin))
        {
            Privilege::where('role_id', $role->id)->delete();
            $role->delete();
            return redirect()->back()->with('alert',['messageType'=>'danger','message'=>'Data Deleted Successfully!']);
        }
        return redirect()->back()->with('alert',['messageType'=>'warning','message'=>'Data Deletion Failed!']);
    }
}
