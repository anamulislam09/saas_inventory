@extends('layouts.admin.master')
@section('content')
    <style>
        #basic_info {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* Full viewport height */
            width: 100vw;
            /* Full viewport width */
            position: absolute;
            /* Ensure the div covers the entire viewport */
            top: 0;
            left: 0;
        }

        #basic_info .btn {
            padding: 15px 30px;
            font-size: 18px;
            background-color: #007bff;
            color: #fff;
            border-radius: 30px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        #basic_info .btn:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            #basic_info .btn {
                font-size: 16px;
                padding: 12px 25px;
            }
        }

        @media (max-width: 480px) {
            #basic_info .btn {
                font-size: 14px;
                padding: 10px 20px;
            }
        }
    </style>
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.admin.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Basic Info</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Basic Info</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    @if ($basicInfo)
                        <section class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="bootstrap-data-table-panel">
                                        <div class="table-responsive">
                                            <table id="example1" class="table table-bordered table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th>Title</th>
                                                        <td>{{ $basicInfo->title }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Moto</th>
                                                        <td>{{ $basicInfo->moto }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Phone-1</th>
                                                        <td>{{ $basicInfo->phone1 }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Phone-2</th>
                                                        <td>{{ $basicInfo->phone2 }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Email</th>
                                                        <td>{{ $basicInfo->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Address</th>
                                                        <td>{{ $basicInfo->address }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Logo</th>
                                                        <td>
                                                            @if ($basicInfo->logo)
                                                                <img src="{{ asset('public/uploads/basic-info/' . $basicInfo->logo) }}"
                                                                    height="29px" width="141px">
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Fav Icon</th>
                                                        <td>
                                                            @if ($basicInfo->logo)
                                                                <img src="{{ asset('public/uploads/basic-info/' . $basicInfo->favIcon) }}"
                                                                    height="32px" width="32px">
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Currency Code</th>
                                                        <td>{{ $basicInfo->currency_code }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Currency Symbol</th>
                                                        <td>{{ $basicInfo->currency_symbol }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Accept Payment Type</th>
                                                        <td>
                                                            @if ($basicInfo->logo)
                                                                <img src="{{ asset('public/uploads/basic-info/' . $basicInfo->acceptPaymentType) }}"
                                                                    height="39px" width="267px">
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Copy Right Text</th>
                                                        <td>{!! $basicInfo->copyRightName !!}</td>
                                                    </tr>
                                                    <tr hidden>
                                                        <th>Copy Right Link</th>
                                                        <td>{{ $basicInfo->copyRightLink }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Map Link</th>
                                                        <td>{!! $basicInfo->mapLink !!}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Facebook</th>
                                                        <td>{{ $basicInfo->facebook }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Instagram</th>
                                                        <td>{{ $basicInfo->instagram }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Twitter</th>
                                                        <td>{{ $basicInfo->twitter }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Pinterest</th>
                                                        <td>{{ $basicInfo->pinterest }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>LinkedIn</th>
                                                        <td>{{ $basicInfo->linkedIn }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ route('basic-infos.edit', $basicInfo->id) }}"
                                        class="btn btn-primary">Edit</a>
                                </div>
                            </div>
                        </section>
                    @else
                        <div id="basic_info">
                            <a href="{{ route('basic-infos.create') }}" class="btn btn-primary">Create</a>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection
