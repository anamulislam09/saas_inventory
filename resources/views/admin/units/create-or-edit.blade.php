@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Units</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Units</li>
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
                                <h3 class="card-title">{{ $data['title'] }} Form</h3>
                            </div>
                            <form action="{{ isset($data['item']) ? route('units.update',$data['item']->id) : route('units.store'); }}" method="POST" enctype="multipart/form-data">
                                @csrf()
                                @if(isset($data['item']))
                                    @method('put')
                                @endif
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                            <label>Title *</label>
                                            <input value="{{ isset($data['item']) ? $data['item']->title : null }}" type="text" class="form-control" name="title" placeholder="Title" required>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                            <label>Status *</label>
                                            <select name="status" id="status" class="form-control">
                                                <option {{ isset($data['item']) ? $data['item']->status == 1 ? 'selected' : null : null }} value="1">Active</option>
                                                <option {{ isset($data['item']) ? $data['item']->status == 0 ? 'selected' : null : null }} value="0">Inactive</option>
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