<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .container {
            display: block;
            width: 100%;
            background: #fff;
            max-width: 350px;
            padding: 25px;
            margin: 50px auto 0;
            box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
        }
        .container-fluid {
            display: block;
            width: 100%;
            /* background: #fff; */
            max-width: 350px;
            padding: 5px;
            margin: 50px auto 0;
            /* font-size: 10px; */
            /* box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); */
        }

        .receipt_header {
            padding-bottom: 40px;
            border-bottom: 1px dashed #000;
            text-align: center;
        }

        .receipt_header h1 {
            font-size: 20px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .receipt_header h1 span {
            display: block;
            font-size: 25px;
        }

        .receipt_header h2 {
            font-size: 14px;
            color: #727070;
            font-weight: 300;
        }

        .receipt_header h2 span {
            display: block;
        }

        .receipt_body {
            margin-top: 25px;
        }

        table {
            width: 100%;
        }

        thead,
        tfoot {
            position: relative;
        }

        thead th:not(:last-child) {
            text-align: left;
        }

        thead th:last-child {
            text-align: right;
        }

        thead::after {
            content: '';
            width: 100%;
            border-bottom: 1px dashed #000;
            display: block;
            position: absolute;
        }

        tbody td:not(:last-child),
        tfoot td:not(:last-child) {
            text-align: left;
        }

        tbody td:last-child,
        tfoot td:last-child {
            text-align: right;
        }

        tbody tr:first-child td {
            padding-top: 15px;
        }

        tbody tr:last-child td {
            padding-bottom: 15px;
        }

        tfoot tr:first-child td {
            padding-top: 15px;
        }

        tfoot::before {
            content: '';
            width: 100%;
            border-top: 1px dashed #000;
            display: block;
            position: absolute;
        }

        tfoot tr:nth-child(5) td:first-child,
        tfoot tr:nth-child(5) td:last-child {
            font-weight: bold;
            font-size: 16px;
        }

        .date_time_con {
            display: flex;
            justify-content: center;
            column-gap: 25px;
        }

        .items {
            margin-top: 25px;
        }

        h3 {
            border-top: 1px dashed #000;
            padding-top: 10px;
            margin-top: 25px;
            text-align: center;
            text-transform: uppercase;
        }
        /* New */
        .button
        {
            display: inline-block;
            padding: 5px 10px;
            font-size: 24px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #04AA6D;
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px #999;
        }
        .button:hover {background-color: #3e8e41}
        .button:active {
            background-color: #3e8e41;
            box-shadow: 0 5px #666;
            transform: translateY(4px);
        }


    </style>

</head>

<body>
    <div class="container-fluid" id="header_id" style="float: between;">
        <a href="{{ Session::get('back_url') }}" class="button">Back</a>
        <button onclick="my_print();" class="button">Print</button>
        <a href="{{ url('admin/manual-bills') }}" class="button">Dashboard</a>
    </div>

    <div class="container">
        <div class="receipt_header">
            <h1>Receipt of Payment <span>{{ $data['basicInfo']->title }}</span></h1>
            <h2>{{ $data['basicInfo']->address }}<span>Tel: {{ $data['basicInfo']->phone1 }}</span></h2>
        </div>
        <div class="receipt_body">
            <div class="date_time_con">
                <div class="date">{{ date_format(date_create($data['order']->completed_at), 'd M Y') }}</div>
                <div class="time">{{ date_format(date_create($data['order']->completed_at), 'h:i:s a') }}</div>
            </div>
            <div class="items">
                <table>
                    <thead>
                        <th>ITEM</th>
                        <th>QTY X Price</th>
                        <th>Sub Total</th>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($data['order']->order_details as $key => $ods)
                            <tr>
                                <td>{{ $ods->item->title }}</td>
                                <td>{{ $ods->quantity }} x {{ $ods->unit_price }}</td>
                                <td>{{ $data['basicInfo']->currency_symbol }}
                                    {{ $subTotal = $ods->quantity * $ods->unit_price }}</td>
                            </tr>
                            @php
                                $total += $subTotal;
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Total Amount</td>
                            <td></td>
                            <td>{{ $data['basicInfo']->currency_symbol }} {{ number_format($data['order']->mrp, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Vat</td>
                            <td></td>
                            <td>{{ $data['basicInfo']->currency_symbol }} {{ number_format($data['order']->vat, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Gross Total</td>
                            <td></td>
                            <td>{{ $data['basicInfo']->currency_symbol }} {{ number_format($data['order']->mrp + $data['order']->vat, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Discount</td>
                            <td></td>
                            <td>{{ $data['basicInfo']->currency_symbol }} {{ number_format($data['order']->discount, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Net Payable</td>
                            <td></td>
                            <td>{{ $data['basicInfo']->currency_symbol }} {{ number_format($data['order']->net_bill, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Paid Amount</td>
                            <td></td>
                            <td>{{ $data['basicInfo']->currency_symbol }} {{ number_format($data['order']->paid_amount, 2) }}</td>
                        </tr>
                    </tfoot>
                    {{-- <tfoot>
                        <tr>
                            <td>Total</td>
                            <td></td>
                            <td>{{ $data['basicInfo']->currency_symbol }}
                                {{ number_format($data['payment']->total_amount, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Discount</td>
                            <td></td>
                            <td>{{ $data['basicInfo']->currency_symbol }}
                                {{ number_format($data['payment']->discount, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Tax</td>
                            <td></td>
                            <td>{{ $data['basicInfo']->currency_symbol }}
                                {{ number_format($data['payment']->tax_amount, 2) }}</td>
                        </tr>
                        <tr>
                            <td><b>Grand Total</b></td>
                            <td></td>
                            <td><b>{{ $data['basicInfo']->currency_symbol }} {{ number_format($data['payment']->total_payable, 2) }}</b></td>
                        </tr>
                    </tfoot> --}}
                </table>
            </div>
        </div>
        <h3>Thank You!</h3>
    </div>
</body>

</html>
<script src="{{ asset('public/admin-assets') }}/plugins/jquery/jquery.min.js"></script>
<script>
    $(function() {
        my_print();
    });
    function my_print(){
        $('#header_id').hide();
        window.print();
        setTimeout(() => {
            $('#header_id').show();
        }, 500);
    }
</script>
