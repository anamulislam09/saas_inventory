@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.admin.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Weekly Holiday</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Weekly Holiday</li>
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
                            <div class="card-body">
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-centre" style="text-align: center;">
                                            <thead>
                                                <tr>
                                                    <th>Saturday</th>
                                                    <th>Sunday</th>
                                                    <th>Monday</th>
                                                    <th>Tuesday</th>
                                                    <th>Wednesday</th>
                                                    <th>Thursday</th>
                                                    <th>Friday</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                @php
                                                    $yes = "<span class='badge badge-success'>Yes</span>";
                                                    $no = "<span class='badge badge-danger'>No</span>";
                                                @endphp
                                                <tr>
                                                    <td>{!! $weeklyHolidays->saturday ? $yes : $no !!}</td>
                                                    <td>{!! $weeklyHolidays->sunday ? $yes : $no !!}</td>
                                                    <td>{!! $weeklyHolidays->monday ? $yes : $no !!}</td>
                                                    <td>{!! $weeklyHolidays->tuesday ? $yes : $no !!}</td>
                                                    <td>{!! $weeklyHolidays->wednesday ? $yes : $no !!}</td>
                                                    <td>{!! $weeklyHolidays->thursday ? $yes : $no !!}</td>
                                                    <td>{!! $weeklyHolidays->friday ? $yes : $no !!}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <a href="{{ route('weekly-holidays.edit', $weeklyHolidays->id) }}"
                                                                class="btn btn-info">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
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
@endsection
@section('script')
<script>
    $(document).ready(function(){
        // getData($('#date').val())
        // $('#date').on('change',function(){
        //     let date = $('#date').val();
        //     localStorage.setItem("holiday-date", JSON.stringify({date: date}));
        //     getData(date);
        // });
    });

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
