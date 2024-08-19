<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BasicInfo;
use App\Models\Category;
use App\Models\Product;
use App\Models\StockHistory;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    
    public function index(Request $request)
    {
        if($request->isMethod('post')){
            $cat_id = $request->cat_id;
            $sub_cat_id = $request->sub_cat_id;
            $products = Product::query();
            if($cat_id) $products = $products->where('cat_id', $cat_id);
            if($sub_cat_id) $products = $products->where('sub_cat_id', $sub_cat_id);

            $data['products'] = $products->with(['category','sub_category','category_type','unit'])->orderBy('id','desc')->get();
            $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
            return response()->json($data, 200);

        }else{
            return view('admin.products.index');
        }
    }

    public function create()
    {
        $data['units'] = Unit::where('status',1)->get();
        $data['categories'] = Category::where('parent_cat_id', 0)->where('status',1)->get();
        return view('admin.products.create', compact('data'));
    }

    public function subCategory($catId)
    {
        $sub_categories = Category::where('parent_cat_id',$catId)->where('status',1)->get();
        return response()->json($sub_categories, 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['cat_id'] = Category::find($data['id'])->cat_id;
        if(isset($data['image'])){
            $fileName = 'item-'. time().'.'. $data['image']->getClientOriginalExtension();
            $data['image']->move(public_path('uploads/items'), $fileName);
            $data['image'] = $fileName;
        }
        $data['current_stock'] = $data['opening_stock']; 
        $product = Product::create($data);
        if(in_array($product->cat_type_id,[1,3]))
        {
            //Stock History Update
            $stockHistory = new StockHistory;
            $stockHistory->product_id = $product->id;
            $stockHistory->date = date('Y-m-d');
            $stockHistory->particular = 'Opening Stock';
            $stockHistory->stock_in_qty = $product->opening_stock;
            // $stockHistory->stock_out_qty = $value->quantity;
            $stockHistory->rate = $product->cost;
            $stockHistory->current_stock = $product->opening_stock;
            $stockHistory->created_by_id = Auth::guard('admin')->user()->id;
            $stockHistory->save();
        }
        return redirect()->route('products.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }

    public function edit($id=null)
    {
        if($id){
            $data['title'] = 'Edit';
            $data['product'] = Product::find($id);
            $data['categories'] = Category::where('parent_cat_id', 0)->where('status', 1)->get();
            $data['sub_categories'] = Category::where('parent_cat_id',$data['product']->cat_id)->where('status',1)->get();

        }else{
            $data['title'] = 'Create';
        }
        $data['units'] = Unit::where('status',1)->get();
        $data['categories'] = Category::where('parent_cat_id', 0)->where('status',1)->get();
        return view('admin.products.create-or-edit', compact('data'));
    }

    public function update(Request $request,$id)
    {
        $product = Product::find($id);
        $data = $request->all();
        $data['cat_type'] = Category::find($data['cat_id'])->cat_type;
        if(isset($data['image'])){
            $fileName = 'product-'. time().'.'. $data['image']->getClientOriginalExtension();
            $data['image']->move(public_path('uploads/products'), $fileName);
            $data['image'] = $fileName;
            if($product->product_image) unlink(public_path('uploads/products/'. $product->image));
        }
        $product->update($data);
        return redirect()->route('products.index')->with('alert',['messageType'=>'warning','message'=>'Data Updated Successfully!']);
    }

    public function destroy($id)
    {
        $stockHistory = StockHistory::where('product_id', $id)->exists();
        if($stockHistory) return redirect()->back()->with('alert',['messageType'=>'warning','message'=>'Data Deletion Failed!']);
        Product::destroy($id);
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>'Data Deleted Successfully!']);
    }
}
