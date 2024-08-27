@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Issue Items</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Issue Items</li>
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
                            <form id="form-submit" action="{{ route('sales.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf()
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
                                                            <th>Purchase Price</th>
                                                            <th>Quantity</th>
                                                            <th>Sub Total</th>
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
                                                                            item-title="{{ $item->product_name }} ({{ $item->unit->title }})"
                                                                            item-price="{{ $item->price }}"> {{ $item->product_name }} ({{ $item->unit->title }})
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </th>
                                                            <th><input placeholder="0.00" type="number"
                                                                    class="form-control form-control-sm calculate"
                                                                    id="unit_price_temp"></th>
                                                            <th><input placeholder="0.00" type="number"
                                                                    class="form-control form-control-sm calculate"
                                                                    id="quantity_temp"></th>
                                                            <th><input placeholder="0.00" type="number"
                                                                    class="form-control form-control-sm" id="total_temp"
                                                                    disabled></th>
                                                            <th><button id="btn-add" class="btn btn-sm btn-primary"
                                                                    type="button"><i
                                                                        class="fa-sharp fa-solid fa-plus"></i></button></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table-data">
                                                        @isset($data['purchase'])
                                                            @foreach ($data['purchase']->order_details as $key => $value)
                                                                <tr>
                                                                    <input type="hidden" name="order_details_id[]"
                                                                        value="{{ $value->id }}">
                                                                    <td class="serial">{{ $loop->iteration }}</td>
                                                                    <td><input type="hidden" value="{{ $value->item->id }}"
                                                                            name="item_id[]">{{ $value->item->title }}</td>
                                                                    <td><input type="number" readonly
                                                                            value="{{ $value->unit_price }}"
                                                                            class="form-control form-control-sm calculate"
                                                                            name="unit_price[]" placeholder="0.00"></td>
                                                                    <td><input type="number" value="{{ $value->quantity }}"
                                                                            class="form-control form-control-sm calculate"
                                                                            name="quantity[]" placeholder="0.00"></td>
                                                                    <td><input type="number"
                                                                            value="{{ $value->unit_price * $value->quantity }}"
                                                                            class="form-control form-control-sm"
                                                                            name="sub_total[]" placeholder="0.00" disabled></td>
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
                                        <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                            <label>Date *</label>
                                            <input name="date" id="date" type="date"
                                                value="{{ isset($data['purchase']) ? $data['purchase']->note : date('Y-m-d') }}"
                                                class="form-control" required>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                            <label>Note</label>
                                            <input value="{{ isset($data['purchase']) ? $data['purchase']->note : null }}"
                                                class="form-control" type="text" name="note" id="note"
                                                placeholder="Note">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                            <label>Total</label>
                                            <input value="{{ isset($data['purchase']) ? $data['purchase']->total : null }}"
                                                class="form-control" type="text" name="total" id="totol" placeholder="0.00" readonly>
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
                $('#unit_price_temp').val($('#item_id_temp option:selected').attr('item-price'));
                $('#quantity_temp').val(1);
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
                let item_price = $('#item_id_temp option:selected').attr('item-price');

                let unit_price_temp = $('#unit_price_temp').val();
                let quantity_temp = $('#quantity_temp').val();
                let total_temp = $('#total_temp').val();
                let td = '';
                if (!(item_id && unit_price_temp && quantity_temp && total_temp)) return alert(
                    "Please fill up required field!");

                td += '<tr>';
                td += '<td class="serial"></td>';
                td += '<td><input type="hidden" value="' + item_id + '" name="item_id[]">' + item_title + '</td>';
                td += '<td><input type="number" value="' + unit_price_temp +
                    '" class="form-control form-control-sm calculate" name="unit_price[]" placeholder="0.00" required></td>';
                td += '<td><input type="number" value="' + quantity_temp +
                    '" class="form-control form-control-sm calculate" name="quantity[]" placeholder="0.00" required></td>';
                td += '<td><input type="number" value="' + total_temp +
                    '" class="form-control form-control-sm" name="sub_total[]" placeholder="0.00" disabled></td>';
                td +=
                    '<td><button class="btn btn-sm btn-danger btn-del" type="button"><i class="fa-solid fa-trash btn-del"></i></button></td>';
                td += '</tr>';

                $('#table-data').append(td);
                $(".serial").each(function(index) {
                    $(this).html(index + 1);
                });

                $('#item_id_temp').val('');
                $('#unit_price_temp').val('');
                $('#quantity_temp').val('');
                $('#total_temp').val('');
                calculate(true);
            });
        });

        $('#form-submit').submit(function(e) {
            if (!$('input[name="item_id[]"]').length) {
                e.preventDefault();
                alert('Please Select Item!');
            }
        });

        function calculate(isDefaultRecipentAmt) {

            $('#total_temp').val($('#quantity_temp').val() * $('#unit_price_temp').val());
            let item_id = $('input[name="item_id[]"]');
            let total = 0;
            for (let i = 0; i < item_id.length; i++)
            total += $('input[name="sub_total[]"]')[i].value = ($('input[name="unit_price[]"]')[i].value * $('input[name="quantity[]"]')[i].value);
            $('#totol').val(total);
        }
    </script>
@endsection
