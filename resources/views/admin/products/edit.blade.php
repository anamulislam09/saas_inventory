<div class="card">
    <div class="card-body p-5">
        <form action="{{ route('products.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            @php
                                $categories = App\Models\Category::where('id', $product->cat_id)->value('title');
                                $subcategories = App\Models\Category::where('id', $product->sub_cat_id)->value('title');
                            @endphp
                            <label>Category *</label>
                            {{-- <select name="cat_id" id="cat_id" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if ($product->cat_id == $category->id) selected @endif>{{ $category->title }}
                                    </option>
                                @endforeach
                            </select> --}}
                            <input type="text" class="form-control" value="{{ $categories }}" readonly>
                        </div>
                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            <label>Sub Category</label>
                            {{-- <select name="sub_cat_id" id="sub_cat_id" class="form-control">
                                <option value="">All Subcategory</option>

                            </select> --}}
                            <input type="text" class="form-control" value="{{ $subcategories}}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            <label>Product Name *</label>
                            <input value="{{ $product->product_name }}" type="text" class="form-control"
                                name="product_name" required>
                        </div>
                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            <label>Unit *</label>
                            <select name="unit_id" id="unit_id" class="form-control" required>
                                <option value="">Select Unit</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}"
                                        @if ($product->unit_id == $unit->id) selected @endif>{{ $unit->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            <label>Description</label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="3">{{ $product->description }}</textarea>
                        </div>
                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            <label>Status *</label>
                            <select name="status" id="status" class="form-control">
                                <option @if ($product->status == 1) selected @endif value="1">Active</option>
                                <option @if ($product->status == 0) selected @endif value="0">Inactive
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            <label>Image (1:1)</label>
                            <label class="col-md-3" style="cursor:pointer">
                                <img id="image_view" style="max-width:100%" class="img-thumbnail"
                                    src="{{ asset('public/uploads/product/' . (isset($product->image) && $product->image ? $product->image : 'placeholder.png')) }}">
                                <input id="image" name="image" style="display:none" onchange="itemImage(this);"
                                    type="file" accept="image/*">
                            </label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
