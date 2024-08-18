@extends('layouts.admin.master')
@section('content')
    <style>
        table td,
        table th {
            padding: 3px !important;
            text-align: center;
        }

        input[type="number"] {
            text-align: right;
        }

        .item {
            text-align: left;
        }

        .form-group {
            padding: 2px;
            margin: 0px;
        }

        label {
            margin-bottom: 0px;
        }
    </style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manual Bills</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manual Bills</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ $data['title'] }} Form</h3>
                            </div>
                            <form id="form-submit"
                                action="{{ isset($data['order']) ? route('manual-bills.update', $data['order']->id) : route('manual-bills.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf()
                                @if (isset($data['order']))
                                    @method('put')
                                @endif
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                            <div class="table-responsive">
                                                <table id="expanse-table"
                                                    class="table table-striped table-bordered table-centre p-0 m-0">
                                                    <thead>
                                                        <tr>
                                                            <th width="5%">SN</th>
                                                            <th>Item</th>
                                                            <th>Unit Price</th>
                                                            <th>Quantity</th>
                                                            <th>Sub Total</th>
                                                            <th>Vat</th>
                                                            <th width="5%">Action</th>
                                                        </tr>
                                                        <tr class="p-0 m-0">
                                                            <th>#</th>
                                                            <th>
                                                                <select class="form-control form-control-sm"
                                                                    id="item_id_temp">
                                                                    <option value="" selected>Select Item</option>
                                                                    @foreach ($data['items'] as $key => $item)
                                                                        <option value="{{ $item->id }}"
                                                                            item-title="{{ $item->title }}"
                                                                            item-vat="{{ $item->vat }}"
                                                                            item-price="{{ $item->price }}">
                                                                            {{ $item->title }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </th>
                                                            <th><input placeholder="0.00" type="number"
                                                                    class="form-control form-control-sm calculate"
                                                                    id="unit_price_temp" disabled></th>
                                                            <th><input placeholder="0.00" type="number"
                                                                    class="form-control form-control-sm calculate"
                                                                    id="quantity_temp"></th>
                                                            <th><input placeholder="0.00" type="number"
                                                                    class="form-control form-control-sm" id="total_temp"
                                                                    disabled></th>
                                                            <th><input placeholder="0.00" type="number"
                                                                    class="form-control form-control-sm" id="vat_temp"
                                                                    disabled></th>
                                                            <th><button id="btn-add" class="btn btn-sm btn-success"
                                                                    type="button">Save</button></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table-data">
                                                        @isset($data['order'])
                                                            @foreach ($data['order']->order_details as $key => $value)
                                                                @php
                                                                    $subtotol_vat =
                                                                        ($value->item->vat / 100) *
                                                                        ($value->unit_price * $value->quantity);
                                                                @endphp
                                                                <tr>
                                                                    <td class="serial"></td>
                                                                    <input type="hidden" name="order_details_id[]" value="{{ $value->id }}">
                                                                    <td class="item"><input type="hidden" value="{{ $value->item->id }}"
                                                                            name="item_id[]">{{ $value->item->title }}</td>
                                                                    <td><input readonly type="number"
                                                                            value="{{ $value->unit_price }}"
                                                                            class="form-control form-control-sm calculate"
                                                                            name="unit_price[]" placeholder="0.00" required>
                                                                    </td>
                                                                    <td><input type="number" value="{{ $value->quantity }}" readonly
                                                                            class="form-control form-control-sm calculate"
                                                                            name="quantity[]" placeholder="0.00" required></td>
                                                                    <td><input type="number" value="{{ $value->unit_price * $value->quantity }}"
                                                                            class="form-control form-control-sm"
                                                                            name="sub_total[]" placeholder="0.00" disabled></td>
                                                                    <td>
                                                                        <input type="number" value="{{ $subtotol_vat }}"
                                                                            class="form-control form-control-sm"
                                                                            name="subtotol_vat[]" placeholder="0.00" disabled>
                                                                        <input type="hidden" value="{{ $value->item->vat }}"
                                                                            name="vat_perc[]">
                                                                    </td>
                                                                    <td><button class="btn btn-sm btn-danger btn-del"
                                                                            type="button"><i
                                                                                class="fa-solid fa-trash btn-del"></i></button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endisset
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                            <label>Service Table *</label>
                                            <select name="table_id" id="table_id" class="form-control form-control-sm"
                                                required
                                                @isset($data['order']) @disabled(true) @endisset>
                                                <option value="" selected>Select Table</option>
                                                @foreach ($data['tables'] as $table)
                                                    <option
                                                        @isset($data['order'])
                                                            @if ($table->id == $data['order']->table_id)
                                                                selected
                                                            @endif
                                                        @endisset
                                                        value="{{ $table->id }}"
                                                        @if (!$table->is_available) class="bg-danger" @disabled(true) @endif>
                                                        {{ $table->title }}
                                                        {{ $table->is_available == 1 ? 'Available' : 'Serving' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                            <label>Payment Methods *</label>
                                            <select name="payment_method_id" id="payment_method_id"
                                                class="form-control form-control-sm" required>
                                                <option value='' selected>Select Payment Method</option>
                                                @foreach ($data['paymentMethods'] as $pm)
                                                    <option @selected($pm->is_default)
                                                        value="{{ $pm->id }}">{{ $pm->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                            <label>Total Amount</label>
                                            <input value="{{ isset($data['order']) ? $data['order']->mrp : null }}"
                                                type="number" class="form-control form-control-sm" name="mrp"
                                                id="mrp" placeholder="0.00" readonly>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-3 col-lg-3">
                                            <label>Discount Rate</label>
                                            <input value="{{ isset($data['order']) ? $data['order']->discount : null }}" step="0.01" type="number"
                                                class="form-control form-control-sm" name="discount_rate"
                                                id="discount_rate" placeholder="0.00">
                                        </div>
                                        <div class="form-group col-sm-4 col-md-3 col-lg-3">
                                            <label>Discount Method</label>
                                            <select name="discount_method" id="discount_method"
                                                class="form-control form-control-sm">
                                                <option value="1">In Percentage</option>
                                                <option value="2" selected>Solid Amount</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-3 col-lg-3">
                                            <label>Dicount Amount</label>
                                            <input value="{{ isset($data['order']) ? $data['order']->discount : null }}"
                                                readonly type="number" class="form-control form-control-sm"
                                                name="discount_amount" id="discount_amount" placeholder="0.00">
                                        </div>
                                        <div class="form-group col-sm-4 col-md-3 col-lg-3">
                                            <label>Total Vat</label>
                                            <input value="{{ isset($data['order']) ? $data['order']->vat : null }}"
                                                type="number" class="form-control form-control-sm" name="vat"
                                                id="vat" placeholder="0.00" readonly>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-6 col-lg-6">
                                            <label>Note</label>
                                            <input value="{{ isset($data['order']) ? $data['order']->note : null }}"
                                                class="form-control form-control-sm" type="text" name="note"
                                                id="note" placeholder="Note">
                                        </div>
                                        <div class="form-group col-sm-4 col-md-2 col-lg-2">
                                            <label>Total Payable</label>
                                            <input value="{{ isset($data['order']) ? $data['order']->net_bill : null }}"
                                                readonly type="number" class="form-control form-control-sm"
                                                name="total_payable" id="total_payable" placeholder="0.00">
                                        </div>
                                        <div class="form-group col-sm-4 col-md-2 col-lg-2">
                                            <label>Recipient Amount</label>
                                            <input value="{{ isset($data['order']) ? $data['order']->net_bill : 0.0 }}"
                                                step="0.01" type="number" class="form-control form-control-sm"
                                                name="recipient_amount" id="recipient_amount" placeholder="0.00">
                                        </div>
                                        <div class="form-group col-sm-4 col-md-2 col-lg-2">
                                            <label>Balance</label>
                                            <input value="0.00" readonly type="number"
                                                class="form-control form-control-sm" name="balance" id="balance"
                                                placeholder="0.00">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            $('#item_id_temp').on('change', function(e) {
                $('#quantity_temp').val(1.00);
                $('#unit_price_temp').val($('#item_id_temp option:selected').attr('item-price'));
                calculate(true);
            });

            $('#expanse-table').bind('keyup, input', function(e) {
                if ($(e.target).is('.calculate')) {
                    calculate(true);
                }
            });

            $('#table-data').bind('click', function(e) {
                $(e.target).is('.btn-del') && e.target.closest('tr').remove();
                $(".serial").each(function(index) {
                    $(this).html(index + 1);
                });
                calculate(true);
            });

            $('#btn-add').click(function() {
                let item_id = $('#item_id_temp').val();
                let item_title = $('#item_id_temp option:selected').attr('item-title');
                let item_price = parseFloat($('#item_id_temp option:selected').attr('item-price')) || 0;
                let vat_per = parseFloat($('#item_id_temp option:selected').attr('item-vat')) || 0;

                let unit_price_temp = parseFloat($('#unit_price_temp').val()) || 0;
                let quantity_temp = parseFloat($('#quantity_temp').val()) || 0;
                let total_temp = parseFloat($('#total_temp').val()) || 0;
                let vat_temp = parseFloat($('#vat_temp').val()) || 0;

                if (!(item_id && unit_price_temp && quantity_temp && total_temp)) {
                    return alert("Please fill up required field!");
                }

                let td = `<tr>`;
                td += `<td class="serial"></td>`;
                td += `<input type="hidden" name="order_details_id[]" value="">`;
                td +=
                    `<td class="item"><input type="hidden" value="${item_id}" name="item_id[]">${item_title}</td>`;
                td +=
                    `<td><input readonly type="number" value="${unit_price_temp}" class="form-control form-control-sm calculate" name="unit_price[]" placeholder="0.00" required></td>`;
                td +=
                    `<td><input type="number" value="${quantity_temp}" class="form-control form-control-sm calculate" name="quantity[]" placeholder="0.00" required></td>`;
                td +=
                    `<td><input type="number" value="${total_temp}" class="form-control form-control-sm" name="sub_total[]" placeholder="0.00" disabled></td>`;
                td += `<td>`;
                td +=
                    `<input type="number" value="${vat_temp}" class="form-control form-control-sm" name="subtotol_vat[]" placeholder="0.00" disabled>`;
                td += `<input type="hidden" value="${vat_per}" name="vat_perc[]">`;
                td += `</td>`;
                td +=
                    `<td><button class="btn btn-sm btn-danger btn-del" type="button"><i class="fa-solid fa-trash btn-del"></i></button></td>`;
                td += `</tr>`;

                $('#table-data').append(td);
                $(".serial").each(function(index) {
                    $(this).html(index + 1);
                });

                $('#item_id_temp').val('');
                $('#unit_price_temp').val('');
                $('#quantity_temp').val('');
                $('#total_temp').val('');
                $('#vat_temp').val('');
                calculate(true);
            });
        });

        $('#form-submit').submit(function(e) {
            if (!$('input[name="item_id[]"]').length) {
                e.preventDefault();
                alert('Please Insert Expense Details!');
            }
        });

        $('#discount_rate').on('keyup', function(e) {
            calculate(true);
        });
        $('#recipient_amount').on('keyup', function(e) {
            calculate(false);
        });
        $('#discount_method').on('change', function(e) {
            calculate(true);
        });


        function calculate(isDefaultRecipentAmt) {
            let unit_price = parseFloat($('#item_id_temp option:selected').attr('item-price')) || 0;
            let vat_per = parseFloat($('#item_id_temp option:selected').attr('item-vat')) || 0;
            let quantity = parseFloat($('#quantity_temp').val()) || 0;
            let sub_total = subtotal(unit_price, quantity);
            let sub_total_vat = vatcal(vat_per, sub_total);
            $('#total_temp').val(sub_total.toFixed(2));
            $('#vat_temp').val(sub_total_vat.toFixed(2));

            let balance = 0;
            let total = 0;
            let total_vat = 0;

            for (let index = 0; index < $('input[name="item_id[]"]').length; index++) {
                let unit_price = parseFloat($('input[name="unit_price[]"]').eq(index).val()) || 0;
                let quantity = parseFloat($('input[name="quantity[]"]').eq(index).val()) || 0;
                let vat_perc = parseFloat($('input[name="vat_perc[]"]').eq(index).val()) || 0;

                console.log(vat_perc);

                let sub_total = subtotal(unit_price, quantity);
                let vat = vatcal(vat_perc, sub_total);
                total += sub_total;
                total_vat += vat;

                $('input[name="sub_total[]"]').eq(index).val(sub_total.toFixed(2));
                $('input[name="subtotol_vat[]"]').eq(index).val(vat.toFixed(2));

            }

            $('#mrp').val(total.toFixed(2));
            $('#vat').val(total_vat.toFixed(2));

            let discount_method = parseInt($('#discount_method').val()) || 0;
            let discount_rate = parseFloat($('#discount_rate').val()) || 0;
            let discount_amount = discount_method == 1 ? total * (discount_rate / 100) : discount_rate;

            let total_payable = total + total_vat - discount_amount;
            if (isDefaultRecipentAmt) {
                $('#recipient_amount').val(total_payable.toFixed(2));
            } else {
                let recipient_amount = parseFloat($('#recipient_amount').val()) || 0;
                balance = recipient_amount - total_payable;
            }
            $('#balance').val(balance.toFixed(2));
            $('#discount_amount').val(discount_amount.toFixed(2));
            $('#total_payable').val(total_payable.toFixed(2));
        }

        function vatcal(var_percentage, amount) {
            return (var_percentage / 100) * amount;
        }

        function subtotal(unit_price, quantity) {
            return unit_price * quantity;
        }
    </script>
@endsection
