@extends('layouts.admin.master')
@section('content')
    @inject('authorization', 'App\Services\AuthorizationService')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.admin.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Purchases</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Purchases</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <section class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-primary p-1">
                                <h3 class="card-title">
                                    @if (
                                        $authorization->hasMenuAccess(42) ||
                                            (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                        <a href="{{ route('purchases.create') }}"class="btn btn-light shadow rounded m-0"><i
                                                class="fas fa-plus"></i>
                                            <span>Add New</span></i></a>
                                    @else
                                        <span class="btn btn-light shadow rounded m-0">Purchases</span>
                                    @endif
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-striped table-bordered table-centre">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Vouchar No</th>
                                                    <th>Supplier</th>
                                                    <th>Date</th>
                                                    <th>Vat/Tax</th>
                                                    <th>Discount</th>
                                                    <th>Payable</th>
                                                    <th>Paid|Due</th>
                                                    <th>Payment Status</th>
                                                    <th>Note</th>
                                                    <th>Created By</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data['purchases'] as $purchase)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td><a target="_blank"
                                                                href="{{ route('purchases.vouchar', [$purchase->id]) }}"><b>{{ $purchase->vouchar_no }}</b></a>
                                                        </td>
                                                        <td>{{ $purchase->supplier->name }}</td>
                                                        <td>{{ $purchase->date }}</td>
                                                        <td>{{ $data['currency_symbol'] }} {{ $purchase->vat_tax }}</td>
                                                        <td>{{ $data['currency_symbol'] }} {{ $purchase->discount }}</td>
                                                        <td>{{ $data['currency_symbol'] }} {{ $purchase->total_payable }}
                                                        </td>
                                                        <td style="text-align: center;">
                                                            {{ $data['currency_symbol'] }}
                                                            {{ $purchase->paid_amount }}<br>
                                                            <strong>{{ $data['currency_symbol'] }}
                                                                {{ $purchase->total_payable - $purchase->paid_amount }}</strong>
                                                        </td>
                                                        <td><span
                                                                class="badge badge-{{ $purchase->payment_status == 1 ? 'success' : 'danger' }}">{{ $purchase->payment_status == 1 ? 'Paid' : 'Due' }}</span>
                                                        </td>
                                                        <td>{{ $purchase->note }}</td>
                                                        <td>{{ $purchase->created_by->name }}</td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                @if (
                                                                    $authorization->hasMenuAccess(45) ||
                                                                        (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                                                    <a target="_blank"
                                                                        href="{{ route('purchases.vouchar.print', [$purchase->id, 'print']) }}"
                                                                        class="btn btn-sm btn-dark ml-1">
                                                                        <i class="fa fa-print"></i>
                                                                    </a>
                                                                @endif
                                                                <a target="_blank"
                                                                    href="{{ route('purchases.vouchar', [$purchase->id]) }}"
                                                                    class="btn btn-sm btn-info ml-1">
                                                                    <i class="fa-solid fa-eye"></i>
                                                                </a>
                                                                <div class="btn-group ml-1">
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-success dropdown-toggle"
                                                                        data-toggle="dropdown" aria-expanded="false">
                                                                        More
                                                                    </button>
                                                                    <div class="dropdown-menu m-auto">
                                                                        @if (
                                                                            $authorization->hasMenuAccess(46) ||
                                                                                (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                                                            <button
                                                                                due="{{ $purchase->total_payable - $purchase->paid_amount }}"
                                                                                purchase-id="{{ $purchase->id }}"
                                                                                type="button"
                                                                                class="btn btn-success btn-sm pay-now dropdown-item"
                                                                                data-toggle="modal"
                                                                                data-target="#exampleModal"
                                                                                data-whatever="@getbootstrap">Add
                                                                                Payments</button>
                                                                        @endif
                                                                        @if (
                                                                            $authorization->hasMenuAccess(43) ||
                                                                                (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                                                            <a href="{{ route('purchase-return.create', $purchase->id) }}"
                                                                                class="text-center dropdown-item"
                                                                                style="border-top: 1px solid #ddd">Return</a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Payment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="form-submit" action="{{ route('purchases.payment.store') }}" method="POST"
                            enctype="multipart/form-data">
                            <div class="modal-body">
                                @csrf()
                                <div class="row">
                                    <input type="hidden" name="purchase_id" id="purchase_id">
                                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                        <label>Payment Date *</label>
                                        <input value="{{ date('Y-m-d') }}" type="date" class="form-control"
                                            name="date" id="date" placeholder="0.00">
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                        <label>Payment Methods *</label>
                                        <select name="payment_method_id" id="payment_method_id" class="form-control"
                                            required>
                                            @foreach ($data['paymentMethods'] as $pm)
                                                <option @selected($pm->is_default) value="{{ $pm->id }}">
                                                    {{ $pm->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                        <label>Due Amount</label>
                                        <input readonly value="0.00" type="number" class="form-control" name="due_amount"
                                            id="due_amount" placeholder="0.00">
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                        <label>Paid Amount</label>
                                        <input value="0.00" type="number" class="form-control" name="amount"
                                            id="amount" placeholder="0.00">
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                        <label>Note</label>
                                        <input type="text" class="form-control" name="note" id="note"
                                            placeholder="Note">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="cancel" type="button" class="btn btn-secondary"
                                    data-dismiss="modal">Cancel</button>
                                <button id="save_payment" type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.pay-now').on('click', function(e) {
                $('#purchase_id').val($(this).attr('purchase-id'));
                $('#amount').val(parseFloat($(this).attr('due')).toFixed(2));
                $('#due_amount').val(parseFloat($(this).attr('due')).toFixed(2));
            });
            $('#form-submit').submit(function(e) {
                let paid_amount = parseFloat($('#amount').val());
                let due = parseFloat($('#due_amount').val());
                if (paid_amount > due) {
                    e.preventDefault();
                    Swal.fire("Couldn't be pay more then payable!");
                }
            });
        });
    </script>
@endsection
