@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Leave Report</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Leave Report</li>
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
                                <h3 class="card-title">Leave Report</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-12 col-md-5 col-lg-5">
                                        <label>Employee</label>
                                        <select name="leave_taken_by_id" id="leave_taken_by_id" class="form-control">
                                            @foreach($data['employees'] as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-5 col-lg-5">
                                        <label>Month</label>
                                        <input name="date" id="date" type="month" class="form-control">
                                    </div>
                                    <div class="form-group col-sm-12 col-md-2 col-lg-2">
                                        <label>&nbsp;</label>
                                        <button ame="print" id="print" type="button" class="form-control btn btn-primary">Print</button>
                                    </div>

                                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                        <div class="table-responsive">
                                            <table id="expanse-table" class="table table-striped table-bordered table-centre p-0 m-0">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>SN</th>
                                                        <th>Duty Handover To</th>
                                                        <th>Leave Type</th>
                                                        <th>Reason</th>
                                                        <th>Application Start Date</th>
                                                        <th>Application End Date</th>
                                                        <th>Approved Start Date</th>
                                                        <th>Approved End Date</th>
                                                        <th>Application Days</th>
                                                        <th>Approved Days</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-data" style="text-align: center;">
                                                    <tr><td style="text-align: center;" colspan="10"><b>Loading data...</b></td></tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            onLoad();
            $('#leave_taken_by_id, #date').on('change',function(){
                let leave_taken_by_id = $('#leave_taken_by_id').val();
                let date = $('#date').val();
                localStorage.setItem("leaveSearchBy", JSON.stringify({leave_taken_by_id: leave_taken_by_id, date: date}));
                getData(leave_taken_by_id,date);
            });
        });

        function onLoad() {
            let leave_taken_by_id;
            let date;
            let leaveSearchBy = JSON.parse(localStorage.getItem("leaveSearchBy"));
            if(leaveSearchBy){
                leave_taken_by_id = leaveSearchBy.leave_taken_by_id;
                date = leaveSearchBy.date;
            }else{
                leave_taken_by_id = $('#leave_taken_by_id').val();
                date = "{{ date('Y-m') }}";
                localStorage.setItem("leaveSearchBy", JSON.stringify({leave_taken_by_id: leave_taken_by_id, date: date}));
            }
            $('#leave_taken_by_id').val(leave_taken_by_id);
            $('#date').val(date);
            getData(leave_taken_by_id,date);
        }

        function getData(leave_taken_by_id,date) {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('leave-reports.index') }}",
                data:{ leave_taken_by_id: leave_taken_by_id, date: date},
                type: 'POST',
                dataType: 'JSON',
                success: function(res){

                    let td = '';
                    let total_application_days = 0;
                    let total_approved_days = 0;
                    $('#table-data').html('<tr><td style="text-align: center;" colspan="10"><b>Loading data...</b></td></tr>');

                    res.forEach((val,index)=>{
                        total_application_days += parseInt(val.application_days);
                        total_approved_days += parseInt(val.approved_days);
                        val.reason = val.reason ? val.reason : '';

                        td += '<tr>';
                        td +=   '<td>'+(index + 1)+'</td>';
                        td +=   '<td>'+val.duty_handover_to.name+'</td>';
                        td +=   '<td>'+val.leave_type.name+'</td>';
                        td +=   '<td>'+val.reason+'</td>';
                        td +=   '<td>'+val.application_start_date+'</td>';
                        td +=   '<td>'+val.application_end_date+'</td>';
                        td +=   '<td>'+val.approved_start_date+'</td>';
                        td +=   '<td>'+val.approved_end_date+'</td>';
                        td +=   '<td>'+val.application_days+' Days</td>';
                        td +=   '<td>'+val.approved_days+' Days</td>';
                        td += '</tr>';
                    });
                        td += '<tr>';
                        td +=   '<th style="text-align: left;" colspan="8">Total: </th>';
                        td +=   '<th>'+total_application_days+' Days</th>';
                        td +=   '<th>'+total_approved_days+' Days</th>';
                        td += '</tr>';

                    $('#table-data').html(td);
                    if(!res.length) $('#table-data').html('<tr><td style="text-align: center;" colspan="10"><b>No Data Found!...</b></td></tr>');
                }
            });
        }

    </script>
@endsection
