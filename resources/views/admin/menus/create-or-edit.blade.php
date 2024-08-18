@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Menu Manage</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Menu Manage</li>
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
                            <form action="{{ isset($data['item']) ? route('menus.update',$data['item']['id']) : route('menus.store'); }}" method="POST">
                                @csrf()
                                @if(isset($data['item']))
                                    @method('put')
                                @endif
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                            <label>Parent Menu</label>
                                            <select name="parent_id" id="parent_id" class="form-control" required>
                                                <option value="0">Select Parent Menu</option>
                                                {!! (function($menus, $data) {
                                                    $displayMenuOption = function($menus, $level = 0, $data, &$srl = 1) use (&$displayMenuOption) {
                                                        $options = '';
                                                        foreach ($menus as $key => $menu) {
                                                            if ($level == 0) {
                                                                $arrow = '&#11042; ';
                                                            } elseif ($level == 1) {
                                                                $arrow = '&nbsp;&nbsp;&rArr;';
                                                            } elseif ($level == 2) {
                                                                $arrow = '&nbsp;&nbsp;&nbsp;&rarr;';
                                                            } elseif ($level == 3) {
                                                                $arrow = '&nbsp;&nbsp;&nbsp;&nbsp;&rarr;';
                                                            }
                                                            $selected = (isset($data['addmenu']) && $data['addmenu']['id'] == $menu['id']) || (isset($data['item']) && $data['item']['parent_id'] == $menu['id']) ? 'selected' : null;
                                                            $options .= '<option ' . $selected . ' value="' . $menu['id'] . '">' . $arrow . $menu['menu_name'] . '</option>';
                                                            if (isset($menu['children'])) {
                                                                $options .= $displayMenuOption($menu['children'], $level + 1, $data, $srl);
                                                            }
                                                        }
                                                        return $options;
                                                    };
                                                    return $displayMenuOption($menus, 0, $data);
                                                })($data['menus'], $data) !!}
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                            <label>Menu Name *</label>
                                            <input value="{{ isset($data['item']) ? $data['item']['menu_name'] : null }}" type="text" class="form-control" name="menu_name" placeholder="Menu Name" required>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                            <label>Route</label>
                                            <input value="{{ isset($data['item']) ? $data['item']['route'] : null }}" type="text" class="form-control" name="route" placeholder="example.index">
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
        // function profile(input) {
        //     if (input.files && input.files[0]) {
        //         var reader = new FileReader();
        //         reader.onload = function(e) {
        //             $('#image_view').attr('src', e.target.result);
        //         };
        //         reader.readAsDataURL(input.files[0]);
        //     }
        // }
    </script>
@endsection
