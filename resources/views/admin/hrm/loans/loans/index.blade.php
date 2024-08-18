@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.admin.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Loan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Loan</li>
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
                                    <a href="{{ route('loans.create') }}"class="btn btn-light shadow rounded m-0"><i
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
                                                    <th>Employee Name</th>
                                                    <th>Load Details</th>
                                                    <th>Application Date</th>
                                                    <th>Approved Date</th>
                                                    <th>Repayment From</th>
                                                    <th>Amount</th>
                                                    <th>Interest Percent</th>
                                                    <th>Installment Period</th>
                                                    <th>Repayment Total</th>
                                                    <th>Installment</th>
                                                    <th>Paid Amount</th>
                                                    <th>Payment Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($data['loans'] as $loan)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $loan->employee->name }}</td>
                                                    <td>{{ $loan->loan_details }}</td>
                                                    <td>{{ $loan->application_date }}</td>
                                                    <td>{{ $loan->approved_date }}</td>
                                                    <td>{{ $loan->repayment_from }}</td>
                                                    <td>{{ $data['currency_symbol'] }} {{ number_format($loan->amount,2) }}</td>
                                                    <td>{{ $loan->interest_percent }} %</td>
                                                    <td>{{ $loan->installment_period }} Months</td>
                                                    <td>{{ $data['currency_symbol'] }} {{ number_format($loan->repayment_total,2) }}</td>
                                                    <td>{{ $data['currency_symbol'] }} {{ number_format($loan->installment,2) }}</td>
                                                    <td>{{ $data['currency_symbol'] }} {{ number_format($loan->paid_amount,2) }}</td>
                                                    <td><span class="badge badge-{{ $loan->payment_status == 1 ? 'success' : 'danger' }}">{{ $loan->payment_status == 1? 'Paid' : 'Pending' }}</span></td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-info @disabled($loan->paid_amount>0)">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </a>
                                                            <form class="delete" action="{{ route('loans.destroy', $loan->id) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger" @disabled($loan->paid_amount>0)>
                                                                    <i class="fa-solid fa-trash"></i>
                                                                </button>
                                                            </form>
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
    </div>
@endsection
