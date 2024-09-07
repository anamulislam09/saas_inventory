@extends('layouts.admin.master')
@section('content')
    <link rel="stylesheet" href="{{ asset('public/admin-assets') }}/dist/css/vouchar.css">
    <div id="invoiceholder">
        <div id="invoice" class="effect2">
            <div id="invoice-top">
                <div class="logo"><img src="{{ asset('public/uploads/basic-info/' . $data['basicInfo']->logo) }}"
                        alt="Logo" /></div>
                <div class="title">
                    <h1 class="h1">Vouchar #<span
                            class="invoiceVal invoice_num">{{ $data['salesReturn']->invoice_no }}</span></h1>
                    <p class="p">Vouchar Date: <span
                            id="invoice_date">{{ date('dS M Y', strtotime($data['salesReturn']->date)) }}</span></p>
                    <p class="p mt-0"><span><svg class="barcode"></svg></span></p>
                </div>
            </div>
            <div id="invoice-mid">
                <div class="clearfix">
                    <div class="col-left">
                        <div class="clientinfo">
                            <h2 class="h2" id="vendor">{{ $data['salesReturn']->vendor->name ?? '' }}
                                <p class="p"><span
                                        id="address">{{ $data['salesReturn']->vendor->address ?? '' }}</span><br><span
                                        id="city"></span><span id="country"></span><span id="zip"></span><span
                                        id="tax_num">{{ $data['salesReturn']->vendor->phone ?? '' }}
                                        {{ $data['salesReturn']->vendor->email ?? '' }}</span><br></p>
                        </div>
                    </div>
                    <div class="col-right">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><span>Vouchar Total</span><label
                                            id="invoice_total">{{ $data['basicInfo']->currency_symbol }}
                                            {{ number_format($data['salesReturn']->total_amount, 2) }}</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><span>Note</span>:<label
                                            id="note">{{ $data['salesReturn']->note }}</label></td>
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
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['salesReturn']->sales_return_details as $key => $value)
                                <tr class="list-item">
                                    <td>{{ $key + 1 }}</td>
                                    <td data-label="Type">{{ $value->product->product_name }}</td>
                                    <td data-label="Quantity">{{ number_format($value->quantity_returned, 2) }}</td>
                                    <td data-label="Unit Price">{{ $data['basicInfo']->currency_symbol }}
                                        {{ number_format($value->unit_price, 2) }} / {{ $value->product->unit->title }}
                                    </td>
                                    <td data-label="Total">{{ $data['basicInfo']->currency_symbol }}
                                        {{ number_format($value->amount, 2) }}</td>
                                </tr>
                            @endforeach
                            <tr class="list-item total-row">
                                <th colspan="4">Total</th>
                                <td style="text-align: right;">{{ $data['basicInfo']->currency_symbol }}
                                    {{ number_format($data['salesReturn']->total_amount, 2) }}</td>
                            </tr>
                            <tr class="list-item total-row">
                                <th colspan="4">Paid Amount</th>
                                <td style="text-align: right;">{{ $data['basicInfo']->currency_symbol }}
                                    {{ number_format($data['salesReturn']->refund_amount, 2) }}</td>
                            </tr>
                            <tr class="list-item total-row">
                                <th colspan="4">Due Amount</th>
                                <td style="text-align: right;">{{ $data['basicInfo']->currency_symbol }}
                                    {{ number_format((float)str_replace(',', '', $data['salesReturn']->total_amount) - (float)str_replace(',', '', $data['salesReturn']->refund_amount), 2) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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
            $('.pay-now').on('click', function(e) {
                $('#purchase_id').val($(this).attr('purchase-id'));
                $('#amount').val(parseFloat($(this).attr('due')).toFixed(2));
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/barcodes/JsBarcode.code128.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script type="text/javascript">
        JsBarcode(".barcode", "{{ $data['salesReturn']->invoice_no }}", {
            width: 1,
            height: 30,
            displayValue: false
        });
    </script>
@endsection
