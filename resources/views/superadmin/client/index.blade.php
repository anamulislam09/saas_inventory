@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.admin.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Admin</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Admin</li>
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
                                    <a href="{{ route('client.create') }}"class="btn btn-light shadow rounded m-0"><i
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
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>NID/NRC</th>
                                                    <th>Address</th>
                                                    <th>Package</th>
                                                    <th>Validation Status</th>
                                                    <th>Image</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($clients as $client)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $client->name }}</td>
                                                        <td>{{ $client->mobile }}</td>
                                                        <td>{{ $client->email }}</td>
                                                        <td>{{ $client->nid_no }}</td>
                                                        <td>{{ $client->address }}</td>
                                                        <td>{{ $client->address }}</td>
                                                        @php
                                                            $today = Carbon\Carbon::today()->toDateString();
                                                            $datetime1 = new DateTime($client->package_start_date);
                                                            $datetime2 = new DateTime($today);
                                                            $difference = $datetime1->diff($datetime2);
                                                        @endphp

                                                        <td>
                                                            @if (!empty($package))
                                                                @if ($difference->days > $package->duration)
                                                                    <span class="badge badge-danger">Expired</span>
                                                                @elseif ($package->duration - $difference->days <= 30)
                                                                    <span class="badge badge-warning">Expeired Soon</span>
                                                                @else
                                                                    <span class="badge badge-primary">Done</span>
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <img width="50px" height="50px"
                                                                src="{{ asset('public/uploads/admin/' . ($client->image ? $client->image : 'placeholder.png')) }}">
                                                        </td>
                                                        <td>
                                                            {{-- @if ($client->status == 1)
                                                                <a href="{{route('client.notactive', $client->id)}}" class="deactive_status"><i
                                                                        class="fas fa-thumbs-down text-danger pr-1"></i><span
                                                                        class="badge badge-success ">Active</span></a>
                                                            @else
                                                                <a href="{{route('client.active', $client->id)}}" class="active_status"><i
                                                                        class="fas fa-thumbs-up text-primary pr-1"></i><span
                                                                        class="badge badge-danger ">Deactive</span></a>
                                                            @endif --}}
                                                            @if ($client->status == 1)
                                                                <span class="badge badge-success">Active</span>
                                                            @else
                                                                <span class="badge badge-danger">Inactive</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <a href="{{ route('client.edit', $client->id) }}"
                                                                    class="btn btn-sm btn-info">
                                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                                </a>
                                                                <form action="{{ route('client.destroy', $client->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                                        <i class="fa-solid fa-trash-can"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
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
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>

    <script>
        //   {{-- active_status --}}
        $('body').on('click', '.active_status', function() {
            var href = $(this).attr('href');
            var url = href;
            $.ajax({
                url: url,
                type: 'get',
                success: function(data) {
                    toastr.success(data);
                    window.location.reload()
                }
            })
        })

        // {{--  deactive_status --}}
        $('body').on('click', '.deactive_status', function() {
            var href = $(this).attr('href');
            var url = href;
            $.ajax({
                url: url,
                type: 'get',
                success: function(data) {
                    toastr.success(data);
                    window.location.reload()
                }
            })
        })
        // {{-- status ajax ends here --}}
    </script>
@endsection
