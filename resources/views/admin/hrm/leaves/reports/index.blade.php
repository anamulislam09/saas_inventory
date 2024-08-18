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
                                        <select name="employee_id" id="employee_id" class="form-control">
                                            <option desc_reports="Leave Report" desc_emp="All Employees" value="0">All Employee</option>
                                            @foreach($data['employees'] as $employee)
                                                <option desc_reports="Leave Report" desc_emp="{{ $employee->name }}" value="{{ $employee->id }}">{{ $employee->name }}</option>
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
                                    <div class="form-group col-sm-12 col-md-12 col-lg-12" id="printable">
                                        <div id="print_header" hidden>
                                            <div class="row justify-content-center">
                                                <div class="col-12 text-center">
                                                    <h1>Leave Report</h1>
                                                </div>
                                                <div class="col-12">
                                                    <h4>Description: <span id="desc_reports"></span> of <strong id="desc_employee"></strong> for the month of <strong id="desc_month"></strong>.</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bootstrap-data-table-panel text-center">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-centre">
                                                    <thead id="thead">
                                                    </thead>
                                                    <tbody id="tbody">
                                                    </tbody>
                                                    <tfoot id="tfoot">
                                                    </tfoot>
                                                </table>
                                            </div>
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
            $('#employee_id, #date').on('change',function(){
                let employee_id = $('#employee_id').val();
                let date = $('#date').val();
                localStorage.setItem("leaveSearchBy", JSON.stringify({employee_id: employee_id, date: date}));
                getData(employee_id,date);
            });

            $('#print').click(function() {
                let employee = $('#employee_id option:selected').attr('desc_emp');
                let reports = $('#employee_id option:selected').attr('desc_reports');
                let date = nsMMYYYY($('#date').val());
                $('#desc_reports').html(reports);
                $('#desc_employee').html(employee);
                $('#desc_month').html(date);

                // Prepare for printing by expanding the table and showing hidden elements
                let originalOverflow = $('.table-responsive').css('overflow');
                let originalMaxHeight = $('.table-responsive').css('max-height');
                $('.table-responsive').css({
                    'overflow': 'visible',
                    'max-height': 'none'
                });
                
                $('#print_header').prop('hidden', false);
                var printContents = $('#printable').html();
                $('#print_header').prop('hidden', true);
                var originalContents = $('body').html();

                $('body').html(printContents);
                window.print();
                $('body').html(originalContents);

                // Restore the original state
                $('.table-responsive').css({
                    'overflow': originalOverflow,
                    'max-height': originalMaxHeight
                });
            });

        });

        function onLoad() {
            let employee_id;
            let date;
            let leaveSearchBy = JSON.parse(localStorage.getItem("leaveSearchBy"));
            if(leaveSearchBy){
                employee_id = leaveSearchBy.employee_id;
                date = leaveSearchBy.date;
            }else{
                employee_id = $('#employee_id').val();
                date = "{{ date('Y-m') }}";
                localStorage.setItem("leaveSearchBy", JSON.stringify({employee_id: employee_id, date: date}));
            }
            $('#employee_id').val(employee_id);
            $('#date').val(date);
            getData(employee_id,date);
        }

        function getData(employee_id,date) {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('leave-reports.index') }}",
                data:{ employee_id: employee_id, date: date},
                type: 'POST',
                dataType: 'JSON',
                success: function(res){
                    if(employee_id > 0){
                        singleEmployee(res);
                    }else{
                        allEmployees(res);
                    }
                }
            });
        }

        function singleEmployee(res) {
            let thead = `<tr>`;
            thead += `<th>SN</th>`;
            thead += `<th>Duty Handover To</th>`;
            thead += `<th>Leave Type</th>`;
            thead += `<th>Reason</th>`;
            thead += `<th>Application Start Date</th>`;
            thead += `<th>Application End Date</th>`;
            thead += `<th>Approved Start Date</th>`;
            thead += `<th>Approved End Date</th>`;
            thead += `<th>Application Days</th>`;
            thead += `<th>Approved Days</th>`;
            thead += `</tr>`;
            nsTBodyLoading('tbody');

            let tbody = '';
            let total_application_days = 0;
            let total_approved_days = 0;

            res.forEach((val, index) => {
                total_application_days += parseInt(val.application_days);
                total_approved_days += parseInt(val.approved_days);
                val.reason = val.reason ? val.reason : '';

                tbody += `<tr>`;
                tbody += `<td>${(index + 1)}</td>`;
                tbody += `<td>${val.duty_handover_to.name}</td>`;
                tbody += `<td>${val.leave_type.name}</td>`;
                tbody += `<td>${val.reason}</td>`;
                tbody += `<td>${val.application_start_date}</td>`;
                tbody += `<td>${val.application_end_date}</td>`;
                tbody += `<td>${val.approved_start_date}</td>`;
                tbody += `<td>${val.approved_end_date}</td>`;
                tbody += `<td>${val.application_days} Days</td>`;
                tbody += `<td>${val.approved_days} Days</td>`;
                tbody += `</tr>`;
            });

            tbody += `<tr>`;
            tbody += `<th style="text-align: left;" colspan="8">Total: </th>`;
            tbody += `<th>${total_application_days} Days</th>`;
            tbody += `<th>${total_approved_days} Days</th>`;
            tbody += `</tr>`;

            $('#tbody').html(tbody);
            $('#thead').html(thead);
            nsTBodyMessage(res.length, 'tbody');
        }

        function allEmployees(res) {
            let thead = `<tr>`;
            thead += `<th>SN</th>`;
            thead += `<th>Employee Name</th>`;
            thead += `<th>Duty Handover To</th>`;
            thead += `<th>Leave Type</th>`;
            thead += `<th>Reason</th>`;
            thead += `<th>App Start Date</th>`;
            thead += `<th>App End Date</th>`;
            thead += `<th>Approved Start Date</th>`;
            thead += `<th>Approved End Date</th>`;
            thead += `<th>Application Days</th>`;
            thead += `<th>Approved Days</th>`;
            thead += `</tr>`;
            nsTBodyLoading('tbody');

            let tbody = '';
            let total_application_days = 0;
            let total_approved_days = 0;

            res.forEach((val, index) => {
                total_application_days += parseInt(val.application_days);
                total_approved_days += parseInt(val.approved_days);
                val.reason = val.reason ? val.reason : '';

                tbody += `<tr>`;
                tbody += `<td>${(index + 1)}</td>`;
                tbody += `<td>${val.leave_taken_by.name}</td>`;
                tbody += `<td>${val.duty_handover_to.name}</td>`;
                tbody += `<td>${val.leave_type.name}</td>`;
                tbody += `<td>${val.reason}</td>`;
                tbody += `<td>${val.application_start_date}</td>`;
                tbody += `<td>${val.application_end_date}</td>`;
                tbody += `<td>${val.approved_start_date}</td>`;
                tbody += `<td>${val.approved_end_date}</td>`;
                tbody += `<td>${val.application_days} Days</td>`;
                tbody += `<td>${val.approved_days} Days</td>`;
                tbody += `</tr>`;
            });

            tbody += `<tr>`;
            tbody += `<th style="text-align: left;" colspan="9">Total: </th>`;
            tbody += `<th>${total_application_days} Days</th>`;
            tbody += `<th>${total_approved_days} Days</th>`;
            tbody += `</tr>`;

            $('#tbody').html(tbody);
            $('#thead').html(thead);
            nsTBodyMessage(res.length, 'tbody');
        }
    </script>
@endsection
