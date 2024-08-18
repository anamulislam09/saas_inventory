@php
    $basicInfo = App\Models\BasicInfo::first();
@endphp
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $basicInfo->title }}</title>
    <!-- Fav Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/uploads/basic-info/' . $basicInfo->favIcon) }}">
    <style type="text/css">
        .style1 {
            font-family: Myriad;
            font-size: 18px;
            color: #000000;
            font-weight: bold;
        }

        .style2 {
            font-family: Impact;
            font-size: 50px;
            color: #808080;
            font-weight: bold;
        }

        .style3 {
            font-family: Arial;
            font-size: 13px;
            color: #0a0a0a;
            font-weight: normal;
        }
    </style>
    <script>
        if ("{{ $print }}" == 'print') {
            window.print();
        }
    </script>
</head>

<body>
    <table width="830" border="0" align="center" cellpadding="2" cellspacing="2" class="style3">
        <tr>
            <td width="452" align="left" valign="middle">
                <table width="400" border="0" cellspacing="2" cellpadding="2">
                    <tr>
                        <td width="448" height="77" align="left" valign="middle" class="style1">
                            <img src="{{ asset('public/uploads/basic-info/' . $basicInfo->logo) }}" border="0" />
                        </td>
                    </tr>
                    <tr>
                        <td align="left" valign="middle"><span class="small_font">{{ $basicInfo->address }}</span>
                        </td>
                    </tr>
                </table>
            </td>
            <td width="454" align="right" valign="middle">
                <table width="400" border="0" cellspacing="2" cellpadding="2">
                    <tr>
                        <td height="77" colspan="2" align="left" valign="middle" class="style2"> INVOICE </td>
                    </tr>
                    <tr>
                        <td width="131" align="left" valign="middle">Invoice Number </td>
                        <td width="255" align="left" valign="middle"> : {{ $order->order_no }}</td>
                    </tr>
                    <tr>
                        <td align="left" valign="middle">Invoice Date </td>
                        <td align="left" valign="middle"> :
                            {{ date('D dS M, Y h:i A', strtotime($order->order_datetime)) }} </td>
                    </tr>
                    <tr>
                        <td align="left" valign="middle">Tracking No. </td>
                        <td align="left" valign="middle"> : {{ $order->tracking_no }} </td>
                    </tr>
                    <tr>
                        <td align="left" valign="middle">Invoice Barcode</td>
                        <td align="left" valign="middle">
                            <div id="barcodeDisplay">:<svg class="barcode"></svg></div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="left" valign="middle">Voice : {{ $basicInfo->phone1 }}</td>
            <td align="center" valign="middle">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" valign="middle">Fax : {{ $basicInfo->phone2 }}</td>
            <td align="center" valign="middle">&nbsp;</td>
        </tr>
        <tr>
            <td align="center" valign="middle">&nbsp;</td>
            <td align="center" valign="middle">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" valign="middle">

                <table width="400" border="0" align="left" cellpadding="2" cellspacing="2"
                    style="border:1px solid #0a0a0a">
                    <tr>
                        <td align="left" valign="middle" bgcolor="#b9b9b9"
                            style="border-bottom:1px solid #0a0a0a; padding-left:20px;"><strong>Bill To :</strong></td>
                    </tr>
                    <tr>
                        <td align="left" valign="middle" style="padding-left:20px;">
                            {{ $order->billing_first_name }}
                            {{ $order->billing_last_name }}<br />{{ $order->billing_company_name }}</td>
                    </tr>
                    <tr>
                        <td align="left" valign="middle" style="padding-left:20px;">
                            {{ $order->billing_street_address }} </td>
                    </tr>
                    <tr>
                        <td align="left" valign="middle" style="padding-left:20px;">
                            {{ $order->billing_city }}, {{ $order->billing_state }}-{{ $order->billing_zip_code }}
                        </td>
                    </tr>

                    <tr>

                        <td align="left" valign="middle" style="padding-left:20px;">
                            {{ $order->billing_country->country_name }}</td>

                    </tr>

                    <tr>

                        <td align="left" valign="middle" style="padding-left:20px;">Phone:
                            {{ $order->billing_phone }}
                        </td>

                    </tr>

                </table>
            </td>

            <td align="right" valign="middle">
                <table width="400" border="0" align="right" cellpadding="2" cellspacing="2"
                    style="border:1px solid #0a0a0a">

                    <tr>

                        <td align="left" valign="middle" bgcolor="#b9b9b9"
                            style="border-bottom:1px solid #0a0a0a; padding-left:20px;"><strong>Ship to:</strong></td>

                    </tr>

                    <tr>

                        <td align="left" valign="middle" style="padding-left:20px;">
                            {{ $order->shipping_first_name }} {{ $order->shipping_last_name }}
                            <br /> {{ $order->shipping_company_name }}
                        </td>

                    </tr>

                    <tr>

                        <td align="left" valign="middle" style="padding-left:20px;">
                            {{ $order->shipping_street_address }}</td>

                    </tr>
                    <tr>
                        <td align="left" valign="middle" style="padding-left:20px;">
                            {{ $order->shipping_city }}, {{ $order->shipping_state }}-{{ $order->shipping_zip_code }}
                        </td>
                    </tr>

                    <tr>

                        <td align="left" valign="middle" style="padding-left:20px;">
                            {{ $order->shipping_country->country_name }}</td>

                    </tr>

                    <tr>

                        <td align="left" valign="middle" style="padding-left:20px;">Phone:
                            {{ $order->shipping_phone }}
                        </td>

                    </tr>

                </table>
            </td>

        </tr>

        <tr>

            <td align="center" valign="middle">&nbsp;</td>

            <td align="center" valign="middle">&nbsp;</td>

        </tr>

        <tr>

            <td colspan="2" align="center" valign="middle">

                <table width="825" border="0" align="center" cellpadding="2" cellspacing="0">

                    <tr>

                        <td width="311" align="center" valign="middle" bgcolor="#b9b9b9"
                            style="border:1px solid #0a0a0a;"> Customer ID </td>
                        <td width="162" align="center" valign="middle" bgcolor="#b9b9b9"
                            style="border-bottom:1px solid #0a0a0a; border-top: 1px solid #0a0a0a;"> Payment Status
                        </td>
                        <td width="164" align="center" valign="middle" bgcolor="#b9b9b9"
                            style="border:1px solid #0a0a0a;"> Shipping Method </td>
                        <td width="162" align="center" valign="middle" bgcolor="#b9b9b9"
                            style="border-bottom:1px solid #0a0a0a; border-top: 1px solid #0a0a0a; border-right: 1px solid #0a0a0a;">
                            Order Status </td>
                    </tr>

                    <tr>
                        {{-- {{ dd($order) }} --}}
                        <td align="center" valign="middle"
                            style="border-left:1px solid #0a0a0a; border-bottom: 1px solid #0a0a0a;">
                            {{ $order->user->id . ' - ' . $order->user->email }}</td>

                        <td align="center" valign="middle"
                            style="border-left:1px solid #0a0a0a; border-bottom: 1px solid #0a0a0a;">
                            {{ $order->payment_status }}
                        </td>

                        <td align="center" valign="middle"
                            style="border-left:1px solid #0a0a0a; border-bottom: 1px solid #0a0a0a;">
                            {{ $order->shipped_by }}</td>

                        <td align="center" valign="middle"
                            style="border-left:1px solid #0a0a0a; border-bottom: 1px solid #0a0a0a; border-right: 1px solid #0a0a0a;">
                            {{ $order->order_status }}</td>

                    </tr>

                </table>
            </td>

        </tr>

        <tr>

            <td align="center" valign="middle">&nbsp;</td>

            <td align="center" valign="middle">&nbsp;</td>

        </tr>

        <tr>

            <td colspan="2" align="center" valign="middle">
                <table width="830" border="0" align="center" cellpadding="2" cellspacing="2">

                    <tr class="small_font">

                        <td height="350" colspan="4" align="center" valign="top"
                            style="border:1px solid #000000;">
                            <table width="831" border="0" align="center" cellpadding="3" cellspacing="0">



                                <tr>

                                    <td width="12%" height="25" align="center" bgcolor="#b9b9b9"
                                        style="border:1px solid #0a0a0a;"><strong> Serial No. </strong></td>

                                    <td width="46%" align="left" bgcolor="#b9b9b9"
                                        style="border-bottom:1px solid #0a0a0a; border-top: 1px solid #0a0a0a;">
                                        <strong> Product Name </strong>
                                    </td>
                                    <td width="14%" align="center" valign="middle" bgcolor="#b9b9b9"
                                        style="border:1px solid #0a0a0a;"><strong> Color </strong>
                                    </td>
                                    <td width="14%" align="center" valign="middle" bgcolor="#b9b9b9"
                                        style="border:1px solid #0a0a0a;"><strong> Size </strong>
                                    </td>
                                    <td width="14%" align="right" valign="middle" bgcolor="#b9b9b9"
                                        style="border:1px solid #0a0a0a;"><strong> Product Price </strong>
                                    </td>

                                    <td width="12%" align="center" valign="middle" bgcolor="#b9b9b9"
                                        style="border-bottom:1px solid #0a0a0a; border-top: 1px solid #0a0a0a;">
                                        <strong> Product Qty </strong>
                                    </td>

                                    <td width="19%" align="right" valign="middle" bgcolor="#b9b9b9"
                                        style="border:1px solid #0a0a0a; padding-right:10px;"><strong> Total Price
                                        </strong></td>

                                </tr>
                                <tr>
                                    <td height="25" colspan="7" align="left" bgcolor="#b9b9b9"
                                        style="border-bottom:1px solid #0a0a0a; border-left:1px solid #0a0a0a; border-right:1px solid #0a0a0a;">
                                        &nbsp; &nbsp; &nbsp;<strong>Order Information</strong></td>
                                </tr>
                                @php
                                    $subtotal = 0;
                                @endphp
                                @foreach ($order->order_details as $key => $value)
                                    @php
                                        $total_price = $value->price * $value->quantity;
                                        $subtotal = $total_price;
                                    @endphp
                                    <tr class="small_font">
                                        <td height="24" align="center" valign="middle"
                                            style="border-left:1px solid #0a0a0a; border-bottom:1px solid #0a0a0a;">
                                            {{ $loop->iteration }}</td>
                                        <td align="left" valign="middle"
                                            style="border-left:1px solid #0a0a0a; border-bottom:1px solid #0a0a0a;">
                                            {{ $value->product->product_title . ' (' . $value->product->product_code . ')' }}
                                        </td>
                                        <td align="center" valign="middle"
                                            style="border-left:1px solid #0a0a0a; border-bottom:1px solid #0a0a0a;">
                                            {{ $value->color->name }}</td>
                                        <td align="center" valign="middle"
                                            style="border-left:1px solid #0a0a0a; border-bottom:1px solid #0a0a0a;">
                                            {{ $value->size->code }}</td>
                                        <td align="right" valign="middle"
                                            style="border-left:1px solid #0a0a0a; border-bottom:1px solid #0a0a0a;"> {{ $basicInfo->currency_symbol }}                                             {{ $value->price }}</td>
                                        <td align="center" valign="middle"
                                            style="border-left:1px solid #0a0a0a; border-bottom:1px solid #0a0a0a;">
                                            {{ $value->quantity }}</td>
                                        <td align="right" valign="middle"
                                            style="border-left:1px solid #0a0a0a; border-bottom:1px solid #0a0a0a; border-right:1px solid #0a0a0a; padding-right:10px;">
                                            {{ $basicInfo->currency_symbol }} {{ $total_price }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>

                    </tr>

                </table>
            </td>

        </tr>

        <tr>

            <td align="left" valign="middle"><span class="style1">Notes :</span> <span
                    class="style3">{{ $order->notes }}</span></td>

            <td align="right" valign="middle">
                <table width="400" border="0" align="right" cellpadding="2" cellspacing="2">
                    <tr class="small_font">
                        <td width="63%" align="left" valign="top" style="border:1px solid #0a0a0a;">Subtotal
                        </td>
                        <td width="37%" align="right" valign="middle" style="border:1px solid #0a0a0a;">{{ $basicInfo->currency_symbol }} {{ $order->total_price }}</strong></td>
                    </tr>
                    <tr class="small_font">
                        <td align="left" valign="top" style="border:1px solid #0a0a0a;">Discount</td>
                        <td width="37%" align="right" valign="middle" style="border:1px solid #0a0a0a;">{{ $basicInfo->currency_symbol }} {{ $order->total_discount }}</td>
                    </tr>
                    <tr class="small_font">
                        <td align="left" valign="top" style="border:1px solid #0a0a0a;">Gross Total</td>
                        <td width="37%" align="right" valign="middle" style="border:1px solid #0a0a0a;"> {{ $basicInfo->currency_symbol }} {{ $order->total_price - $order->total_discount }}</td>
                    </tr>
                    <tr class="small_font">
                        <td align="left" valign="top" style="border:1px solid #0a0a0a;">Shipping Charge</td>
                        <td align="right" valign="middle" style="border:1px solid #0a0a0a;">{{ $basicInfo->currency_symbol }} {{ $order->shipping_charge }}
                        </td>
                    </tr>
                    <tr class="small_font">
                        <td align="left" valign="top" style="border:1px solid #0a0a0a;">Tax</td>
                        <td align="right" valign="middle" style="border:1px solid #0a0a0a;">{{ $basicInfo->currency_symbol }} 0</td>
                    </tr>
                    <tr class="small_font">
                        <td align="left" valign="top" bgcolor="#808080" style="border:1px solid #0a0a0a;">
                            <strong>Grand Total</strong>
                        </td>
                        <td align="right" valign="middle" bgcolor="#808080" style="border:1px solid #0a0a0a;">
                            <strong>{{ $basicInfo->currency_symbol }} {{ $order->payable_amount }}</strong>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/barcodes/JsBarcode.code128.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script type="text/javascript">
    JsBarcode(".barcode", "{{ $order->order_no }}", {
        // format: "upc",
        // lineColor: "#0aa",
        width: 1,
        height: 30,
        displayValue: false
    });

</script>