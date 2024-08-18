@extends('layouts.admin.master')
@section('content')
    <style>
        .ul-scrollable {
            width: 100%;
            overflow: hidden;
            overflow-y: scroll;
        }
    </style>
    <div class="content-wrapper">
        <div class="content-header  mb-0">
            @include('layouts.admin.flash-message')
            <div class="container-fluid mb-0">
                <div class="card card-primary bg-secondary p-2  mb-0">
                    <div class="row  mb-0">
                        <div class="col-sm-12 col-md-12 col-lg-12 mb-0">
                            <div class="bootstrap-data-table-panel">
                                <div class="table-responsive">
                                    <table @style('width: 100%;') class="table table-sm table-bordered mb-0">
                                        <tbody>
                                            <tr>
                                                <th style="widht:1%; text-align: center;">Total Collection :
                                                    {{ $data['currency_symbol'] }} {{ $data['total_collection'] }}</th>
                                                <th style="widht:1%; text-align: center;">My Collection :
                                                    {{ $data['currency_symbol'] }} {{ $data['my_collection'] }}</th>
                                                <th style="widht:1%; text-align: center;">Pending Collection :
                                                    {{ $data['currency_symbol'] }} {{ $data['pending_collection'] }}</th>
                                                <th style="widht:1%; text-align: center;">Pending Orders :
                                                    {{ $data['pending_orders'] }}</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    @foreach ($data['orders']->items() as $order)
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="small-box bg-dark">
                                <div class="inner">
                                    <h5>{{ $order->table->title }} ({{ $order->orderCreatedBy->name }})</h5>
                                    <p>Order No - {{ $order->order_no }} <span class="text-warning"><b>Total: {{ $data['currency_symbol'] }} {{ $order->net_bill }}</b></span></p>
                                    <ul class="mt-1 @if (count($order->order_details) > 3) ul-scrollable @endif"
                                        style="list-style-type: none; height: 80px;font-size: 14px;">
                                        @foreach ($order->order_details as $key => $ods)
                                            <li class="mt-1">
                                                @if($ods->item->image)
                                                    <img src="{{ asset('public/uploads/items/' . $ods->item->image) }}" height="30px" width="30px">
                                                @endif
                                                {{ $ods->item->title }} {{ $ods->quantity }} x {{ $ods->unit_price }} = {{ $data['currency_symbol'] }} {{ $subTotal = $ods->quantity * $ods->unit_price }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="row m-0 p-0">
                                    <div class="col-12 mb-1">
                                        <div class="d-flex justify-content-center m-0 p-0">
                                            <button type="button" class="btn btn-success btn-sm pay-now" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"
                                                total="{{ $order->mrp }}"
                                                order-id="{{ $order->id }}"
                                                vat="{{ $order->vat }}"
                                                >Pay Now</button>
                                            <form class="cancel-form" action="{{ route('collections.orders.cancel') }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $order->id }}">
                                                <input type="hidden" name="order_status" value="2">
                                                <button class="btn btn-sm btn-danger p-1 ml-4" type="submit">Cancel Order</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="icon">
                                    <i class="fa-solid fa-burger"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Collection</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="payment-form" action="{{ route('collections.store') }}" method="POST"
                            enctype="multipart/form-data">
                            <div class="modal-body">
                                @csrf()
                                <div class="row">
                                    <input type="hidden" name="order_id" id="order_id">
                                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                        <label>Payment Methods *</label>
                                        <select name="payment_method_id" id="payment_method_id" class="form-control"
                                            required>
                                            <option value='' selected>Select Payment Method</option>
                                            @foreach ($data['paymentMethods'] as $pm)
                                                <option @selected($pm->is_default) value="{{ $pm->id }}">{{ $pm->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                        <label>Discount Rate</label>
                                        <input value="0.00" step="0.01" type="number" class="form-control" name="discount_rate" id="discount_rate" placeholder="0.00">
                                    </div>
                                    <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                        <label>Discount Method</label>
                                        <select name="discount_method" id="discount_method" class="form-control">
                                            <option value="1" selected>In Percentage</option>
                                            <option value="2">Solid Amount</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                        <label>Recipient Amount</label>
                                        <input step="0.01" value="0.00" type="number" class="form-control" name="recipient_amount"
                                            id="recipient_amount" placeholder="0.00">
                                    </div>
                                    <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                        <label>Sub Total</label>
                                        <input readonly type="number" class="form-control" name="sub_total"
                                            id="sub_total" placeholder="0.00">
                                    </div>
                                    <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                        <label>Dicount Amount</label>
                                        <input readonly type="number" class="form-control" name="discount_amount"
                                            id="discount_amount" placeholder="0.00">
                                    </div>
                                    <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                        <label>Vat Amount</label>
                                        <input readonly value="0.00" type="number" class="form-control"
                                            name="vat" id="vat" placeholder="0.00">
                                    </div>
                                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                        <label>Total Payable</label>
                                        <input readonly type="number" class="form-control" name="total_payable"
                                            id="total_payable" placeholder="0.00">
                                    </div>
                                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                        <label>Balance</label>
                                        <input readonly type="number" class="form-control" name="balance"
                                            id="balance" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="cancel" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button id="save_payment" type="submit" class="btn btn-primary">Save Collection</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <section class="content">
        <audio id="myAudio">
            <source src="{{ asset('public/uploads/audio/alert.wav') }}" type="audio/ogg">
            <source src="{{ asset('public/uploads/audio/alert.wav') }}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>

    </section>
    <div style="width: 100%">
        <div class="d-flex justify-content-end">
            {!! $data['orders']->onEachSide(1)->links() !!}
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            checNewCollection();
            setInterval(()=>{checNewCollection();},5000);
            $('.pay-now').on('click', function(e) {
                let order_id = $(this).attr('order-id');
                let total = parseFloat($(this).attr('total')) || 0;
                let vat = parseFloat($(this).attr('vat')) || 0;
                let recipient_amount = parseFloat(total + vat) || 0;
                $('#sub_total').val(total.toFixed(2));
                $('#vat').val(vat.toFixed(2));
                $('#order_id').val(order_id);
                $('#recipient_amount').val(recipient_amount.toFixed(2));
                calculate();
            });
            $('#discount_rate, #recipient_amount').on('keyup', function(e) {
                calculate();
            });
            $('#discount_method').on('change', function(e) {
                calculate();
            });
            $('.cancel-form').click(function(e) {
                e.preventDefault();
                let element = $(this);
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "No",
                    confirmButtonText: "Yes, Cancel it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        element.submit();
                    }
                })
            });
        });
        function calculate() {
            let discount_method = $('#discount_method').val();
            let sub_total = parseFloat($('#sub_total').val());
            let discount_rate = parseFloat($('#discount_rate').val()) || 0;
            let vat = parseFloat($('#vat').val());
            let recipient_amount = parseFloat($('#recipient_amount').val()) || 0;
            let discount_amount = discount_rate;
            if (discount_method == 1) discount_amount = sub_total * (discount_rate / 100);

            let total_payable = sub_total + vat - discount_amount;
            let balance = (recipient_amount) - (sub_total + vat - discount_amount);

            $('#balance').val(balance.toFixed(2));
            $('#discount_amount').val(discount_amount.toFixed(2));
            $('#total_payable').val(total_payable.toFixed(2));
        }
        function clear() {
            $('#discount_method').val('1');
            $('#sub_total').val('0.00');
            $('#discount_rate').val('0.00');
            $('#vat').val('0.00');
            $('#recipient_amount').val('0.00');
            $('#balance').val('0.00');
            $('#discount_amount').val('0.00');
            $('#total_payable').val('0.00');
        }
        async function checNewCollection() {
            res = await nsAjaxGet("{{ route('collections.check-new-collections') }}");
            if(res){
                document.getElementById("myAudio").play();
                setInterval(()=>{location.reload()},3000);
            }
        }
    </script>
@endsection
