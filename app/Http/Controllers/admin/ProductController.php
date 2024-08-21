<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\BasicInfo;
use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use App\Models\StockHistory;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        if (Auth::guard('admin')->user()->client_id == 0) {
            $products = Product::where('client_id', Auth::guard('admin')->user()->id)->orderBy('id')->get();
        } else {
            $products = Product::where('client_id', $client->id)->orderBy('id')->get();
        }
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        if (Auth::guard('admin')->user()->client_id == 0) {
            $data['categories'] = Category::where('client_id', Auth::guard('admin')->user()->id)->where('parent_cat_id', 0)->where('status', 1)->get();
        } else {
            $data['categories'] = Category::where('client_id', $client->id)->where('parent_cat_id', 0)->where('status', 1)->get();
        }

        $data['units'] = Unit::where('status', 1)->get();
        return view('admin.products.create', compact('data'));
    }

    public function subCategory($catId)
    {

        $sub_category = Category::where('parent_cat_id', $catId)->where('status', 1)->get();
        return response()->json($sub_category, 200);
    }

    public function store(Request $request)
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();

        $data = $request->all();
        if (Auth::guard('admin')->user()->client_id == 0) {
            $data['client_id'] = Auth::guard('admin')->user()->id;
        } else {
            $data['client_id'] = $client->id;
        }
        $data['created_by'] = Auth::guard('admin')->user()->id;
        if (isset($data['image'])) {
            $fileName = 'item-' . time() . '.' . $data['image']->getClientOriginalExtension();
            $data['image']->move(public_path('uploads/product'), $fileName);
            $data['image'] = $fileName;
        }
        $product = Product::create($data);
        if ($product) {
            $data['client_id'] = $product->client_id;
            $data['product_id'] = $product->id;
            $data['date'] = date('Y-m-d');
            $data['created_by_id'] = Auth::guard('admin')->user()->id;
            Stock::create($data);
        }

        return redirect()->route('products.index')->with('alert', ['messageType' => 'success', 'message' => 'Product Inserted Successfully!']);
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        $units = Unit::where('status', 1)->get();

        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        if (Auth::guard('admin')->user()->client_id == 0) {
            $categories = Category::where('client_id', Auth::guard('admin')->user()->id)->where('parent_cat_id', 0)->where('status', 1)->get();
        } else {
            $categories = Category::where('client_id', $client->id)->where('parent_cat_id', 0)->where('status', 1)->get();
        }
        return view('admin.products.edit', compact('product', 'units', 'categories'));
    }

    public function update(Request $request)
    {
        $product = Product::find($request->id);
        $data = $request->all();
        if (isset($data['image'])) {
            $fileName = 'product-' . time() . '.' . $data['image']->getClientOriginalExtension();
            $data['image']->move(public_path('uploads/product'), $fileName);
            $data['image'] = $fileName;
            if ($product->product_image) unlink(public_path('uploads/product/' . $product->image));
        }
        $product->update($data);
        return redirect()->route('products.index')->with('alert', ['messageType' => 'warning', 'message' => 'Product Updated Successfully!']);
    }

    public function destroy($id)
    {
        $stockHistory = StockHistory::where('product_id', $id)->exists();
        if ($stockHistory) return redirect()->back()->with('alert', ['messageType' => 'warning', 'message' => 'Data Deletion Failed!']);
        Product::destroy($id);
        return redirect()->back()->with('alert', ['messageType' => 'success', 'message' => 'Data Deleted Successfully!']);
    }
}
