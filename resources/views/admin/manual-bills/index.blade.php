@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.admin.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manual Bills</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manual Bills</li>
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
                                    <a href="{{ route('manual-bills.create') }}"class="btn btn-light shadow rounded m-0"><i
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
                                                    <th>Created At</th>
                                                    <th>Processed At</th>
                                                    <th>Note</th>
                                                    <th>Order Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $badge = ['danger','warning','dark','info','primary','success'];
                                                    $order_status = ['Pending','Approved','Cancelled','Processing','Incomplete','Completed'];
                                                @endphp
                                                @foreach ($data['orders'] as $order)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td><a target="_blank" href="{{ route('collections.receipt', $order->id) }}"><b>{{ $order->order_no }}</b></a></td>
                                                        <td>{{ $order->table->title }}</td>
                                                        <td>{{ $data['currency_symbol'] }} {{ $order->net_bill }}</td>
                                                        <td>@if($order->created_at){{ date_format(date_create($order->created_at),"d M Y h:i:s a") }}@endif</td>
                                                        <td>@if($order->processed_at){{ date_format(date_create($order->processed_at),"d M Y h:i:s a") }}@endif</td>
                                                        <td>{{ $order->note }}</td>
                                                        <td><button type="button" order-id="{{ $order->id }}" class="{{ $order->order_status == 4 ? 'complete' : null }} btn btn-sm btn-{{ $badge[$order->order_status] }}">{{ $order_status[$order->order_status] }}</button></td>
                                                        <td hidden><span class="badge badge-{{ $order->payment_status == 1 ? 'success' : 'danger' }}">{{ $order->payment_status==1? 'Paid' : 'Unpaid' }}</span></td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <a target="_blank" href="{{ route('collections.receipt', $order->id) }}" class="btn btn-warning ml-1">
                                                                    <i class="fa fa-print"></i>
                                                                </a>
                                                                <a href="{{ route('manual-bills.edit', $order->id) }}" class="btn btn-info">
                                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Order No</th>
                                                    <th>Table Title</th>
                                                    <th>Total Amount</th>
                                                    <th>Created At</th>
                                                    <th>Processed At</th>
                                                    <th>Note</th>
                                                    <th>Order Status</th>
                                                    <th>Action</th>
                                                </tr>
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
@section('script')
<script>
    $('.complete').click(function(e) {
            e.preventDefault();

            order_id = $(this).attr('order-id');

            let element = $(this);
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "No",
                confirmButtonText: "Yes, Complete it!"
            }).then(async (result) => {
                if (result.isConfirmed) {
                    url = '{{ route("manual-bills.complete", ":id") }}'.replace(":id",order_id);
                    res = await nsAjaxGet(url);
                    if(res){
                        location.reload();
                    }
                }
            })
        });
</script>
@endsection
