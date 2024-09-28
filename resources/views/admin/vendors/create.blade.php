@extends('layouts.admin.master')
@section('content')
    @inject('authorization', 'App\Services\AuthorizationService')
    <style>
        table,
        tr,
        th,
        td {
            font-size: 14px;
            padding: 10px !important;
        }
    </style>
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.admin.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Customer</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Customer</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ $data['title'] }} Form</h3>
                            </div>
                            <form id="customerForm"
                                action="{{ isset($data['item']) ? route('customers.update', $data['item']->id) : route('customers.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($data['item']))
                                    @method('put')
                                @endif
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label>Customer Name *</label>
                                            <input value="{{ isset($data['item']) ? $data['item']->name : null }}"
                                                type="text" class="form-control" name="name"
                                                placeholder="Customer Name" required>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label>Phone *</label>
                                            <input value="{{ isset($data['item']) ? $data['item']->phone : null }}"
                                                type="number" class="form-control" name="phone"
                                                placeholder="+8801XXXXXXXXX" required>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label>Address</label>
                                            <input class="form-control" name="address" placeholder="Enter Address"
                                                value="{{ isset($data['item']) ? $data['item']->address : null }}">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label>Status *</label>
                                            <select name="status" class="form-control">
                                                <option value="1"
                                                    {{ isset($data['item']) && $data['item']->status == 1 ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="0"
                                                    {{ isset($data['item']) && $data['item']->status == 0 ? 'selected' : '' }}>
                                                    Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    @if (
                                        $authorization->hasMenuAccess(180) ||
                                            (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    @else
                                    <span style="color:#fb5200; font-size:14px;">You do not have permission to create customers </span>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">All Customers</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Customer Name</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data['vendors'] as $vendor)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $vendor->name }}</td>
                                                    <td>{{ $vendor->phone }}</td>
                                                    <td>{{ $vendor->address }}</td>
                                                    <td>
                                                        <span
                                                            class="badge badge-{{ $vendor->status == 1 ? 'success' : 'danger' }}">
                                                            {{ $vendor->status == 1 ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </td>
                                                    <td class="d-flex">
                                                        @if (
                                                            $authorization->hasMenuAccess(181) ||
                                                                (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                                            <a href="#" class="btn btn-sm btn-info edit"
                                                                style="font-size: 12px" data-id="{{ $vendor->id }}"
                                                                data-toggle="modal" data-target="#editcustomer">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </a>
                                                        @endif

                                                        @if (
                                                            $authorization->hasMenuAccess(182) ||
                                                                (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                                            <form action="{{ route('customers.destroy', $vendor->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger"
                                                                    style="font-size: 12px">
                                                                    <i class="fa-solid fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="editcustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Customer </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal_body">

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('body').on('click', '.edit', function() {
            let pid = $(this).data('id');
            let url = '{{ route('customers.edit', ':id') }}'.replace(":id", pid)

            $.get(url, function(data) {
                console.log(data);
                $('#modal_body').html(data);
            });
        });
    </script>
@endsection
