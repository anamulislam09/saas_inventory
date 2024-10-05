@extends('layouts.admin.master')
@section('content')
    @inject('authorization', 'App\Services\AuthorizationService')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.admin.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Departments</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Departments</li>
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
                                        $authorization->hasMenuAccess(146) ||
                                            (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                        <a href="{{ route('departments.create') }}"class="btn btn-light shadow rounded m-0"><i
                                                class="fas fa-plus"></i>
                                            <span>Add New</span></i></a>
                                    @else
                                        <span class="btn btn-light shadow rounded m-0">Departments</span>
                                    @endif
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-striped table-bordered table-centre">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Title</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($departments as $department)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $department->title }}</td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                @if (
                                                                    $authorization->hasMenuAccess(147) ||
                                                                        (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                                                    <a href="{{ route('departments.edit', $department->id) }}"
                                                                        class="btn btn-info">
                                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                                    </a>
                                                                @endif
                                                                @if (
                                                                    $authorization->hasMenuAccess(148) ||
                                                                        (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                                                    <form class="delete"
                                                                        action="{{ route('departments.destroy', $department->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger">
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
                                                    <th>Title</th>
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
