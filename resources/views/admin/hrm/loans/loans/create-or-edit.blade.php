@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
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
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ $data['title'] }} Form</h3>
                            </div>
                            <form id="form-submit" action="{{ isset($data['item']) ? route('loans.update',$data['item']->id) : route('loans.store'); }}" method="POST" enctype="multipart/form-data">
                                @csrf()
                                @if(isset($data['item']))
                                    @method('put')
                                @endif
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-sm-12 col-md-3 col-lg-3">
                                            <label>Employee*</label>
                                            <select name="employee_id" id="employee_id" class="form-control" required>
                                                <option value="">Select Employee</option>
                                                @foreach($data['employees'] as $employee)
                                                    <option @isset($data['item']) @if( $data['item']->employee_id == $employee->id ) selected @endif @endisset value="{{ $employee->id }}">{{ $employee->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-9 col-lg-9">
                                            <label>Loan Details</label>
                                            <textarea type="text" class="form-control" name="loan_details" id="loan_details" placeholder="Loan Details" cols="9" rows="1" required>{{ isset($data['item']) ? $data['item']->loan_details : null }}</textarea>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                            <label>Application Date</label>
                                            <input value="{{ isset($data['item']) ? $data['item']->application_date : null }}" type="date" class="form-control" name="application_date" id="application_date" required>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                            <label>Approved Date</label>
                                            <input value="{{ isset($data['item']) ? $data['item']->approved_date : null }}" type="date" class="form-control" name="approved_date" id="approved_date" required>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                            <label>Repayment From</label>
                                            <input value="{{ isset($data['item']) ? $data['item']->repayment_from : null }}" type="date" class="form-control" name="repayment_from" id="repayment_from" required>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                            <div class="row">
                                                <div class="form-group col-sm-12 col-lg">
                                                    <label>Amount</label>
                                                    <input value="{{ isset($data['item']) ? $data['item']->amount : null }}" type="number" class="form-control calculate" name="amount" id="amount" placeholder="0.00" required>
                                                </div>
                                                <div class="form-group col-sm-12 col-lg">
                                                    <label>Interest Percent</label>
                                                    <input value="{{ isset($data['item']) ? $data['item']->interest_percent : null }}" type="number" class="form-control calculate" name="interest_percent" id="interest_percent" placeholder="0.00" required>
                                                </div>
                                                <div class="form-group col-sm-12 col-lg">
                                                    <label>Installment Period</label>
                                                    <input value="{{ isset($data['item']) ? $data['item']->installment_period : null }}" type="number" class="form-control calculate" name="installment_period" id="installment_period" placeholder="0.00" required>
                                                </div>
                                                <div class="form-group col-sm-12 col-lg">
                                                    <label>Repayment Total</label>
                                                    <input value="{{ isset($data['item']) ? $data['item']->repayment_total : null }}" type="number" class="form-control calculate" name="repayment_total" id="repayment_total" placeholder="0.00" readonly required>
                                                </div>
                                                <div class="form-group col-sm-12 col-lg">
                                                    <label>Installment</label>
                                                    <input value="{{ isset($data['item']) ? $data['item']->installment : null }}" type="number" class="form-control calculate" name="installment" id="installment" placeholder="0.00" readonly required>
                                                </div>
                                            </div>
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
        $(document).ready(function(){
            $('.calculate').on('input',function(){
                let amount = parseFloat($('#amount').val());
                let interest_percent = parseFloat($('#interest_percent').val()?$('#interest_percent').val():0);
                let installment_period = parseFloat($('#installment_period').val());
                let repayment_total = amount + (amount * (interest_percent/100));
                let installment = installment_period ? repayment_total / installment_period : 0;
                $('#repayment_total').val(repayment_total.toFixed(2));
                $('#installment').val(installment.toFixed(2));
            });
        });
    </script>
@endsection