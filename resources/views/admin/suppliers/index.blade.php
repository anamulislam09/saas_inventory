@extends('layouts.admin.master')
@section('content')
@inject('authorization', 'App\Services\AuthorizationService')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.admin.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Suppliers</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Suppliers</li>
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
                                        $authorization->hasMenuAccess(104) ||
                                            (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                        <a href="{{ route('suppliers.create') }}"class="btn btn-light shadow rounded m-0"><i
                                                class="fas fa-plus"></i>
                                            <span>Add New</span></i></a>
                                    @else
                                        <span class="btn btn-light shadow rounded m-0">Suppliers</span>
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
                                                    <th>Supplier Name</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Address</th>
                                                    {{-- <th>Organization</th> --}}
                                                    {{-- <th>Opening Payable</th>
                                                    <th>Opening Receivable</th> --}}
                                                    <th>Current Bal</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data['suppliers'] as $supplier)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $supplier->name }}</td>
                                                        <td>{{ $supplier->phone }}</td>
                                                        <td>{{ $supplier->email }}</td>
                                                        <td>{{ $supplier->address }}</td>
                                                        {{-- <td>{{ $supplier->organization }}</td> --}}
                                                        {{-- <td>{{ $data['currency_symbol'] }} {{ number_format($supplier->opening_payable,2) }}</td>
                                                        <td>{{ $data['currency_symbol'] }} {{ number_format($supplier->opening_receivable,2) }}</td> --}}
                                                        <td>{{ $data['currency_symbol'] }}
                                                            {{ number_format($supplier->current_balance, 2) }}</td>
                                                        <td><span
                                                                class="badge badge-{{ $supplier->status == 1 ? 'success' : 'danger' }}">{{ $supplier->status == 1 ? 'Active' : 'Inactive' }}</span>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                @if (
                                                                    $authorization->hasMenuAccess(105) ||
                                                                        (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                                                    <a href="{{ route('suppliers.edit', $supplier->id) }}"
                                                                        class="btn btn-info">
                                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                                    </a>
                                                                @endif
                                                                @if (
                                                                    $authorization->hasMenuAccess(106) ||
                                                                        (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                                                    <form class="delete"
                                                                        action="{{ route('suppliers.destroy', $supplier->id) }}"
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
