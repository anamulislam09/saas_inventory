@extends('layouts.admin.master')
@section('content')
<link rel="stylesheet" href="{{ asset('public/admin-assets') }}/dist/css/vouchar.css">
<div id="invoiceholder">
        <div id="invoice" class="effect2">
            <div id="invoice-top">
                <div class="logo"><img src="{{ asset('public/uploads/basic-info/' . $data['basicInfo']->logo) }}"
                        alt="Logo" /></div>
                <div class="title">
                    {{-- <h1 class="h1">Vouchar #<span class="invoiceVal invoice_num">{{ $data['purchase']->vouchar_no }}</span></h1>
                    <p class="p">Vouchar Date: <span id="invoice_date">{{ date('dS M Y', strtotime($data['purchase']->date)) }}</span></p> --}}
                    <p class="p mt-0"><span><svg class="barcode"></svg></span></p>
                </div>
            </div>
            <div id="invoice-mid">
                <div class="clearfix">
                    <div class="col-left">
                        <div class="clientinfo">
                            <h3>{{ $data['recipes']['item']['title'] }}</h3>
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
                                <th>Raw Materials</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['recipes']['details'] as $key => $details)
                                <tr class="list-item">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $details['raw_materials']['title'] }}</td>
                                    <td>{{  $details['sub_quantity'].' '. $details['sub_unit']['title'] }}</td>
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
