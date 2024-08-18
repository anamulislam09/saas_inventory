<?php

namespace App\Http\Controllers\admin;

use App\Models\ProductionPlan;
use App\Models\PPDetails;
use App\Models\PPDRawMaterial;
use App\Models\Recipe;
use App\Models\RecipeDetails;
use App\Models\BasicInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ProductionPlanController extends Controller
{
    public function index()
    {
        $data['production_plans'] = ProductionPlan::orderBy('id', 'desc')->get();
        return view('admin.production.production-plans.index', compact('data'));
    }

    public function createOrEdit($id=null)
    {
        if($id){
            $data['title'] = 'Edit';
            $data['item'] = ProductionPlan::with(['ppdetails.recipe.item.unit','ppdraw_materials.item.unit'])->find($id)->toArray();
        }else{
            $data['title'] = 'Create';
        }
        $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
        $data['recipes'] = Recipe::with('item.unit')->get();
        return view('admin.production.production-plans.create-or-edit',compact('data'));
    }
    public function view($id)
    {
        $data['production_plan'] = ProductionPlan::with(['ppdetails.recipe.item.unit','ppdraw_materials.item.unit'])->find($id)->toArray();
        $data['basicInfo'] = BasicInfo::first();
        return view('admin.production.production-plans.view',compact('data'));
    }

    public function store(Request $request)
    {
        $date = $request->date;
        $note = $request->note;
        $recipe_id = $request->recipe_id;
        $quantity = $request->quantity;
        $created_by_id = Auth::guard('admin')->user()->id;

        //Production Plan create*****
        $productionPlan = new ProductionPlan();
        $productionPlan->plan_no = $this->formatNumber(ProductionPlan::max('plan_no')+1);
        $productionPlan->date = $date;
        $productionPlan->note = $note;
        $productionPlan->status = 1;
        $productionPlan->created_by_id = $created_by_id;
        $productionPlan->save();
        //End*****
        for ($i=0; $i < count($recipe_id); $i++)
        {
            //Production Plan Details create*****
            $ppDetails = new PPDetails;
            $ppDetails->pp_id = $productionPlan->id;
            $ppDetails->recipe_id = $recipe_id[$i];
            $ppDetails->quantity = $quantity[$i];
            $ppDetails->save();
            $recipeDetails = RecipeDetails::where('recipe_id', $ppDetails->recipe_id)->get();
            foreach ($recipeDetails as $key => $rd) {
                $ppdRawMaterial = PPDRawMaterial::where(['pp_id'=>$productionPlan->id,'raw_material_id'=>$rd->raw_material_id])->first();
                if($ppdRawMaterial){
                    $ppdRawMaterial->quantity += $rd->main_quantity * $ppDetails->quantity;
                }else{
                    $ppdRawMaterial = new PPDRawMaterial;
                    $ppdRawMaterial->pp_id = $productionPlan->id;
                    $ppdRawMaterial->raw_material_id = $rd->raw_material_id;
                    $ppdRawMaterial->quantity = $rd->main_quantity * $ppDetails->quantity;
                }
                $ppdRawMaterial->save();
            }
            //End*****
        }
        return redirect()->route('production-plans.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }

    public function update(Request $request, $id)
    {
        $date = $request->date;
        $note = $request->note;
        $recipe_id = $request->recipe_id;
        $quantity = $request->quantity;
        $updated_by_id = Auth::guard('admin')->user()->id;

        //Production Plan create*****
        $productionPlan = ProductionPlan::find($id);
        $productionPlan->plan_no = $this->formatNumber(ProductionPlan::max('plan_no')+1);
        $productionPlan->date = $date;
        $productionPlan->note = $note;
        $productionPlan->status = 1;
        $productionPlan->updated_by_id = $updated_by_id;
        $productionPlan->save();
        //End*****

        PPDetails::where('pp_id', $id)->delete();
        PPDRawMaterial::where('pp_id', $id)->delete();

        for ($i=0; $i < count($recipe_id); $i++)
        {
            //Production Plan Details create*****
            $ppDetails = new PPDetails;
            $ppDetails->pp_id = $productionPlan->id;
            $ppDetails->recipe_id = $recipe_id[$i];
            $ppDetails->quantity = $quantity[$i];
            $ppDetails->save();
            $recipeDetails = RecipeDetails::where('recipe_id', $ppDetails->recipe_id)->get();
            foreach ($recipeDetails as $key => $rd) {
                $ppdRawMaterial = PPDRawMaterial::where(['pp_id'=>$productionPlan->id,'raw_material_id'=>$rd->raw_material_id])->first();
                if($ppdRawMaterial){
                    $ppdRawMaterial->quantity += $rd->main_quantity * $ppDetails->quantity;
                }else{
                    $ppdRawMaterial = new PPDRawMaterial;
                    $ppdRawMaterial->pp_id = $productionPlan->id;
                    $ppdRawMaterial->raw_material_id = $rd->raw_material_id;
                    $ppdRawMaterial->quantity = $rd->main_quantity * $ppDetails->quantity;
                }
                $ppdRawMaterial->save();
            }
            //End*****
        }
        return redirect()->route('production-plans.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }

    public function destroy($id)
    {
        ProductionPlan::destroy($id);
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>'Data Deleted Successfully!']);
    }
    public function formatNumber($srl)
    {
        switch(strlen($srl)){
            case 1:
                $zeros = '000000';
                break;
            case 2:
                $zeros = '00000';
                break;
            case 3:
                $zeros = '0000';
                break;
            case 4:
                $zeros = '000';
                break;
            case 5:
                $zeros = '00';
                break;
            default:
                $zeros = '0';
            break;
        }
        return $zeros . $srl;
    }
}