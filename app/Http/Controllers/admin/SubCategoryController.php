<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class SubCategoryController extends Controller
{
    public function index()
    {
        $sub_categories = Category::where('parent_cat_id','!=',0)->orderBy('id', 'desc')->get();
        return view('admin.sub-categories.index', compact('sub_categories'));
    }

    public function createOrEdit($id=null)
    {
        if($id){
            $data['title'] = 'Edit';
            $data['item'] = Category::find($id);
        }else{
            $data['title'] = 'Create';
        }
        $data['categories'] = Category::where('parent_cat_id', 0)->get();
        return view('admin.sub-categories.create-or-edit',compact('data'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if(isset($data['image'])){
            $fileName = 'cat-'. time().'.'. $data['image']->getClientOriginalExtension();
            $data['image']->move(public_path('uploads/category'), $fileName);
            $data['image'] = $fileName;
        }
        $category = Category::create($data);
        return redirect()->route('sub-categories.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $data = $request->all();
        if(isset($data['image'])){
            $fileName = 'cat-'. time().'.'. $data['image']->getClientOriginalExtension();
            $data['image']->move(public_path('uploads/category'), $fileName);
            $data['image'] = $fileName;
            if($category->image) unlink(public_path('uploads/category/'.$category->image));
        }
        $category->update($data);
        return redirect()->route('sub-categories.index')->with('alert',['messageType'=>'success','message'=>'Data Updated Successfully!']);
    }
    
    public function destroy($id)
    {
        $category = Category::find($id);
        $imagePath = public_path('uploads/category/'.$category->image);
        if($category->image) unlink($imagePath);
        $category->delete();
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>'Data Deleted Successfully!']);
    }
}
