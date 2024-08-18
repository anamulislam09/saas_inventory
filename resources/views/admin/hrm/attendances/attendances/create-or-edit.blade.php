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
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ $data['title'] }} Form</h3>
                            </div>
                            <form action="{{ isset($data['item']) ? route('attendances.update',$data['item']->id) : route('attendances.store'); }}" method="POST" enctype="multipart/form-data">
                                @csrf()
                                @if(isset($data['item']))
                                    @method('put')
                                @endif
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                            <label>Employee *</label>
                                            <select name="employee_id" id="employee_id" class="form-control" required>
                                                <option value="">Select Employee</option>
                                                @foreach($data['employees'] as $employee)
                                                    <option  @isset($data['item']) @if( $data['item']->employee_id == $employee->id ) selected @endif @endisset value="{{ $employee->id }}">{{ $employee->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                            <label>Date *</label>
                                            <input value="{{ isset($data['item']) ? $data['item']->date : Date('Y-m-d') }}" type="date" class="form-control" name="date" id="date" required>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                            <label>In Time *</label>
                                            <input value="{{ isset($data['item']) ? $data['item']->in_at : Date('Y-m-d\TH:i', time()) }}" type="datetime-local" class="form-control" name="in_at" id="in_at" required>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                            @php
                                                if(isset($data['item'])){
                                                    if($data['item']->out_at){
                                                        $out_time = $data['item']->out_at;
                                                    }else{
                                                        $out_time = Date('Y-m-d\TH:i', time());
                                                    }
                                                }else{
                                                    $out_time = null;
                                                }
                                            @endphp
                                            <label>Out Time</label>
                                            <input value="{{ $out_time }}" type="datetime-local" class="form-control" name="out_at" id="out_at">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                            <label>Note</label>
                                            <input value="{{ isset($data['item']) ? $data['item']->note : null }}" type="text" class="form-control" name="note" id="note" placeholder="Note">
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