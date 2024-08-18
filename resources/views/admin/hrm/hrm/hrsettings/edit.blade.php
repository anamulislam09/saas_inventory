@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="form-group col-sm-6">
                        <h1 class="m-0">HR Settings</h1>
                    </div>
                    <div class="form-group col-sm-6">
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
                    <div class="form-group col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Form</h3>
                            </div>
                            <form action="{{ route('hrsettings.update', $hrsettings->id)}}" method="POST" enctype="multipart/form-data">
                              @csrf
                              @method('put')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                            <label class="form-label">Office Start At *</label>
                                            <input type="time" class="form-control" id="office_start_at" name="office_start_at"
                                                value="{{ $hrsettings->office_start_at }}" required>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                            <label class="form-label">Office End At *</label>
                                            <input type="time" class="form-control" id="office_end_at" name="office_end_at"
                                                value="{{ $hrsettings->office_end_at }}" required>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                            <label class="form-label">Over Time Rate (% of Salary) *</label>
                                            <input type="number" class="form-control" id="overtime_rate" name="overtime_rate"
                                                value="{{ $hrsettings->overtime_rate * 100 }}" placeholder="0.00" required>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                            <label class="form-label">Equivalent Absences Late *</label>
                                            <input type="number" class="form-control" id="equivalent_absences" name="equivalent_absences"
                                                value="{{ $hrsettings->equivalent_absences }}" placeholder="3 day late = 1 absent" required>
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