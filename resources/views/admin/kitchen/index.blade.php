@php
    $basicInfo = App\Models\BasicInfo::first();
    $userImage = asset('public/admin-assets/dist/img/avatar5.png');
    if(Auth::guard('admin')->user()->image) $userImage = asset('public/uploads/admin/'. Auth::guard('admin')->user()->image);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $basicInfo->title }}</title>
    @include('layouts.admin.links')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <nav class="main-header navbar navbar-expand navbar-light navbar-light m-0 p-0">
        <ul class="navbar-nav ml-auto" style="padding: 2px; width: 100%;">
            <li class="nav-item bg-secondary" style="width: 95%; padding: 2px;">
                <div class="row p-1">
                    <div class="form-group p-1 m-0 col-sm-6 col-md-3 col-lg-3">
                        <a href="{{ Session::get('kitchen_back_url') }}" class="btn btn-light btn-lg shadow rounded w-100">
                            <i class="fas fa-long-arrow-alt-left"></i> Back</a>
                    </div>
                    <div class="form-group p-1 m-0 col-sm-6 col-md-3 col-lg-3">
                        <select name="in_row" id="in_row" class="form-control form-control-lg shadow rounded w-100">
                            <option value="" disabled selected>Select Order In a row</option>
                            <option value="100%">In a row : 1</option>
                            <option value="50%">In a row : 2</option>
                            <option value="33.33%">In a row : 3</option>
                            <option value="25%">In a row : 4</option>
                            <option value="20%">In a row : 5</option>
                            <option value="16.66%">In a row : 6</option>
                        </select>
                    </div>
                    <div class="form-group p-1 m-0 col-sm-6 col-md-3 col-lg-3">
                        <select name="bg_color" id="bg_color" class="form-control form-control-lg shadow rounded w-100">
                            <option disabled selected>Select order background</option>
                            <option color ="black" value="#ffffff">Background : White</option>
                            <option color ="black" value="#ADD8E6">Background : Low blue</option>
                            <option color ="black" value="#ADD444">Background : Normal blue</option>
                            <option color ="white" value="blue">Background : High blue</option>
                            <option color ="black" value="#CD9C14">Background : Low yellow</option>
                            <option color ="black" value="#F2C548">Background : Normal yellow</option>
                            <option color ="black" value="yellow">Background : High yellow</option>
                            <option color ="white" value="#6F2D83">Background : Low purple</option>
                            <option color ="white" value="#A161AE">Background : Normal purple</option>
                            <option color ="white" value="purple">Background : High purple</option>
                        </select>
                    </div>
                    <div class="form-group p-1 m-0 col-sm-6 col-md-3 col-lg-3">
                        <a href="{{ route('kitchen.index') }}"
                            class="btn btn-light btn-lg shadow rounded w-100">
                            <i class="fas fa-redo"></i> Reload</a>
                    </div>
                </div>
            </li>
            <li class="nav-item" style="width: 5%;">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item" style="width: auto;">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-white-600 small">
                                <b>{{ App\Models\Admin::with('role')->where('id', Auth::guard('admin')->user()->id)->first()->role->role }}</b>
                            </span>
                            <img class="img-profile rounded-circle" src="{{ $userImage }}" height="30" width="30">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('profile.update-details') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal"
                                data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>    
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure? You want to logout.</div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" onclick="event.preventDefault();this.closest('form').submit();">Logout</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <section class="content mt-1">
        @include('layouts.admin.flash-message')
        <div class="container-fluid">
            <div class="row" id="orders_div_id">
            </div>
        </div>
    </section>
    <section class="content">
        <audio id="myAudio">
            <source src="{{ asset('public/uploads/audio/alert.wav') }}" type="audio/ogg">
            <source src="{{ asset('public/uploads/audio/alert.wav') }}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    </section>
    @include('layouts.admin.scripts')
