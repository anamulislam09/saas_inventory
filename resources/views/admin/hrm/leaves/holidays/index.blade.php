@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.admin.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Holiday</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Holiday</li>
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
                                <div class="row">
                                    <div class="col">
                                        <h3 class="card-title">
                                            <a href="{{ route('holidays.create') }}"class="btn btn-light shadow rounded m-0"><i
                                                    class="fas fa-plus"></i>
                                                <span>Add New</span></i></a>
                                        </h3>
                                    </div>
                                    <div class="col-2">
                                        <input name="date" id="date" type="month" value="{{ date('Y-m') }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-centre">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Date</th>
                                                    <th>Occation</th>
                                                    <th>Day</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Date</th>
                                                    <th>Occation</th>
                                                    <th>Day</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
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
@endsection
@section('script')
<script>
    $(document).ready(function(){
        onLoad();
        $('#date').on('change',function(){
            let date = $('#date').val();
            localStorage.setItem("holiday_date", JSON.stringify({date: date}));
            getData(date);
        });
    });
    function onLoad() {
        
        let date;
        let holiday_date = JSON.parse(localStorage.getItem("holiday_date"));
        if(holiday_date){
            $('#date').val(holiday_date.date);
            date = holiday_date.date;
        }else{
            date = "{{ date('Y-m') }}";
            localStorage.setItem("holiday_date", JSON.stringify({date: date}));
            $('#date').val(date);
        }
        getData(date);
    }


    function getData(date) {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ route('holidays.holidays-by-date') }}",
            data:{date: date},
            type: 'POST',
            dataType: 'JSON',
            success: function(res){
                const baseUrl = "{{ route('holidays.destroy', ':id') }}";
                let tbody = '';
                res.forEach((element, index) => {
                    let route = baseUrl.replace(':id', element.id);
                    weekday = new Date(element.date).toLocaleString('default', {weekday: 'short'});
                    tbody += '<tr>';
                    tbody +=     '<td>'+(index+1)+'</td>';
                    tbody +=     '<td>'+element.date+'</td>';
                    tbody +=     '<td>'+element.occasion+'</td>';
                    tbody +=     '<td>'+weekday+'</td>';
                    tbody +=     '<td>';
                    tbody +=         '<div class="d-flex justify-content-center">';
                    tbody +=             '<form class="delete" action="'+route+'" method="post">';
                    tbody +=                 '@csrf';
                    tbody +=                 '@method("DELETE")';
                    tbody +=                 '<button type="submit" class="btn btn-danger">';
                    tbody +=                     '<i class="fa-solid fa-trash"></i>';
                    tbody +=                 '</button>';
                    tbody +=             '</form>';
                    tbody +=         '</div>';
                    tbody +=     '</td>';
                    tbody += '</tr>';
                });

                $('#tbody').html(tbody);


            }
        });
    }

</script>
@endsection
