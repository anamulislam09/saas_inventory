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
                        <h1 class="m-0">Recipe</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Recipe</li>
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
                            <form id="form-submit" action="{{ isset($data['item']) ? route('recipes.update',$data['item']['id']) : route('recipes.store'); }}" method="POST" enctype="multipart/form-data">
                                @csrf()
                                @if(isset($data['item']))
                                    @method('put')
                                @endif
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                            <label>Production Items</label>
                                            <select class="form-control" name="item_id" required>
                                                <option value="">Select Production Items</option>
                                                @foreach ($data['production_items'] as $key => $item)
                                                    <option @selected(isset($data['item']) && $data['item']['item_id'] == $item->id) value="{{ $item->id }}">{{ $item->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                            <label>Raw Materials</label>
                                            <select class="form-control normalize" id="raw_material_id_temp">
                                                <option value="" selected>Select Raw Materials</option>
                                                @foreach ($data['raw_materials'] as $key => $item)
                                                    <option value="{{ $item->id }}"
                                                        unit_type="{{ $item->unit->unit_type }}"
                                                        unit_id="{{ $item->unit->id }}" item-title="{{ $item->title }}"
                                                        item-price="{{ $item->cost }}"> {{ $item->title }}
                                                        ({{ $item->unit->title }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                            <label>Status *</label>
                                            <select name="recipe_status" id="recipe_status" class="form-control">
                                                <option @selected(isset($data['item']) && $data['item']['recipe_status'] == 1) value="1">Active</option>
                                                <option @selected(isset($data['item']) && $data['item']['recipe_status'] == 0) value="0">Inactive</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                            <div class="table-responsive">
                                                <table id="table"
                                                    class="table table-striped table-bordered table-centre p-0 m-0">
                                                    <thead>
                                                        <tr>
                                                            <th>SN</th>
                                                            <th>Raw Materials</th>
                                                            <th>Purchase Price</th>
                                                            <th>Unit</th>
                                                            <th>Qty</th>
                                                            <th>Sub Total Cost</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody">
                                                        @isset($data['item'])
                                                            @php
                                                                $total = 0;
                                                            @endphp
                                                            @foreach($data['item']['details'] as $key => $details)
                                                                @php
                                                                    $unit_type = App\Models\Unit::find($details['sub_unit_id'])->unit_type;
                                                                    $units = App\Models\Unit::where('unit_type',$unit_type)->get()->toArray();
                                                                @endphp
                                                                <tr>
                                                                    <td class="serial">{{ $loop->iteration }}</td>
                                                                    <td class="text-left"><input type="hidden" value="{{ $details['raw_materials']['id'] }}" name="raw_material_id[]">{{ $details['raw_materials']['title'] }}</td>
                                                                    <td><input type="number" value="{{ $details['sub_unit_price'] }}" class="form-control form-control-sm calculate" name="unit_price[]" readonly></td>
                                                                    <td>
                                                                        <select class="form-control form-control-sm sub_unit_id" name="sub_unit_id[]">
                                                                            @foreach($units as $key => $unit)
                                                                                @php
                                                                                    $unit_price = $details['raw_materials']['cost'];
                                                                                    if ($details['raw_materials']['unit_id'] != $unit['id']) {
                                                                                        if (in_array($details['sub_unit_id'],[1, 3])){
                                                                                            $unit_price *= 1000;
                                                                                        }
                                                                                        if (in_array($details['sub_unit_id'],[2, 4])){
                                                                                            $unit_price /= 1000;
                                                                                        }
                                                                                    }
                                                                                @endphp
                                                                                <option value="{{ $unit['id'] }}" @selected($unit['id'] == $details['sub_unit_id']) unit_price="{{ $unit_price }}">{{ $unit['title'] }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                    <td><input step="0.01" type="number" value="{{ $details['sub_quantity'] }}" class="form-control form-control-sm calculate" name="sub_quantity[]"></td>
                                                                    <td><input type="number" value="{{ $details['cost'] }}" class="form-control form-control-sm" name="sub_total[]" readonly></td>
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
                                            <label>Total Cost</label>
                                            <input
                                                value="{{ isset($data['item']) ? $data['item']['total_cost'] : null }}"
                                                type="number" class="form-control" name="total_cost" id="total_cost"
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
            $('#raw_material_id_temp').on('change', async function() {
                let selected = $('#raw_material_id_temp option:selected');
                let raw_material_id_temp = selected.val();
                let item_title = selected.attr('item-title');
                let item_price = parseFloat(selected.attr('item-price'));
                let unit_type = selected.attr('unit_type');
                let unit_id = selected.attr('unit_id');
                let quantity = 1;
                let total_temp = item_price * quantity;

                let res = await nsAjaxGet('{{ route('recipes.load-units', ':any') }}'.replace(":any",
                    unit_type));

                let options = res.map(element => {
                    let sub_unit_price = unitConverter({
                        main_unit_id: unit_id,
                        main_unit_price: item_price,
                        sub_unit_id: element.id
                    });
                    return `<option value="${element.id}" unit_price="${sub_unit_price}">${element.title}</option>`;
                }).join('');

                let row = `
                    <tr>
                        <td class="serial"></td>
                        <td class="text-left"><input type="hidden" value="${raw_material_id_temp}" name="raw_material_id[]">${item_title}</td>
                        <td><input type="number" value="${item_price}" class="form-control form-control-sm calculate" name="unit_price[]" readonly></td>
                        <td><select class="form-control form-control-sm sub_unit_id" name="sub_unit_id[]">${options}</select></td>
                        <td><input type="number" value="${quantity}" class="form-control form-control-sm calculate" name="sub_quantity[]" required></td>
                        <td><input step="0.01" type="number" value="${total_temp}" class="form-control form-control-sm" name="sub_total[]"readonly></td>
                        <td><button class="btn btn-sm btn-danger btn-del" type="button"><i class="fa-solid fa-trash btn-del"></i></button></td>
                    </tr>
                `;

                $('#tbody').append(row);
                updateSerialNumbers();
                calculateTotal();
            });

            // Attach event handlers to dynamically added elements using event delegation
            $('#table').on('input', '.calculate', function() {
                calculateTotal();
            });

            $('#tbody').on('change', '.sub_unit_id', function() {
                calculateTotal();
            });

            $('#tbody').on('click', '.btn-del', function() {
                $(this).closest('tr').remove();
                updateSerialNumbers();
                calculateTotal();
            });

            $('#form-submit').submit(function(e) {
                if (!$('input[name="raw_material_id[]"]').length) {
                    e.preventDefault();
                    Swal.fire("Please Insert Item!");
                }
            });

            function calculateTotal() {
                let total_cost = 0;

                $('input[name="raw_material_id[]"]').each(function(index) {
                    let unit_price = parseFloat($('select[name="sub_unit_id[]"]').eq(index).find('option:selected').attr('unit_price'));

                    console.log(unit_price);

                    let quantity = parseFloat($('input[name="sub_quantity[]"]').eq(index).val());
                    let subtotal = unit_price * quantity;

                    $('input[name="unit_price[]"]').eq(index).val(unit_price);
                    $('input[name="sub_total[]"]').eq(index).val(subtotal);

                    total_cost += subtotal;
                });

                $('#total_cost').val(total_cost.toFixed(2));
            }

            function updateSerialNumbers() {
                $('.serial').each(function(index) {
                    $(this).text(index + 1);
                });
            }

            function unitConverter({
                main_unit_id,
                main_unit_price,
                sub_unit_id
            }) {
                let sub_unit_price = main_unit_price;
                if (main_unit_id != sub_unit_id) {
                    if ([1, 3].includes(sub_unit_id)) sub_unit_price *= 1000;
                    if ([2, 4].includes(sub_unit_id)) sub_unit_price /= 1000;
                }
                return sub_unit_price;
            }
        });
    </script>
@endsection
