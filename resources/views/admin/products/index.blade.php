@extends('layouts.admin.master')
@section('content')
    @inject('authorization', 'App\Services\AuthorizationService')
    <style>
        .modal-dialog {
            max-width: 700px;
        }
    </style>

    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.admin.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Products</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Products</li>
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
                                    @if (
                                        $authorization->hasMenuAccess(34) ||
                                            (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                        <a href="{{ route('products.create') }}"class="btn btn-light shadow rounded m-0">
                                            <i class="fas fa-plus"></i>
                                            <span>Add New</span></i></a>
                                    @else
                                        <span class="btn btn-light shadow rounded m-0">Products</span>
                                    @endif
                                </h3>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive" id="membersTableContainer">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>product name</th>
                                                <th>Category</th>
                                                <th>Subcategory</th>
                                                <th>Unit</th>
                                                <th>Image</th>
                                                <th>Purchase Price</th>
                                                <th>Selling Price</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="memberTable">
                                            @foreach ($products as $key => $product)
                                                @php
                                                    $categories = App\Models\Category::where(
                                                        'id',
                                                        $product->cat_id,
                                                    )->value('title');
                                                    $subcategories = App\Models\Category::where(
                                                        'id',
                                                        $product->sub_cat_id,
                                                    )->value('title');
                                                    $unit = App\Models\Unit::where('id', $product->unit_id)->value(
                                                        'title',
                                                    );
                                                @endphp
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $product->product_name }}</td>
                                                    <td>{{ $categories }}</td>
                                                    <td>{{ $subcategories }}</td>
                                                    <td>{{ $unit }}</td>
                                                    <td>
                                                        <img src="{{ asset('public/uploads/product/' . (isset($product->image) && $product->image ? $product->image : 'placeholder.png')) }}"
                                                            class="img-thumbnail img-fluid"
                                                            style="max-width: 60px; height: auto;"
                                                            alt="{{ $product->name }}" />

                                                    </td>
                                                    <td>{{ $product->purchase_price }}</td>
                                                    <td>{{ $product->selling_price }}</td>
                                                    <td>
                                                        @if ($product->status == 0)
                                                            <span class="badge badge-danger">Inactive</span>
                                                        @else
                                                            <span class="badge badge-success">Active</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (
                                                            $authorization->hasMenuAccess(35) ||
                                                                (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                                            <a href="" class="btn btn-sm btn-info edit"
                                                                data-id="{{ $product->id }}" data-toggle="modal"
                                                                data-target="#editproduct"><i class="fas fa-edit"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="editproduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Product </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal_body">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('body').on('click', '.edit', function() {
            let pid = $(this).data('id');
            let url = '{{ route('products.edit', ':id') }}'.replace(":id", pid)

            $.get(url, function(data) {
                console.log(data);
                $('#modal_body').html(data);
            });
        });


        $(document).ready(function() {
            $('#category_id').change(function() {
                let catId = $(this).val();
                let url = '{{ route('products.sub-category', ':id') }}'.replace(":id", catId)
                $.ajax({
                    // url: '/admin/products/sub_category/' + catId,
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        $('#sub_cat_id').html(
                            '<option value="" selected disabled>All Subcategory</option>'
                        );
                        $.each(data, function(index, sub_category) {
                            $('#sub_cat_id').append('<option value="' + sub_category
                                .id + '">' + sub_category.title + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
