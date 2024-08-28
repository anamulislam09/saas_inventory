<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\BasicInfo;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Sales;
use App\Models\Sales_Details;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function index()
    {
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        if (Auth::guard('admin')->user()->client_id == 0) {
            $data['sales'] = Sales::where('client_id', Auth::guard('admin')->user()->id)->with(['created_by'])->orderBy('id', 'desc')->get();
        } else {
            $data['sales'] = Sales::where('client_id', $client->id)->with(['created_by'])->orderBy('id', 'desc')->get();
        }

        $data['currency_symbol'] = BasicInfo::first()->currency_symbol;
        return view('admin.sales.index', compact('data'));
    }

    public function createOrEdit($id = null)
    {
        if ($id) {
            $data['title'] = 'Edit';
            $data['item'] = Sales::find($id);
        } else {
            $data['title'] = 'Create';
        }

        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();
        if (Auth::guard('admin')->user()->client_id == 0) {
            $data['items'] = Product::where('client_id', Auth::guard('admin')->user()->id)->with('unit')->where('status', 1)->orderBy('product_name', 'asc')->get();
            $data['paymentMethods'] = PaymentMethod::where('client_id', Auth::guard('admin')->user()->id)->orderBy('title', 'asc')->get();
        } else {
            $data['items'] = Product::where('client_id', $client->id)->with('unit')->where('status', 1)->orderBy('product_name', 'asc')->get();
            $data['paymentMethods'] = PaymentMethod::where('client_id', $client->id)->orderBy('title', 'asc')->get();
        }
        return view('admin.sales.create-or-edit', compact('data'));
    }

    public function invoice($id, $print = null)
    {
        $data['sales'] = Sales::with(['sales_details', 'created_by'])->find($id);
        $data['print'] = $print;
        $data['basicInfo'] = BasicInfo::first();
        $data['currency_symbol'] = $data['basicInfo']->currency_symbol;
        return view('admin.sales.invoice', compact('data'));
    }

    public function store(Request $request)
    {
        //Issue Items......
        $client = Admin::where('id', Auth::guard('admin')->user()->client_id)->first();

        $data =
            [
                'invoice_no' => $this->formatSrl(Sales::latest()->limit(1)->max('invoice_no') + 1),
                'date' => date('Y-m-d'),
                'sales_price' => $request->sales_price,
                'discount_method' => $request->discount_method,
                'discount_rate' => $request->discount_rate,
                'discount' => $request->discount_amount,
                // 'vat_tax' => $request->total,
                'receiveable_amount' => $request->total_payable,
                'receive_amount' => $request->paid_amount,
                'note' => $request->note,
                'status' => 1,
                'client_id' => (Auth::guard('admin')->user()->client_id == 0) ? Auth::guard('admin')->user()->id : $client->id,
                'created_by_id' => Auth::guard('admin')->user()->id,
            ];

        $sales = Sales::create($data);

        //Issue Item Details......
        $product_id = $request->item_id;
        $unit_price = $request->unit_price;
        $quantity = $request->quantity;

        for ($i = 0; $i < count($product_id); $i++) {
            $data2 =
                [
                    'sales_id' => $sales->id,
                    'product_id' => $product_id[$i],
                    'quantity' => $quantity[$i],
                    'unit_price' => $unit_price[$i],
                    'total_amount' => $unit_price[$i] * $quantity[$i],
                ];
            Sales_Details::create($data2);

            //Item Stock Update...
            $stock = Stock::find($product_id[$i]);
            $stock->stock_quantity = $stock->stock_quantity - $quantity[$i];
            $stock->updated_date = date('Y-m-d');
            $stock->save();
        }
        return redirect()->route('sales.index')->with('alert', ['messageType' => 'success', 'message' => 'Data Inserted Successfully!']);
    }

    public function formatSrl($srl)
    {
        switch (strlen($srl)) {
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
