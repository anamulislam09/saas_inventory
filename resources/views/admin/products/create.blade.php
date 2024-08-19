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
                                <h3 class="card-title">{{ $data['title'] }} Form</h3>
                            </div>
                            <form
                                action="{{ isset($data['item']) ? route('products.update', $data['item']->id) : route('products.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf()
                                @if (isset($data['item']))
                                    @method('put')
                                @endif
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="form-group col-sm-12 col-md col-lg">
                                                    <label>Category *</label>
                                                    <select name="cat_id" id="cat_id" class="form-control" required>
                                                        <option value="">Select Category</option>
                                                        @foreach ($data['categories'] as $category)
                                                            <option value="{{ $category->id }}">{{ $category->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-sm-12 col-md col-lg">
                                                    <label>Sub Category</label>
                                                    <select name="sub_cat_id" id="sub_cat_id" class="form-control">
                                                        <option value="">Select Sub Category</option>

                                                    </select>
                                                </div>
                                                <div class="form-group col-sm-12 col-md col-lg">
                                                    <label>Product Name *</label>
                                                    <input value="{{ isset($data['item']) ? $data['item']->title : null }}"
                                                        type="text" class="form-control" name="title"
                                                        placeholder="Item Name" required>
                                                </div>
                                                <div class="form-group col-sm-12 col-md col-lg">
                                                    <label>Unit *</label>
                                                    <select name="unit_id" id="unit_id" class="form-control" required>
                                                        <option value="">Select Unit</option>
                                                        @foreach ($data['units'] as $unit)
                                                            <option
                                                                @isset($data['item'])
                                                                    @if ($data['item']->unit_id == $unit->id)
                                                                        @selected(true)
                                                                    @endif
                                                                @endisset
                                                                value="{{ $unit->id }}">{{ $unit->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="form-group col-sm-12 col-md col-lg">
                                                    <label id="lable_cost_purchase">Production Cost *</label>
                                                    <input value="{{ isset($data['item']) ? $data['item']->cost : null }}"
                                                        type="number" class="form-control" name="cost"
                                                        placeholder="0.00" required>
                                                </div>
                                                <div class="form-group col-sm-12 col-md col-lg" id="price_div_id" hidden>
                                                    <label>Sales Price *</label>
                                                    <input value="{{ isset($data['item']) ? $data['item']->price : null }}"
                                                        type="number" class="form-control" name="price" id="price"
                                                        placeholder="0.00" required>
                                                </div>
                                                <div class="form-group col-sm-12 col-md col-lg" id="vat_div_id" hidden>
                                                    <label>Vat (%)*</label>
                                                    <input value="{{ isset($data['item']) ? $data['item']->vat : null }}"
                                                        type="number" class="form-control" name="vat" id="vat"
                                                        placeholder="0.00" required>
                                                </div>
                                                <div class="form-group col-sm-12 col-md col-lg" id="opening_stock_div"
                                                    hidden>
                                                    <label>Opening Stock *</label>
                                                    <input
                                                        value="{{ isset($data['item']) ? $data['item']->opening_stock : null }}"
                                                        type="number" class="form-control" name="opening_stock"
                                                        id="opening_stock" placeholder="0.00" required>
                                                </div>
                                                <div class="form-group col-sm-12 col-md col-lg">
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
                                        </div>
                                        <div class="form-group col-sm-12 col-md-7 col-lg-7">
                                            <label>Description</label>
                                            <textarea name="description" id="description" class="form-control" cols="30" rows="3"
                                                placeholder="Description">{{ isset($data['item']) ? $data['item']->description : null }}</textarea>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-5 col-lg-5 margin-auto"
                                            style="margin: auto;">
                                            <label>Image (1:1)</label>
                                            <label class="col-md-3" style="cursor:pointer">
                                                <img id="image_view" style="max-width:100%" class="img-thumbnail"
                                                    src="{{ asset('public/uploads/items/' . (isset($data['item']) && $data['item']->image ? $data['item']->image : 'placeholder.png')) }}">
                                                <input id="image" name="image" style="display:none"
                                                    onchange="itemImage(this);" type="file" accept="image/*">
                                            </label>
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
@section('script')
    <script>
        // $(document).ready(function() {
        //     $('#cat_id').change(function() {
        //         let catId = $(this).val();
        //         $.ajax({
        //             url: '/admin/products/sub-category/' + catId,
        //             type: 'GET',
        //             success: function(data) {
        //                 console.log(data); // Add this line to check the response data
        //                 $('#sub_cat_id').html(
        //                     '<option value="" selected disabled>Select Sub Category</option>'
        //                 );
        //                 $.each(data.sub_categories, function(index, sub_category) {
        //                     $('#sub_cat_id').append('<option value="' + sub_category.id + '">' + sub_category.title + '</option>');
        //                 });
        //             }
        //         });
        //     });
        // })
        $(document).ready(function() {
    $('#cat_id').change(function() {
        let catId = $(this).val();
        if (catId) {
            $.ajax({
                url: '/admin/products/sub-category/' + catId,
                type: 'GET',
                success: function(data) {
                    $('#sub_cat_id').html('<option value="" selected disabled>Select Sub Category</option>');
                    $.each(data.sub_categories, function(index, sub_category) {
                        $('#sub_cat_id').append('<option value="' + sub_category.id + '">' + sub_category.title + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        } else {
            $('#sub_cat_id').html('<option value="" selected disabled>Select Sub Category</option>');
        }
    });
});

    </script>

    @endsection
