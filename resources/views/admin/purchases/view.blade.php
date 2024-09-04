@extends('layouts.admin.master')
@section('content')
<link rel="stylesheet" href="{{ asset('public/admin-assets') }}/dist/css/vouchar.css">
<div id="invoiceholder">
        <div id="invoice" class="effect2">
            <div id="invoice-top">
                <div class="logo"><img src="{{ asset('public/uploads/basic-info/' . $data['basicInfo']->logo) }}"
                        alt="Logo" /></div>
                <div class="title">
                    <h1 class="h1">Vouchar #<span class="invoiceVal invoice_num">{{ $data['purchase']->vouchar_no }}</span></h1>
                    <p class="p">Vouchar Date: <span id="invoice_date">{{ date('dS M Y', strtotime($data['purchase']->date)) }}</span></p>
                    <p class="p mt-0"><span><svg class="barcode"></svg></span></p>
                </div>
                {{-- <div class="title">
                    <p class="p">
                        <svg class="barcode"></svg>
                    </p>
                    {{-- <p class="p"><span><svg class="barcode"></svg></span></p>
                </div> --}}
            </div>
            <div id="invoice-mid">
                {{-- <div class="cta-group mobile-btn-group">
                    <a class="a" href="javascript:void(0);" class="btn-primary">Approve</a>
                    <a class="a" href="javascript:void(0);" class="btn-default">Reject</a>
                </div> --}}
                <div class="clearfix">
                    <div class="col-left">
                        {{-- <div class="clientlogo"><img
                                src="https://cdn3.iconfinder.com/data/icons/daily-sales/512/Sale-card-address-512.png"
                                alt="Sup" /></div> --}}
                        <div class="clientinfo">
                            <h2 class="h2" id="vendor">{{ $data['purchase']->supplier->name }},
                                {{ $data['purchase']->supplier->organization }}</h2>
                            <p class="p"><span
                                    id="address">{{ $data['purchase']->supplier->address }}</span><br><span
                                    id="city"></span><span id="country"></span><span id="zip"></span><span
                                    id="tax_num">{{ $data['purchase']->supplier->phone }},
                                    {{ $data['purchase']->supplier->email }}</span><br></p>
                        </div>
                    </div>
                    <div class="col-right">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><span>Vouchar Total</span><label
                                            id="invoice_total">{{ $data['basicInfo']->currency_symbol }}
                                            {{ number_format($data['purchase']->total_payable, 2) }}</label></td>
                                    {{-- <td><span>Currency</span><label id="currency">EUR</label></td> --}}
                                </tr>
                                {{-- <tr>
                                    <td><span>Payment Term</span><label id="payment_term">60 gg DFFM</label></td>
                                    <td><span>Invoice Type</span><label id="invoice_type">EXP REP INV</label></td>
                                </tr> --}}
                                <tr>
                                    <td colspan="2"><span>Note</span>:<label
                                            id="note">{{ $data['purchase']->note }}</label></td>
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
                                <th>Sl#</th>
                                <th>Product Name</th>
                                <th>Unit Measurement</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total_price = 0;
                            @endphp
                            @foreach ($data['purchase']->purchase_details as $key => $value)
                                @php
                                    $total_price += $value->total_amount;
                                    // $unit = App\Models\Unit::where('id', $value->product_id)->first();
                                    // dd($value->product_id);
                                @endphp
                                <tr class="list-item">
                                    <td data-label="Type">{{ $key+1 }}</td>
                                    <td data-label="Type">{{ $value->product->product_name }}</td>
                                    <td data-label="Type">{{ $value->product->unit->title }}</td>
                                    <td data-label="Quantity">{{ number_format($value->quantity, 2) }}</td>
                                    <td data-label="Unit Price">{{ $data['basicInfo']->currency_symbol }}
                                        {{ number_format($value->unit_price, 2) }} / {{ $value->product->unit->title }}</td>
                                    <td data-label="Total">{{ $data['basicInfo']->currency_symbol }}
                                        {{ number_format($value->total_amount, 2) }}</td>
                                </tr>
                            @endforeach
                            <tr class="list-item total-row">
                                <th colspan="5">Total</th>
                                <td style="text-align: right;">{{ $data['basicInfo']->currency_symbol }}
                                    {{ number_format($total_price, 2) }}</td>
                            </tr>
                            <tr class="list-item total-row">
                                <th colspan="5">Discount</th>
                                <td style="text-align: right;">{{ $data['basicInfo']->currency_symbol }}
                                    {{ number_format($data['purchase']->discount, 2) }}</td>
                            </tr>
                            <tr class="list-item total-row">
                                <th colspan="5">Tax</th>
                                <td style="text-align: right;">{{ $data['basicInfo']->currency_symbol }}
                                    {{ number_format(0, 2) }}</td>
                            </tr>
                            <tr class="list-item total-row">
                                <th colspan="5">Total Payable</th>
                                <td style="text-align: right;">{{ $data['basicInfo']->currency_symbol }}
                                    {{ number_format($data['purchase']->total_payable, 2) }}</td>
                            </tr>
                            <tr class="list-item total-row">
                                <th colspan="5">Paid Amount</th>
                                <td style="text-align: right;">{{ $data['basicInfo']->currency_symbol }}
                                    {{ number_format($data['purchase']->paid_amount, 2) }}</td>
                            </tr>
                            <tr class="list-item total-row">
                                <th colspan="5">Due Amount</th>
                                <td style="text-align: right;">{{ $data['basicInfo']->currency_symbol }}
                                    {{ number_format($data['purchase']->total_payable - $data['purchase']->paid_amount, 2) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="payment-head">
                <div class="clearfix">
                    <div class="col-left">
                        <div class="clientinfo">
                            <h4>Payments</h4>
                        </div>
                    </div>
                    {{-- <div class="col-right"><a type="button" class="a" href="javascript:void(0);">Add Payment</a></div> --}}
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
                        <tbody>
                            @php
                                $total_price = 0;
                            @endphp
                            @foreach ($data['purchase']->payments as $key => $value)
                                <tr class="list-item">
                                    <td style="text-align: left;">{{ $value->date }}</td>
                                    <td style="text-align: center;">{{ $data['basicInfo']->currency_symbol }} {{ number_format($value->amount, 2) }}</td>
                                    <td style="text-align: right;">
                                        <form class="delete" action="{{ route('purchases.payment.destroy') }}" method="POST" enctype="multipart/form-data">
                                                @csrf()
                                                @method('delete')
                                                <input type="hidden" name="payment_id" value="{{ $value->id }}">
                                                <input type="hidden" name="purchase_id" value="{{ $data['purchase']->id }}">
                                            <button type="submit" class="btn btn-sm btn-danger "><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- <div class="cta-group">
                    <a class="a" href="javascript:void(0);" class="btn-primary">Approve</a>
                    <a class="a" href="javascript:void(0);" class="btn-default">Reject</a>
                </div> --}}
            </div>
            {{-- <footer>
                <div id="legalcopy" class="clearfix">
                    <p class="p" class="col-right">Our mailing address is:
                        <span class="email"><a class="a"
                                href="mailto:supplier.portal@almonature.com">supplier.portal@almonature.com</a></span>
                    </p>
                </div>
            </footer> --}}
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
        JsBarcode(".barcode", "{{ $data['purchase']->vouchar_no }}", {
            // format: "upc",
            // lineColor: "#0aa",
            width: 1,
            height: 30,
            displayValue: false
        });
    </script>
@endsection
