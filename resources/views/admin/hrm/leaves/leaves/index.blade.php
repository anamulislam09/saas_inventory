@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.admin.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Leave</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Leave</li>
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
                                    <a href="{{ route('leaves.create') }}"class="btn btn-light shadow rounded m-0"><i
                                            class="fas fa-plus"></i>
                                        <span>Add New</span></i></a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-striped table-bordered table-centre">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Leave Taken By</th>
                                                    <th>Duty Handover To</th>
                                                    <th>Leave Type</th>
                                                    <th>Application Start Date</th>
                                                    <th>Application End Date</th>
                                                    <th>Application Days</th>
                                                    <th>Approved Start Date</th>
                                                    <th>Approved End Date</th>
                                                    <th>Approved Days</th>
                                                    <th>Reason</th>
                                                    <th>Application Hard Copy</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($leaves as $leave)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ isset($leave->leave_taken_by) ? $leave->leave_taken_by->name : null }}</td>
                                                    <td>{{ isset($leave->duty_handover_to) ? $leave->duty_handover_to->name : null }}</td>
                                                    <td>{{ isset($leave->leaveType) ? $leave->leaveType->name : null }}</td>
                                                    <td>{{ $leave->application_start_date }}</td>
                                                    <td>{{ $leave->application_end_date }}</td>
                                                    <td>{{ $leave->application_days }} Days</td>
                                                    <td>{{ $leave->approved_start_date }}</td>
                                                    <td>{{ $leave->approved_end_date }}</td>
                                                    <td>{{ $leave->approved_days }} Days</td>
                                                    <td>{{ $leave->reason }}</td>
                                                    <td>
                                                        @if($leave->image)
                                                            <img src="{{ asset('public/uploads/leave-application/' . $leave->image) }}" height="50px" width="50px">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <a href="{{ route('leaves.edit', $leave->id) }}"
                                                                class="btn btn-info">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </a>
                                                            <form class="delete" action="{{ route('leaves.destroy', $leave->id) }}" method="post">
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
                                                    <th>Leave Taken By</th>
                                                    <th>Duty Handover To</th>
                                                    <th>Leave Type</th>
                                                    <th>Application Start Date</th>
                                                    <th>Application End Date</th>
                                                    <th>Application Days</th>
                                                    <th>Approved Start Date</th>
                                                    <th>Approved End Date</th>
                                                    <th>Approved Days</th>
                                                    <th>Reason</th>
                                                    <th>Application Hard Copy</th>
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
