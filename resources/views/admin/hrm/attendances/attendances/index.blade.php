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
                    <section class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-primary p-1">
                                <h3 class="card-title">
                                    <a href="{{ route('attendances.create') }}"class="btn btn-light shadow rounded m-0">
                                        <i class="fas fa-plus p-1"></i><span>Add Single</span>
                                    </a>
                                    <a href="{{ route('attendances.create-or-edit-multiple') }}"class="btn btn-light shadow rounded m-0">
                                        <i class="fas fa-solid fa-list-check p-1"></i><span>Add Multiple</span>
                                    </a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-striped table-bordered table-centre">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Employee Name</th>
                                                    <th>Date</th>
                                                    <th>In Time</th>
                                                    <th>Out Time</th>
                                                    <th>Worked Hour</th>
                                                    <th>Over Time</th>
                                                    <th>Note</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($attendances as $attendance)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $attendance->employee->name }}</td>
                                                        <td>{{ date_format(date_create($attendance->date),"d M Y") }}</td>
                                                        <td>{{ date_format(date_create($attendance->in_at),"h:i A") }}</td>
                                                        <td>
                                                            @if($attendance->out_at)
                                                                {{ date_format(date_create($attendance->out_at),"h:i A") }}
                                                            @else
                                                                <a href="{{ route('attendances.edit', $attendance->id) }}" class="badge badge-danger">Set Out Time</i></a>
                                                            @endif
                                                        </td>
                                                        <td>{{ $attendance->worked_hour }} h</td>
                                                        <td>{{ $attendance->over_time_hour }} h</td>
                                                        <td>{{ $attendance->note }}</td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <a href="{{ route('attendances.edit', $attendance->id) }}"
                                                                    class="btn btn-info">
                                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                                </a>
                                                                <form class="delete" action="{{ route('attendances.destroy', $attendance->id) }}" method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">
                                                                        <i class="fa-solid fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Employee Name</th>
                                                    <th>Date</th>
                                                    <th>In Time</th>
                                                    <th>Out Time</th>
                                                    <th>Worked Hour</th>
                                                    <th>Over Time</th>
                                                    <th>Note</th>
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