</body>
<script>
    $(document).ready(function() {
        initialize();
        $('#in_row, #bg_color').on('change', function(e) {
            const data = {};
            data.width = $('#in_row').val();
            data.background = $('#bg_color').val();
            data.color = $('#bg_color option:selected').attr('color');
            nsSetItem("kitchenStyleKeys",data);
            setStyle();
        });

        $(document).on('click', '.cancel-form button', function(e) {
            e.preventDefault();
            let element = $(this).closest('form');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "No",
                confirmButtonText: "Yes, Cancel it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    element.submit();
                }
            });
        });
    });
    function initialize() {
        const defaultData = {width: `33.33%`, color: `#000000`, background: `#ADD8E6`};
        const data = nsGetItem("kitchenStyleKeys") || defaultData;
        $('#in_row').val(data.width);
        $('#bg_color').val(data.background);
        nsSetItem("kitchenStyleKeys",data);
        kitchenOrders();
        setInterval(() =>{
            kitchenOrders();
        },5000);
    }
    function setStyle() {
        const data = nsGetItem("kitchenStyleKeys");
        $('.orderlist').css({'width': data.width});
        $('.order').css({'color': data.color,'background-color': data.background});
    }

    async function kitchenOrders() {
        res = await nsAjaxGet("{{ route('kitchen.orders') }}");
        let orders = ``;
        let maxItem = 0;
        if (res.alert == true) document.getElementById("myAudio").play();
        res.orders.forEach(order => {
            maxItem = maxItem < order.order_details.length ? order.order_details.length : maxItem;
            let formattedDate = moment(order.created_at).format('DD MMM YYYY hh:mm:ss a');
            orders += `<div class="orderlist m-0 p-0">
                            <div class="card m-1 p-1 order">
                                <div class="card-header bg-primary p-1 text-white">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <div class="d-flex flex-grow-1">
                                                <h3 class="card-title m-0 mr-auto"><strong>${order.table.title}</strong></h3>
                                            </div>
                                            <div class="d-flex flex-grow-1 justify-content-end">
                                                <p class="p-0 m-0">Order # <b>${order.order_no}</b></p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex flex-grow-1">
                                                <h3 class="card-title m-0 mr-auto"><strong>Created At</strong></h3>
                                            </div>
                                            <div class="d-flex flex-grow-1 justify-content-end">
                                                <p class="p-0 m-0">${formattedDate}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="padding: 10px;">
                                    <ol>${makeList(order.order_details)}</ol>
                                </div>
                                <div class="card-footer m-0 p-0">
                                    <div class="row m-0 p-0">
                                        <div class="form-group col-sm-4 col-lg-4 col-lg-4">${btnProcess(order)}</div>
                                        <div class="form-group m-0 col-sm-4 col-lg-4 col-lg-4">
                                            <a href="${`{{ route('kitchen.update.status',[3,":id"]) }}`.replace(":id",order.id)}" class="form-control form-control-sm btn btn-success btn-sm" type="button">Ready</a>
                                        </div>
                                        <div class="form-group m-0 col-sm-4 col-lg-4 col-lg-4">
                                            <form class="cancel-form" action="{{ route('collections.orders.cancel') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="${order.id}">
                                                <input type="hidden" name="order_status" value="2">
                                                <button class="form-control form-control-sm btn btn-danger btn-sm" type="submit">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
        });
        let olHeight = maxItem * 33.61;
        $('#orders_div_id').html(orders);
        $('ol').css({height:olHeight});
        setStyle();
    }
    function makeList(orderDetails) {
        let li = ``;
            orderDetails.forEach(ods => {
                li += `<li class="p-1">${ods.item.title} X ${ods.quantity}`;
                if (ods.status == 1){
                    li += `<button class="btn btn-success btn-sm p-0 ml-1" type="button">Ready</button>`;
                }else{
                    li += `<a href="${`{{ route('kitchen.update.status',[1,":id"]) }}`.replace(":id",ods.id)}" class="btn btn-warning btn-sm p-0 ml-1" type="button">Mark As Ready</a>`;
                }
                li += `</li>`;
            });
        return li;
    }
    function btnProcess(order) {
        let url = `{{ route('kitchen.update.status',[2,":id"]) }}`.replace(":id",order.id);
        let btn_txt = `Process`;
        let color = `info`;
        if(order.order_status == 3){
            url = `javascript:void(0)`;
            btn_txt = `Processing`;
            color = `primary`;
        }
        return `<a href="${url}" class="form-control form-control-sm btn btn-sm btn-${color}" type="button">${btn_txt}</a>`;
    }
</script>
</html>
