@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Items</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Items</li>
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
                                <h3 class="card-title">Form</h3>
                            </div>
                            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf()
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                                    <label>Category *</label>
                                                    <select name="cat_id" id="cat_id" class="form-control" required>
                                                        <option value="">Select Category</option>
                                                        @foreach ($data['categories'] as $category)
                                                            <option value="{{ $category->id }}">{{ $category->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                                    <label>Sub Category</label>
                                                    <select name="sub_cat_id" id="sub_cat_id" class="form-control">
                                                        <option value="">All Subcategory</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                                    <label>Product Name *</label>
                                                    <input value="" type="text" class="form-control"
                                                        name="product_name" placeholder="Product Name" required>
                                                </div>
                                                <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                                    <label>Unit *</label>
                                                    <select name="unit_id" id="unit_id" class="form-control" required>
                                                        <option value="">Select Unit</option>
                                                        @foreach ($data['units'] as $unit)
                                                            <option value="{{ $unit->id }}">{{ $unit->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                                    <label>Description</label>
                                                    <textarea name="description" id="description" class="form-control" cols="30" rows="3"
                                                        placeholder="Description"></textarea>
                                                </div>
                                                <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                                    <label>Status *</label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option
                                                            {{ isset($data['item']) ? ($data['item']->status == 1 ? 'selected' : null) : null }}
                                                            value="1">Active</option>
                                                        <option
                                                            {{ isset($data['item']) ? ($data['item']->status == 0 ? 'selected' : null) : null }}
                                                            value="0">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                                    <label>Image (1:1)</label>
                                                    <label class="col-md-3" style="cursor:pointer">
                                                        <img id="image_view" style="max-width:100%" class="img-thumbnail"
                                                            src="{{ asset('public/uploads/product/' . 'placeholder.png') }}">
                                                        <input id="image" name="image" style="display:none"
                                                            onchange="itemImage(this);" type="file" accept="image/*">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#cat_id').change(function() {
                let catId = $(this).val();
                let url = '{{ route('products.sub-category', ':id') }}'.replace(":id", catId);

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        $('#sub_cat_id').empty();
                        $('#sub_cat_id').append(
                            '<option value="" selected disabled>All Subcategory</option>'
                        );
                        $.each(data, function(index, sub_category) {
                            $('#sub_cat_id').append('<option value="' + sub_category
                                .id + '">' + sub_category.title + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
            });
        });
    </script>
@endsection
