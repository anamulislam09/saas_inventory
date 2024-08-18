@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Holiday</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Holiday</li>
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
                            <form action="{{ isset($data['item']) ? route('holidays.update',$data['item']->id) : route('holidays.store'); }}" method="POST" enctype="multipart/form-data">
                                @csrf()
                                @if(isset($data['item']))
                                    @method('put')
                                @endif
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12" id="benefit_div">
                                            <div class="row benefit-row">
                                                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                                    <label>Date *</label>
                                                    <input type="date" class="form-control" name="date[]" required>
                                                </div>
                                                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                                    <label>Occasion *</label>
                                                    <input type="text" class="form-control" name="occasion[]" placeholder="Occasion" required>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <input type="button" class="btn btn-info btn-sm p-1 m-0" id="add_more" value="Add More">
                                                    </div>
                                                </div>
                                            </div>
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
        $(document).ready(function(){
            $('#add_more').on('click',function(){
            let cont = '';
                cont +='<div class="row benefit-row">';
                cont += '<div class="form-group col-sm-12 col-md-6 col-lg-6">';
                cont +=     '<label>Date *</label>';
                cont +=     '<input type="date" class="form-control" name="date[]" required>';
                cont += '</div>';
                cont += '<div class="form-group col-sm-12 col-md-6 col-lg-6">';
                cont +=     '<label>Occasion *</label>';
                cont +=     '<input type="text" class="form-control" name="occasion[]" placeholder="Occasion" required>';
                cont += '</div>';
                cont += '<div class="col-12">';
                cont +=     '<div class="form-group">';
                cont +=         '<input type="button" class="btn btn-danger btn-sm p-1 m-0 remove" value="Remove">';
                cont +=     '</div>';
                cont += '</div>';
                cont +='</div>';
                $("#benefit_div").append(cont);
            });
            $('#benefit_div').on('click',(e)=>{$(e.target).is('.remove') && $(e.target).closest('.benefit-row').remove();});
        });
    </script>
@endsection