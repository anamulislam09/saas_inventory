@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Salary Process</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Salary Process</li>
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
                                <h3 class="card-title">Salary Process</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('salaries.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf()
                                    <div class="row">
                                        <div class="form-group col-sm-12 col-md-3 col-lg-3">
                                            <label for="date">Month</label>
                                            <input name="date" id="date" type="month" value="{{ Date('Y-m') }}" class="form-control">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-3 col-lg-3 d-flex align-items-center">
                                            <div class="clearfix" style="margin-top: 37px;">
                                              <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="bonus">
                                                <label for="bonus">
                                                    Has Bonus?
                                                </label>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-2 col-lg-2 d-flex align-items-end">
                                            <button name="show_data" id="show_data" type="button" class="form-control btn btn-info">Show Data</button>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-2 col-lg-2 d-flex align-items-end">
                                            <button name="process_salary" id="process_salary" type="button" class="form-control btn btn-primary" disabled>Process Salary</button>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-2 col-lg-2 d-flex align-items-end">
                                            <button name="save_salary" id="save_salary" type="submit" class="form-control btn btn-success" disabled>Save</button>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                            <div class="bootstrap-data-table-panel">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-centre text-center">
                                                        <thead id="thead_ap">
                                                        </thead>
                                                        <tbody id="tbody_ap">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                            <div class="bootstrap-data-table-panel">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-centre text-center">
                                                        <thead id="thead">
                                                            <th>SN</th>
                                                            <th>Employee Name</th>
                                                            <th>Basic Salary</th>
                                                            <th>Bonus</th>
                                                            <th>Overtime</th>
                                                            <th>Others</th>
                                                            <th>Absent</th>
                                                            <th>Late</th>
                                                            <th>Loan</th>
                                                            <th>Total Payable</th>
                                                        </thead>
                                                        <tbody id="tbody">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
            $('#bonus').change(function(){
                $('#process_salary').prop('disabled', true);
                $('#save_salary').prop('disabled', true);
            });
            $('#process_salary').click(async function(){
                $.ajax({
                    url: "{{ route('salary-processes.process') }}",
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(res){
                        loadTable(res);
                        $('#save_salary').prop('disabled', false);
                    }
                });
            });

            $('#show_data').click(async function() {

                //Validation.......
                const response = await validates();
                if (!response.validated){
                    if(response.redirect){
                        alert(response.message);
                        return window.location.href = response.redirect;
                    }else{
                        return alert(response.message); 
                    }
                }

                //Show Data
                let data = {};
                data.bonus = $('#bonus').prop('checked');
                data.date = $('#date').val();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ route('salary-processes.index') }}",
                    data: data,
                    type: 'POST',
                    dataType: 'JSON',
                    success: function(res){
                        loadTable(res);
                        $('#process_salary').prop('disabled', false);
                        $('#save_salary').prop('disabled', true);
                    }
                });
            });
        });

        async function validates() {
            const response = {validated: true, message: '',redirect: null};
            const date = $('#date').val();
            if (!date) {
                response.validated = false;
                response.message = 'Please Select Month!';
                return response;
            }

            const iap = await isAttendanceProcessed(date);
            if (!iap) {
                response.validated = false;
                response.message = 'Please Process Attendance!';
                response.redirect = '{{ route("attendance-processes.index") }}';
                return response;
            }
            
            const ilp = await isLoanProcessed(date);
            if (!ilp) {
                response.validated = false;
                response.message = 'Please Process Loan!';
                response.redirect = '{{ route("loan-processes.index") }}';
                return response;
            }
            return response;
        }

        function isAttendanceProcessed(date) {
            return new Promise((resolve, reject) => {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ route('salary-processes.isAttendanceProcessed') }}",
                    data: {date: date},
                    type: 'POST',
                    dataType: 'JSON',
                    success: function(res) {
                        resolve(res);
                    },
                    error: function(err) {
                        reject(err);
                    }
                });
            });
        }
        function isLoanProcessed(date) {
            return new Promise((resolve, reject) => {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ route('salary-processes.isLoanProcessed') }}",
                    data: {date: date},
                    type: 'POST',
                    dataType: 'JSON',
                    success: function(res) {
                        resolve(res);
                    },
                    error: function(err) {
                        reject(err);
                    }
                });
            });
        }
        function loadTable(res) {
            let tbody = ``;
            res.forEach((item, index) => {
                item.basic_salary = nsFormatNumber(item.basic_salary);
                item.bonus = nsFormatNumber(item.bonus);
                item.overtime = nsFormatNumber(item.overtime);
                item.others = nsFormatNumber(item.others);
                item.absent = nsFormatNumber(item.absent);
                item.late = nsFormatNumber(item.late);
                item.loan = nsFormatNumber(item.loan);
                item.net_payable = nsFormatNumber(item.net_payable);

                tbody += `<tr>`;
                tbody +=   `<td>${(index + 1)}</td>`;
                tbody +=   `<td class="text-left">${item.employee.name}</td>`;
                tbody +=   `<td>${item.basic_salary}</td>`;
                tbody +=   `<td>${item.bonus}</td>`;
                tbody +=   `<td>${item.overtime}</td>`;
                tbody +=   `<td>${item.others}</td>`;
                tbody +=   `<td>${item.absent}</td>`;
                tbody +=   `<td>${item.late}</td>`;
                tbody +=   `<td>${item.loan}</td>`;
                tbody +=   `<td>${item.net_payable}</td>`;
                tbody += `</tr>`;
            });
            $('#tbody').html(tbody);
        }
    </script>
@endsection
