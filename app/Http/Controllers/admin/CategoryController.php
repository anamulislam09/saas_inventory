<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use App\Models\Item;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Auth;

class CategoryController extends Controller
{
    public function index()
    {

        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        if (Auth::guard('admin')->user()->client_id == 0) {
            $categories = Category::where('client_id', Auth::guard('admin')->user()->id)->where('parent_cat_id', 0)->orderBy('id', 'desc')->get();
        } else {
            $categories = Category::where('client_id', $client->id)->where('parent_cat_id', 0)->orderBy('id', 'desc')->get();
        }
        return view('admin.categories.index', compact('categories'));
    }

    public function createOrEdit($id = null)
    {
        if ($id) {
            $data['title'] = 'Edit';
            $data['item'] = Category::find($id);
        } else {
            $data['title'] = 'Create';
        }
        return view('admin.categories.create-or-edit', compact('data'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();

        if (Auth::guard('admin')->user()->client_id == 0) {
            $data['client_id'] = Auth::guard('admin')->user()->id;
        } else {
            $data['client_id'] = $client->id;
        }

        if (isset($data['image'])) {
            $fileName = 'cat-' . time() . '.' . $data['image']->getClientOriginalExtension();
            $data['image']->move(public_path('uploads/category'), $fileName);
            $data['image'] = $fileName;
        }
        $category = Category::create($data);
        return redirect()->route('categories.index')->with('alert', ['messageType' => 'success', 'message' => 'Data Inserted Successfully!']);
    }


    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $data = $request->all();
        if (isset($data['image'])) {
            $fileName = 'cat-' . time() . '.' . $data['image']->getClientOriginalExtension();
            $data['image']->move(public_path('uploads/category'), $fileName);
            $data['image'] = $fileName;
            if ($category->image) unlink(public_path('uploads/category/' . $category->image));
        }
        $category->update($data);
        return redirect()->route('categories.index')->with('alert', ['messageType' => 'success', 'message' => 'Data Updated Successfully!']);
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);

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
