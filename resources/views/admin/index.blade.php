@inject('authorization', 'App\Services\AuthorizationService')
@extends('layouts.admin.master')
@section('content')
<style>
   .small-box p{color: white;}
    h3{
        color:white;
    }
</style>
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
                    @if($authorization->hasMenuAccess(2) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                        <div class="col">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $data['category'] }}</h3>
                                    <p>Total Category</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endif
                    @if($authorization->hasMenuAccess(3) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                        <div class="col">
                            <div class="small-box" style="background: #6571FF">
                                <div class="inner">
                                    <h3>{{ $data['sub_category'] }}</h3>
                                    <p>Total SubCategory</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endif
                    @if($authorization->hasMenuAccess(4) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                        <div class="col">
                            <div class="small-box" style="background: #0AC074">
                                <div class="inner">
                                    <h3>{{ $data['product'] }}</h3>
                                    <p>Total Products</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endif
                    @if($authorization->hasMenuAccess(5) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                        <div class="col">
                            <div class="small-box " style="background:#0099FB">
                                <div class="inner">
                                    <h3>{{ $data['customer'] }}</h3>
                                    <p>Total Customers</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endif
                    @if($authorization->hasMenuAccess(6) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                        <div class="col">
                            <div class="small-box" style="background: #FFB821">
                                <div class="inner">
                                    <h3>{{ $data['supplier'] }}</h3>
                                    <p>Total Suppliers</p>
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
                    @if($authorization->hasMenuAccess(7) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-dark">
                                <div class="inner">
                                    <h3>{{ $data['currency_symbol'] }} {{ $data['purchase'] }}</h3>
                                    <p>Total Purchase</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endif
                    @if($authorization->hasMenuAccess(8) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                        <div class="col-lg-3 col-6">
                            <div class="small-box" style="background:#6F42C1">
                                <div class="inner">
                                    <h3>{{ $data['currency_symbol'] }} {{ $data['purchase_return'] }}</h3>
                                    <p>Purchase Return</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endif
                    @if($authorization->hasMenuAccess(189) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                        <div class="col-lg-3 col-6">
                            <div class="small-box " style="background: #E83E8C">
                                <div class="inner">
                                    <h3>{{ $data['currency_symbol'] }} {{ $data['sales'] }}</h3>
                                    <p>Total Sales</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endif
                    @if($authorization->hasMenuAccess(190) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                        <div class="col-lg-3 col-6">
                            <div class="small-box" style="background: #b36288">
                                <div class="inner">
                                    <h3>{{ $data['currency_symbol'] }} {{ $data['sales_return'] }}</h3>
                                    <p>Sales Return</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endif
                    @if($authorization->hasMenuAccess(191) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                        <div class="col-lg-3 col-6">
                            <div class="small-box " style="background: #00C6FF">
                                <div class="inner">
                                    <h3>{{ $data['currency_symbol'] }} {{ $data['todaySales'] }}</h3>
                                    <p>Today Sales</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endif
                    @if($authorization->hasMenuAccess(192) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                        <div class="col-lg-3 col-6">
                            <div class="small-box " style="background: #FF0000">
                                <div class="inner">
                                    <h3>{{ $data['currency_symbol'] }} {{ $data['todayPurchase'] }}</h3>
                                    <p>Today Purchase</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endif
                    @if($authorization->hasMenuAccess(193) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                        <div class="col-lg-3 col-6">
                            <div class="small-box " style="background: #707fef">
                                <div class="inner">
                                    <h3>{{ $data['currency_symbol'] }} {{ $data['expense'] }}</h3>
                                    <p>Today Expense</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endif
                    @if($authorization->hasMenuAccess(194) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                        <div class="col-lg-3 col-6">
                            <div class="small-box" style="background: #FB5200">
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
                    @if($authorization->hasMenuAccess(10) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                        <div class="col-lg-3 col-6">
                            <div class="small-box " style="background:#9FE080">
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
