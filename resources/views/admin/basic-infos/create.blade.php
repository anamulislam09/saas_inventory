@extends('layouts.admin.master')
@section('content')
<style>
    label{
        font-size: 15px;
    }
    .star{
        color: #fb5200;
    }
    
    .infoText{
        color: #fb5200;
        font-size: 13px;
        padding-left: 20px;
        font-weight: 600;
    }
</style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="form-group col-sm-6">
                        <h1 class="m-0">Basic Info</h1>
                    </div>
                    <div class="form-group col-sm-6">
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
                    <div class="form-group col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Create Form</h3>
                            </div>
                            <form action="{{ route('basic-infos.store')}}" method="post" enctype="multipart/form-data">
                              @csrf
                              <span class="infoText">Info:( * ) Marked Fields are Required.</span>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-sm-6 col-md-3 col-lg-3">
                                            <label class="form-label">Title<span class="star">*</span></label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                value="" placeholder="Title" required>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-3 col-lg-3">
                                            <label class="form-label">Phone-1<span class="star">*</span></label>
                                            <input type="text" class="form-control" id="phone1" name="phone1"
                                                value="" placeholder="+88018XXXXXXXX" required>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-3 col-lg-3">
                                            <label class="form-label">Phone-2*</label>
                                            <input type="text" class="form-control" id="phone2" name="phone2"
                                                value="" placeholder="+88018XXXXXXXX">
                                        </div>
                                        <div class="form-group col-sm-6 col-md-3 col-lg-3">
                                            <label class="form-label">Currency<span class="star">*</span></label>
                                            <select class="form-control" id="currency_symbol_id" name="currency_symbol_id" required>
                                                <option value=''>Select Currency</option>
                                                @foreach ($currencys as $currency)
                                                    <option value="{{ $currency->id }}">{{ $currency->country }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                            <label class="form-label">Moto</label>
                                            <textarea class="form-control" id="moto" name="moto" cols="30" rows="3" placeholder="Moto"></textarea>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                            <label class="form-label">Address<span class="star">*</span></label>
                                            <textarea class="form-control" id="address" name="address" cols="30" rows="3" placeholder="Address" required></textarea>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-3 col-lg-3">
                                            <label class="form-label">Email<span class="star">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value=""placeholder="Email" required>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-3 col-lg-3">
                                            <label for="logo" class="form-label">Logo (141 X 29)<span class="star">*</span></label>
                                            <input type="file" name="logo" class="form-control">
                                        </div>
                                        <div class="form-group col-sm-4 col-md-3 col-lg-3">
                                            <label for="favIcon" class="form-label">Fab Icon (32 X 32)</label>
                                            <input type="file" name="favIcon" class="form-control">
                                        </div>
                                        <div class="form-group col-sm-4 col-md-3 col-lg-3">
                                            <label for="acceptPaymentType" class="form-label">Accept Payment Types (267 X 39)</label>
                                            <input type="file" name="acceptPaymentType" class="form-control">
                                        </div>
                                        {{-- <div class="form-group col-sm-6 col-md-4 col-lg-4">
                                            <label class="form-label">Copy Right Text*</label>
                                            <input type="text" class="form-control" id="copyRightName" name="copyRightName"
                                                value="{{ $b    asicInfo->copyRightName }}" placeholder="Copy Right Name" required>
                                        </div> --}}
                                        {{-- <p>Copyright © <a href="{{ $basicInfo->copyRightLink }}">{{ $basicInfo->copyRightName }}</a>All Rights Reserved.</p> --}}
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                            <label class="form-label">Copy Right Text<span class="star">*</span></label>
                                            <textarea id="copyRightName" name="copyRightName" required></textarea>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12" hidden>
                                            <label for="inputAddress" class="form-label">Copy Right Link<span class="star">*</span></label>
                                            <input type="text" class="form-control" id="copyRightLink" name="copyRightLink"
                                                value="" placeholder="Copy Right Link">
                                        </div>
                                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                            <label for="mapLink" class="form-label">Location Map Link</label>
                                            <input type="text" class="form-control" id="mapLink" name="mapLink"
                                                value="" placeholder="Location Map Link">
                                        </div>
                                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                            <label for="facebook" class="form-label">Facebook Link</label>
                                            <input type="text" class="form-control" id="facebook" name="facebook"
                                                value="" placeholder="Facebook Link">
                                        </div>
                                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                            <label for="instagram" class="form-label">Instagram Link</label>
                                            <input type="text" class="form-control" id="instagram" name="instagram"
                                                value="" placeholder="Instagram Link">
                                        </div>
                                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                            <label for="twitter" class="form-label">Twitter Link</label>
                                            <input type="text" class="form-control" id="twitter" name="twitter"
                                                value="" placeholder="Twitter Link">
                                        </div>
                                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                            <label for="pinterest" class="form-label">Pinterest Link</label>
                                            <input type="text" class="form-control" id="pinterest" name="pinterest"
                                                value="" placeholder="Pinterest Link">
                                        </div>
                                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                            <label for="linkedIn" class="form-label">LinkedIn Link</label>
                                            <input type="text" class="form-control" id="linkedIn" name="linkedIn"
                                                value="" placeholder="LinkedIn Link">
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
    $('#copyRightName').summernote({
        placeholder: 'Copy Right Text',
        tabsize: 2,
        height: 100
    });
</script>
@endsection