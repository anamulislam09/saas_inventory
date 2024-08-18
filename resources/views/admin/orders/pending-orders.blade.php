@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.admin.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Pending Orders</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pending Orders</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    @foreach ($orders as $order)
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="small-box bg-dark">
                                <div class="inner">
                                    <h5>{{ $order->table->title }}</h5>
                                    <span>Order No - {{ $order->order_no }}</span>
                                    <ul style="list-style-type: none;">
                                        @foreach($order->order_details as $key => $ods)
                                            <li class="m-1">
                                                @if($ods->item->image)
                                                    <img src="{{ asset('public/uploads/items/' . $ods->item->image) }}" height="50px" width="50px">
                                                @endif
                                                {{ $ods->item->title }} {{ $ods->quantity }}x
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-center">
                                            <form action="{{ route('orders.approve') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $order->id }}">
                                                <input type="hidden" name="order_status" value="1">
                                                <button class="btn btn-sm btn-success p-1" type="submit">Approve</button>
                                            </form>
                                            <form action="{{ route('orders.cancel') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $order->id }}">
                                                <input type="hidden" name="order_status" value="2">
                                                <button class="btn btn-sm btn-danger p-1 ml-4" type="submit">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="icon">
                                    <i class="fa-solid fa-burger"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
