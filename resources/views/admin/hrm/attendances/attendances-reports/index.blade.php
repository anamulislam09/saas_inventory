@extends('layouts.admin.master')
@section('content')

    <style>
        @media print {
            .table-responsive {
                overflow: visible !important;
                max-height: none !important;
            }
            /* Additional print-specific styles here */
        }
    </style>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Attendance Report</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Attendance Report</li>
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
                                <h3 class="card-title">Attendance Report</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-12 col-md-5 col-lg-5">
                                        <label>Employee</label>
                                        <select name="employee_id" id="employee_id" class="form-control" required>
                                            <option desc_reports="Attendance Summary" desc_emp="All Employees" value="-1">Attendance Summary</option>
                                            <option desc_reports="Attendance Details" desc_emp="All Employees" value="0">Attendance Details</option>
                                            @foreach($data['employees'] as $employee)
                                                <option desc_reports="Attendance Report" desc_emp="{{ $employee->name }}" value="{{ $employee->id }}">{{ $employee->name }}</option>
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
                                                    <h1>Attendance Report</h1>
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
                localStorage.setItem("attendSearchBy", JSON.stringify({employee_id: employee_id, date: date}));
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
            let attendSearchBy = JSON.parse(localStorage.getItem("attendSearchBy"));
            if(attendSearchBy){
                $('#employee_id').val(attendSearchBy.employee_id);
                $('#date').val(attendSearchBy.date);
                employee_id = attendSearchBy.employee_id;
                date = attendSearchBy.date;
            }else{
                employee_id = 0;
                date = "{{ date('Y-m') }}";
                localStorage.setItem("attendSearchBy", JSON.stringify({employee_id: employee_id, date: date}));
                $('#date').val(date);
            }
            getData(employee_id,date);
        }

        function getData(employee_id,date) {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('attendances-reports.index') }}",
                data:{ employee_id: employee_id, date: date},
                type: 'POST',
                dataType: 'JSON',
                success: function(res){
                    if(employee_id==0){
                        employeesDetails(res,date);
                    }else if(employee_id==-1){
                        employeesSummary(res);
                    }else{
                        singleEmployee(res);
                    }
                }
            });
        }
        function employeesDetails(res,date){

            let wh = res.weeklyHoliday;
            const whdays = [wh.sunday, wh.monday, wh.tuesday, wh.wednesday, wh.thursday, wh.friday, wh.saturday];
            let myDate = new Date(date);
            let monthName = myDate.toLocaleString('default',{ month:'long' });
            var totalNumberOfDays = new Date(myDate.getFullYear(), myDate.getMonth() + 1, 0).getDate();
            let tbody = '';
            let thead = '';
            let tfoot = '';
            let allDates = [];

            let bgcolor;
            let attendanceStatus;

            for (let i = 0; i<totalNumberOfDays; i++) {
                let month = myDate.getMonth().toString().length == 2 ? parseInt(myDate.getMonth()+1) : '0' + parseInt(myDate.getMonth()+1);
                let day = (i+1).toString().length == 2 ? (i+1) : '0' + (i+1);
                allDates[i] = myDate.getFullYear()+'-'+month+'-'+day;
            }

            //Table Head........
            thead += `<tr>`;
            thead +=    `<th style="background-color: #28607F;color: white;padding: .40rem;">${monthName}</th>`;
            for (let i = 0; i < totalNumberOfDays; i++){
                weekday = (new Date(myDate.getFullYear(), myDate.getMonth(), (i+1))).toLocaleString('default', {weekday: 'short'});
                thead += `<th style="background-color: #D6EBF2;color: black;padding: .40rem;">${weekday}</th>`;
            }
            thead += `</tr>`;
            thead += `<tr style="text-align: center;">`;
            thead +=    `<th style="background-color: #747572;color: white;padding: .40rem;">Name</th>`;
            for (let i = 0; i < totalNumberOfDays; i++){
                thead += `<th style="background-color: #555151;color: white;padding: .40rem;">${i + 1}</th>`;
            }
            thead += '</tr>';

            //Table Body........
            res.employees.forEach((item,index)=>{
                tbody += `<tr>`;
                tbody +=   `<td style="padding: .40rem;">${item.name}</td>`;
                for (let i = 0; i < totalNumberOfDays; i++){
                    if(item.presentDates.includes(allDates[i])){
                        if(item.lateDates.includes(allDates[i])){
                            bgcolor = '#FF8488';
                            attendanceStatus = 'LT';
                        }else{
                            bgcolor = '#387FAD';
                            attendanceStatus = 'P';
                        }
                    }else{
                        if(res.holidayDates.includes(allDates[i]) || parseInt(whdays[new Date(allDates[i]).getDay()])){
                            bgcolor = '#31D2F2';
                            attendanceStatus = 'HD';
                        }else if(item.leaveDates.includes(allDates[i])){
                            bgcolor = '#FFFFE0';
                            attendanceStatus = 'LV';
                        }else{
                            bgcolor = '#FFCCCB';
                            attendanceStatus = 'A';
                        }
                    }
                    tbody += `<td style="padding: .40rem;background-color: ${bgcolor}; border-color: #8F8F8E;height: 30px;">${attendanceStatus}</td>`;
                }
                tbody += `</tr>`;
            });

            //Table Footer........
            tfoot += `<tr>`;
            tfoot +=    `<th style="padding: .40rem;background-color: #747572;color: white;">Name</th>`;
            for (let i = 0; i < totalNumberOfDays; i++){
                tfoot += `<th style="padding: .40rem;background-color: #555151;color: white;">${i + 1}</th>`;
            }
            tfoot += '</tr>';

            tfoot += `<tr>`;
            tfoot +=    `<th style="padding: .40rem;background-color: #28607F;color: white;">${monthName}</th>`;
            for (let i = 0; i < totalNumberOfDays; i++){
                weekday = (new Date(myDate.getFullYear(), myDate.getMonth(), (i+1))).toLocaleString('default', {weekday: 'short'});
                tfoot += `<th style="padding: .40rem;background-color: #D6EBF2;color: black;">${weekday}</th>`;
            }
            tfoot += `</tr>`;

            $('#thead').html(thead);
            $('#tbody').html(tbody);
            $('#tfoot').html(tfoot);
        }

        function singleEmployee(res){
            let td = '';
            let thead = '';
            let total_worked_hour = 0;
            let over_time_hour = 0;
    
            thead += '<tr style="text-align: center;">';
            thead +=    '<th>SN</th>';
            thead +=    '<th>Date</th>';
            thead +=    '<th>Note</th>';
            thead +=    '<th>In Time</th>';
            thead +=    '<th>Out Time</th>';
            thead +=    '<th>Worked Hour</th>';
            thead +=    '<th>Over Time</th>';
            thead += '</tr>';

            res.forEach((val,index)=>{
                if(val.in_at) val.in_at = (new Date(val.in_at)).toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
                if(val.out_at) val.out_at = (new Date(val.out_at)).toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
                total_worked_hour += parseInt(val.worked_hour);
                over_time_hour += parseInt(val.over_time_hour);
                td += '<tr>';
                td +=   '<td>'+(index + 1)+'</td>';
                td +=   '<td>'+val.date+'</td>';
                td +=   '<td>'+(val.note?val.note:'')+'</td>';
                td +=   '<td>'+val.in_at+'</td>';
                td +=   '<td>'+val.out_at+'</td>';
                td +=   '<td>'+(val.worked_hour? val.worked_hour + ' h':'')+'</td>';
                td +=   '<td>'+(val.over_time_hour? val.over_time_hour + ' h':'')+'</td>';
                td += '</tr>';
            });
                td += '<tr>';
                td +=   '<th style="text-align: left;" colspan="5">Total: </th>';
                td +=   '<th>'+total_worked_hour+' h</th>';
                td +=   '<th>'+over_time_hour+' h</th>';
                td += '</tr>';
                $('#thead').html(thead);
                $('#tbody').html(td);
                $('#tfoot').html('');
                nsTBodyMessage(res.length,'tbody');
        }

        function employeesSummary(res){
            let td = ``;
            let thead = ``;
            
            thead += `<tr>`;
            thead +=    `<th>SN</th>`;
            thead +=    `<th>Employee Name</th>`;
            thead +=    `<th>Present</th>`;
            thead +=    `<th>Leave</th>`;
            thead +=    `<th>Late</th>`;
            thead +=    `<th>Absent</th>`;
            thead += `</tr>`;

            res.forEach((item,index)=>{
                td += `<tr>`;
                td +=   `<td>${index + 1}</td>`;
                td +=   `<td>${item.name}</td>`;
                td +=   `<td>${item.presents}</td>`;
                td +=   `<td>${item.leaves}</td>`;
                td +=   `<td>${item.lates}</td>`;
                td +=   `<td>${item.absents}</td>`;
                td += `</tr>`;
            });
            $(`#thead`).html(thead);
            $(`#tbody`).html(td);
            $(`#tfoot`).html('');
            nsTBodyMessage(res.length,'tbody');

        }

    </script>
@endsection
