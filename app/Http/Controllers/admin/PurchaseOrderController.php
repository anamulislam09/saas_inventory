<?php

namespace App\Http\Controllers\admin;

use App\Models\PurchaseRequisition;
use App\Models\BasicInfo;
use App\Models\PaymentMethod;
use App\Models\Supplier;
use App\Models\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class PurchaseOrderController extends Controller
{
    public function createOrEdit($id=null)
    {
        $data['title'] = 'Create';
        $data['paymentMethods'] = PaymentMethod::orderBy('title','asc')->get();
        $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
        $data['suppliers'] = Supplier::where('status',1)->orderBy('name','asc')->get();
        $data['items'] = Item::with('unit')->where('status',1)->whereIn('cat_type_id',[1,3])->orderBy('title','asc')->get();
        return view('admin.production.purchase-orders.create-or-edit',compact('data'));
    }

}