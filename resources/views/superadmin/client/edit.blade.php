@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.admin.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Client</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Client</li>
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
                                <h3 class="card-title">Edit Client</h3>
                            </div>
                            <form action="{{  route('client.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf()
                                <input type="hidden" name="client_id" value="{{$data->id}}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                            <label>Full Name</label>
                                            <input value="{{ $data->name ?? null }}" required type="text" class="form-control" name="name"
                                                placeholder="Full Name">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                            <label>Email</label>
                                            <input value="{{ $data->email ?? null }}" required type="text" class="form-control" name="email" placeholder="Email">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                            <label>Contact No.</label>
                                            <input value="{{ $data->mobile ?? null }}" required type="number" class="form-control" name="mobile"
                                                placeholder="01XXXXXXXXX">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                            <label>Packages</label>
                                            <select name="package_id" id="package_id" class="form-control">
                                                <option value="" selected disabled>Select Package</option>
                                                @foreach ($packages as $package)
                                                    <option value="{{$package->id}}" @if ($package->id == $data->package_id ) selected @endif>{{$package->package_name}}</option>
                                                @endforeach
                                              
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                            <label>Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option @selected(($data->status ?? null) === 1) value="1">Active</option>
                                                <option @selected(($data->status ?? null) === 0) value="0">Inactive</option>
                                            </select>
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
