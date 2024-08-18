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
                        <h1 class="m-0">Production Plan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Production Plan</li>
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
                            <form id="form-submit" action="{{ isset($data['item']) ? route('production-plans.update',$data['item']['id']) : route('production-plans.store'); }}" method="POST" enctype="multipart/form-data">
                                @csrf()
                                @if(isset($data['item']))
                                    @method('put')
                                @endif
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                            <label>Date *</label>
                                            <input name="date" id="date" type="date"
                                                value="{{ isset($data['item']) ? $data['item']['date'] : date('Y-m-d') }}"
                                                class="form-control" required>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                            <label>Item</label>
                                            <select class="form-control normalize" id="recipe_id_temp">
                                                <option value="" selected>Select Item</option>
                                                @foreach ($data['recipes'] as $key => $recipe)
                                                    <option value="{{ $recipe->id }}" item-title="{{ $recipe->item->title }}"
                                                        item-price="{{ $recipe->item->cost }}"
                                                        unit_name="{{ $recipe->item->unit->title }}"
                                                        > {{ $recipe->item->title }} ({{ $recipe->item->unit->title }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                            <div class="table-responsive">
                                                <table id="table"
                                                    class="table table-striped table-bordered table-centre p-0 m-0">
                                                    <thead>
                                                        <tr>
                                                            <th width="5%">SN</th>
                                                            <th>Item</th>
                                                            <th>Unit Name</th>
                                                            <th>Cost</th>
                                                            <th>Quantity</th>
                                                            <th>Sub Total</th>
                                                            <th width="5%">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody">
                                                        @isset($data['item'])
                                                            @php
                                                                $total = 0;
                                                            @endphp
                                                            @foreach($data['item']['ppdetails'] as $key => $ppdetails)
                                                                @php
                                                                    $total += $subtotal = $ppdetails['quantity'] * $ppdetails['recipe']['item']['cost'];
                                                                @endphp
                                                                <tr>
                                                                    <td class="serial">{{ $loop->iteration }}</td>
                                                                    <td><input type="hidden" value="{{ $ppdetails['recipe_id'] }}" name="recipe_id[]">{{ $ppdetails['recipe']['item']['title'] }}</td>
                                                                    <td><input type="number" value="{{ $ppdetails['recipe']['item']['cost'] }}" class="form-control form-control-sm calculate" name="unit_price[]" placeholder="0.00" readonly></td>
                                                                    <td><input type="number" value="{{  $ppdetails['quantity'] }}" class="form-control form-control-sm calculate" name="quantity[]" placeholder="0.00" required></td>
                                                                    <td><input type="number" value="{{ $subtotal }}" class="form-control form-control-sm" name="sub_total[]" placeholder="0.00" disabled></td>
                                                                    <td><button class="btn btn-sm btn-danger btn-del" type="button"><i class="fa-solid fa-trash btn-del"></i></button></td>
                                                                </tr>
                                                            @endforeach
                                                        @endisset
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-9 col-md-9 col-lg-9">
                                            <label>Note</label>
                                            <input value="{{ isset($data['item']) ? $data['item']['note'] : null }}"
                                                class="form-control" type="text" name="note" id="note"
                                                placeholder="Note">
                                        </div>
                                        <div class="form-group col-sm-3 col-md-3 col-lg-3">
                                            <label>Total</label>
                                            <input
                                                value="{{ isset($data['item']) ? $total : null }}"
                                                type="number" class="form-control" name="total" id="total"
                                                placeholder="0.00" readonly>
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
            $('#recipe_id_temp').on('change', function(e) {
                let recipe_id = $('#recipe_id_temp').val();
                let item_title = $('#recipe_id_temp option:selected').attr('item-title');
                let unit_name = $('#recipe_id_temp option:selected').attr('unit_name');
                let item_price = $('#recipe_id_temp option:selected').attr('item-price');
                let unit_price_temp = $('#recipe_id_temp option:selected').attr('item-price');
                let quantity_temp = 1;
                let total_temp = unit_price_temp * quantity_temp;
                let tbody = ``;

                tbody +=  `<tr>
                            <td class="serial"></td>
                            <td><input type="hidden" value="${recipe_id}" name="recipe_id[]">${item_title}</td>
                            <td>${item_title}</td>
                            <td><input type="number" value="${unit_price_temp}" class="form-control form-control-sm calculate" name="unit_price[]" placeholder="0.00" readonly></td>
                            <td><input type="number" value="${quantity_temp}" class="form-control form-control-sm calculate" name="quantity[]" placeholder="0.00" required></td>
                            <td><input type="number" value="${total_temp}" class="form-control form-control-sm" name="sub_total[]" placeholder="0.00" disabled></td>
                            <td><button class="btn btn-sm btn-danger btn-del" type="button"><i class="fa-solid fa-trash btn-del"></i></button></td>
                        </tr>`

                $('#tbody').append(tbody);
                $(".serial").each(function(index) { $(this).html(index + 1);});
                $('#recipe_id_temp').val('');
                calculate(true);
            });

            $('#table').bind('keyup, input', function(e) {
                if ($(e.target).is('.calculate')) {
                    calculate(true);
                }
            });
            $('#tbody').bind('click', function(e) {
                $(e.target).is('.btn-del') && e.target.closest('tr').remove();
                $(".serial").each(function(index) {
                    $(this).html(index + 1);
                });
                calculate(true);
            });
        });

        $('#form-submit').submit(function(e) {
            if (!$('input[name="recipe_id[]"]').length) {
                e.preventDefault();
                Swal.fire("Please Insert Item!");
            }
            if(parseFloat($('#paid_amount').val())>parseFloat($('#total_payable').val())){
                e.preventDefault();
                Swal.fire("Couldn't be pay more then payable!");
            }
        });


        function calculate(isDefaultRecipentAmt) {
            let recipe_id = $('input[name="recipe_id[]"]');
            let total = 0;
            for (let i = 0; i < recipe_id.length; i++) {
                $('input[name="sub_total[]"]')[i].value = ($('input[name="unit_price[]"]')[i].value * $(
                    'input[name="quantity[]"]')[i].value);
                total += $('input[name="unit_price[]"]')[i].value * $('input[name="quantity[]"]')[i].value;
            }
            $('#total').val(total);
        }

    </script>
@endsection
