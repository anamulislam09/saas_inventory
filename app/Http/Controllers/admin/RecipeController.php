<?php

namespace App\Http\Controllers\admin;

use App\Models\Recipe;
use App\Models\RecipeDetails;
use App\Models\Unit;
use App\Models\BasicInfo;
use App\Models\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class RecipeController extends Controller
{
    public function index()
    {
        $data['recipes'] = Recipe::with(['item','created_by'])->orderBy('id', 'desc')->get();
        $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
        return view('admin.production.recipes.index', compact('data'));
    }

    public function createOrEdit($id=null)
    {
        if($id){
            $data['title'] = 'Edit';
            $data['item'] = Recipe::with(['item','created_by','details'])->find($id)->toArray();
        }else{
            $data['title'] = 'Create';
        }

        $data['raw_materials'] = Item::with('unit')->where('status',1)->where('cat_type_id',3)->orderBy('title','asc')->get();
        $data['production_items'] = Item::with('unit')->where('status',1)->where('cat_type_id',2)->orderBy('title','asc')->get();

        return view('admin.production.recipes.create-or-edit',compact('data'));
    }
    public function loadUnit($unit_type)
    {
        $data = Unit::where('unit_type', $unit_type)->get();
        return response()->json($data, 200);
    }
    public function vouchar($id,$print=null)
    {
        $data['recipes'] = Recipe::with(['item','created_by','details'])->find($id)->toArray();
        $data['basicInfo'] = BasicInfo::first();
        $data['currency_symbol'] = $data['basicInfo']->currency_symbol;
        return view('admin.production.recipes.view',compact('data'));
    }
    public function store(Request $request)
    {
        $isExist = Recipe::where('item_id', $request->item_id)->exists();
        if($isExist) return redirect()->route('recipes.index')->with('alert',['messageType'=>'warning','message'=>'Recipe already created!']);
        $recipe = new Recipe;
        $recipe->item_id = $request->item_id; 
        $recipe->total_cost = $request->total_cost; 
        $recipe->note = $request->note; 
        $recipe->recipe_status = $request->recipe_status; 
        $recipe->created_by_id = Auth::guard('admin')->user()->id;
        $recipe->save();
        Item::find($request->item_id)->update(['cost'=> $recipe->total_cost]);
        
        $raw_material_id = $request->raw_material_id;
        $sub_unit_price = $request->unit_price;
        $sub_unit_id = $request->sub_unit_id;
        $sub_quantity = $request->sub_quantity;
        $sub_total = $request->sub_total;

        for ($i=0; $i < count($raw_material_id); $i++) {
            
            $main_qty = $sub_quantity[$i];
            $main_unit_price = $sub_unit_price[$i];
            $main_unit_id = Item::find($raw_material_id[$i])->unit_id;

            if ($main_unit_id != $sub_unit_id[$i]) {
                if (in_array($sub_unit_id[$i],[1, 3])) $main_qty = $main_qty * 1000;
                if (in_array($sub_unit_id[$i],[2, 4])) $main_qty = $main_qty / 1000;
                $main_unit_price = $sub_total[$i] / $main_qty;
            }

            $recipeDetails = new RecipeDetails;
            $recipeDetails->recipe_id = $recipe->id;
            $recipeDetails->raw_material_id = $raw_material_id[$i];
            $recipeDetails->sub_quantity = $sub_quantity[$i];
            $recipeDetails->sub_unit_price = $sub_unit_price[$i];
            $recipeDetails->sub_unit_id = $sub_unit_id[$i];
            $recipeDetails->main_unit_id = $main_unit_id;
            $recipeDetails->main_quantity = $main_qty;
            $recipeDetails->main_unit_price = $main_unit_price;
            $recipeDetails->cost = $sub_total[$i];
            $recipeDetails->save();
        }
        return redirect()->route('recipes.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }

    public function update(Request $request, $id)
    {
        $recipe = Recipe::find($id);
        $recipe->item_id = $request->item_id; 
        $recipe->total_cost = $request->total_cost; 
        $recipe->note = $request->note; 
        $recipe->recipe_status = $request->recipe_status; 
        $recipe->updated_by_id = Auth::guard('admin')->user()->id;
        $recipe->save();
        Item::find($request->item_id)->update(['cost'=> $recipe->total_cost]);
        
        RecipeDetails::where('recipe_id', $id)->delete();


        $raw_material_id = $request->raw_material_id;
        $sub_unit_price = $request->unit_price;
        $sub_unit_id = $request->sub_unit_id;
        $sub_quantity = $request->sub_quantity;
        $sub_total = $request->sub_total;

        for ($i=0; $i < count($raw_material_id); $i++) {
            
            $main_qty = $sub_quantity[$i];
            $main_unit_price = $sub_unit_price[$i];
            $main_unit_id = Item::find($raw_material_id[$i])->unit_id;

            if ($main_unit_id != $sub_unit_id[$i]) {
                if (in_array($sub_unit_id[$i],[1, 3])) $main_qty = $main_qty * 1000;
                if (in_array($sub_unit_id[$i],[2, 4])) $main_qty = $main_qty / 1000;
                $main_unit_price = $sub_total[$i] / $main_qty;
            }

            $recipeDetails = new RecipeDetails;
            $recipeDetails->recipe_id = $recipe->id;
            $recipeDetails->raw_material_id = $raw_material_id[$i];
            $recipeDetails->sub_quantity = $sub_quantity[$i];
            $recipeDetails->sub_unit_price = $sub_unit_price[$i];
            $recipeDetails->sub_unit_id = $sub_unit_id[$i];
            $recipeDetails->main_unit_id = $main_unit_id;
            $recipeDetails->main_quantity = $main_qty;
            $recipeDetails->main_unit_price = $main_unit_price;
            $recipeDetails->cost = $sub_total[$i];
            $recipeDetails->save();
        }
        return redirect()->route('recipes.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }

    public function destroy($id)
    {
        Recipe::destroy($id);
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>'Data Deleted Successfully!']);
    }
}