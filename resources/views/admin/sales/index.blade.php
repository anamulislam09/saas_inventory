@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.admin.flash-message')
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
                    <section class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-primary p-1">
                                <h3 class="card-title">
                                    <a href="{{ route('sales.create') }}"class="btn btn-light shadow rounded m-0"><i
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
                                                    <th>Invoice No</th>
                                                    <th>Date</th>
                                                    <th>Sales Amount</th>
                                                    <th>Discount</th>
                                                    <th>VAt Tax</th>
                                                    <th>Total Amount</th>
                                                    <th>Collection</th>
                                                    <th>Due</th>
                                                    <th>Note</th>
                                                    <th>Created By</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data['sales'] as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td><a target="_blank" href="{{ route('sales.invoice',[$item->id]) }}"><b>{{ $item->invoice_no }}</b></a></td>
                                                        <td>{{ $item->date }}</td>
                                                        <td>{{ $item->sales_price }}</td>
                                                        <td>{{ $item->discount }}</td>
                                                        <td>{{ $item->vat_tax }}</td>
                                                        <td>{{ $item->receiveable_amount }}</td>
                                                        <td>{{ $item->receive_amount }}</td>
                                                        <td>{{ $item->receiveable_amount -$item->receive_amount }}</td>
                                                        <td>{{ $item->note }}</td>
                                                        <td>{{ $item->created_by->name }}</td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <a target="_blank" href="{{ route('sales.invoice.print', [$item->id,'print']) }}" class="btn btn-sm btn-dark ml-1">
                                                                    <i class="fa fa-print"></i>
                                                                </a>
                                                                <a target="_blank" href="{{ route('sales.invoice', [$item->id]) }}" class="btn btn-sm btn-info ml-1">
                                                                    <i class="fa-solid fa-eye"></i>
                                                                </a>
                                                                <div class="btn-group ml-1">
                                                                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                        More
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                        <button due="{{ $item->receiveable_amount -$item->receive_amount }}" sales-id="{{ $item->id }}" type="button" class="btn btn-success btn-sm pay-now dropdown-item"
                                                                            data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Add Collection</button>
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
        </section>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Payment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form-submit" action="{{ route('sales.collection.store') }}" method="POST"
                        enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf()
                            <div class="row">
                                <input type="hidden" name="purchase_id" id="purchase_id">
                                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                    <label>Payment Date *</label>
                                    <input value="{{ date('Y-m-d') }}" type="date" class="form-control" name="date" id="date" placeholder="0.00">
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                    <label>Payment Methods *</label>
                                    <select name="payment_method_id" id="payment_method_id" class="form-control" required>
                                        <option value='' selected>Select Payment Method</option>
                                        @foreach ($data['paymentMethods'] as $pm)
                                            <option @selected($pm->is_default) value="{{ $pm->id }}">{{ $pm->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                    <label>Due Amount</label>
                                    <input readonly value="0.00" type="number" class="form-control" name="due_amount" id="due_amount" placeholder="0.00">
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                    <label>Paid Amount</label>
                                    <input value="0.00" type="number" class="form-control" name="amount" id="amount" placeholder="0.00">
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                    <label>Note</label>
                                    <input type="text" class="form-control" name="note" id="note" placeholder="Note">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="cancel" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button id="save_payment" type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
                if(paid_amount>due){
                    e.preventDefault();
                    Swal.fire("Couldn't be pay more then payable!");
                }
            });
        });
    </script>
@endsection
