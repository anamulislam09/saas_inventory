<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with(['category_type'])->where('parent_cat_id',0)->orderBy('id', 'desc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function createOrEdit($id=null)
    {
        if($id){
            $data['title'] = 'Edit';
            $data['item'] = Category::find($id);
        }else{
            $data['title'] = 'Create';
        }
        $data['category_types'] = CategoryType::get();
        return view('admin.categories.create-or-edit',compact('data'));
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
        return redirect()->route('categories.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
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
        return redirect()->route('categories.index')->with('alert',['messageType'=>'success','message'=>'Data Updated Successfully!']);
    }
    
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $itemsCount = Item::where('cat_id', $category->id)->count();

            if ($itemsCount > 0) {
                throw new \Exception('Cannot delete category with associated items!');
            }

            if (!empty($category->image)) {
                $imagePath = public_path('uploads/category/' . $category->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $category->delete();

            return redirect()->back()->with('alert', [
                'messageType' => 'success',
                'message' => 'Category deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('alert', [
                'messageType' => 'warning',
                'message' => $e->getMessage()
            ]);
        }
    }


}
