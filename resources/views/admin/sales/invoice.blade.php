<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $data['basicInfo']->title }}</title>
    <link rel="shortcut icon" type="image/x-icon"
        href="{{ asset('public/uploads/basic-info/' . $data['basicInfo']->favIcon) }}">
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
        if ("{{ $data['print'] }}" == 'print') {
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
                            <img height="120px" width="120px"
                                src="{{ asset('public/uploads/basic-info/' . $data['basicInfo']->logo) }}"
                                border="0" />
                        </td>
                    </tr>
                    <tr>
                        <td align="left" valign="middle"><span
                                class="small_font">{{ $data['basicInfo']->address }}</span></td>
                    </tr>
                </table>
            </td>
            <td width="454" align="right" valign="middle">
                <table width="400" border="0" cellspacing="2" cellpadding="2">
                    <tr>
                        <td height="77" colspan="2" align="left" valign="middle" class="style2">INVOICE</td>
                    </tr>
                    <tr>
                        <td width="131" align="left" valign="middle">Invoice Number </td>
                        <td width="255" align="left" valign="middle"> : {{ $data['issue_items']->invoice_no }}</td>
                    </tr>
                    <tr>
                        <td align="left" valign="middle">Invoice Date </td>
                        <td align="left" valign="middle"> : {{ date('D dS M, Y h:i A', strtotime($data['issue_items']->date)) }} </td>
                    </tr>
                    <tr>
                        <td align="left" valign="middle">Invoice Barcode</td>
                        <td align="left" valign="middle">:<svg class="barcode"></svg></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="left" valign="middle">Voice : {{ $data['basicInfo']->phone1 }}</td>
            <td align="center" valign="middle">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" valign="middle">Fax : {{ $data['basicInfo']->phone2 }}</td>
            <td align="center" valign="middle">&nbsp;</td>
        </tr>
        <tr>
            <td align="center" valign="middle">&nbsp;</td>
            <td align="center" valign="middle">&nbsp;</td>
        </tr>
        <tr>
            <td align="center" valign="middle">&nbsp;</td>
            <td align="center" valign="middle">&nbsp;</td>
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
                                        <strong>Item Name</strong>
                                    </td>
                                    <td width="14%" align="center" valign="middle" bgcolor="#b9b9b9"
                                        style="border:1px solid #0a0a0a;"><strong>Unit Price</strong>
                                    </td>
                                    <td width="12%" align="center" valign="middle" bgcolor="#b9b9b9"
                                        style="border-bottom:1px solid #0a0a0a; border-top: 1px solid #0a0a0a;">
                                        <strong>Qty</strong>
                                    </td>

                                    <td width="19%" align="right" valign="middle" bgcolor="#b9b9b9"
                                        style="border:1px solid #0a0a0a; padding-right:10px;"><strong> Total Price
                                        </strong></td>
                                </tr>
                                @php
                                    $total_price = 0;
                                @endphp
                                @foreach ($data['issue_items']->issue_item_details as $key => $value)
                                    @php
                                        $total_price += $value->total_amount;
                                    @endphp
                                    <tr class="small_font">
                                        <td height="24" align="center" valign="middle"
                                            style="border-left:1px solid #0a0a0a; border-bottom:1px solid #0a0a0a;">
                                            {{ $loop->iteration }}</td>
                                        <td align="left" valign="middle"
                                            style="border-left:1px solid #0a0a0a; border-bottom:1px solid #0a0a0a;">
                                            {{ $value->item->title }}
                                        </td>
                                        <td align="right" valign="middle"
                                            style="border-left:1px solid #0a0a0a; border-bottom:1px solid #0a0a0a;">
                                            {{ $data['basicInfo']->currency_symbol }} {{ number_format($value->unit_price,2) }} / {{ $value->item->unit->title }}
                                        </td>
                                        <td align="center" valign="middle"
                                            style="border-left:1px solid #0a0a0a; border-bottom:1px solid #0a0a0a;">
                                            {{ number_format($value->quantity,2) }}
                                        </td>
                                        <td align="right" valign="middle"
                                            style="border-left:1px solid #0a0a0a; border-bottom:1px solid #0a0a0a; border-right:1px solid #0a0a0a; padding-right:10px;">
                                            {{ $data['basicInfo']->currency_symbol }} {{ number_format($value->total_amount,2) }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="left" valign="middle"><span class="style1">Notes :</span> <span class="style3">{{ $data['issue_items']->note }}</span></td>
        </tr>
    </table>
</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/barcodes/JsBarcode.code128.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script type="text/javascript">
    JsBarcode(".barcode", "{{ $data['issue_items']->invoice_no }}", {
        // format: "upc",
        // lineColor: "#0aa",
        width: 1,
        height: 30,
        displayValue: false
    });
</script>
