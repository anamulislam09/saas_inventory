<?php

namespace App\Http\Controllers\admin;

use App\Models\Item;
use App\Models\StockHistory;
use App\Models\Unit;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\BasicInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        if($request->isMethod('post')){
            $cat_type_id = $request->cat_type_id;
            $cat_id = $request->cat_id;
            $sub_cat_id = $request->sub_cat_id;
            $items = Item::query();
            if($cat_type_id) $items = $items->where('cat_type_id', $cat_type_id);
            if($cat_id) $items = $items->where('cat_id', $cat_id);
            if($sub_cat_id) $items = $items->where('sub_cat_id', $sub_cat_id);

            $data['items'] = $items->with(['category','sub_category','category_type','unit'])->orderBy('id','desc')->get();
            $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
            return response()->json($data, 200);

        }else{
            $data['category_types'] = CategoryType::get();
            return view('admin.items.index',compact('data'));
        }
    }

    public function createOrEdit($id=null)
    {
        if($id){
            $data['title'] = 'Edit';
            $data['item'] = Item::find($id);
            $data['categories'] = Category::where(['parent_cat_id'=>0, 'cat_type_id'=> $data['item']->cat_type_id])->where('status',1)->get();
            $data['sub_categories'] = Category::where('parent_cat_id',$data['item']->cat_id)->where('status',1)->get();

        }else{
            $data['title'] = 'Create';
        }
        $data['category_types'] = CategoryType::get();
        $data['units'] = Unit::where('status',1)->get();
        return view('admin.items.create-or-edit', compact('data'));
    }

    public function subCategory($id=null)
    {
        $sub_categories = Category::where('parent_cat_id',$id)->where('status',1)->get();
        return response()->json($sub_categories, 200);
    }
    public function categories($id=null)
    {
        $categories = Category::where(['parent_cat_id'=>0, 'cat_type_id'=> $id])->where('status',1)->get();
        return response()->json($categories, 200);
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $data['cat_type_id'] = Category::find($data['cat_id'])->cat_type_id;
        if(isset($data['image'])){
            $fileName = 'item-'. time().'.'. $data['image']->getClientOriginalExtension();
            $data['image']->move(public_path('uploads/items'), $fileName);
            $data['image'] = $fileName;
        }
        $data['current_stock'] = $data['opening_stock']; 
        $item = Item::create($data);
        if(in_array($item->cat_type_id,[1,3]))
        {
            //Stock History Update
            $stockHistory = new StockHistory;
            $stockHistory->item_id = $item->id;
            $stockHistory->date = date('Y-m-d');
            $stockHistory->particular = 'Opening Stock';
            $stockHistory->stock_in_qty = $item->opening_stock;
            // $stockHistory->stock_out_qty = $value->quantity;
            $stockHistory->rate = $item->cost;
            $stockHistory->current_stock = $item->opening_stock;
            $stockHistory->created_by_id = Auth::guard('admin')->user()->id;
            $stockHistory->save();
        }
        return redirect()->route('items.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }

    public function update(Request $request,$id)
    {
        $item = Item::find($id);
        $data = $request->all();
        $data['cat_type'] = Category::find($data['cat_id'])->cat_type;
        if(isset($data['image'])){
            $fileName = 'item-'. time().'.'. $data['image']->getClientOriginalExtension();
            $data['image']->move(public_path('uploads/items'), $fileName);
            $data['image'] = $fileName;
            if($item->product_image) unlink(public_path('uploads/items/'. $item->image));
        }
        $item->update($data);
        return redirect()->route('items.index')->with('alert',['messageType'=>'warning','message'=>'Data Updated Successfully!']);
    }

    public function destroy($id)
    {
        $stockHistory = StockHistory::where('item_id', $id)->exists();
        if($stockHistory) return redirect()->back()->with('alert',['messageType'=>'warning','message'=>'Data Deletion Failed!']);
        Item::destroy($id);
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>'Data Deleted Successfully!']);
    }
}
