@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.admin.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">HR Settings</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">HR Settings</li>
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
                                        <table id="example1" class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <th>Office Start Time</th>
                                                    <td>
                                                        {{ date_format(date_create($hrsettings->office_start_at),'h:i A') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Office End Time</th>
                                                    <td>
                                                        {{ date_format(date_create($hrsettings->office_end_at),'h:i A') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Daily Work Hours</th>
                                                    <td>
                                                        {{ $hrsettings->daily_work_hour }} h
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Over Time Rate</th>
                                                    <td>
                                                        {{ $hrsettings->overtime_rate * 100 }}% of main Salary
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Equivalent Absences</th>
                                                    <td>
                                                        {{ $hrsettings->equivalent_absences }} Days Late = 1 Absent
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('hrsettings.edit', $hrsettings->id) }}" class="btn btn-primary">Edit</a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>
@endsection