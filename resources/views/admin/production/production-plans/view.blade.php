@extends('layouts.admin.master')
@section('content')
<link rel="stylesheet" href="{{ asset('public/admin-assets') }}/dist/css/vouchar.css">
<style>
    .invoice-bot {
        min-height: 100px;
    }
</style>
<div id="invoiceholder">
        <div id="invoice" class="effect2">
            <div id="invoice-top">
                <div class="logo"><img src="{{ asset('public/uploads/basic-info/' . $data['basicInfo']->logo) }}"
                        alt="Logo" /></div>
                <div class="title">
                    <h1 class="h1">Plan No #<span class="invoiceVal invoice_num">{{ $data['production_plan']['plan_no'] }}</span></h1>
                    <p class="p">Plan Date: <span id="invoice_date">{{ date('dS M Y', strtotime($data['production_plan']['date'])) }}</span></p>
                    <p class="p mt-0"><span><svg class="barcode"></svg></span></p>
                </div>
            </div>
            <div id="invoice-mid">
                <div class="clearfix">
                    <div class="col-left">
                        <div class="clientinfo">
                            <h3>Production Plan</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="invoice-bot">
                <div class="table-2">
                    <table class="table-main">
                        <thead>
                            <tr class="tabletitle">
                                <th>SN</th>
                                <th>Item</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['production_plan']['ppdetails'] as $key => $ppdetails)
                                <tr class="list-item">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ppdetails['recipe']['item']['title'] }}</td>
                                    <td>{{  $ppdetails['quantity'].' '. $ppdetails['recipe']['item']['unit']['title'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="invoice-mid">
                <h3>Required Ingredients</h3>
            </div>
            <div class="invoice-bot" style="margin-bottom: 100px!important;">
                <div class="table-2" style="margin-bottom: 100px!important;">
                    <table class="table-main">
                        <thead>
                            <tr class="tabletitle">
                                <th>SN</th>
                                <th>Item</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['production_plan']['ppdraw_materials'] as $key => $ppdraw_materials)
                                <tr class="list-item">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ppdraw_materials['item']['title'] }}</td>
                                    <td>{{  $ppdraw_materials['quantity'].' '. $ppdraw_materials['item']['unit']['title'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    window.print();
</script>
@endsection
