@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.admin.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Packages</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Packages</li>
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
                                    <a href="{{ route('package.create') }}"class="btn btn-light shadow rounded m-0"><i
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
                                                    <th>SL</th>
                                                    <th>Package Name</th>
                                                    <th>Amount</th>
                                                    <th>Duration</th>
                                                    <th> Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($packages as $key => $item)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $item->package_name }}</td>
                                                        <td>{{ $item->amount }}</td>
                                                        <td>{{ $item->duration }}</td>
                                                        <td>
                                                            <a href="" class="btn btn-sm btn-info edit action"
                                                                data-id="{{ $item->id }}" data-toggle="modal"
                                                                data-target="#editUser"><i class="fas fa-edit"></i></a>
                                                            {{-- <a href="{{ route('package.delete', $item->id) }}"
                                                            class="btn btn-sm btn-danger action" id="delete"><i
                                                                class="fas fa-trash"></i></a> --}}
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

    <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header editmodel">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Package </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal_body" class="modl-body">

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>

    <script>
        $('body').on('click', '.edit', function() {
            let id = $(this).data('id');
            let url = "{{ route('package.edit', ':id') }}"; // Use the Laravel route helper

            url = url.replace(':id', id); // Replace placeholder with the actual ID

            $.get(url, function(data) {
                $('#modal_body').html(data);
            });
        });
    </script>
@endsection
