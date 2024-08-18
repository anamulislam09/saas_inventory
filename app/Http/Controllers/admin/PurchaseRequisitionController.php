<?php

namespace App\Http\Controllers\admin;

use App\Models\ProductionPlan;
use App\Models\PurchaseRequisition;
use App\Models\PurchaseRequisitionDetails;
use App\Models\BasicInfo;
use App\Models\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

class PurchaseRequisitionController extends Controller
{
    public function index()
    {
        $data['purchaseRequisitions'] = PurchaseRequisition::with(['created_by'])->orderBy('id', 'desc')->get();
        $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
        return view('admin.production.purchase-requisitions.index', compact('data'));
    }

    public function createOrEdit($id=null)
    {
        if($id){
            $data['title'] = 'Edit';
            $data['item'] = PurchaseRequisition::with(['prdetails.item'])->find($id);
        }else{
            $data['title'] = 'Create';
        }
        return view('admin.production.purchase-requisitions.create-or-edit',compact('data'));
    }
    public function vouchar($id,$print=null)
    {
        $data['purchaseRequisitions'] = PurchaseRequisition::with(['prdetails.item'])->find($id);
        $data['basicInfo'] = BasicInfo::first();
        $data['currency_symbol'] = $data['basicInfo']->currency_symbol;
        $data['print'] = $print;
        return view('admin.production.purchase-requisitions.view',compact('data'));
    }

    public function store(Request $request)
    {
        $date = $request->date;
        $total = $request->total;
        $note = $request->note;

        $item_id = $request->item_id;
        $unit_price = $request->unit_price;
        $quantity = $request->quantity;
        $created_by_id = Auth::guard('admin')->user()->id;

        //Purchase create*****
        $purchaseRequisition = new PurchaseRequisition;
        $purchaseRequisition->vouchar_no = $this->formatNumber(PurchaseRequisition::max('vouchar_no')+1);
        $purchaseRequisition->date = $date;
        $purchaseRequisition->total_price = $total;
        $purchaseRequisition->note = $note;
        $purchaseRequisition->status = 1;
        $purchaseRequisition->created_by_id = $created_by_id;
        $purchaseRequisition->save();
        //End*****

        for ($i=0; $i < count($item_id); $i++)
        {
            //Purchase Details create*****
            $purchaseRequisitionDetails = new PurchaseRequisitionDetails();
            $purchaseRequisitionDetails->purchase_requisition_id = $purchaseRequisition->id;
            $purchaseRequisitionDetails->item_id = $item_id[$i];
            $purchaseRequisitionDetails->item_type_id = Item::find($item_id[$i])->cat_type_id;
            $purchaseRequisitionDetails->quantity = $quantity[$i];
            $purchaseRequisitionDetails->unit_price = $unit_price[$i];
            $purchaseRequisitionDetails->amount = $unit_price[$i] * $quantity[$i];
            $purchaseRequisitionDetails->save();
            //End*****
        }

        return redirect()->route('purchase-requisitions.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }
    public function update(Request $request, $id)
    {
        $date = $request->date;
        $total = $request->total;
        $note = $request->note;

        $item_id = $request->item_id;
        $unit_price = $request->unit_price;
        $quantity = $request->quantity;
        $updated_by_id = Auth::guard('admin')->user()->id;

        //Purchase create*****
        $purchaseRequisition = PurchaseRequisition::find($id);
        $purchaseRequisition->total_price = $total;
        $purchaseRequisition->note = $note;
        $purchaseRequisition->updated_by_id = $updated_by_id;
        $purchaseRequisition->save();
        //End*****

        PurchaseRequisitionDetails::where('purchase_requisition_id', $id)->delete();
        for ($i=0; $i < count($item_id); $i++)
        {
            //Purchase Details create*****
            $purchaseRequisitionDetails = new PurchaseRequisitionDetails();
            $purchaseRequisitionDetails->purchase_requisition_id = $purchaseRequisition->id;
            $purchaseRequisitionDetails->item_id = $item_id[$i];
            $purchaseRequisitionDetails->item_type_id = Item::find($item_id[$i])->cat_type_id;
            $purchaseRequisitionDetails->quantity = $quantity[$i];
            $purchaseRequisitionDetails->unit_price = $unit_price[$i];
            $purchaseRequisitionDetails->amount = $unit_price[$i] * $quantity[$i];
            $purchaseRequisitionDetails->save();
            //End*****
        }
        return redirect()->route('purchase-requisitions.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
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
            case 6:
                $zeros = '0';
            default:
                $zeros = '';
            break;
        }
        return $zeros . $srl;
    }
    public function destroy($id)
    {
        PurchaseRequisition::destroy($id);
        return redirect()->back()->with('alert',['messageType'=>'success','message'=>'Data Deleted Successfully!']);
    }

    public function productionPlans($date)
    {
        $data = ProductionPlan::join('ppd_raw_materials', 'ppd_raw_materials.pp_id', '=', 'production_plans.id')
            ->join('items','items.id','=','ppd_raw_materials.raw_material_id')
            ->join('units','units.id','=','items.unit_id')
            ->where('production_plans.date', $date)
            ->groupBy('ppd_raw_materials.raw_material_id')
            ->select([
                'items.id',
                'items.title',
                'items.cost',
                'units.title as unit_name',
                DB::raw('SUM(ppd_raw_materials.quantity) as quantity')
            ])
            ->orderBy('items.title','asc')
            ->get()
            ->toArray();
        return response()->json($data, 200);
    }
}