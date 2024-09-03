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
                        <h1 class="m-0">Purchase Return</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Purchase-return</li>
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
                            <form action="{{ route('purchase-return.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="purchase_id" value="{{ $data['purchase']->id }}">

                                <div class="form-group">
                                    <label for="date">Return Date:</label>
                                    <input type="date" class="form-control" name="date" id="date"
                                        value="{{ date('Y-m-d') }}" required>
                                </div>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Purchased Quantity</th>
                                            <th>Return Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Total Return Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['purchase']->purchase_details as $detail)
                                            @php
                                                $product_name = App\Models\Product::where(
                                                    'id',
                                                    $detail->product_id,
                                                )->value('product_name');
                                            @endphp
                                            <tr>
                                                <td>{{ $product_name }}</td>
                                                <td>
                                                    <input type="number" class="form-control" name="original_quantity[]"
                                                        id="original_quantity" value="{{ $detail->quantity }}" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control return-quantity"
                                                        name="return_quantity[]" value="0" min="0"
                                                        max="{{ $detail->quantity }}"
                                                        data-unit-price="{{ $detail->unit_price }}">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="unit_price[]"
                                                        value="{{ $detail->unit_price }}" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control return-total"
                                                        name="return_total[]" value="0" readonly>
                                                </td>
                                                <input type="hidden" name="product_id[]" value="{{ $detail->product_id }}">
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="total_return_amount">Total Return Amount:</label>
                                            <input type="number" class="form-control" name="total_return_amount"
                                                id="total_return_amount" value="0" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="refund_amount">Refund Amount:</label>
                                            <input type="number" class="form-control" name="refund_amount"
                                                id="refund_amount" value="0">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="note">Note:</label>
                                            <input type="text" class="form-control" name="note" id="note"
                                                placeholder="Write some nots">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group my-4 ml-4">
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
            $('.return-quantity').on('input', function() {
                let returnQty = $(this).val();
                let original_quantity = $(this).closest('tr').find('input[name="original_quantity[]"]')
                    .val();

                if (parseFloat(returnQty) > parseFloat(original_quantity)) {
                    alert('OH! The return quantity must be less than or equal to the original quantity.');
                    $(this).val(original_quantity);
                    returnQty = original_quantity;
                }

                let unitPrice = $(this).data('unit-price');
                let returnTotal = returnQty * unitPrice;
                $(this).closest('tr').find('.return-total').val(returnTotal);

                calculateTotalReturnAmount();
            });

            // Filter out rows with return_quantity = 0 before submitting the form
            $('form').on('submit', function(e) {
                $('input[name="return_quantity[]"]').each(function() {
                    if ($(this).val() == 0) {
                        // If the return quantity is 0, remove the corresponding row's input fields
                        $(this).closest('tr').find('input').attr('disabled', true);
                    }
                });
            });

            function calculateTotalReturnAmount() {
                let totalReturnAmount = 0;
                $('.return-total').each(function() {
                    totalReturnAmount += parseFloat($(this).val()) || 0;
                });
                $('#total_return_amount').val(totalReturnAmount);
            }
        });
    </script>
@endsection
