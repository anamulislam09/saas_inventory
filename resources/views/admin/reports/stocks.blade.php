@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Stock Reports</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Stock Reports</li>
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
                                <h3 class="card-title">Stock Reports</h3>
                            </div>
                            <div class="card-body">
                                <div class="bootstrap-data-table-panel text-center">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-striped table-bordered table-centre">
                                            <thead id="thead">
                                                <tr>
                                                    <th>Sl</th>
                                                    {{-- <th>Category</th>
                                                    <th>Sub_Category</th> --}}
                                                    <th>Product Name</th>
                                                    <th>Product Price</th>
                                                    <th>Quantity</th>
                                                    <th>Value</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                @foreach ($data['products'] as $key => $product)
                                                    @php
                                                        // $categories = App\Models\Category::where(
                                                        //     'id',
                                                        //     $product->cat_id,
                                                        // )->value('title');
                                                        // $subcategories = App\Models\Category::where(
                                                        //     'id',
                                                        //     $product->sub_cat_id,
                                                        // )->value('title');
                                                        $qty = App\Models\Stock::where(
                                                            'product_id',
                                                            $product->id,
                                                        )->value('stock_quantity');
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        {{-- <td>{{ $categories }}</td>
                                                        <td>{{ $subcategories }}</td> --}}
                                                        <td>{{ $product->product_name }} ({{ $product->unit->title }})</td>
                                                        <td>{{ $product->purchase_price }}</td>
                                                        <td>{{ $qty }}</td>
                                                        <td>{{ $product->purchase_price * $qty }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
@endsection
{{-- @section('script')
    <script>

    $(document).ready(function(){
        $('#print').click(function() {
            let product_id = $('#product_id').val();
            let from_date = $('#from_date').val();
            let to_date = $('#to_date').val();
            let product_name = $('#product_id option:selected').attr('product-name');
            if(product_id==0){
                $('#description').html(`${product_name} Stock Report.`);
            }else{
                let description = `${product_name} Stock Report`;
                if(from_date){
                    description += ` from ${from_date}`;
                    if(to_date){
                        description += ` to ${to_date}`;
                    }
                }
                description += `.`;
                $('#description').html(description);
            }
            // Prepare for printing by expanding the table and showing hidden elements
            let originalOverflow = $('.table-responsive').css('overflow');
            let originalMaxHeight = $('.table-responsive').css('max-height');
            $('.table-responsive').css({
                'overflow': 'visible',
                'max-height': 'none'
            });
            $('#print_header').prop('hidden', false);
            var printContents = $('#printable').html();
            $('#print_header').prop('hidden', true);
            var originalContents = $('body').html();
            $('body').html(printContents);
            window.print();
            $('body').html(originalContents);
            // Restore the original state
            $('.table-responsive').css({
                'overflow': originalOverflow,
                'max-height': originalMaxHeight
            });
        });
    });


    $(document).ready(function(){
        initialize();
        $('#product_id, #from_date, #to_date').on('change', function (event) {
            const data = getFormData();
            nsSetProduct("productReportSearchKeys",data);
            getData(data);
        });
    });

    function initialize() {
        const defaultData = {product_id: 0,from_date: null,to_date: null};
        const data = nsGetProduct("productReportSearchKeys") || defaultData;
        $('#product_id').val(data.product_id);
        $('#from_date').val(data.from_date);
        $('#to_date').val(data.to_date);
        nsSetProduct("productReportSearchKeys",data);
        getData(data);
    }
    async function getData(data){
        res = await nsAjaxPost("{{ route('reports.stocks') }}",data);
        if(data.product_id==0){
            allProduct(res);
        }else{
            singleProduct(res);
        }
    }
    function getFormData() {
        return {
            product_id: $('#product_id').val(),
            from_date: $('#from_date').val(),
            to_date: $('#to_date').val()
        }
    }
    function singleProduct(res) {
        let tbody = ``;
        let thead = ``;
            thead += `<tr>`;
            thead += `<th>SN</th>`;
            thead += `<th>Date</th>`;
            thead += `<th>Particular</th>`;
            thead += `<th>Stock In Qty</th>`;
            thead += `<th>Stock Out Qty</th>`;
            thead += `<th>Current Stock</th>`;
            thead += `</tr>`;
            $('#thead').html(thead);

        res.stockHistory.forEach((val,index)=>{
            val.stock_in_qty = parseFloat(val.stock_in_qty) || 0;
            val.stock_out_qty = parseFloat(val.stock_out_qty) || 0;
            val.current_stock = parseFloat(val.current_stock) || 0;
            tbody += `<tr>`;
            tbody +=   `<td>${(index + 1)}</td>`;
            tbody +=   `<td>${val.date}</td>`;
            tbody +=   `<td>${val.particular}</td>`;
            tbody +=   `<td>${val.stock_in_qty?val.stock_in_qty +' '+res.unit:'__'}</td>`;
            tbody +=   `<td>${val.stock_out_qty?'-'+val.stock_out_qty +' '+res.unit:'__'}</td>`;
            tbody +=   `<td>${val.current_stock +' '+res.unit}</td>`;
            tbody += `</tr>`;
        });
        $('#tbody').html(tbody);
    }
    function allProduct(res) {
        let tbody = ``;
        let thead = ``;
            thead = `<tr>`;
            thead +=    `<th width="5%">SN</th>`
            thead +=    `<th width="70%">Title</th>`
            thead +=    `<th width="25%">Current Stock</th>`
            thead += `</tr>`;
            $('#thead').html(thead);
            
        res.stockHistory.forEach((val,index)=>{
            tbody += `<tr>`;
            tbody +=   `<td>${(index + 1)}</td>`;
            tbody +=   `<td class="text-left">${val.title}</td>`;
            tbody +=   `<td>${val.current_stock} ${val.unit.title}</td>`;
            tbody += `</tr>`;
        });
        $('#tbody').html(tbody);
    }

</script>
@endsection --}}
