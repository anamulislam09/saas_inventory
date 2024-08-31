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
                        <h1 class="m-0">Purchase</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Purchase</li>
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
                            <form id="form-submit" action="{{ route('purchases.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf()
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                            <label>Suppliers *</label>
                                            <select name="supplier_id" id="vendor_id" class="form-control" required
                                                @isset($data['purchase']) @disabled(true) @endisset>
                                                <option value="" selected>Select Supplier</option>
                                                @foreach ($data['suppliers'] as $vendor)
                                                    <option
                                                        @isset($data['purchase']) @selected($vendor->id == $data['purchase']->vendor_id) @endisset
                                                        value="{{ $vendor->id }}">
                                                        {{ $vendor->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                            <label>Date *</label>
                                            <input name="date" id="date" type="date"
                                                value="{{ isset($data['purchase']) ? $data['purchase']->date : date('Y-m-d') }}"
                                                class="form-control" required>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                            <label>Product</label>
                                            <select class="form-control normalize" id="product_id">
                                                <option value="" selected>Select Product</option>
                                                @foreach ($data['products'] as $key => $product)
                                                    <option value="{{ $product->id }}" product_name="{{ $product->product_name }}"
                                                        product_price="{{ $product->cost }}"
                                                        unit_name="{{ $product->unit->title }}"
                                                        > {{ $product->product_name }}
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
                                                            <th>Product</th>
                                                            <th>Unit</th>
                                                            <th>Unit Price</th>
                                                            <th>Quantity</th>
                                                            <th>Sub Total</th>
                                                            <th width="5%">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3 col-md-3 col-lg-3">
                                            <label>Discount Method</label>
                                            <select name="discount_method" id="discount_method" class="form-control">
                                                <option value="1" selected>In Percentage</option>
                                                <option value="2">Solid Amount</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-3 col-md-3 col-lg-3">
                                            <label>Discount Rate</label>
                                            <input value="0.00" step="0.01" type="number" class="form-control"
                                                name="discount_rate" id="discount_rate" placeholder="0.00">
                                        </div>
                                        <div class="form-group col-sm-3 col-md-3 col-lg-3">
                                            <label>Dicount Amount</label>
                                            <input readonly type="number" class="form-control" name="discount_amount"
                                                id="discount_amount" placeholder="0.00">
                                        </div>
                                        <div class="form-group col-sm-3 col-md-3 col-lg-3">
                                            <label>Total</label>
                                            <input
                                                value="{{ isset($data['purchase']) ? $data['purchase']->total : null }}"
                                                type="number" class="form-control" name="total" id="total"
                                                placeholder="0.00" readonly>
                                        </div>
                                        <div class="form-group col-sm-3 col-md-3 col-lg-3">
                                            <label>Vat</label>
                                            <input readonly value="0.00" type="number" class="form-control"
                                                name="tax_amount" id="tax_amount" placeholder="0.00">
                                        </div>
                                        <div class="form-group col-sm-3 col-md-3 col-lg-3">
                                            <label>Total Payable</label>
                                            <input readonly type="number" class="form-control"
                                                name="total_payable" id="total_payable" placeholder="0.00">
                                        </div>
                                        <div class="form-group col-sm-3 col-md-3 col-lg-3">
                                            <label>Payment Methods *</label>
                                            <select name="payment_method_id" id="payment_method_id" class="form-control">
                                                <option value='' selected>Select Payment Method</option>
                                                @foreach ($data['paymentMethods'] as $pm)
                                                    <option @selected($pm->is_default)
                                                        value="{{ $pm->id }}">{{ $pm->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-3 col-md-3 col-lg-3">
                                            <label>Paid Amount</label>
                                            <input value="0.00" step="0.01" type="number"
                                                class="form-control" name="paid_amount"
                                                id="paid_amount" placeholder="0.00">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                            <label>Note</label>
                                            <input value="{{ isset($data['purchase']) ? $data['purchase']->note : null }}"
                                                class="form-control" type="text" name="note" id="note"
                                                placeholder="Note">
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

            // $('#vouchar_no').on('input', async function(){
            //     let vouchar_no = $(this).val();
            //     let tbody = ``;
            //     if(vouchar_no){
            //         let amount;
            //         res = await nsAjaxGet('{{ route("purchase-orders.purchase-requisition",":vouchar_no") }}'.replace(":vouchar_no",vouchar_no));
            //         if(Object.keys(res).length){
            //             res.prdetails.forEach((element, index) => {
            //                 amount = parseFloat(element.cost) * parseFloat(element.quantity);
            //                 tbody += `<tr>
            //                             <td class="serial">${index + 1}</td>
            //                             <td class="text-left"><input type="hidden" value="${element.product_id}" name="product_id[]">${element.product.product_name}</td>
            //                             <td>${element.product.unit.title}</td>
            //                             <td><input type="number" value="${element.unit_price}" class="form-control form-control-sm calculate" name="unit_price[]" placeholder="0.00" required></td>
            //                             <td><input type="number" value="${element.quantity}" class="form-control form-control-sm calculate" name="quantity[]" placeholder="0.00" required></td>
            //                             <td><input type="number" value="${element.amount}" class="form-control form-control-sm" name="sub_total[]" placeholder="0.00" disabled></td>
            //                             <td><button class="btn btn-sm btn-danger btn-del" type="button"><i class="fa-solid fa-trash btn-del"></i></button></td>
            //                         </tr>`;
            //             });
            //         }
            //     }
            //     $('#tbody').html(tbody);
            //     calculate(true);
            // });

            $('#product_id').on('change', function(e) {
                let product_id = $('#product_id').val();
                let product_name = $('#product_id option:selected').attr('product_name');
                // alert(product_name);
                let unit_name = $('#product_id option:selected').attr('unit_name');
                let product_price = $('#product_id option:selected').attr('product-price');

                let unit_price_temp = $('#product_id option:selected').attr('product-price');
                let quantity_temp = 1;
                let total_temp = unit_price_temp * quantity_temp;
                let tbody =  ``;

                tbody += `<tr>
                            <td class="serial"></td>
                            <td class="text-left"><input type="hidden" value="${product_id}" name="product_id[]">${product_name}</td>
                            <td>${unit_name}</td>
                            <td><input type="number" value="${unit_price_temp}" class="form-control form-control-sm calculate" name="unit_price[]" placeholder="0.00" required></td>
                            <td><input type="number" value="${quantity_temp}" class="form-control form-control-sm calculate" name="quantity[]" placeholder="0.00" required></td>
                            <td><input type="number" value="${total_temp}" class="form-control form-control-sm" name="sub_total[]" placeholder="0.00" disabled></td>
                            <td><button class="btn btn-sm btn-danger btn-del" type="button"><i class="fa-solid fa-trash btn-del"></i></button></td>
                        </tr>`;

                $('#tbody').append(tbody);
                $(".serial").each(function(index) { $(this).html(index + 1);});
                $('#product_id').val('');
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
            if (!$('input[name="product_id[]"]').length) {
                e.preventDefault();
                Swal.fire("Please Insert product!");
            }
            if(parseFloat($('#paid_amount').val())>parseFloat($('#total_payable').val())){
                e.preventDefault();
                Swal.fire("Couldn't be pay more then payable!");
            }
        });
        $('#discount_rate').on('keyup', function(e) {
            calculate(true);
        });
        $('#paid_amount').on('keyup', function(e) {
            calculate(false);
        });
        $('#discount_method').on('change', function(e) {
            calculate(true);
        });
        function calculate(isDefaultRecipentAmt) {
            let product_id = $('input[name="product_id[]"]');
            let total = 0;
            for (let i = 0; i < product_id.length; i++) {
                $('input[name="sub_total[]"]')[i].value = ($('input[name="unit_price[]"]')[i].value * $(
                    'input[name="quantity[]"]')[i].value);
                total += $('input[name="unit_price[]"]')[i].value * $('input[name="quantity[]"]')[i].value;
            }
            $('#total').val(total.toFixed(2));
            let discount_method = $('#discount_method').val();
            let discount_rate = parseFloat($('#discount_rate').val());
            let tax_amount = parseFloat($('#tax_amount').val());

            let discount_amount = discount_rate;
            if (discount_method == 1) discount_amount = total * (discount_rate / 100);
            let total_payable = total + tax_amount - discount_amount;
            if (isDefaultRecipentAmt) {
                $('#paid_amount').val(total_payable.toFixed(2));
            } else {
                paid_amount = $('#paid_amount').val();
            }
            $('#discount_amount').val(discount_amount.toFixed(2));
            $('#total_payable').val(total_payable.toFixed(2));
        }

    </script>
@endsection
