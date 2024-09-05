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
                            <h3 class="card-title">{{ $data['title'] }}</h3>
                        </div>
                        <form id="form-submit" action="{{ route('sales.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf()
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                        <div class="table-responsive">
                                            <table id="expanse-table" class="table table-striped table-bordered table-centre p-0 m-0">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">SN</th>
                                                        <th>Customer</th>
                                                        <th>Item</th>
                                                        <th>Sales Price</th>
                                                        <th>Quantity</th>
                                                        <th>Sub Total</th>
                                                        <th width="5%">Action</th>
                                                    </tr>
                                                    <tr class="p-0 m-0">
                                                        <th>#</th>
                                                        <th>
                                                            <select class="form-control form-control-sm select2" id="vendor_id" name="vendor_id">
                                                                <option value="" selected>Select Customer</option>
                                                                @foreach ($data['vendors'] as $key => $vendor)
                                                                    <option value="{{ $vendor->id }}" vendor-name="{{ $vendor->name }}">{{ $vendor->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </th>
                                                        <th>
                                                            <select class="form-control form-control-sm select2" id="item_id_temp">
                                                                <option value="" selected>Select Product</option>
                                                                @foreach ($data['items'] as $key => $item)
                                                                    @php
                                                                        $qty = App\Models\Stock::where('product_id', $item->id)->first();
                                                                    @endphp
                                                                    <option value="{{ $item->id }}" @if ($qty->stock_quantity < 1) disabled style="color: #fb5200;" @endif
                                                                        item-title="{{ $item->product_name }} ({{ $item->unit->title }})"
                                                                        item-price="{{ $item->price }}">
                                                                        {{ $item->product_name }} ({{ $item->unit->title }}) ({{ $qty->stock_quantity }})
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </th>
                                                        <th><input placeholder="0.00" type="number" class="form-control form-control-sm calculate" id="unit_price_temp"></th>
                                                        <th><input placeholder="0.00" type="number" class="form-control form-control-sm calculate" id="quantity_temp"></th>
                                                        <th><input placeholder="0.00" type="number" class="form-control form-control-sm" id="total_temp" disabled></th>
                                                        <th><button id="btn-add" class="btn btn-sm btn-primary" type="button"><i class="fa-sharp fa-solid fa-plus"></i></button></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-data">
                                                    <!-- Existing rows if any -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Calculations -->
                                    <div class="form-group col-sm-4 col-md-3 col-lg-3">
                                        <label>Selling Amount</label>
                                        <input type="number" name="sales_price" id="totol" class="form-control" placeholder="0.00" readonly>
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
                                        <input value="0.00" step="0.01" type="number" class="form-control" name="discount_rate" id="discount_rate" placeholder="0.00">
                                    </div>
                                    <div class="form-group col-sm-4 col-md-3 col-lg-3">
                                        <label>Discount Amount</label>
                                        <input readonly type="number" class="form-control" name="discount_amount" id="discount_amount" placeholder="0.00">
                                    </div>
                                    <div class="form-group col-sm-4 col-md-3 col-lg-3">
                                        <label>Total Receivable</label>
                                        <input readonly type="number" class="form-control" name="total_payable" id="total_payable" placeholder="0.00">
                                    </div>
                                    <div class="form-group col-sm-4 col-md-3 col-lg-3">
                                        <label>Payment Methods *</label>
                                        <select name="payment_method_id" id="payment_method_id" class="form-control">
                                            @foreach ($data['paymentMethods'] as $pm)
                                                <option @selected($pm->is_default) value="{{ $pm->id }}">{{ $pm->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4 col-md-3 col-lg-3">
                                        <label>Receive Amount</label>
                                        <input value="0.00" step="0.01" type="number" class="form-control" name="paid_amount" id="paid_amount" placeholder="0.00">
                                    </div>
                                    <div class="form-group col-sm-4 col-md-3 col-lg-3">
                                        <label>Note</label>
                                        <input value="" class="form-control" type="text" name="note" id="note" placeholder="Note">
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
        // Calculate totals and discounts before clicking "Add"
        function calculateTotal() {
            let unit_price = parseFloat($('#unit_price_temp').val());
            let quantity = parseFloat($('#quantity_temp').val());
            let sub_total = unit_price * quantity;

            if (!isNaN(sub_total)) {
                $('#total_temp').val(sub_total.toFixed(2));
            }
        }

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

        $('#item_id_temp, #unit_price_temp, #quantity_temp').on('input', function() {
            calculateTotal();
        });

        $('#discount_rate, #discount_method').on('input change', function() {
            calculateDiscount(parseFloat($('#totol').val()));
        });

        // Add product to the list
        $('#btn-add').click(function() {
            let item_id = $('#item_id_temp').val();
            let item_title = $('#item_id_temp option:selected').attr('item-title');
            let unit_price_temp = $('#unit_price_temp').val();
            let quantity_temp = $('#quantity_temp').val();
            let total_temp = $('#total_temp').val();

            if (!(item_id && unit_price_temp && quantity_temp)) {
                return alert("Please fill in all the required fields!");
            }

            let row = `
                <tr>
                    <td class="serial"></td>
                    <td><input type="hidden" value="${item_id}" name="item_id[]">${item_title}</td>
                    <td><input type="number" value="${unit_price_temp}" class="form-control form-control-sm calculate" name="unit_price[]" placeholder="0.00" required></td>
                    <td><input type="number" value="${quantity_temp}" class="form-control form-control-sm calculate" name="quantity[]" placeholder="0.00" required></td>
                    <td><input type="number" value="${total_temp}" class="form-control form-control-sm" name="sub_total[]" placeholder="0.00" readonly></td>
                    <td><button class="btn btn-sm btn-danger btn-del" type="button"><i class="fa fa-trash"></i></button></td>
                </tr>
            `;

            $('#table-data').append(row);
            $(".serial").each(function(index) {
                $(this).html(index + 1);
            });

            $('#item_id_temp').val('');
            $('#unit_price_temp').val('');
            $('#quantity_temp').val('');
            $('#total_temp').val('');
        });

        // Remove product from the list
        $('#table-data').on('click', '.btn-del', function() {
            $(this).closest('tr').remove();
            $(".serial").each(function(index) {
                $(this).html(index + 1);
            });
        });
    });
</script>
@endsection
