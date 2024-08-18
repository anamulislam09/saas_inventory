@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.admin.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Payments</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Payments</li>
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
                                    <a href="{{ route('payments.create') }}"class="btn btn-light shadow rounded m-0"><i
                                            class="fas fa-plus"></i>
                                        <span>Add New</span></i></a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-striped table-bordered table-centre">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Supplier Name</th>
                                                    <th>Date</th>
                                                    <th>Amount</th>
                                                    <th>Vouchar No</th>
                                                    <th>Payment Method</th>
                                                    <th>Note</th>
                                                    <th>Created By</th>
                                                    {{-- <th>Action</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data['payments'] as $payment)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $payment->supplier->name }}</td>
                                                        <td>{{ $payment->date }}</td>
                                                        <td>{{ $data['currency_symbol'] }} {{ $payment->amount }}</td>
                                                        <td>@isset($payment->purchase)<a href="{{ route('purchases.vouchar',[$payment->purchase->id]) }}"><b>{{ $payment->purchase->vouchar_no }}</b></a>@endisset</td>
                                                        
                                                        <td>{{ $payment->payment_method->title }}</td>
                                                        <td>{{ $payment->note }}</td>
                                                        <td>{{ $payment->created_by->name }}</td>
                                                        {{-- <td></td> --}}
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Supplier Name</th>
                                                    <th>Date</th>
                                                    <th>Amount</th>
                                                    <th>Vouchar No</th>
                                                    <th>Payment Method</th>
                                                    <th>Note</th>
                                                    <th>Created By</th>
                                                    {{-- <th>Action</th> --}}
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
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
            });
        });
    </script>
@endsection
