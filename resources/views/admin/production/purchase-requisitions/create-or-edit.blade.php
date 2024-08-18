@extends('layouts.admin.master')
@section('content')
<style>
    table td, table th{
        padding: 3px!important;
        text-align: center;
    }
    input[type="number"]{
        text-align: right;
    }
    .item{
        text-align: left;
    }
    .form-group{
        padding: 2px;
        margin: 0px;
    }
    label{
        margin-bottom: 0px;
    }
</style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Purchase Requisition</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Purchase Requisition</li>
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
                            <form id="form-submit" action="{{ isset($data['item']) ? route('purchase-requisitions.update',$data['item']['id']) : route('purchase-requisitions.store'); }}" method="POST" enctype="multipart/form-data">
                                @csrf()
                                @if(isset($data['item']))
                                    @method('put')
                                @endif
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                            <label>Date *</label>
                                            <input name="date" id="date" type="date"
                                                value="{{ isset($data['item']) ? $data['item']['date'] : null }}"
                                                class="form-control" @readonly(isset($data['item'])) required>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                            <div class="table-responsive">
                                                <table id="table"
                                                    class="table table-striped table-bordered table-centre p-0 m-0">
                                                    <thead>
                                                        <tr>
                                                            <th width="5%">SN</th>
                                                            <th>Item</th>
                                                            <th>Unit Name</th>
                                                            <th>Unit Price</th>
                                                            <th>Quantity</th>
                                                            <th>Sub Total</th>
                                                            <th width="5%">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody">
                                                        @isset($data['item'])
                                                            @php
                                                                $total = 0;
                                                            @endphp
                                                            @foreach($data['item']['prdetails'] as $key => $prdetails)
                                                                @php
                                                                    $total += $subtotal = $prdetails->amount;
                                                                @endphp
                                                                <tr>
                                                                    <td class="serial">{{ $loop->iteration }}</td>
                                                                    <td class="text-left"><input type="hidden" value="{{ $prdetails->item_id }}" name="item_id[]">{{ $prdetails->item->title }}</td>
                                                                    <td><input type="number" value="{{ $prdetails->unit_price }}" class="form-control form-control-sm calculate" name="unit_price[]" placeholder="0.00" readonly></td>
                                                                    <td><input step="0.01" type="number" value="{{ $prdetails->quantity }}" class="form-control form-control-sm calculate" name="quantity[]" placeholder="0.00" required></td>
                                                                    <td><input type="number" value="{{ $subtotal }}" class="form-control form-control-sm" name="amount[]" placeholder="0.00" disabled></td>
                                                                    <td><button class="btn btn-sm btn-danger btn-del" type="button"><i class="fa-solid fa-trash btn-del"></i></button></td>
                                                                </tr>
                                                            @endforeach
                                                        @endisset
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-9 col-md-9 col-lg-9">
                                            <label>Note</label>
                                            <input value="{{ isset($data['item']) ? $data['item']->note : null }}"
                                                class="form-control" type="text" name="note" id="note"
                                                placeholder="Note">
                                        </div>
                                        <div class="form-group col-sm-3 col-md-3 col-lg-3">
                                            <label>Total</label>
                                            <input
                                                value="{{ isset($data['item']) ? $total : null }}"
                                                type="number" class="form-control" name="total" id="total"
                                                placeholder="0.00" readonly>
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
        $(document).ready(function() {
            $('#date').on('change',async function() {
                let tbody = ``;
                let total_amount = 0;
                let amount;
                res = await nsAjaxGet('{{ route("purchase-requisitions.production-plan",":date") }}'.replace(":date",$(this).val()));
                console.log(res);
                res.forEach((element, index) => {
                    total_amount += amount = parseFloat(element.cost) * parseFloat(element.quantity);
                  tbody +=`<tr>
                            <td class="serial">${index+1}</td>
                            <td class="text-left"><input type="hidden" value="${element.id}" name="item_id[]">${element.title}</td>
                            <td>${element.unit_name}</td>
                            <td><input type="number" value="${element.cost}" class="form-control form-control-sm calculate" name="unit_price[]" placeholder="0.00" readonly></td>
                            <td><input step="0.01" type="number" value="${element.quantity}" class="form-control form-control-sm calculate" name="quantity[]" placeholder="0.00" required></td>
                            <td><input type="number" value="${amount}" class="form-control form-control-sm" name="amount[]" placeholder="0.00" disabled></td>
                            <td><button class="btn btn-sm btn-danger btn-del" type="button"><i class="fa-solid fa-trash btn-del"></i></button></td>
                        </tr>`;
                });
                $('#tbody').html(tbody);
                $('#total').val(total_amount);
            });

            $('#tbody').bind('click', function(e) {
                $(e.target).is('.btn-del') && e.target.closest('tr').remove();
                $(".serial").each(function(index) {
                    $(this).html(index + 1);
                });
                calculate();
            });
            
            $('#form-submit').submit(function(e) {
                if (!$('input[name="item_id[]"]').length) {
                    e.preventDefault();
                    Swal.fire("No Item Found!");
                }
            });
        });
        function calculate() {
            let item_id = $('input[name="item_id[]"]');
            let total = 0;
            for (let i = 0; i < item_id.length; i++) {
                $('input[name="amount[]"]')[i].value = ($('input[name="unit_price[]"]')[i].value * $(
                    'input[name="quantity[]"]')[i].value);
                total += $('input[name="unit_price[]"]')[i].value * $('input[name="quantity[]"]')[i].value;
            }
            $('#total').val(total);
        }

    </script>
@endsection
