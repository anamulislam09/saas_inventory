@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Employee</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Employee</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-dark">
                            <div class="card-header">
                                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button tab-index="0" class="nav-link emp-nav active" id="pills-basic-information-tab" data-toggle="pill"
                                            data-target="#pills-basic-information" type="button" role="tab"
                                            aria-controls="pills-basic-information" aria-selected="true">Basic
                                            Information</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button tab-index="1" class="nav-link emp-nav wqwqrwq3rqwrqwr" id="pills-positional-information-tab" data-toggle="pill"
                                            data-target="#pills-positional-information" type="button" role="tab"
                                            aria-controls="pills-positional-information" aria-selected="false">Positional
                                            Information</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button tab-index="2" class="nav-link emp-nav" id="pills-benefits-tab" data-toggle="pill"
                                            data-target="#pills-benefits" type="button" role="tab"
                                            aria-controls="pills-benefits" aria-selected="false">Benefits</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button tab-index="3" class="nav-link emp-nav" id="pills-biographical-information-tab" data-toggle="pill"
                                            data-target="#pills-biographical-information" type="button" role="tab"
                                            aria-controls="pills-biographical-information"
                                            aria-selected="false">Biographical Information</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button tab-index="4" class="nav-link emp-nav" id="pills-additional-address-tab" data-toggle="pill"
                                            data-target="#pills-additional-address" type="button" role="tab"
                                            aria-controls="pills-additional-address" aria-selected="false">Additional
                                            Address</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button tab-index="5" class="nav-link emp-nav" id="pills-emergency-contact-tab" data-toggle="pill"
                                            data-target="#pills-emergency-contact" type="button" role="tab"
                                            aria-controls="pills-emergency-contact" aria-selected="false">Emergency
                                            Contact</button>
                                    </li>
                                </ul>
                            </div>
                            <form id="form" action="{{ isset($data['item']) ? route('employees.update', $data['item']->id) : route('employees.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf()
                                @if (isset($data['item']))
                                    @method('put')
                                @endif
                                <div class="card-body">
                                    <div class="row">
                                        <div class="tab-content" id="pills-tabContent" style="width: 100%">
                                            <div tab-cont="0" class="tab-pane fade show active" id="pills-basic-information"
                                                role="tabpanel" aria-labelledby="pills-home-tab">
                                                <div class="row">
                                                        <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                                            <label>Full Name *</label>
                                                            <input value="{{ isset($data['item']) ? $data['item']->name : null }}" type="text" class="form-control" name="name" id="name" placeholder="Full Name" required>
                                                        </div>
                                                        <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                                            <label>Contact *</label>
                                                            <input value="{{ isset($data['item']) ? $data['item']->contact : null }}" type="number" class="form-control" name="contact" id="contact" placeholder="+8801*********" required>
                                                        </div>
                                                        <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                                            <label>Email *</label>
                                                            <input value="{{ isset($data['item']) ? $data['item']->email : null }}" type="email" class="form-control" name="email" id="email" placeholder="example@gmail.com" required>
                                                        </div>
                                                        <div class="form-group col-sm-12 col-md-3 col-lg-3">
                                                            <label>Country</label>
                                                            <select name="country_id" id="country_id" class="form-control">
                                                                <option value="">Select Category Type</option>
                                                                @foreach($data['countries'] as $key => $country)
                                                                    <option  @isset($data['item']) @if( $data['item']->country_id == $country->id ) selected @endif @endisset value="{{ $country->id }}">{{ $country->country_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-sm-12 col-md-3 col-lg-3">
                                                            <label>State</label>
                                                            <input value="{{ isset($data['item']) ? $data['item']->state : null }}" type="text" class="form-control" name="state" placeholder="State">
                                                        </div>
                                                        <div class="form-group col-sm-12 col-md-3 col-lg-3">
                                                            <label>City</label>
                                                            <input value="{{ isset($data['item']) ? $data['item']->city : null }}" type="text" class="form-control" name="city" placeholder="City">
                                                        </div>
                                                        <div class="form-group col-sm-12 col-md-3 col-lg-3">
                                                            <label>Zip</label>
                                                            <input value="{{ isset($data['item']) ? $data['item']->zip : null }}" type="number" class="form-control" name="zip" placeholder="1212">
                                                        </div>
                                                </div> 
                                            </div>
                                            <div tab-cont="1" class="tab-pane fade" id="pills-positional-information" role="tabpanel" aria-labelledby="pills-positional-information-tab">
                                                <div class="row">
                                                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                                        <label>Division *</label>
                                                        <select name="division_id" id="division_id" class="form-control" required>
                                                            <option value="">Select Division</option>
                                                            @foreach($data['divisions'] as $key => $department)
                                                                
                                                                <option value="{{ $department->id }}" disabled>{{ $department->title }}</option>
                                                                    @foreach($department->divisions as $divkey => $division)
                                                                       <option  @isset($data['item']) @if( $data['item']->division_id == $division->id ) selected @endif @endisset value="{{ $division->id }}">&nbsp;&RightArrow; {{ $division->title }}</option>
                                                                    @endforeach
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                                        <label>Designation *</label>
                                                        <select name="designation_id" id="designation_id" class="form-control" required>
                                                            <option value="">Select Designation</option>
                                                            @foreach($data['designations'] as $key => $designation)
                                                                <option  @isset($data['item']) @if( $data['item']->designation_id == $designation->id ) selected @endif @endisset value="{{ $designation->id }}">{{ $designation->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                                        <label>Duty Type</label>
                                                        <select name="duty_type" id="duty_type" class="form-control">
                                                            <option @isset($data['item']) @if( $data['item']->duty_type == $designation->id ) selected @endif @endisset value="Full Time">Full Time</option>
                                                            <option @isset($data['item']) @if( $data['item']->duty_type == $designation->id ) selected @endif @endisset value="Part Time">Part Time</option>
                                                            <option @isset($data['item']) @if( $data['item']->duty_type == $designation->id ) selected @endif @endisset value="Contructual">Contructual</option>
                                                            <option @isset($data['item']) @if( $data['item']->duty_type == $designation->id ) selected @endif @endisset value="Others">Others</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                                        <label>Hire Date *</label>
                                                        <input value="{{ isset($data['item']) ? $data['item']->hire_date : null }}" type="date" class="form-control" name="hire_date" id="hire_date" placeholder="Hire Date" required>
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                                        <label>Original Hire Date *</label>
                                                        <input value="{{ isset($data['item']) ? $data['item']->original_hire_date : null }}" type="date" class="form-control" name="original_hire_date" id="original_hire_date" placeholder="Original Hire Date" required>
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-3">
                                                        <label>Termination Date</label>
                                                        <input value="{{ isset($data['item']) ? $data['item']->termination_date : null }}" type="date" class="form-control" name="termination_date" id="termination_date">
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-3">
                                                        <label>Termination Reason</label>
                                                        <input value="{{ isset($data['item']) ? $data['item']->termination_reason : null }}" type="text" class="form-control" name="termination_reason" id="termination_reason" placeholder="Termination Reason">
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-3">
                                                        <label>Termination Voluntary</label>
                                                        <select name="termination_voluntary" id="termination_voluntary" class="form-control">
                                                            <option @isset($data['item']) @if( $data['item']->termination_voluntary == "Yes" ) selected @endif @endisset value="Yes">Yes</option>
                                                            <option @isset($data['item']) @if( $data['item']->termination_voluntary == "No" ) selected @endif @endisset value="No">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-3">
                                                        <label>Rehire Date</label>
                                                        <input value="{{ isset($data['item']) ? $data['item']->rehire_date : null }}" type="date" class="form-control" name="rehire_date" id="rehire_date" placeholder="Rehire Date">
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-3 col-lg-3">
                                                        <label>Rate Type *</label>
                                                        <select name="rate_type" id="rate_type" class="form-control" required>
                                                            {{-- <option @isset($data['item']) @if( $data['item']->rate_type == 'Hourly' ) selected @endif @endisset value="Hourly">Hourly</option> --}}
                                                            <option @selected(true) @isset($data['item']) @if( $data['item']->rate_type == 'Salary' ) selected @endif @endisset value="Salary">Salary</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-3 col-lg-3">
                                                        <label>Rate *</label>
                                                        <input value="{{ isset($data['item']) ? $data['item']->rate : null }}" type="number" class="form-control" name="rate" id="rate" placeholder="0.00" required>
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-3 col-lg-3">
                                                        <label>Bonus *</label>
                                                        <input value="{{ isset($data['item']) ? $data['item']->bonus : null }}" type="number" class="form-control" name="bonus" id="bonus" placeholder="0.00" required>
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-3 col-lg-3">
                                                        <label>Leave Days *</label>
                                                        <input value="{{ isset($data['item']) ? $data['item']->allocate_leave : null }}" @disabled(isset($data['item'])) type="number" class="form-control" name="allocate_leave" id="allocate_leave" placeholder="0.00" required>
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                                        <label>Pay Frequency *</label>
                                                        <select name="pay_frequency" id="pay_frequency" class="form-control" required>
                                                            <option @isset($data['item']) @if( $data['item']->pay_frequency == 'Weekly' ) selected @endif @endisset value="Weekly">Weekly</option>
                                                            <option @isset($data['item']) @if( $data['item']->pay_frequency == 'Biweekly' ) selected @endif @endisset value="Biweekly">Biweekly</option>
                                                            <option @isset($data['item']) @if( $data['item']->pay_frequency == 'Annually' ) selected @endif @endisset value="Annually">Annually</option>
                                                            <option @isset($data['item']) @if( $data['item']->pay_frequency == 'Monthly' ) selected @endif @endisset value="Monthly">Monthly</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                                        <label>Pay Frequency Description</label>
                                                        <input value="{{ isset($data['item']) ? $data['item']->pay_frequency_desc : null }}" type="text" class="form-control" name="pay_frequency_desc" id="pay_frequency_desc" placeholder="Pay Frequency Description">
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                                        <label>Status *</label>
                                                        <select name="status" id="status" class="form-control">
                                                            <option {{ isset($data['item']) ? $data['item']->status == 1 ? 'selected' : null : null }} value="1">Active</option>
                                                            <option {{ isset($data['item']) ? $data['item']->status == 0 ? 'selected' : null : null }} value="0">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div tab-cont="2" class="tab-pane fade" id="pills-benefits" role="tabpanel" aria-labelledby="pills-benefits-tab" style="width: 100%">
                                                <div class="row">
                                                    <div class="col-12" id="benefit_div">
                                                        @if(!isset($data['benefits']))
                                                            <div class="row benefit-row">
                                                                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                                                    <label>Benefit Class Code</label>
                                                                    <input value="{{ isset($data['item']) ? $data['item']->code : null }}" type="text" class="form-control" name="code[]" placeholder="Benefit Class Code">
                                                                </div>
                                                                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                                                    <label>Benefit Description</label>
                                                                    <input value="{{ isset($data['item']) ? $data['item']->description : null }}" type="text" class="form-control" name="description[]" placeholder="Benefit Description">
                                                                </div>
                                                                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                                                    <label>Benefit Accrual Date</label>
                                                                    <input value="{{ isset($data['item']) ? $data['item']->accrual_date : null }}" type="date" class="form-control" name="accrual_date[]">
                                                                </div>
                                                                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                                                    <label>Status</label>
                                                                    <select name="benefit_status[]" class="form-control">
                                                                        <option {{ isset($data['item']) ? $data['item']->status == 1 ? 'selected' : null : null }} value="1">Active</option>
                                                                        <option {{ isset($data['item']) ? $data['item']->status == 0 ? 'selected' : null : null }} value="0">Inactive</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <input type="button" class="btn btn-info btn-sm p-1 m-0" id="add_more" value="Add More">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @isset($data['benefits'])
                                                            @foreach($data['benefits'] as $key => $benefit)
                                                                <div class="row benefit-row">
                                                                    <input value="{{ $benefit->id }}" type="hidden" name="benefit_id[]">
                                                                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                                                        <label>Benefit Class Code</label>
                                                                        <input value="{{ $benefit->code }}" type="text" class="form-control" name="code[]" placeholder="Benefit Class Code">
                                                                    </div>
                                                                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                                                        <label>Benefit Description</label>
                                                                        <input value="{{ $benefit->description }}" type="text" class="form-control" name="description[]" placeholder="Benefit Description">
                                                                    </div>
                                                                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                                                        <label>Benefit Accrual Date</label>
                                                                        <input value="{{ $benefit->accrual_date }}" type="date" class="form-control" name="accrual_date[]">
                                                                    </div>
                                                                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                                                        <label>Status</label>
                                                                        <select name="benefit_status[]" class="form-control">
                                                                            <option {{ $benefit->status == 1 ? 'selected': null }} value="1">Active</option>
                                                                            <option {{ $benefit->status == 0 ? 'selected': null }} value="0">Inactive</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <input type="button" class="btn btn-info btn-sm p-1 m-0" id="add_more" value="Add More">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        @endisset
                                                    </div>
                                                </div>
                                            </div>
                                            <div tab-cont="3" class="tab-pane fade" id="pills-biographical-information"
                                                role="tabpanel" aria-labelledby="pills-profile-tab">
                                                <div class="row">
                                                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                                        <label>Date Of Birth *</label>
                                                        <input value="{{ isset($data['item']) ? $data['item']->date_of_birth : null }}" type="date" class="form-control" name="date_of_birth" id="date_of_birth" required>
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                                        <label>Gender *</label>
                                                        <select name="gender" id="gender" class="form-control" required>
                                                            <option @isset($data['item']) @if( $data['item']->gender == "Male" ) selected @endif @endisset value="Male">Male</option>
                                                            <option @isset($data['item']) @if( $data['item']->gender == "Female" ) selected @endif @endisset value="Female">Female</option>
                                                            <option @isset($data['item']) @if( $data['item']->gender == "Other" ) selected @endif @endisset value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                                        <label>Marital Status</label>
                                                        <select name="marital_status" id="marital_status" class="form-control">
                                                            <option @isset($data['item']) @if( $data['item']->marital_status == "Single" ) selected @endif @endisset value="Single">Single</option>
                                                            <option @isset($data['item']) @if( $data['item']->marital_status == "Married" ) selected @endif @endisset value="Married">Married</option>
                                                            <option @isset($data['item']) @if( $data['item']->marital_status == "Divorced" ) selected @endif @endisset value="Divorced">Divorced</option>
                                                            <option @isset($data['item']) @if( $data['item']->marital_status == "Widowed" ) selected @endif @endisset value="Widowed">Widowed</option>
                                                            <option @isset($data['item']) @if( $data['item']->marital_status == "Other" ) selected @endif @endisset value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                                        <label>Ethnic Group</label>
                                                        <input value="{{ isset($data['item']) ? $data['item']->ethnic_group : null }}" type="text" class="form-control" name="ethnic_group" placeholder="Ethnic Group">
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                                        <label>EEO Class</label>
                                                        <input value="{{ isset($data['item']) ? $data['item']->eeo_class : null }}" type="text" class="form-control" name="eeo_class" placeholder="EEO Class">
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                                        <label>SSN</label>
                                                        <input value="{{ isset($data['item']) ? $data['item']->ssn : null }}" type="text" class="form-control" name="ssn" placeholder="SSN">
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                                        <label>Work In State</label>
                                                        <select name="work_in_state" id="work_in_state" class="form-control">
                                                            <option @isset($data['item']) @if( $data['item']->work_in_state == $designation->id ) selected @endif @endisset value="Yes">Yes</option>
                                                            <option @isset($data['item']) @if( $data['item']->work_in_state == $designation->id ) selected @endif @endisset value="No">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                                        <label>Live In State</label>
                                                        <select name="live_in_state" id="live_in_state" class="form-control">
                                                            <option @isset($data['item']) @if( $data['item']->live_in_state == $designation->id ) selected @endif @endisset value="Yes">Yes</option>
                                                            <option @isset($data['item']) @if( $data['item']->live_in_state == $designation->id ) selected @endif @endisset value="No">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                                        <label>Image</label>
                                                        <input value="{{ isset($data['item']) ? $data['item']->image : null }}" type="file" class="form-control" name="image">
                                                    </div>
                                                </div> 
                                            </div>
                                            <div tab-cont="4" class="tab-pane fade" id="pills-additional-address" role="tabpanel" aria-labelledby="pills-contact-tab">
                                                 <div class="row">
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                                        <label>Cell Phone *</label>
                                                        <input value="{{ isset($data['item']) ? $data['item']->cell_phone : null }}" type="number" class="form-control" name="cell_phone" id="cell_phone" placeholder="+8801*********" required>
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                                        <label>Home Phone *</label>
                                                        <input value="{{ isset($data['item']) ? $data['item']->home_phone : null }}" type="number" class="form-control" name="home_phone" id="home_phone" placeholder="+8801*********" required>
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                                        <label>Business Phone</label>
                                                        <input value="{{ isset($data['item']) ? $data['item']->business_phone : null }}" type="number" class="form-control" name="business_phone" placeholder="+8801*********">
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                                        <label>Home Email</label>
                                                        <input value="{{ isset($data['item']) ? $data['item']->home_email : null }}" type="email" class="form-control" name="home_email" placeholder="home@gmail.com">
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                                        <label>Business Email</label>
                                                        <input value="{{ isset($data['item']) ? $data['item']->business_email : null }}" type="email" class="form-control" name="business_email" placeholder="business@gmail.com">
                                                    </div>
                                                </div> 
                                            </div>
                                            <div tab-cont="5" class="tab-pane fade" id="pills-emergency-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                                <div class="row">
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                                        <label>Emergency Contact *</label>
                                                        <input value="{{ isset($data['item']) ? $data['item']->emerg_cont : null }}" type="number" class="form-control" name="emerg_cont" placeholder="+8801*********" required>
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                                        <label>Emergency Contact Home *</label>
                                                        <input value="{{ isset($data['item']) ? $data['item']->emerg_home_cont : null }}" type="number" class="form-control" name="emerg_home_cont" placeholder="+8801*********" required>
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                                        <label>Emergency Contact Work *</label>
                                                        <input value="{{ isset($data['item']) ? $data['item']->emerg_work_cont : null }}" type="number" class="form-control" name="emerg_work_cont" placeholder="+8801*********" required>
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                                        <label>Emergency Contact Alt</label>
                                                        <input value="{{ isset($data['item']) ? $data['item']->emerg_cont_alt : null }}" type="number" class="form-control" name="emerg_cont_alt" placeholder="+8801*********">
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                                        <label>Emergency Contact Home Alt</label>
                                                        <input value="{{ isset($data['item']) ? $data['item']->emerg_cont_home_alt : null }}" type="number" class="form-control" name="emerg_cont_home_alt" placeholder="+8801*********">
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                                        <label>Emergency Contact Work Alt</label>
                                                        <input value="{{ isset($data['item']) ? $data['item']->emerg_cont_work_alt : null }}" type="number" class="form-control" name="emerg_cont_work_alt" placeholder="+8801*********">
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                                        <label>Emergency Contact Relation</label>
                                                        <input value="{{ isset($data['item']) ? $data['item']->emerg_cont_relations : null }}" type="text" class="form-control" name="emerg_cont_relations" placeholder="Emergency Contact Relation">
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    {{-- <button id="btn_submit" type="button" class="btn btn-info float-right mx-1">Submit</button> --}}
                                    <button id="btn_submit" type="submit" class="btn btn-info float-right mx-1" hidden>Submit</button>
                                    <button id="btn_next" type="button" class="btn btn-primary float-right">Next</button>
                                    <button id="btn_previous" type="button" class="btn btn-primary float-right mx-1" disabled>Previous</button>
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
                cont +=     '<label>Benefit Class Code</label>';
                cont +=     '<input type="text" class="form-control" name="code[]" placeholder="Benefit Class Code">';
                cont += '</div>';
                cont += '<div class="form-group col-sm-12 col-md-6 col-lg-6">';
                cont +=     '<label>Benefit Description</label>';
                cont +=     '<input type="text" class="form-control" name="description[]" placeholder="Benefit Description">';
                cont += '</div>';
                cont += '<div class="form-group col-sm-12 col-md-6 col-lg-6">';
                cont +=     '<label>Benefit Accrual Date</label>';
                cont +=     '<input type="date" class="form-control" name="accrual_date[]" placeholder="Benefit Accrual Date">';
                cont += '</div>';
                cont += '<div class="form-group col-sm-12 col-md-6 col-lg-6">';
                cont +=     '<label>Status</label>';
                cont +=     '<select name="benefit_status[]" class="form-control">';
                cont +=         '<option value="1">Active</option>';
                cont +=         '<option value="0">Inactive</option>';
                cont +=     '</select>';
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

            $('.emp-nav').on('click',function(){
                let tab_index = parseInt($(this).attr('tab-index'));
                disable_controler(tab_index);
            });

            $('#btn_next').on('click',function(){ 
                $('.emp-nav').each(function(index, element){
                    if($(this).hasClass('active')){
                        $(this).toggleClass('active');
                        let current_tab = parseInt($(this).attr('tab-index'));
                        $('[tab-cont='+current_tab+']').toggleClass("show active");

                        let next_tab = ++current_tab;
                        $('[tab-index='+next_tab+']').toggleClass('active');
                        $('[tab-cont='+next_tab+']').toggleClass("show active");
                        disable_controler(next_tab);
                        return false;
                    }
                });
            });
            $('#btn_previous').on('click',function(){ 
                $('.emp-nav').each(function(index, element){
                    if($(this).hasClass('active')){
                        $(this).toggleClass('active');
                        let current_tab = parseInt($(this).attr('tab-index'));
                        $('[tab-cont='+current_tab+']').toggleClass("show active");
                        
                        let previous_tab = --current_tab;
                        $('[tab-index='+previous_tab+']').toggleClass('active');
                        $('[tab-cont='+previous_tab+']').toggleClass("show active");
                        disable_controler(previous_tab);
                        return false;
                    }
                });
            });

            $('#btn_submit').on('click',function(e){

                let name = $('#name').val();
                let contact = $('#contact').val();
                let email = $('#email').val();

                let division_id = $('#division_id').val();
                let designation_id = $('#designation_id').val();
                let hire_date = $('#hire_date').val();
                let original_hire_date = $('#original_hire_date').val();
                let rate_type = $('#rate_type').val();
                let rate = $('#rate').val();
                let pay_frequency = $('#pay_frequency').val();

                let date_of_birth = $('#date_of_birth').val();
                let gender = $('#gender').val();

                let cell_phone = $('#cell_phone').val();
                let home_phone = $('#home_phone').val();

                let emerg_cont = $('#emerg_cont').val();
                let emerg_home_cont = $('#emerg_home_cont').val();
                let emerg_work_cont = $('#emerg_work_cont').val();

                if(!(name && contact && email)){return activeRequiredTab(0);}
                else if(!(division_id && designation_id && hire_date && original_hire_date && rate_type && rate && pay_frequency)){return activeRequiredTab(1);}
                else if(!(date_of_birth && gender)){return activeRequiredTab(3);}
                else if(!(cell_phone && home_phone)){return activeRequiredTab(4);}
                else if(!(emerg_cont && emerg_home_cont && emerg_work_cont)){return activeRequiredTab(5);}

                $('#form').submit();

            });


        });

        function activeRequiredTab(new_tab){
            $('.emp-nav').each(function(index, element){
                if($(this).hasClass('active')){
                    $(this).toggleClass('active');
                    let old_tab = parseInt($(this).attr('tab-index'));
                    $('[tab-cont='+old_tab+']').toggleClass("show active");
                    $('[tab-index='+new_tab+']').toggleClass('active');
                    $('[tab-cont='+new_tab+']').toggleClass("show active");
                    disable_controler(new_tab);
                    return false;
                }
            });
        }

        function disable_controler(tab_index){
            if(tab_index==0){
                    $('#btn_previous').attr('disabled', true);
                    $('#btn_next').attr('hidden', false);
                    $('#btn_submit').attr('hidden', true);
                } else if(tab_index==5){
                    $('#btn_previous').attr('disabled', false);
                    $('#btn_next').attr('hidden', true);
                    $('#btn_submit').attr('hidden', false);
                }else{
                    $('#btn_previous').attr('disabled', false);
                    $('#btn_next').attr('hidden', false);
                    $('#btn_submit').attr('hidden', true);
                }
        }
    </script>
@endsection