@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.admin.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Orders</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Orders</li>
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
                                    <a href="{{ route('orders.create') }}"class="btn btn-light shadow rounded m-0"><i
                                            class="fas fa-plus"></i>
                                        <span>Add New</span></i></a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-striped table-bordered table-centre">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Order No</th>
                                                    <th>Table Title</th>
                                                    <th>Total Amount</th>
                                                    <th>Vat</th>
                                                    <th>Discouont</th>
                                                    <th>Net Payable</th>
                                                    <th>Created At</th>
                                                    <th>Approved At</th>
                                                    <th>Processed At</th>
                                                    <th hidden>Completed At</th>
                                                    <th>Note</th>
                                                    <th>Order Status</th>
                                                    <th>Payment Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $badge = ['danger','warning','dark','info','primary','success'];
                                                    $order_status = ['Pending','Approved','Cancelled','Processing','Processed','Completed'];
                                                @endphp
                                                @foreach ($data['orders'] as $order)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td><a target="_blank" href="{{ route('orders.invoice', $order->id) }}"><b>{{ $order->order_no }}</b></a></td>
                                                        <td>{{ $order->table->title }}</td>
                                                        <td>{{ $data['currency_symbol'] }} {{ $order->mrp }}</td>
                                                        <td>{{ $data['currency_symbol'] }} {{ $order->vat }}</td>
                                                        <td>{{ $data['currency_symbol'] }} {{ $order->discount }}</td>
                                                        <td>{{ $data['currency_symbol'] }} {{ $order->net_bill }}</td>
                                                        <td>@if($order->created_at){{ date_format(date_create($order->created_at),"d M Y h:i:s a") }}@endif</td>
                                                        <td>@if($order->approved_at){{ date_format(date_create($order->approved_at),"d M Y h:i:s a") }}@endif</td>
                                                        <td>@if($order->processed_at){{ date_format(date_create($order->processed_at),"d M Y h:i:s a") }}@endif</td>
                                                        <td hidden>@if($order->completed_at){{ date_format(date_create($order->completed_at),"d M Y h:i:s a") }}@endif</td>
                                                        <td>{{ $order->note }}</td>
                                                        <td><span class="badge badge-{{ $badge[$order->order_status] }}">{{ $order_status[$order->order_status] }}</span></td>
                                                        <td><span class="badge badge-{{ $order->payment_status == 1 ? 'success' : 'danger' }}">{{ $order->payment_status==1? 'Paid' : 'Unpaid' }}</span></td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-info">
                                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                                </a>
                                                                <a target="_blank" href="{{ route('orders.invoice', $order->id) }}" class="btn btn-warning ml-1">
                                                                    <i class="fa fa-print"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                            </tfoot>
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
