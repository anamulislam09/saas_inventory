@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.admin.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Menus</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Menus</li>
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
                                    <a href="{{ route('menus.create') }}"class="btn btn-light shadow rounded m-0"><i
                                            class="fas fa-plus"></i>
                                        <span>Add New</span></i></a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-sm table-striped table-bordered table-centre">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Menu ID</th>
                                                    <th>Parent Menu ID</th>
                                                    <th>Main Menu</th>
                                                    <th>Menu</th>
                                                    <th>Sub Menu</th>
                                                    <th>Sub Child Menu</th>
                                                    <th>Route</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                if (!function_exists('displayMenuTable')) {
                                                    function displayMenuTable($menus, $level = 0, &$srl = 1) {
                                                            $html = '';
                                                            foreach ($menus as $key => $menu) {
                                                                $mainMenu = $level == 0 ? $menu->menu_name : '';
                                                                $menuLevel = $level == 1 ? $menu->menu_name : '';
                                                                $subMenu = $level == 2 ? $menu->menu_name : '';
                                                                $subChildMenu = $level == 3 ? $menu->menu_name : '';
                                                                $html .= '<tr>';
                                                                $html .= '<td>' . $srl++ . '</td>';
                                                                $html .= '<td>' . $menu->id . '</td>';
                                                                $html .= '<td>' . $menu->parent_id . '</td>';
                                                                $html .= '<td>' . $mainMenu . '</td>';
                                                                $html .= '<td>' . $menuLevel . '</td>';
                                                                $html .= '<td>' . $subMenu . '</td>';
                                                                $html .= '<td>' . $subChildMenu . '</td>';
                                                                $html .= '<td>' . $menu->route . '</td>';
                                                                $html .= '
                                                                    <td>
                                                                        <div class="d-flex justify-content-center">
                                                                            <a href="' . route("menus.edit", [$menu->id, "addmenu"]) . '" class="btn btn-sm btn-success">
                                                                                <i class="fas right fa-solid fa-plus"></i>
                                                                            </a>
                                                                            <a href="' . route("menus.edit", $menu->id) . '" class="btn btn-sm btn-info">
                                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                                            </a>
                                                                            <form class="delete" action="' . route("menus.destroy", $menu->id) . '" method="post">
                                                                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                                                                <input type="hidden" name="_method" value="DELETE">
                                                                                <button type="submit" class="btn btn-sm btn-danger">
                                                                                    <i class="fa-solid fa-trash"></i>
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </td>
                                                                ';
                                                                $html .= '</tr>';
                                                                if ($menu->children) {
                                                                    $html .= displayMenuTable($menu->children, $level + 1, $srl);
                                                                }
                                                            }
                                                            return $html;
                                                        }
                                                    }
                                                @endphp
                                                {!! displayMenuTable($menus) !!}
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Menu ID</th>
                                                    <th>Parent Menu ID</th>
                                                    <th>Main Menu</th>
                                                    <th>Menu</th>
                                                    <th>Sub Menu</th>
                                                    <th>Sub Child Menu</th>
                                                    <th>Route</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
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
