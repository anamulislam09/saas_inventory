@extends('layouts.admin.master')
@section('content')
<link rel="stylesheet" href="{{ asset('public/admin-assets') }}/dist/css/vouchar.css">
<div id="invoiceholder">
    <div id="invoice" class="effect2">
        <div id="invoice-top">
            <div class="logo"><img src="{{ asset('public/uploads/basic-info/' . $data['basicInfo']->logo) }}" alt="Logo" /></div>
            <div class="title">
                <h1 class="h1">Vouchar #<span class="invoiceVal invoice_num">{{ $data['purchaseRequisitions']->vouchar_no }}</span></h1>
                <p class="p">Vouchar Date: <span id="invoice_date">{{ date('dS M Y', strtotime($data['purchaseRequisitions']->date)) }}</span></p>
                <p class="p mt-0"><span><svg class="barcode"></svg></span></p>
            </div>
        </div>
        <div id="invoice-mid">
            <div class="clearfix">
                <div class="col-center">
                    <h3 style="text-align: center; margin-top: 0;">Purchase Requisition</h3>
                </div>
                <div class="col-right">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><span>Vouchar Total</span><label id="invoice_total">{{ $data['basicInfo']->currency_symbol }} {{ number_format($data['purchaseRequisitions']->total_price, 2) }}</label></td>
                            </tr>
                            <tr>
                                <td colspan="2"><span>Note</span>:<label id="note">{{ $data['purchaseRequisitions']->note }}</label></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="invoice-bot">
            <div class="table-2">
                <table class="table-main">
                    <thead>
                        <tr class="tabletitle">
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total_price = 0;
                        @endphp
                        @foreach ($data['purchaseRequisitions']->prdetails as $key => $value)
                            @php
                                $total_price += $value->total_amount;
                            @endphp
                            <tr class="list-item">
                                <td data-label="Type">{{ $value->item->title }}</td>
                                <td data-label="Quantity">{{ number_format($value->quantity, 2) }}</td>
                                <td data-label="Unit Price">{{ $data['basicInfo']->currency_symbol }} {{ number_format($value->unit_price, 2) }} / {{ $value->item->unit->title }}</td>
                                <td data-label="Total">{{ $data['basicInfo']->currency_symbol }} {{ number_format($value->amount, 2) }}</td>
                            </tr>
                        @endforeach
                        <tr class="list-item total-row">
                            <th colspan="3">Total</th>
                            <td style="text-align: right;">{{ $data['basicInfo']->currency_symbol }} {{ number_format($data['purchaseRequisitions']->total_price, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        if ("{{ $data['print'] }}" == 'print') {
            var printContents = document.getElementById('invoice').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/barcodes/JsBarcode.code128.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script type="text/javascript">
    JsBarcode(".barcode", "{{ $data['purchaseRequisitions']->vouchar_no }}", {
        // format: "upc",
        // lineColor: "#0aa",
        width: 1,
        height: 30,
        displayValue: false
    });
</script>
@endsection
