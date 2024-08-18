@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.admin.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Expenses</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Expenses</li>
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
                                    <a href="{{ route('expenses.create') }}"class="btn btn-light shadow rounded m-0"><i
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
                                                    <th>Expense No</th>
                                                    <th>Date</th>
                                                    <th>Total Amount</th>
                                                    <th>Note</th>
                                                    <th>Created By</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data['expenses'] as $expense)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $expense->expense_no }}</td>
                                                        <td>{{ $expense->date }}</td>
                                                        <td style="text-align: right;">{{ $data['currency_symbol'] }} {{ number_format($expense->total_amount,2) }}</td>
                                                        <td>{{ $expense->expense_note }}</td>
                                                        <td>{{ $expense->admin->name }}</td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <button total="{{ 435 }}" expense_id="{{ $expense->id }}" type="button" class="btn btn-warning expense-details" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">
                                                                    <i class="fa fa-eye"></i>
                                                                </button>
                                                                <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-info">
                                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                                </a>
                                                                <form class="delete" action="{{ route('expenses.destroy', $expense->id) }}" method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Expense Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="expense_id" id="expense_id">
                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                            <label>Expense No</label>
                            <input type="text" class="form-control" name="expense_no" id="expense_no" disabled placeholder="123456" required>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                            <label>Expense Date</label>
                            <input type="date" class="form-control" name="date" id="date" disabled required>
                        </div>
                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                            <table id="expanse-table" class="table table-striped table-bordered table-centre p-0 m-0">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th width="5%">SN</th>
                                        <th>Expense Category</th>
                                        <th>Expense Head</th>
                                        <th>Note</th>
                                        <th>Amount</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.expense-details').on('click', function(e) {
                const expense_id = $(this).attr('expense_id');
                $('#expense_id').val(expense_id);
                $('#note').val('');
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ route('expenses.details') }}",
                    data:{expense_id: expense_id},
                    type: 'POST',
                    dataType: 'JSON',
                    success: function(res){
                        let tbody = ``;
                        let currency_symbol = "{{ $data['currency_symbol'] }}";
                        res.expense_details.forEach((item,index)=>{
                            tbody += `<tr>`;
                            tbody +=     `<td>${index+1}</td>`;
                            tbody +=     `<td>${item.expense_cat.cat_name}</td>`;
                            tbody +=     `<td>${item.expense_head.title}</td>`;
                            tbody +=     `<td>${item.note?item.note:''}</td>`;
                            tbody +=     `<td style="text-align: right;">${currency_symbol} ${nsFormatNumber(item.amount)}</td >`;
                            tbody +=     `<td>${item.quantity}</td>`;
                            tbody +=     `<td style="text-align: right;">${currency_symbol} ${nsFormatNumber(item.amount * item.quantity)}</td>`;
                            tbody += `</tr>`;
                        });
                        tbody += `<tr>`;
                        tbody +=     `<th>Note</th>`;
                        tbody +=     `<td colspan="3">${res.expense_note?res.expense_note:''}</td>`;
                        tbody +=     `<th>Grand Total:</th>`;
                        tbody +=     `<th colspan="2" style="text-align: right;">${currency_symbol} ${nsFormatNumber(res.total_amount)}</th>`;
                        tbody += `</tr>`;
                        $('#expense_no').val(res.expense_no);
                        $('#tbody').html(tbody);
                        $('#date').val(res.date);
                    }
                });
            });
        });
    </script>
@endsection
