<?php

namespace App\Http\Controllers\admin;

use App\Models\Item;
use App\Models\IssueItem;
use App\Models\IssueItemDetails;
use App\Models\StockHistory;
use App\Models\BasicInfo;
use Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IssueItemController extends Controller
{
    public function index()
    {
        $data['issue_items'] = IssueItem::with(['created_by'])->orderBy('id', 'desc')->get();
        $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
        return view('admin.issue-items.index', compact('data'));
    }

    public function createOrEdit($id=null)
    {
        if($id){
            $data['title'] = 'Edit';
            $data['item'] = IssueItem::find($id);
        }else{
            $data['title'] = 'Create';
        }
        $data['items'] = Item::with('unit')->where('status',1)->where('cat_type_id',3)->orderBy('title','asc')->get();
        return view('admin.issue-items.create-or-edit',compact('data'));
    }
    public function invoice($id,$print=null)
    {
        $data['issue_items'] = IssueItem::with(['issue_item_details','created_by'])->find($id);
        $data['print'] = $print;
        $data['basicInfo'] = BasicInfo::first();
        $data['currency_symbol'] = $data['basicInfo']->currency_symbol;
        return view('admin.issue-items.invoice',compact('data'));
    }

    public function store(Request $request)
    {

        //Issue Items......
        $data = 
        [
            'invoice_no'=> $this->formatSrl(IssueItem::latest()->limit(1)->max('invoice_no')+1),
            'date'=> $request->date,
            'total_price'=> $request->total,
            'note'=> $request->note,
            'status'=> 1,
            'created_by_id'=> Auth::guard('admin')->user()->id,
        ];

        $issue_item = IssueItem::create($data);

        //Issue Item Details......
        $item_id = $request->item_id;
        $unit_price = $request->unit_price;
        $quantity = $request->quantity;

        for ($i=0; $i < count($item_id); $i++)
        {
            $data2 = 
            [
                'issue_id'=> $issue_item->id,
                'item_id'=> $item_id[$i],
                'quantity'=> $quantity[$i],
                'unit_price'=> $unit_price[$i],
                'total_amount'=> $unit_price[$i] * $quantity[$i],
            ];
            IssueItemDetails::create($data2);

            //Item Stock Update...
            $item = Item::find($item_id[$i]);
            $current_stock = $item->current_stock - $quantity[$i];
            $item->update(['current_stock'=> $current_stock]);

            $stockHistory = 
            [
                'item_id'=> $item_id[$i],
                'sales_qty'=> $quantity[$i],
                'sales_rate'=> $unit_price[$i],
                'current_stock'=> $current_stock,
                'created_by_id'=> Auth::guard('admin')->user()->id,
                'created_at'=> date('Y-m-d'),
            ];
            StockHistory::create($stockHistory);
        }
        return redirect()->route('issue-items.index')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }
    
    public function formatSrl($srl)
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