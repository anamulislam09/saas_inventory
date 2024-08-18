<?php

namespace App\Http\Controllers\admin;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('children.children.children')->where('parent_id',0)->orderBy('id','desc')->get();
        return view('admin.menus.index', compact('menus'));
    }
    public function createOrEdit($id=null,$addmenu=null)
    {
        if($addmenu){
            $data['title'] = 'Create';
            $data['addmenu'] = Menu::find($id)->toArray();
        }else if($id){
            $data['title'] = 'Edit';
            $data['item'] = Menu::find($id)->toArray();
        }else{
            $data['title'] = 'Create';
        }
        $data['menus'] = Menu::with('children.children.children')->where('parent_id',0)->orderBy('id','desc')->get()->toArray();
        return view('admin.menus.create-or-edit',compact('data'));
    }
    public function store(Request $request)
    {
        $data = $request->all();
        Menu::create($data);
        return redirect()->route('menus.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }
    public function update(Request $request, $id)
    {
        $data = $request->all();
        Menu::find($id)->update($data);
        return redirect()->route('menus.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }
    public function destroy($id)
    {
        Menu::destroy($id);
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>'Data Deleted Successfully!']);
    }
}
