@extends('layouts.admin.master')
@section('content')
    <style>
        table td, table th{
            padding: 3px!important;
            text-align: center;
        }
        input[type="number"]{
            text-align: right;
        }
        .item{
            text-align: left;
        }
        .form-group{
            padding: 2px;
            margin: 0px;
        }
        label{
            margin-bottom: 0px;
        }
    </style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Orders</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Orders</li>
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
                            <form id="form-submit" action="{{ isset($data['order']) ? route('orders.update',$data['order']->id) : route('orders.store'); }}" method="POST" enctype="multipart/form-data">
                                @csrf()
                                @if(isset($data['order']))
                                    @method('put')
                                @endif
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                            <table id="expanse-table" class="table table-striped table-bordered table-centre p-0 m-0">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">SN</th>
                                                        <th>Item</th>
                                                        <th>Unit Price</th>
                                                        <th>Quantity</th>
                                                        <th>Total</th>
                                                        <th width="5%">Action</th>
                                                    </tr>
                                                    <tr class="p-0 m-0">
                                                        <th>#</th>
                                                        <th>
                                                            <select class="form-control form-control-sm" id="item_id_temp">
                                                                <option value="" selected>Select Item</option>
                                                                @foreach($data['items'] as $key => $item)
                                                                    <option value="{{ $item->id }}" item-title="{{ $item->title }}" item-price="{{ $item->price }}">{{ $item->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </th>
                                                        <th><input placeholder="0.00" type="number" class="form-control form-control-sm calculate" id="unit_price_temp" disabled></th>
                                                        <th><input placeholder="0.00" type="number" class="form-control form-control-sm calculate" id="quantity_temp"></th>
                                                        <th><input placeholder="0.00" type="number" class="form-control form-control-sm" id="total_temp" disabled></th>
                                                        <th><button id="btn-add" class="btn btn-sm btn-primary" type="button"><i class="fa-sharp fa-solid fa-plus"></i></button></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-data">
                                                    @isset($data['order'])
                                                        @foreach($data['order']->order_details as $key => $value)
                                                            <tr>
                                                                <input type="hidden" name="order_details_id[]" value="{{ $value->id }}">
                                                                <td class="serial">{{ $loop->iteration }}</td>
                                                                <td class="item"><input type="hidden" value="{{ $value->item->id  }}" name="item_id[]">{{ $value->item->title }}</td>
                                                                <td><input type="number" readonly value="{{ $value->unit_price }}" class="form-control form-control-sm calculate" name="unit_price[]" placeholder="0.00"></td>
                                                                <td><input type="number" readonly value="{{ $value->quantity }}" class="form-control form-control-sm calculate" name="quantity[]" placeholder="0.00"></td>
                                                                <td><input type="number" value="{{ $value->unit_price * $value->quantity }}" class="form-control form-control-sm" name="total[]" placeholder="0.00" disabled></td>
                                                                <td><button class="btn btn-sm btn-danger btn-del" type="button"><i class="fa-solid fa-trash btn-del"></i></button></td>
                                                            </tr>
                                                        @endforeach
                                                    @endisset
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>Service Table *</label>
                                                <select name="table_id" id="table_id" class="form-control" required @isset($data['order']) @disabled(true) @endisset>
                                                    <option value="" selected>Select Table</option>
                                                    @foreach ($data['tables'] as $table)
                                                        <option
                                                            @isset($data['order'])
                                                                @if($table->id == $data['order']->table_id)
                                                                    selected
                                                                @endif
                                                            @endisset
                                                        value="{{ $table->id }}" @if(!$table->is_available) class="bg-danger" @disabled(true) @endif>{{ $table->title }} {{ $table->is_available == 1 ? 'Available' : 'Serving' }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>Note</label>
                                                <input value="{{ isset($data['order']) ? $data['order']->note : null }}" class="form-control" type="text" name="note" id="note" placeholder="Note">
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                            <label>Grand Total</label>
                                            <input value="{{ isset($data['order']) ? $data['order']->mrp : null }}" type="number" class="form-control" name="total" id="total" placeholder="0.00" readonly>
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
    $(document).ready(function(){

        $('#item_id_temp').on('change', function (e) {
            $('#unit_price_temp').val($('#item_id_temp option:selected').attr('item-price'));
            $('#quantity_temp').val(1);
            calculate();
        });

        $('#expanse-table').bind('keyup, input', function (e) {
            if($(e.target).is('.calculate')){
                calculate();
            }
        });
        $('#table-data').bind('click', function (e) {
            $(e.target).is('.btn-del') && e.target.closest('tr').remove();
            $( ".serial" ).each(function(index){$(this).html(index+1);});
            calculate();
        });
        $('#btn-add').click(function(){
            

            let item_id = $('#item_id_temp').val();
            let item_title = $('#item_id_temp option:selected').attr('item-title');
            let item_price = $('#item_id_temp option:selected').attr('item-price');

            let unit_price_temp = $('#unit_price_temp').val();
            let quantity_temp = $('#quantity_temp').val();
            let total_temp = $('#total_temp').val();
            let td = '';
            if(!(item_id && unit_price_temp && quantity_temp && total_temp)) return alert("Please fill up required field!");

            td += '<tr>';
            td +=   '<td class="serial"></td>';
            td +=   '<input type="hidden" name="order_details_id[]" value="">';
            td +=   '<td class="item"><input type="hidden" value="'+item_id+'" name="item_id[]">'+item_title+'</td>';
            td +=   '<td><input readonly type="number" value="'+unit_price_temp+'" class="form-control form-control-sm calculate" name="unit_price[]" placeholder="0.00" required></td>';
            td +=   '<td><input type="number" value="'+quantity_temp+'" class="form-control form-control-sm calculate" name="quantity[]" placeholder="0.00" required></td>';
            td +=   '<td><input type="number" value="'+total_temp+'" class="form-control form-control-sm" name="total[]" placeholder="0.00" disabled></td>';
            td +=   '<td><button class="btn btn-sm btn-danger btn-del" type="button"><i class="fa-solid fa-trash btn-del"></i></button></td>';
            td += '</tr>';

            $('#table-data').append(td);
            $( ".serial" ).each(function(index){$(this).html(index+1);});

            $('#item_id_temp').val('');
            $('#unit_price_temp').val('');
            $('#quantity_temp').val('');
            $('#total_temp').val('');
            calculate();
        });
    });

    $('#form-submit').submit(function(e){
        if(!$('input[name="item_id[]"]').length){
            e.preventDefault();
            alert('Please Insert Expense Details!');
        }
    });
    function calculate(){
        $('#total_temp').val($('#quantity_temp').val() * $('#unit_price_temp').val());
        let item_id = $('input[name="item_id[]"]');
        let grand_total = 0;
        for (let i = 0; i < item_id.length; i++){
            $('input[name="total[]"]')[i].value = ($('input[name="unit_price[]"]')[i].value * $('input[name="quantity[]"]')[i].value);
            grand_total += $('input[name="unit_price[]"]')[i].value * $('input[name="quantity[]"]')[i].value;
        }
        $('#total').val(grand_total);
    }


</script>
@endsection