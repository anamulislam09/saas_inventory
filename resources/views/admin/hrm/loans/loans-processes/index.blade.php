@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Loan Process</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Loan Process</li>
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
                                <h3 class="card-title">Loan Process</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('loan-processes.proccess') }}" method="POST" enctype="multipart/form-data">
                                    @csrf()
                                    <div class="row">
                                        <div class="form-group col-sm-12 col-md-5 col-lg-5">
                                            <label for="date">Month</label>
                                            <input name="date" id="date" type="month" class="form-control">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-2 col-lg-2 d-flex align-items-end">
                                            <button name="attendanceProces" id="attendanceProces" type="submit" class="form-control btn btn-primary">Process Loan</button>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                            <div class="bootstrap-data-table-panel">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-centre text-center">
                                                        <thead id="thead">
                                                            <th>SN</th>
                                                            <th>Employee Name</th>
                                                            <th>Amount</th>
                                                            <th>Payament Date</th>
                                                            <th>Payment Status</th>
                                                        </thead>
                                                        <tbody id="tbody">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
        $(document).ready(function(){
            onLoad();
            $('#date').on('change',function(){
                let date = $('#date').val();
                localStorage.setItem("loanProcess", JSON.stringify({date: date}));
                getData(date);
            });
        });

        function onLoad() {
            let date;
            let loanProcess = JSON.parse(localStorage.getItem("loanProcess"));
            if(loanProcess){
                $('#date').val(loanProcess.date);
                date = loanProcess.date;
            }else{
                date = "{{ date('Y-m') }}";
                localStorage.setItem("loanProcess", JSON.stringify({date: date}));
                $('#date').val(date);
            }
            getData(date);
        }

        function getData(date) {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('loan-processes.index') }}",
                data:{date: date},
                type: 'POST',
                dataType: 'JSON',
                success: function(res){
                    let tbody = ``;
                    res.forEach((item,index)=>{
                        tbody += `<tr>`;
                        tbody +=   `<td>${(index + 1)}</td>`;
                        tbody +=   `<td class="text-left">${item.name}</td>`;
                        tbody +=   `<td>${item.amount}</td>`;
                        tbody +=   `<td>${item.payment_date}</td>`;
                        tbody +=   `<td><span class="badge badge-${item.payment_status == 1 ? 'success' : 'danger'}">${item.payment_status == 1? 'Paid' : 'Pending'}</span></td>`;
                        tbody += `</tr>`;
                    });
                    $('#tbody').html(tbody);
                    if(!res.length) $('#tbody').html('<tr><td style="text-align: center;" colspan="5"><b>No Data Found!</b></td></tr>');
                }
            });
        }

    </script>
@endsection
