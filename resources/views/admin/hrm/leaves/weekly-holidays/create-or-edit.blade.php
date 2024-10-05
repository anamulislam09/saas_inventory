@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Holiday</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Holiday</li>
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
                            <form action="{{ route('weekly-holidays.update',$data['item']->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf()
                                @method('put')
                                <input type="hidden" name="client_id" value="{{$data['item']->client_id}}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12" id="benefit_div">
                                            <div class="row benefit-row">
                                                <div class="form-group col-sm-12 col-md-12 col-lg">
                                                    <div class="custom-control custom-switch custom-switch-off-gray custom-switch-on-success child-menu">
                                                        <input {{ $data['item']->saturday?'checked':null }} name="saturday" type="checkbox" class="custom-control-input" id="saturday">
                                                        <label class="custom-control-label" for="saturday">Saturday</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12 col-md-12 col-lg">
                                                    <div class="custom-control custom-switch custom-switch-off-gray custom-switch-on-success child-menu">
                                                        <input {{ $data['item']->sunday?'checked':null }} name="sunday" type="checkbox" class="custom-control-input" id="sunday">
                                                        <label class="custom-control-label" for="sunday">Sunday</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12 col-md-12 col-lg">
                                                    <div class="custom-control custom-switch custom-switch-off-gray custom-switch-on-success child-menu">
                                                        <input {{ $data['item']->monday?'checked':null }} name="monday" type="checkbox" class="custom-control-input" id="monday">
                                                        <label class="custom-control-label" for="monday">Monday</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12 col-md-12 col-lg">
                                                    <div class="custom-control custom-switch custom-switch-off-gray custom-switch-on-success child-menu">
                                                        <input {{ $data['item']->tuesday?'checked':null }} name="tuesday" type="checkbox" class="custom-control-input" id="tuesday">
                                                        <label class="custom-control-label" for="tuesday">Tuesday</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12 col-md-12 col-lg">
                                                    <div class="custom-control custom-switch custom-switch-off-gray custom-switch-on-success child-menu">
                                                        <input {{ $data['item']->wednesday?'checked':null }} name="wednesday" type="checkbox" class="custom-control-input" id="wednesday">
                                                        <label class="custom-control-label" for="wednesday">Wednesday</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12 col-md-12 col-lg">
                                                    <div class="custom-control custom-switch custom-switch-off-gray custom-switch-on-success child-menu">
                                                        <input {{ $data['item']->thursday?'checked':null }} name="thursday" type="checkbox" class="custom-control-input" id="thursday">
                                                        <label class="custom-control-label" for="thursday">Thursday</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12 col-md-12 col-lg">
                                                    <div class="custom-control custom-switch custom-switch-off-gray custom-switch-on-success child-menu">
                                                        <input {{ $data['item']->friday?'checked':null }} name="friday" type="checkbox" class="custom-control-input" id="friday">
                                                        <label class="custom-control-label" for="friday">Friday</label>
                                                    </div>
                                                </div>
                                            </div>
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