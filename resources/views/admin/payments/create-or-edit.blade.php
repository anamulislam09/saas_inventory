@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
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
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ $data['title'] }} Form</h3>
                            </div>
                            <form id="payment-form" action="{{ route('payments.store') }}" method="POST"
                                enctype="multipart/form-data">
                                <div class="modal-body">
                                    @csrf()
                                    <div class="row">
                                        <input type="hidden" name="purchase_id" id="purchase_id">
                                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                            <label>Payment Date *</label>
                                            <input value="{{ date('Y-m-d') }}" type="date" class="form-control"
                                                name="date" id="date" placeholder="0.00">
                                        </div>
                                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                            <label>Supplier *</label>
                                            <select name="supplier_id" id="supplier_id" class="form-control" required>
                                                <option value="" selected>Select Supplier</option>
                                                @foreach ($data['suppliers'] as $supplier)
                                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                            <label>Payment Methods *</label>
                                            <select name="payment_method_id" id="payment_method_id" class="form-control"
                                                required>
                                                <option value='' selected>Select Payment Method</option>
                                                @foreach ($data['paymentMethods'] as $pm)
                                                    <option @selected($pm->is_default) value="{{ $pm->id }}">
                                                        {{ $pm->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                            <label>Amount</label>
                                            <input type="number" class="form-control" name="amount" id="amount" placeholder="0.00" required>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                            <label>Paid as Advance</label>
                                            <input readonly type="number" class="form-control" name="paid_in_advanced" id="paid_in_advanced" placeholder="0.00">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>SN</th>
                                                            <th>Vouchar No</th>
                                                            <th>Date</th>
                                                            <th>Payable</th>
                                                            <th>Paid</th>
                                                            <th>Due</th>
                                                            <th>Pay To Vouchar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                            <label>Note</label>
                                            <input type="text" class="form-control" name="note" id="note"
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
            $('#amount').on('keyup',(e)=>{calculate();});
            $('#tbody').bind('change',(e)=>{
                if(e.target.classList.contains('pay_it')) calculate();
            });

            $('#supplier_id').on('change', (e)=>{
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url:"{{ route('payments.due.vouchars') }}",
                    data:{supplier_id: $('#supplier_id').val()},
                    type: 'POST',
                    dataType: 'JSON',
                    success: function(res){
                        let td = '';
                        res.purchases.forEach((val,index) => {
                            td += '<tr>';
                            td +=     '<td>'+(index+1)+'</td>';
                            td +=     '<td><a href="{{ url("admin/purchases/vouchar") }}/'+val.id+'"><b>'+val.vouchar_no+'</b></a></td>';
                            td +=     '<td>'+val.date+'</td>';
                            td +=     '<td>'+res.currency_symbol+' '+val.total_payable+'</td>';
                            td +=     '<td style="text-align: center;">'+res.currency_symbol+' '+val.paid_amount+'</td>';
                            td +=     '<td style="text-align: center;">'+res.currency_symbol+' '+(val.total_payable - val.paid_amount)+'</td>';
                            td +=     '<td style="text-align: center;">';
                            td +=         '<div class="form-inline">';
                            td +=             '<input value="'+val.id+'" type="hidden" name="purchase_id[]">';
                            td +=             '<input readonly class="form-control" due="'+(val.total_payable - val.paid_amount)+'" type="number" name="paid_amount[]" placeholder="0.00">';
                            td +=             '<input value="'+val.id+'" checked  class="form-check-input ml-2 pay_it" type="checkbox" id="pay_id-'+index+'" name="pay_it[]">';
                            td +=         '</div>';
                            td +=     '</td>';
                            td += '</tr>';
                        });
                        $('#tbody').html(td);
                        if(!res.purchases.length) $('#tbody').html('<tr><td style="text-align: center;" colspan="7">No Due Vouchar Found!</td></tr>');
                    }
                });

            });
        });


        function calculate() {
            let current_payment = $('#amount').val();
            let due = 0;
            $('input[name="paid_amount[]"]').each(function(index){
                if ($('#pay_id-'+index).prop('checked')) {
                    due = parseFloat($(this).attr("due"));
                    if(current_payment>=due){
                        $(this).val(due);
                        current_payment -= due;
                    }else if(current_payment<due){
                        $(this).val(current_payment);
                        current_payment -= current_payment;
                    }else{
                        $(this).val('');
                    }
                }else{
                    $(this).val('');
                }
            });
            $('#paid_in_advanced').val(current_payment);
        }
    </script>
@endsection
