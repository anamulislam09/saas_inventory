@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Sales</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Sales</li>
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
                            <form id="form-submit" action="{{ route('sales.store') }}" method="POST"
                                enctype="multipart/form-data">
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
                                                            <th>Vendor</th>
                                                            <th>Item</th>
                                                            <th>Sales Price</th>
                                                            <th>Quantity</th>
                                                            <th>Sub Total</th>
                                                            <th width="5%">Action</th>
                                                        </tr>
                                                        <tr class="p-0 m-0">
                                                            <th>#</th>
                                                            <th>
                                                                <select class="form-control form-control-sm"
                                                                    id="vendor_id" name="vendor_id">
                                                                    <option value="" selected>Select Vendor</option>
                                                                    @foreach ($data['vendors'] as $key => $vendor)
                                                                        <option value="{{ $vendor->id }}" vendor-name="{{ $vendor->name }}">
                                                                            {{ $vendor->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </th>
                                                            <th>
                                                                <select class="form-control form-control-sm"
                                                                    id="item_id_temp">
                                                                    <option value="" selected>Select Product</option>
                                                                    @foreach ($data['items'] as $key => $item)
                                                                        @php
                                                                            $qty = App\Models\Stock::where(
                                                                                'product_id',
                                                                                $item->id,
                                                                            )->first();
                                                                        @endphp
                                                                        <option value="{{ $item->id }}"
                                                                            @if ($qty->stock_quantity < 1) disabled style="color: #fb5200;" @endif
                                                                            item-title="{{ $item->product_name }} ({{ $item->unit->title }})"
                                                                            item-price="{{ $item->price }}">
                                                                            {{ $item->product_name }}
                                                                            ({{ $item->unit->title }})
                                                                            ({{ $qty->stock_quantity }})
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
                                        <div class="form-group col-sm-4 col-md-3 col-lg-3">
                                            <label>Selling Amount</label>
                                            {{-- <input name="date" id="date" type="date"
                                                value="{{ isset($data['purchase']) ? $data['purchase']->note : date('Y-m-d') }}"
                                                class="form-control" required> --}}
                                            <input type="number" name="sales_price" id="totol" class="form-control"
                                                placeholder="0.00" readonly>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-3 col-lg-3">
                                            <label>Discount method</label>
                                            <select name="discount_method" class="form-control" id="discount_method">
                                                <option value="1" selected>In Percentage</option>
                                                <option value="2">Solid Amount</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-3 col-lg-3">
                                            <label>Discount Rate</label>
                                            <input value="0.00" step="0.01" type="number" class="form-control"
                                                name="discount_rate" id="discount_rate" placeholder="0.00">
                                        </div>
                                        <div class="form-group col-sm-4 col-md-3 col-lg-3">
                                            <label>Dicount Amount</label>
                                            <input readonly type="number" class="form-control" name="discount_amount"
                                                id="discount_amount" placeholder="0.00">
                                        </div>
                                        {{-- <div class="form-group col-sm-4 col-md-3 col-lg-3">
                                            <label>Vat</label>
                                            <input readonly value="0.00" type="number" class="form-control"
                                                name="tax_amount" id="tax_amount" placeholder="0.00">
                                        </div> --}}
                                        <div class="form-group col-sm-4 col-md-3 col-lg-3">
                                            <label>Total Payable</label>
                                            <input readonly type="number" class="form-control" name="total_payable"
                                                id="total_payable" placeholder="0.00">
                                        </div>
                                        <div class="form-group col-sm-4 col-md-3 col-lg-3">
                                            <label>Payment Methods *</label>
                                            <select name="payment_method_id" id="payment_method_id" class="form-control">
                                                @foreach ($data['paymentMethods'] as $pm)
                                                    <option @selected($pm->is_default) value="{{ $pm->id }}">
                                                        {{ $pm->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-3 col-lg-3">
                                            <label>Paid Amount</label>
                                            <input value="0.00" step="0.01" type="number" class="form-control"
                                                name="paid_amount" id="paid_amount" placeholder="0.00">
                                        </div>
                                        {{-- <div class="form-group col-sm-4 col-md-3 col-lg-3">
                                            <label>Total</label>
                                            <input
                                                value=""
                                                class="form-control" type="text" name="total" id="totol"
                                                placeholder="0.00" readonly>
                                        </div> --}}
                                        <div class="form-group col-sm-4 col-md-3 col-lg-3">
                                            <label>Note</label>
                                            <input value="" class="form-control" type="text" name="note"
                                                id="note" placeholder="Note">
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
    // Function to calculate the total, discount, and payable amount
    function calculate(isDefaultRecipientAmt) {
        $('#total_temp').val($('#quantity_temp').val() * $('#unit_price_temp').val());

        let total = 0;
        $('input[name="sub_total[]"]').each(function() {
            total += parseFloat($(this).val());
        });

        $('#totol').val(total);
        calculateDiscount(total);
    }

    // Function to calculate discount and total payable
    function calculateDiscount(total) {
        let discountMethod = $('#discount_method').val();
        let discountRate = parseFloat($('#discount_rate').val());
        let discountAmount = 0;

        if (discountMethod == '1') { // Percentage discount
            discountAmount = (total * discountRate) / 100;
        } else if (discountMethod == '2') { // Solid amount discount
            discountAmount = discountRate;
        }

        $('#discount_amount').val(discountAmount.toFixed(2));
        let totalPayable = total - discountAmount;
        $('#total_payable').val(totalPayable.toFixed(2));
    }

    // Event binding for item selection
    $('#item_id_temp').on('change', function(e) {
        $('#unit_price_temp').val($('#item_id_temp option:selected').attr('item-price'));
        $('#quantity_temp').val(1);
        calculate(true);
    });

    // Event binding for table inputs
    $('#expanse-table').bind('keyup, input', function(e) {
        if ($(e.target).is('.calculate')) {
            calculate(true);
        }
    });

    // Event binding for delete button
    $('#table-data').bind('click', function(e) {
        if ($(e.target).is('.btn-del')) {
            e.target.closest('tr').remove();
            $(".serial").each(function(index) {
                $(this).html(index + 1);
            });
            calculate(true);
        }
    });

    // Event binding for adding new item
    $('#btn-add').click(function() {
        let vendor_id = $('#vendor_id').val();
        let vendor_name = $('#vendor_id option:selected').attr('vendor-name');
        let item_id = $('#item_id_temp').val();
        let item_title = $('#item_id_temp option:selected').attr('item-title');
        let item_price = $('#item_id_temp option:selected').attr('item-price');
        let unit_price_temp = $('#unit_price_temp').val();
        let quantity_temp = $('#quantity_temp').val();
        let total_temp = $('#total_temp').val();

        if (!(item_id && unit_price_temp && quantity_temp && total_temp)) {
            return alert("Please fill up required fields!");
        }

        let td = `<tr>
            <td class="serial"></td>
            <td><input type="hidden" value="${vendor_id}" name="vendor_id[]">${vendor_name}</td>
            <td><input type="hidden" value="${item_id}" name="item_id[]">${item_title}</td>
            <td><input type="number" value="${unit_price_temp}" class="form-control form-control-sm calculate" name="unit_price[]" placeholder="0.00" required></td>
            <td><input type="number" value="${quantity_temp}" class="form-control form-control-sm calculate" name="quantity[]" placeholder="0.00" required></td>
            <td><input type="number" value="${total_temp}" class="form-control form-control-sm" name="sub_total[]" placeholder="0.00" disabled></td>
            <td><button class="btn btn-sm btn-danger btn-del" type="button"><i class="fa-solid fa-trash btn-del"></i></button></td>
        </tr>`;

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

    // Event binding for form submission
    $('#form-submit').submit(function(e) {
        if (!$('input[name="item_id[]"]').length) {
            e.preventDefault();
            alert('Please Select Item!');
        }
    });

    // Event binding for discount calculation
    $('#discount_rate, #discount_method').on('change keyup', function() {
        calculateDiscount(parseFloat($('#totol').val()));
    });
});

    </script>
@endsection
