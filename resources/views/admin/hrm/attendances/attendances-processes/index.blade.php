@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Attendance Process</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Attendance Process</li>
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
                                <h3 class="card-title">Attendance Process</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('attendance-processes.proccess') }}" method="POST" enctype="multipart/form-data">
                                    @csrf()
                                    <div class="row">
                                        <div class="form-group col-sm-12 col-md-5 col-lg-5">
                                            <label for="date">Month</label>
                                            <input name="date" id="date" type="month" class="form-control">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-2 col-lg-2 d-flex align-items-end">
                                            <button name="attendanceProces" id="attendanceProces" type="submit" class="form-control btn btn-primary">Process Attendance</button>
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
                                                            <th>Present</th>
                                                            <th>Leave</th>
                                                            <th>Absent</th>
                                                            <th>Absent As Late</th>
                                                            <th>Regular Working (Hours)</th>
                                                            <th>Overtime (Hours)</th>
                                                            <th>Total Hours Worked</th>
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
            onLoad();
            $('#date').on('change',function(){
                let date = $('#date').val();
                localStorage.setItem("attendProcess", JSON.stringify({date: date}));
                getData(date);
            });
        });

        function onLoad() {
            let date;
            let attendProcess = JSON.parse(localStorage.getItem("attendProcess"));
            if(attendProcess){
                $('#date').val(attendProcess.date);
                date = attendProcess.date;
            }else{
                date = "{{ date('Y-m') }}";
                localStorage.setItem("attendProcess", JSON.stringify({date: date}));
                $('#date').val(date);
            }
            getData(date);
        }

        function getData(date) {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('attendance-processes.index') }}",
                data:{date: date},
                type: 'POST',
                dataType: 'JSON',
                success: function(res){
                    let tbody = ``;
                    if(res.attendanceProcess){
                        let tbody_ap = '';
                        let thead_ap = '';
                        thead_ap += `<tr>`;
                        thead_ap +=   `<th>Month</th>`;
                        thead_ap +=   `<th>Total Working Days</th>`;
                        thead_ap +=   `<th>Total Working Hours</th>`;
                        thead_ap += `</tr>`;
                        tbody_ap += `<tr>`;
                        tbody_ap +=   `<td>${res.attendanceProcess.date}</td>`;
                        tbody_ap +=   `<td>${res.attendanceProcess.total_working_days}</td>`;
                        tbody_ap +=   `<td>${res.attendanceProcess.total_working_hours}</td>`;
                        tbody_ap += `</tr>`;
                        $('#thead_ap').html(thead_ap);
                        $('#tbody_ap').html(tbody_ap);
                    }else{
                        $('#thead_ap').html('');
                        $('#tbody_ap').html('');
                    }

                    res.employees.forEach((item,index)=>{
                        let present_days = item.apd?item.apd.present_days : '';
                        let absent_days = item.apd?item.apd.absent_days : '';
                        let late_to_absent_days = item.apd?item.apd.late_to_absent_days : '';
                        let leave_days = item.apd?item.apd.leave_days : '';
                        let regular_hours_worked = item.apd?item.apd.regular_hours_worked : '';
                        let overtime_hours = item.apd?item.apd.overtime_hours : '';
                        let total_hours_worked = item.apd?item.apd.total_hours_worked : '';
                        
                        tbody += `<tr>`;
                        tbody +=   `<td>${(index + 1)}</td>`;
                        tbody +=   `<td class="text-left">${item.name}</td>`;
                        tbody +=   `<td>${present_days}</td>`;
                        tbody +=   `<td>${leave_days}</td>`;
                        tbody +=   `<td>${absent_days}</td>`;
                        tbody +=   `<td>${late_to_absent_days}</td>`;
                        tbody +=   `<td>${regular_hours_worked}</td>`;
                        tbody +=   `<td>${overtime_hours}</td>`;
                        tbody +=   `<td>${total_hours_worked}</td>`;
                        tbody += `</tr>`;
                    });
                    $('#tbody').html(tbody);
                }
            });
        }

    </script>
@endsection
