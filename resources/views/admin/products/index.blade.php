@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.admin.flash-message')
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
                    <section class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-primary p-1">
                                <h3 class="card-title">
                                    <a href="{{ route('products.create') }}"class="btn btn-light shadow rounded m-0">
                                        <i class="fas fa-plus"></i>
                                        <span>Add New</span></i></a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                        <label>Category</label>
                                        <select name="cat_id" id="cat_id" class="form-control" required>
                                            <option value="0" selected>All Category</option>
                                        </select> 
                                    </div>
                                    <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                        <label>Sub Category</label>
                                        <select name="sub_cat_id" id="sub_cat_id" class="form-control" required>
                                            <option value="0" selected>All Sub Category</option>
                                        </select> 
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                        <div class="bootstrap-data-table-panel text-center">
                                            <div class="table-responsive">
                                                <table id="itemTable" class="table table-striped table-bordered table-centre">
                                                    <thead id="thead">
                                                    </thead>
                                                    <tbody id="tbody">
                                                    </tbody>
                                                    <tfoot id="tfoot">
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
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
        $(document).ready(async function(){
            initialize();
            $('#cat_type_id, #cat_id, #sub_cat_id').on('change',function(event){
                updateData(event.target);
            });
        });
        function updateData(triggeredElement) {
            let data = getFormData();
            if (triggeredElement.id === 'cat_type_id') {
                loadCategories(data.cat_type_id);
                data.cat_id = '';
                data.sub_cat_id = '';
            } else if (triggeredElement.id === 'cat_id') {
                loadSubCategories(data.cat_id);
                data.sub_cat_id = '';
            }
            nsSetItem("itemSearchBy",data);
            getData(data);
        }
        function getFormData(){
            return {
                cat_type_id: $('#cat_type_id').val(),
                cat_id: $('#cat_id').val(),
                sub_cat_id: $('#sub_cat_id').val(),
            }
        }

        async function initialize() {
            const defaultData = {cat_type_id: 1, cat_id: '', sub_cat_id: ''};
            const data = nsGetItem("itemSearchBy") || defaultData;
            nsSetItem("itemSearchBy",data);
            getData(data);
            await loadCategories(data.cat_type_id,data.cat_id);
            await loadSubCategories(data.cat_id, data.sub_cat_id);
            $('#cat_type_id').val(data.cat_type_id);
        }
        async function getData(data){
            res = await nsAjaxPost("{{ route('products.index') }}", data);
            let editRoute;
            let destroyRoute;
            let isRawMaterial = (data.cat_type_id == 3);
            let isProduction = (data.cat_type_id == 2);

            let tbody = ``;
            let thead = ``;
                thead = `<tr>`;
                thead +=    `<th>SN</th>`
                thead +=    `<th>Title</th>`
                thead +=    `<th>Category Type</th>`
                thead +=    `<th>Category</th>`
                thead +=    `<th>Sub Category</th>`
                thead +=    `<th>Image</th>`
                thead +=    `<th>${(!isProduction) ? 'Purchase Price' : 'Cost'}</th>`

                if(!isRawMaterial){
                    thead +=    `<th>Sales Price</th>`
                    thead +=    `<th>Vat(%)</th>`
                }
                if(!isProduction){
                    thead +=    `<th>Current Stock</th>`
                }

                thead +=    `<th>Status</th>`
                thead +=    `<th>Action</th>`
                thead += `</tr>`;
                $('#thead').html(thead);

            res.items.forEach((item, index) => {

                        editRoute = `{{ route("products.edit", ":id") }}`.replace(":id", item.id);
                        destroyRoute = `{{ route("products.destroy", ":id") }}`.replace(":id", item.id);

                        tbody += `<tr>`;
                        tbody +=     `<td>${index+1}</td>`;
                        tbody +=     `<td>${item.title}</td>`;
                        tbody +=     `<td>${item.category_type.title}</td>`;
                        tbody +=     `<td>${item.category.title}</td>`;
                        tbody +=     `<td>${item.sub_category? item.sub_category.title : ''}</td>`;
                        tbody +=     `<td>`;
                        if(item.image){
                            let src = `{{  asset("public/uploads/products") }}/` + item.image;
                            tbody +=     `<img src="${src}" height="50px" width="50px">`;
                        }
                        tbody +=     `</td>`;
                        tbody +=     `<td>${res.currency_symbol} ${ item.cost }</td>`;
                        if(!isRawMaterial){
                            tbody +=     `<td>${res.currency_symbol} ${ item.price }</td>`;
                            tbody +=     `<td>${ item.vat }</td>`;
                        }
                        if(!isProduction){
                            tbody +=     `<td>${item.current_stock} ${ item.unit.title }</td>`;
                        }
                        tbody +=     `<td><span class="badge badge-${item.status==1? 'success' : 'danger' }">${item.status==1?'Active':'Inactive'}</span></td>`;
                        tbody +=     `<td>`
                        tbody +=         `<div class="d-flex justify-content-center">`
                        tbody +=             `<a href="${editRoute}" class="btn btn-info"> <i class="fa-solid fa-pen-to-square"></i></a>`;
                        tbody +=             `<form class="delete" action="${destroyRoute}" method="post">`
                        tbody +=                 `@csrf`
                        tbody +=                 `@method('DELETE')`
                        tbody +=                 `<button type="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>`
                        tbody +=             `</form>`
                        tbody +=           `</div>`
                        tbody +=     `</td>`
                        tbody += `</tr>`;
            });

            $('#tbody').html(tbody);
        }


        async function loadCategories(cat_type_id, selectd_id = null) {
            res = await nsAjaxGet('{{ route("products.categories", ":id") }}'.replace(':id', cat_type_id));
            nsSetOption({
                selectElementId: 'cat_id',
                data: res,
                defaultValue: '',
                defaultText: 'All Category',
                displayColumn: 'title',
                selectedValue: selectd_id,
            });
            nsSetOption({
                selectElementId: 'sub_cat_id',
                data: [],
                defaultValue: '',
                defaultText: 'All Sub Category',
                displayColumn: 'title',
            });
        }

        async function loadSubCategories(cat_id, selectd_id = null) {
            res = await nsAjaxGet('{{ route("products.sub-categories", ":id") }}'.replace(':id', cat_id));
            nsSetOption({
                selectElementId: 'sub_cat_id',
                data: res,
                defaultValue: '',
                defaultText: 'All Sub Category',
                displayColumn: 'title',
                selectedValue: selectd_id,
            });
        }

    </script>
@endsection
