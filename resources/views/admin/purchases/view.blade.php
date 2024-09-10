@extends('layouts.admin.master')
@section('content')
    <style>
        #invoice-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 20px 20px 0px 20px !important;
        }

        .logo {
            flex: 1;
        }

        .title {
            flex: 2;
            text-align: right;
            padding-bottom: 0px 20px !important;
        }

        .col-right {
            text-align: right;
            flex: 1;
        }

        .col-left {
            flex: 2;
        }

         /* style #due-watermark   */
        #due-watermark {
            position: absolute;
            bottom: -4%;
            left: 30%;
            font-family: cursive;
            transform: translate(-50%, -50%) rotate(-20deg);
            font-size: 90px;
            color: rgba(20, 0, 0, 0.2);
            /* Light red color with transparency */
            font-weight: bold;
            z-index: 0;
            pointer-events: none;
        }

        #invoice {
            position: relative;
            /* z-index: 1; */
            /* Ensures invoice content is above the watermark */
        }
    </style>
    @php

        $amountWord = numtowords($data['purchase']->total_payable);
        //  $collectionWord = numtowords($inv->collection);
        //  $dueWord = numtowords(abs($inv->due));

        function numtowords(float $number)
        {
            $decimal = round($number - ($no = floor($number)), 2) * 100;
            $decimal_part = $decimal;
            $hundred = null;
            $hundreds = null;
            $digits_length = strlen($no);
            $decimal_length = strlen($decimal);
            $i = 0;
            $str = [];
            $str2 = [];
            $words = [
                0 => '',
                1 => 'one',
                2 => 'two',
                3 => 'three',
                4 => 'four',
                5 => 'five',
                6 => 'six',
                7 => 'seven',
                8 => 'eight',
                9 => 'nine',
                10 => 'ten',
                11 => 'eleven',
                12 => 'twelve',
                13 => 'thirteen',
                14 => 'fourteen',
                15 => 'fifteen',
                16 => 'sixteen',
                17 => 'seventeen',
                18 => 'eighteen',
                19 => 'nineteen',
                20 => 'twenty',
                30 => 'thirty',
                40 => 'forty',
                50 => 'fifty',
                60 => 'sixty',
                70 => 'seventy',
                80 => 'eighty',
                90 => 'ninety',
            ];
            $digits = ['', 'hundred', 'thousand', 'lakh', 'crore'];

            while ($i < $digits_length) {
                $divider = $i == 2 ? 10 : 100;
                $number = floor($no % $divider);
                $no = floor($no / $divider);
                $i += $divider == 10 ? 1 : 2;
                if ($number) {
                    $plural = ($counter = count($str)) && $number > 9 ? 's' : null;
                    $hundred = $counter == 1 && $str[0] ? ' and ' : null;
                    $str[] =
                        $number < 21
                            ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred
                            : $words[floor($number / 10) * 10] .
                                ' ' .
                                $words[$number % 10] .
                                ' ' .
                                $digits[$counter] .
                                $plural .
                                ' ' .
                                $hundred;
                } else {
                    $str[] = null;
                }
            }

            $d = 0;
            while ($d < $decimal_length) {
                $divider = $d == 2 ? 10 : 100;
                $decimal_number = floor($decimal % $divider);
                $decimal = floor($decimal / $divider);
                $d += $divider == 10 ? 1 : 2;
                if ($decimal_number) {
                    $plurals = ($counter = count($str2)) && $decimal_number > 9 ? 's' : null;
                    $hundreds = $counter == 1 && $str2[0] ? ' and ' : null;
                    @$str2[] =
                        $decimal_number < 21
                            ? $words[$decimal_number] . ' ' . $digits[$decimal_number] . $plural . ' ' . $hundred
                            : $words[floor($decimal_number / 10) * 10] .
                                ' ' .
                                $words[$decimal_number % 10] .
                                ' ' .
                                $digits[$counter] .
                                $plural .
                                ' ' .
                                $hundred;
                } else {
                    $str2[] = null;
                }
            }

            $takas = implode('', array_reverse($str));
            $paise = implode('', array_reverse($str2));
            $paise = $decimal_part > 0 ? $paise . ' Paise' : '';
            return ($takas ? $takas . 'Takas ' : '') . $paise;
        }

    @endphp
    <link rel="stylesheet" href="{{ asset('public/admin-assets') }}/dist/css/vouchar.css">
    <div id="invoiceholder">
        <div id="invoice" class="effect2">
            <div id="invoice-top" class="row">
                <div class="col-3"><img
                        src="{{ $data['basicInfo']->logo ? asset('public/uploads/basic-info/' . $data['basicInfo']->logo) : '' }}"
                        style="width: 70px" /></div>
                <div class="col-6 text-center">
                    <h4>{{ $data['basicInfo']->title }}</h4>
                    <p class="p">{{ $data['basicInfo']->address }}, {{ $data['basicInfo']->phone1 }}</p>
                </div>
                <div class="col-3">
                    <h6>Vouchar #<span class="invoiceVal invoice_num">{{ $data['purchase']->vouchar_no }}</span></h6>
                    <p class="p">Date: <span
                            id="invoice_date">{{ date('dS M Y', strtotime($data['purchase']->date)) }}</span></p>
                    <p class="p mt-0 mb-0"><span><svg class="barcode"></svg></span></p>
                </div>
            </div>

            <div id="invoice-mid">
                <div class="clearfix">
                    <div class="col-left">
                        <div class="clientinfo">
                            <h2 class="h2" id="vendor">{{ $data['purchase']->supplier->name }}</h2>
                            <p class="p"><span id="address">{{ $data['purchase']->supplier->address }}</span><br>
                                <span id="city"></span><span id="country"></span><span id="zip"></span>
                                <span id="tax_num">{{ $data['purchase']->supplier->phone }},
                                    {{ $data['purchase']->supplier->email }}</span><br>
                            </p>
                        </div>
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
                                @endphp
                                <tr class="list-item">
                                    <td data-label="Type">{{ $key + 1 }}</td>
                                    <td data-label="Type">{{ $value->product->product_name }}</td>
                                    <td data-label="Type">{{ $value->product->unit->title }}</td>
                                    <td data-label="Quantity">{{ number_format($value->quantity, 2) }}</td>
                                    <td data-label="Unit Price">{{ $data['basicInfo']->currency_symbol }}
                                        {{ number_format($value->unit_price, 2) }} / {{ $value->product->unit->title }}
                                    </td>
                                    <td data-label="Total">{{ $data['basicInfo']->currency_symbol }}
                                        {{ number_format($value->total_amount, 2) }}</td>
                                </tr>
                            @endforeach
                            <tr class="list-item total-row">
                                <th colspan="5">Total</th>
                                <td style="text-align: right;">{{ $data['basicInfo']->currency_symbol }}
                                    {{ number_format($total_price, 2) }}</td>
                            </tr>
                            <tr class="list-item total-row " style="border-bottom: 1px solid #ddd">
                                <th colspan="5">Discount</th>
                                <td style="text-align: right;">{{ $data['basicInfo']->currency_symbol }}
                                    {{ number_format($data['purchase']->discount, 2) }}</td>
                            </tr>

                            <tr class="list-item total-row">
                                <th colspan="5">Grand total</th>
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
                    <div id="due-watermark" style="display: none;">DUE</div>
                    <p style="font-size: 12px; margin-left:10px; padding-bottom:30px"><span style="font-weight: 700">In word :</span>
                        {{ $amountWord }} (only)</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            // Existing print logic
            if ("{{ $data['print'] }}" == 'print') {
                var printContents = document.getElementById('invoice').innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }
            // Conditionally show DUE watermark if due amount is greater than zero
            var dueAmount = parseFloat("{{ $data['purchase']->total_payable - $data['purchase']->paid_amount }}");
            if (dueAmount > 0) {
                $('#due-watermark').css('display', 'block');
            }
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
