@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.admin.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Salary</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Salary</li>
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
                            <div class="card-header bg-primary p-1">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="card-title">
                                            <button ame="print" id="print" type="button" class="form-control btn btn-warning">Print</button>
                                        </h3>
                                    </div>
                                    <div class="col-2">
                                        <input name="date" id="date" type="month" value="{{ date('Y-m') }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-12 col-md-12 col-lg-12" id="printable">
                                        <div id="print_header" hidden>
                                            <div class="row justify-content-center">
                                                <div class="col-12 text-center">
                                                    <h1>Salay Report</h1>
                                                </div>
                                                <div class="col-12">
                                                    <h4>Description: Employees Salay Report for the month of <strong id="desc_month"></strong>.</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bootstrap-data-table-panel text-center">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-centre">
                                                    <thead id="thead">
                                                        <tr>
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
                                                        </tr>
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
            $('#date').on('change',function(){
                let date = $('#date').val();
                localStorage.setItem("salaryMonth", JSON.stringify({date: date}));
                getData(date);
            });
            $('#print').click(function() {

                // let employee = $('#employee_id option:selected').attr('desc_emp');
                // let reports = $('#employee_id option:selected').attr('desc_reports');
                let date = nsMMYYYY($('#date').val());

                // $('#desc_reports').html(reports);
                // $('#desc_employee').html(employee);
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
            
            let date;
            let salaryMonth = JSON.parse(localStorage.getItem("salaryMonth"));
            if(salaryMonth){
                $('#date').val(salaryMonth.date);
                date = salaryMonth.date;
            }else{
                date = "{{ date('Y-m') }}";
                localStorage.setItem("salaryMonth", JSON.stringify({date: date}));
                $('#date').val(date);
            }
            getData(date);
        }


        function getData(date) {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('salaries.index') }}",
                data:{date: date},
                type: 'POST',
                dataType: 'JSON',
                success: function(res){
                    nsTBodyLoading('tbody');
                    let tbody = ``;
                    let total_salary = 0;
                    res.forEach((item, index) => {
                        total_salary += parseFloat(item.net_payable);
                        item.basic_salary = nsFormatNumber(item.basic_salary);
                        item.bonus = nsFormatNumber(item.bonus);
                        item.overtime = nsFormatNumber(item.overtime);
                        item.others = nsFormatNumber(item.others);
                        item.absent = nsFormatNumber(item.absent);
                        item.late = nsFormatNumber(item.late);
                        item.loan = nsFormatNumber(item.loan);

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
                        tbody +=   `<td>${nsFormatNumber(item.net_payable)}</td>`;
                        tbody += `</tr>`;
                    });
                    $('#tbody').html(tbody);


                    let tfoot = ``;
                    tfoot += `<tr>`;
                    tfoot +=    `<th colspan="9" style="text-align: left;">Total: </th>`;
                    tfoot +=    `<th>${nsFormatNumber(total_salary)}</th>`;
                    tfoot += `</tr>`;
                    $('#tfoot').html(tfoot);

                    nsTBodyMessage(res.length,'tbody');
                }
            });
        }
    </script>
@endsection
