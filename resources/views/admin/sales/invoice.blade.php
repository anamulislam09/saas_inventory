@extends('layouts.admin.master')
@section('content')
<link rel="stylesheet" href="{{ asset('public/admin-assets') }}/dist/css/vouchar.css">
<div id="invoiceholder">
        <div id="invoice" class="effect2 pb-5">
            <div id="invoice-top">
                <div class="logo"><img src="{{ asset('public/uploads/basic-info/' . $data['basicInfo']->logo) }}"
                        alt="Logo" /></div>
                <div class="title">
                    <h1 class="h1">INVOICE #<span class="invoiceVal invoice_num">{{ $data['sales']->invoice_no }}</span></h1>
                    <p class="p">Vouchar Date: <span id="invoice_date">{{ date('dS M Y', strtotime($data['sales']->date)) }}</span></p>
                    <p class="p mt-0"><span><svg class="barcode"></svg></span></p>
                </div>
            </div>
            <div id="invoice-mid">
                <div class="clearfix">
                    <div class="col-left">
                        {{-- <div class="clientlogo"> --}}
                            {{-- <img --}}
                                {{-- src="https://cdn3.iconfinder.com/data/icons/daily-sales/512/Sale-card-address-512.png"
                                alt="Sup" /> --}}
                            {{-- </div> --}}
                        <div class="clientinfo">
                            <h2 class="h2" id="vendor">{{ $data['sales']->vendor ? $data['sales']->vendor->name : '' }},
                                {{ $data['sales']->vendor ? $data['sales']->vendor->organization : '' }}</h2>
                            <p class="p"><span
                                    id="address">{{ $data['sales']->vendo ? $data['sales']->vendor->address : '' }}</span><br><span
                                    id="city"></span><span id="country"></span><span id="zip"></span><span
                                    id="tax_num">{{ $data['sales']->vendor ? $data['sales']->vendor->phone : '' }},
                                    {{ $data['sales']->vendor ? $data['sales']->vendor->email : '' }}</span><br></p>
                        </div>
                    </div>
                    <div class="col-right">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><span>Vouchar Total</span><label
                                            id="invoice_total">{{ $data['basicInfo']->currency_symbol }}
                                            {{ number_format($data['sales']->receiveable_amount, 2) }}</label></td>
                                    {{-- <td><span>Currency</span><label id="currency">EUR</label></td> --}}
                                </tr>
                                {{-- <tr>
                                    <td><span>Payment Term</span><label id="payment_term">60 gg DFFM</label></td>
                                    <td><span>Invoice Type</span><label id="invoice_type">EXP REP INV</label></td>
                                </tr> --}}
                                <tr>
                                    <td colspan="2"><span>Note</span>:<label
                                            id="note">{{ $data['sales']->note }}</label></td>
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
                                <th>SL#</th>
                                <th>Product Name</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total_price = 0;
                            @endphp
                            @foreach ($data['sales']->sales_details as $key => $value)
                                @php
                                    // $total_price += $value->total_amount;
                                @endphp
                                <tr class="list-item">
                                    <td>{{$key + 1}}</td>
                                    <td data-label="Type">{{ $value->product->product_name }}</td>
                                    <td data-label="Description">{{ $value->unit_price }}</td>
                                    <td data-label="Quantity">{{ number_format($value->quantity, 2) }}</td>
                                    <td data-label="Unit Price">{{ $data['basicInfo']->currency_symbol }}
                                        {{ $value->total_amount }}</td>
                                    {{-- <td data-label="Total">{{ $data['basicInfo']->currency_symbol }}
                                        {{ number_format($value->total_amount, 2) }}</td> --}}
                                        {{-- / {{ $value->product->unit->title }} --}}
                                </tr>
                            @endforeach
                            <tr class="list-item total-row">
                                <th colspan="4">Total</th>
                                <td style="text-align: right;">{{ $data['basicInfo']->currency_symbol }}
                                    {{ number_format($data['sales']->sales_price, 2) }}</td>
                            </tr>
                            <tr class="list-item total-row">
                                <th colspan="4">Discount</th>
                                <td style="text-align: right;">{{ $data['basicInfo']->currency_symbol }}
                                    {{ number_format($data['sales']->discount, 2) }}</td>
                            </tr>
                            <tr class="list-item total-row">
                                <th colspan="4">Tax</th>
                                <td style="text-align: right;">{{ $data['basicInfo']->currency_symbol }}
                                    {{ number_format(0, 2) }}</td>
                            </tr>
                            <tr class="list-item total-row">
                                <th colspan="4">Total Receivable Amount</th>
                                <td style="text-align: right;">{{ $data['basicInfo']->currency_symbol }}
                                    {{ number_format($data['sales']->receiveable_amount, 2) }}</td>
                            </tr>
                            <tr class="list-item total-row">
                                <th colspan="4">Receive Amount</th>
                                <td style="text-align: right;">{{ $data['basicInfo']->currency_symbol }}
                                    {{ number_format($data['sales']->receive_amount, 2) }}</td>
                            </tr>
                            <tr class="list-item total-row">
                                <th colspan="4">Due Amount</th>
                                <td style="text-align: right;">{{ $data['basicInfo']->currency_symbol }}
                                    {{ number_format($data['sales']->receiveable_amount - $data['sales']->receive_amount, 2) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- <div class="payment-head">
                <div class="clearfix">
                    <div class="col-left">
                        <div class="clientinfo">
                            <h4>Payments</h4>
                        </div>
                    </div>
                    <div class="col-right"><a type="button" class="a" href="javascript:void(0);">Add Payment</a></div>
                </div>
            </div>
            <div class="invoice-bot" style="margin: 0px 10px 10px 10px">
                <div class="table-2">
                    <table class="table-main">
                        <thead>
                            <tr class="tabletitle">
                                <th style="text-align: left;">Date</th>
                                <th style="text-align: center;">Amount</th>
                                <th style="text-align: right;">Action</th>
                            </tr>
                        </thead>
                       
                        </tbody>
                    </table>
                </div>
            </div> --}}
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
            $('.pay-now').on('click', function(e) {
                $('#purchase_id').val($(this).attr('purchase-id'));
                $('#amount').val(parseFloat($(this).attr('due')).toFixed(2));
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/barcodes/JsBarcode.code128.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script type="text/javascript">
        JsBarcode(".barcode", "{{ $data['sales']->invoice_no }}", {
            // format: "upc",
            // lineColor: "#0aa",
            width: 1,
            height: 30,
            displayValue: false
        });
    </script>
@endsection
