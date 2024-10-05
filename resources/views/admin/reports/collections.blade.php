@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Collections Report</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Collections Report</li>
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
                                <h3 class="card-title">Collections Report</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-3 col-md-3 col-lg-3">
                                        <label>Customer</label>
                                        <select name="customer_id" id="customer_id" class="form-control select2" required>
                                            <option customer-name="All customer" value="0" selected>All Customer
                                            </option>
                                            @foreach ($data['customers'] as $customer)
                                                <option customer-name="{{ $customer->name }}" value="{{ $customer->id }}">
                                                    {{ $customer->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-3 col-md-3 col-lg-3">
                                        <label>From/On Date</label>
                                        <input name="from_date" id="from_date" type="date" class="form-control">
                                    </div>
                                    <div class="form-group col-sm-3 col-md-3 col-lg-3">
                                        <label>To Date</label>
                                        <input name="to_date" id="to_date" type="date" class="form-control">
                                    </div>
                                    <div class="form-group col-sm-12 col-md-3 col-lg-3">
                                        <label>&nbsp;</label>
                                        <button ame="print" id="print" type="button"
                                            class="form-control btn btn-primary">Print</button>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-12" id="printable">
                                        <div id="print_header" hidden>
                                            <div class="row justify-content-center">
                                                <div class="col-12 text-center">
                                                    <h1>Collection Report</h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bootstrap-data-table-panel text-center">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-centre">
                                                    <thead id="thead">
                                                    </thead>
                                                    <tbody id="tbody">
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
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#print').click(function() {
                let customer_id = $('#customer_id').val();
                let from_date = $('#from_date').val();
                let to_date = $('#to_date').val();
                let customer_name = $('#customer_id option:selected').attr('customer-name');
                let description = `Collection report of ${customer_name}`;

                if (from_date && to_date) description += ` from ${from_date} to ${to_date}`;
                else if (from_date) description += ` on ${from_date}`;
                $('#description').html(description + `.`);


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

        $(document).ready(function() {
            initialize();
            $('#customer_id, #from_date, #to_date').on('change', function(event) {
                const data = getFormData();
                // alert(data);
                nsSetItem("collectionsReportSearchKeys", data);
                getData(data);
            });
        });

        function initialize() {
            const defaultData = {
                customer_id: 0,
                from_date: null,
                to_date: null
            };
            const data = nsGetItem("collectionsReportSearchKeys") || defaultData;
            $('#customer_id').val(data.customer_id);
            $('#from_date').val(data.from_date);
            $('#to_date').val(data.to_date);
            nsSetItem("collectionsReportSearchKeys", data);
            getData(data); // Load the initial collections data
        }

        async function getData(data) {
            res = await nsAjaxPost("{{ route('reports.collections') }}", data);
            if (data.customer_id == 0) {
                allCustomer(res);
            } else {
                singleCustomer(res);
            }
        }

        function getFormData() {
            return {
                customer_id: $('#customer_id').val(),
                from_date: $('#from_date').val(),
                to_date: $('#to_date').val()
            }
        }

        function singleCustomer(res) {
            let total = 0;
            let tbody = ``;
            let thead = ``;
            thead += `<tr>`;
            thead += `<th>SN</th>`;
            thead += `<th>Date</th>`;
            thead += `<th>Collection Amount</th>`;
            thead += `</tr>`;
            $('#thead').html(thead);
            if ((res.collections) && res.collections.length > 0) {
                res.collections.forEach((val, index) => {
                    val.total_collection = parseFloat(val.total_collection);
                    console.log(val.total_collection);
                    tbody += `<tr>`;
                    tbody += `<td>${(index + 1)}</td>`;
                    tbody += `<td>${nsYYYYMMDD(val.date)}</td>`;
                    tbody +=
                    `<td class="text-right">${res.currency_symbol} ${val.total_collection.toFixed(2)}</td>`;
                    tbody += `</tr>`;
                    total += val.total_collection;
                });
                tbody += `<tr>`;
                tbody += `<th colspan="2" class="text-left">Total Amount: </th>`;
                tbody += `<th class="text-right">${res.currency_symbol} ${total.toFixed(2)}</th>`;
                tbody += `</tr>`;
                $('#tbody').html(tbody);
            } else {
                $('#tbody').html('<tr><td colspan="3" class="text-center">No data available</td></tr>');
                // Update the table body
            }
        }

        function allCustomer(res) {
            let total = 0;
            let tbody = ``;
            let thead = ``;

            // Constructing the table head
            thead = `<tr>`;
            thead += `<th width="5%">SN</th>`;
            thead += `<th width="70%">Customer Name</th>`;
            thead += `<th width="25%">Collection Amount</th>`;
            thead += `</tr>`;
            $('#thead').html(thead); // Update the table head

            // Looping through the collections array
            if (Array.isArray(res.collections) && res.collections.length > 0) {
                res.collections.forEach((val, index) => {
                    alert('hello');
                    // Ensure total_collection is a valid number
                    val.total_collection = parseFloat(val.total_collection) || 0;
                    console.log(val.total_collection);

                    // Constructing the table body row by row
                    tbody += `<tr>`;
                    tbody += `<td>${(index + 1)}</td>`;
                    tbody += `<td class="text-left">${val.vendor_name ? val.vendor_name : ''}</td>`;
                    tbody +=
                        `<td class="text-right">${res.currency_symbol} ${val.total_collection.toFixed(2)}</td>`;
                    tbody += `</tr>`;

                    // Accumulating the total collection
                    total += val.total_collection;

                    // Adding the total row
                    tbody += `<tr>`;
                    tbody += `<th colspan="2" class="text-left">Total Amount: </th>`;
                    tbody += `<th class="text-right">${res.currency_symbol} ${total.toFixed(2)}</th>`;
                    tbody += `</tr>`;
                    // Update the table body
                    $('#tbody').html(tbody);
                });
            } else {
                $('#tbody').html('<tr><td colspan="3" class="text-center">No data available</td></tr>');
                // Update the table body
            }
        }
    </script>
@endsection
