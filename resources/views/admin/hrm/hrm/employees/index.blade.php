@extends('layouts.admin.master')
@section('content')
    @inject('authorization', 'App\Services\AuthorizationService')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.admin.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Employee</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Employee</li>
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

                                    @if (
                                        $authorization->hasMenuAccess(153) ||
                                            (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                        <a href="{{ route('employees.create') }}"class="btn btn-light shadow rounded m-0"><i
                                                class="fas fa-plus"></i>
                                            <span>Add New</span></i></a>
                                    @else
                                        <span class="btn btn-light shadow rounded m-0">Employee</span>
                                    @endif
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table id="employee_table" class="table table-striped table-bordered table-centre">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Contact</th>
                                                    <th>Country</th>
                                                    <th>State</th>
                                                    <th>City</th>
                                                    <th>ZIP</th>
                                                    <th>Division</th>
                                                    <th>Designation</th>
                                                    <th>Duty Type</th>
                                                    <th>Hire Date</th>
                                                    <th>Original Hire Date</th>
                                                    <th>Termination Date</th>
                                                    <th>Termination Reason</th>
                                                    <th>Termination Voluntary</th>
                                                    <th>Rehire Date</th>
                                                    <th>Rate Type</th>
                                                    <th>Rate</th>
                                                    <th>Bonus</th>
                                                    <th>Pay Frequency</th>
                                                    <th>Pay Frequency Descriptions</th>
                                                    <th>Allocate Leave Days</th>
                                                    <th>Remaining Leave Days</th>
                                                    <th>Date Of Birth</th>
                                                    <th>Gender</th>
                                                    <th>Marital Status</th>
                                                    <th>Ethnic Group</th>
                                                    <th>EEO Class</th>
                                                    <th>SSN</th>
                                                    <th>Work In State</th>
                                                    <th>Live In State</th>
                                                    <th>Image</th>
                                                    <th>Home Email</th>
                                                    <th>Home Phone</th>
                                                    <th>Cell Phone</th>
                                                    <th>Business Email</th>
                                                    <th>Business Phone</th>
                                                    <th>Emergency Contact</th>
                                                    <th>Emergency Contact Alt</th>
                                                    <th>Emergency Home Contact</th>
                                                    <th>Emergency Contact Home Alt</th>
                                                    <th>Emergency Work Contact</th>
                                                    <th>Emergency Contact Work Alt</th>
                                                    <th>Emergency Contact Relations</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($employees as $employee)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td> {{ $employee->name }} </td>
                                                        <td> {{ $employee->email }} </td>
                                                        <td> {{ $employee->contact }} </td>
                                                        <td> {{ $employee->country->country_name }} </td>
                                                        <td> {{ $employee->state }} </td>
                                                        <td> {{ $employee->city }} </td>
                                                        <td> {{ $employee->zip }} </td>
                                                        <td> {{ $employee->division->title }} </td>
                                                        <td> {{ $employee->designation->title }} </td>
                                                        <td> {{ $employee->duty_type }} </td>
                                                        <td> {{ $employee->hire_date }} </td>
                                                        <td> {{ $employee->original_hire_date }} </td>
                                                        <td> {{ $employee->termination_date }} </td>
                                                        <td> {{ $employee->termination_reason }} </td>
                                                        <td> {{ $employee->termination_voluntary }} </td>
                                                        <td> {{ $employee->rehire_date }} </td>
                                                        <td> {{ $employee->rate_type }} </td>
                                                        <td> {{ $employee->rate }} </td>
                                                        <td> {{ $employee->bonus }} </td>
                                                        <td> {{ $employee->pay_frequency }} </td>
                                                        <td> {{ $employee->pay_frequency_desc }} </td>
                                                        <td> {{ $employee->allocate_leave }} </td>
                                                        <td> {{ $employee->remaining_leave }} </td>
                                                        <td> {{ $employee->date_of_birth }} </td>
                                                        <td> {{ $employee->gender }} </td>
                                                        <td> {{ $employee->marital_status }} </td>
                                                        <td> {{ $employee->ethnic_group }} </td>
                                                        <td> {{ $employee->eeo_class }} </td>
                                                        <td> {{ $employee->ssn }} </td>
                                                        <td> {{ $employee->work_in_state }} </td>
                                                        <td> {{ $employee->live_in_state }} </td>
                                                        <td>
                                                            @if ($employee->image)
                                                                <img src="{{ asset('public/uploads/employee/' . $employee->image) }}"
                                                                    height="50px" width="50px">
                                                            @endif
                                                        </td>
                                                        <td> {{ $employee->home_email }} </td>
                                                        <td> {{ $employee->home_phone }} </td>
                                                        <td> {{ $employee->cell_phone }} </td>
                                                        <td> {{ $employee->business_email }} </td>
                                                        <td> {{ $employee->business_phone }} </td>
                                                        <td> {{ $employee->emerg_cont }} </td>
                                                        <td> {{ $employee->emerg_cont_alt }} </td>
                                                        <td> {{ $employee->emerg_home_cont }} </td>
                                                        <td> {{ $employee->emerg_cont_home_alt }} </td>
                                                        <td> {{ $employee->emerg_work_cont }} </td>
                                                        <td> {{ $employee->emerg_cont_work_alt }} </td>
                                                        <td> {{ $employee->emerg_cont_relations }} </td>
                                                        <td> {{ $employee->status == 1 ? 'Active' : 'Inactive' }} </td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                @if (
                                                                    $authorization->hasMenuAccess(154) ||
                                                                        (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                                                    <a href="{{ route('employees.edit', $employee->id) }}"
                                                                        class="btn btn-info">
                                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                                    </a>
                                                                @endif
                                                                @if (
                                                                    $authorization->hasMenuAccess(155) ||
                                                                        (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                                                    <form id="form"
                                                                        action="{{ route('employees.destroy', $employee->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button onclick="del()" Type="button"
                                                                            class="btn btn-danger">
                                                                            <i class="fa-solid fa-trash"></i>
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Contact</th>
                                                    <th>Country</th>
                                                    <th>State</th>
                                                    <th>City</th>
                                                    <th>ZIP</th>
                                                    <th>Division</th>
                                                    <th>Designation</th>
                                                    <th>Duty Type</th>
                                                    <th>Hire Date</th>
                                                    <th>Original Hire Date</th>
                                                    <th>Termination Date</th>
                                                    <th>Termination Reason</th>
                                                    <th>Termination Voluntary</th>
                                                    <th>Rehire Date</th>
                                                    <th>Rate Type</th>
                                                    <th>Rate</th>
                                                    <th>Bonus</th>
                                                    <th>Pay Frequency</th>
                                                    <th>Pay Frequency Descriptions</th>
                                                    <th>Allocate Leave Days</th>
                                                    <th>Remaining Leave Days</th>
                                                    <th>Date Of Birth</th>
                                                    <th>Gender</th>
                                                    <th>Marital Status</th>
                                                    <th>Ethnic Group</th>
                                                    <th>EEO Class</th>
                                                    <th>SSN</th>
                                                    <th>Work In State</th>
                                                    <th>Live In State</th>
                                                    <th>Image</th>
                                                    <th>Home Email</th>
                                                    <th>Home Phone</th>
                                                    <th>Cell Phone</th>
                                                    <th>Business Email</th>
                                                    <th>Business Phone</th>
                                                    <th>Emergency Contact</th>
                                                    <th>Emergency Contact Alt</th>
                                                    <th>Emergency Home Contact</th>
                                                    <th>Emergency Contact Home Alt</th>
                                                    <th>Emergency Work Contact</th>
                                                    <th>Emergency Contact Work Alt</th>
                                                    <th>Emergency Contact Relations</th>
                                                    <th>Status</th>
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
        $('#employee_table').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
        });

        function del() {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                result.isConfirmed && $('#form').submit();
            });
        }
    </script>
@endsection
