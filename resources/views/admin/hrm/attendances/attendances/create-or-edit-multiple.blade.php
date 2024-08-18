@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.admin.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Attendance</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Attendance</li>
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
                            <form id="form-submit" action="{{ route('attendances.storeOrUpdate-multiple') }}" method="POST" enctype="multipart/form-data">
                                @csrf()
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                                <label>Attendance Date</label>
                                                <input value="{{ Date('Y-m-d') }}" type="date" class="form-control" name="date" id="date" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                            <div class="bootstrap-data-table-panel">
                                                <div class="table-responsive">
                                                   <table class="table table-striped table-bordered table-centre">
                                                        <thead>
                                                            <tr>
                                                                <th>SN</th>
                                                                <th>Employee Name</th>
                                                                <th>In Time</th>
                                                                <th>Out Time</th>
                                                                <th>Note</th>
                                                                <th>Present / Absent<span class="btn btn-sm bg-success m-0" id="select" style="font-size: 11px; padding:2px;">Select All</span></th>
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
        getData();
        $('#date').on('change', function(){
            getData($(this).val());
        });
    });
    function getData(date=jsFormatTime(new Date())) {

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ route('attendances.by-date') }}",
            data:{ date: date},
            type: 'POST',
            dataType: 'JSON',
            success: function(res){
                let tbody = '';
                let in_at;
                let out_at;
                let attendance;
                let attendance_id;
                let deafault_in_at = res.deafault_in_at;
                let deafault_out_at = res.deafault_out_at;
                res.employees.forEach((element, index) => {
                    if(element.attendance){
                        in_at = jsDateTimeLocal(new Date(element.attendance.in_at));
                        out_at = jsDateTimeLocal(new Date(element.attendance.out_at));
                        attendance = 'checked';
                        attendance_id = element.attendance.id;
                    }else{
                        attendance_id = null;
                        in_at = jsDateTimeLocal(new Date(date +' '+deafault_in_at));
                        out_at = jsDateTimeLocal(new Date(date +' '+deafault_out_at));
                        attendance = '';
                    }
                    tbody += '<tr>';
                    tbody += '<input value="'+attendance_id+'" type="hidden" name="attendance_id[]">';
                    tbody +=     '<td>'+(index+1)+'</td>';
                    tbody +=     '<td>'+element.name+'<input value="'+element.id+'" type="hidden" name="employee_id[]"></td>';
                    tbody +=     '<td><input value="'+in_at+'" type="datetime-local" class="form-control" name="in_at[]" required></td>';
                    tbody +=     '<td><input value="'+out_at+'" type="datetime-local" class="form-control" name="out_at[]"></td>';
                    tbody +=     '<td><input type="text" class="form-control" name="note[]" placeholder="Note"></td>';
                    tbody +=     '<td>';
                    tbody +=         '<div class="col-12">';
                    tbody +=             '<div class="custom-control custom-switch custom-switch-off-gray custom-switch-on-success child-menu">';
                    tbody +=                 '<input name="present_emp_id[]" type="checkbox" '+attendance+' class="custom-control-input" id="present_emp_id-'+element.id+'" value="'+element.id+'">';
                    tbody +=                 '<label class="custom-control-label" for="present_emp_id-'+element.id+'" ></label>';
                    tbody +=             '</div>';
                    tbody +=         '</div>';
                    tbody +=     '</td>';
                    tbody += '</tr>';
                });
                $('#tbody').html(tbody);
            }
        });
    }



    $('#select').click(function(){
        let checkboxes = $('input[type="checkbox"]');
        let text = $(this).text();
        if(text=='Select All'){
            $(this).text('Deselect All');
            $(this).removeClass('bg-success');
            $(this).addClass('bg-dark');
            checkboxes.each((index,element)=>{element.checked = true;});
        }else{
            $(this).text('Select All');
            $(this).removeClass('bg-dark');
            $(this).addClass('bg-success');
            checkboxes.each((index,element)=>{element.checked = false;});
        }
    });

    $('#form-submit').submit(function(e){
        let checked = false;
        $('input[type="checkbox"]').each(function(index, element) {
            if(element.checked){
                checked = true;
            }
        });
        if(!checked){
            e.preventDefault();
            return Swal.fire("No present found!");
        }
    });


    
    function jsFormatTime(date) {
        var local = new Date(date);
        local.setMinutes(date.getMinutes() - date.getTimezoneOffset());
        return local.toJSON().slice(0, 10);
    }
    function jsDateTimeLocal(date) {
        var local = new Date(date);
        local.setMinutes(date.getMinutes() - date.getTimezoneOffset());
        return local.toJSON().slice(0, 16);
    }

</script>
@endsection