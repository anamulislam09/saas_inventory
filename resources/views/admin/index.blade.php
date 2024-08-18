@inject('authorization', 'App\Services\AuthorizationService')
@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.admin.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <div class="col-sm-6 text-white">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    @if($authorization->hasMenuAccess(2))
                        <div class="col">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $data['my_orders'] }}</h3>
                                    <p>My Today's Orders</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endif
                    @if($authorization->hasMenuAccess(3))
                        <div class="col">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $data['pending_orders'] }}</h3>
                                    <p>Pending Orders</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endif
                    @if($authorization->hasMenuAccess(4))
                        <div class="col">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $data['pending_collections'] }}</h3>
                                    <p>Pending Collections</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endif
                    @if($authorization->hasMenuAccess(5))
                        <div class="col">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $data['pending_orders_in_kit'] }}</h3>
                                    <p>Pending In Kitchen</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endif
                    @if($authorization->hasMenuAccess(6))
                        <div class="col">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $data['todays_orders'] }}</h3>
                                    <p>Today's Orders</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row">
                    @if($authorization->hasMenuAccess(7))
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-dark">
                                <div class="inner">
                                    <h3>{{ $data['currency_symbol'] }} {{ $data['todays_collections'] }}</h3>
                                    <p>Today's Collections</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endif
                    @if($authorization->hasMenuAccess(8))
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-dark">
                                <div class="inner">
                                    <h3>{{ $data['currency_symbol'] }} {{ $data['weekly_collections'] }}</h3>
                                    <p>Weekly Collections</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endif
                    @if($authorization->hasMenuAccess(9))
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-dark">
                                <div class="inner">
                                    <h3>{{ $data['currency_symbol'] }} {{ $data['monthly_collections'] }}</h3>
                                    <p>Monthly Collections</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endif
                    @if($authorization->hasMenuAccess(10))
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-dark">
                                <div class="inner">
                                    <h3>{{ $data['currency_symbol'] }} {{ $data['total_collections'] }}</h3>
                                    <p>Total Collections</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection
