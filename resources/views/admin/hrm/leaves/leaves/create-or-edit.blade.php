@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Leave</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Leave</li>
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
                            <form id="form-submit" action="{{ isset($data['item']) ? route('leaves.update',$data['item']->id) : route('leaves.store'); }}" method="POST" enctype="multipart/form-data">
                                @csrf()
                                @if(isset($data['item']))
                                    @method('put')
                                @endif
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-sm-3 col-md-3 col-lg-3">
                                            <label>Leave Taken By *</label>
                                            <select name="leave_taken_by_id" id="leave_taken_by_id" class="form-control" required>
                                                <option value="">Select Employee</option>
                                                @foreach($data['employees'] as $employee)
                                                    <option remaining_leave="{{ $employee->remaining_leave }}" @isset($data['item']) @if( $data['item']->leave_taken_by_id == $employee->id ) selected @endif @endisset value="{{ $employee->id }}">{{ $employee->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-3 col-md-3 col-lg-3">
                                            <label>Remaining Leave Days</label>
                                            <input disabled type="text" class="form-control" name="remaining_leave" id="remaining_leave" placeholder="0.00">
                                        </div>
                                        <div class="form-group col-sm-3 col-md-3 col-lg-3">
                                            <label>Duty Hand Over To</label>
                                            <select name="handover_to_id" id="handover_to_id" class="form-control" required>
                                                <option value="">Select Employee</option>
                                                @foreach($data['employees'] as $employee)
                                                    <option  @isset($data['item']) @if( $data['item']->handover_to_id == $employee->id ) selected @endif @endisset value="{{ $employee->id }}">{{ $employee->name }}</option>
                                                @endforeach
                                        </select>
                                        </div>
                                        <div class="form-group col-sm-3 col-md-3 col-lg-3">
                                            <label>Leave Type *</label>
                                            <select name="leave_type_id" id="leave_type_id" class="form-control" required>
                                                <option value="">Select Leave Type</option>
                                                @foreach($data['leaveTypes'] as $leaveType)
                                                    <option  @isset($data['item']) @if( $data['item']->leave_type_id == $leaveType->id ) selected @endif @endisset value="{{ $leaveType->id }}">{{ $leaveType->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                            <label>Application Start Date *</label>
                                            <input value="{{ isset($data['item']) ? $data['item']->application_start_date : null }}" type="date" class="form-control" name="application_start_date" id="application_start_date" required>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                            <label>Application End Date *</label>
                                            <input value="{{ isset($data['item']) ? $data['item']->application_end_date : null }}" type="date" class="form-control" name="application_end_date" id="application_end_date" required>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                            <label>Application Days *</label>
                                            <input readonly value="{{ isset($data['item']) ? $data['item']->application_days : null }}" type="number" class="form-control" name="application_days" id="application_days" placeholder="0.00">
                                        </div>
                                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                            <label>Approved Start Date *</label>
                                            <input value="{{ isset($data['item']) ? $data['item']->approved_start_date : null }}" type="date" class="form-control" name="approved_start_date" id="approved_start_date" required>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                            <label>Approved End Date *</label>
                                            <input value="{{ isset($data['item']) ? $data['item']->approved_end_date : null }}" type="date" class="form-control" name="approved_end_date" id="approved_end_date" required>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                            <label>Approved Days *</label>
                                            <input readonly value="{{ isset($data['item']) ? $data['item']->approved_days : null }}" type="number" class="form-control" name="approved_days" id="approved_days" placeholder="0.00">
                                        </div>
                                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                            <label>Application Hard Copy</label>
                                            <input value="{{ isset($data['item']) ? $data['item']->image : 10 }}" type="file" class="form-control" name="image">
                                        </div>
                                        <div class="form-group col-sm-8 col-md-8 col-lg-8">
                                            <label>Reason</label>
                                            <textarea name="reason" id="reason" cols="30" rows="1" class="form-control" placeholder="Reason"></textarea>
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
            $('#leave_taken_by_id').on('change',function(){
                let leave_taken_by_id = $(this).val();
                let remaining_leave = $('#leave_taken_by_id option:selected').attr('remaining_leave');
                $('#remaining_leave').val(remaining_leave);
                $('#handover_to_id option[value!="'+leave_taken_by_id+'"]').attr({disabled: false, hidden: false});
                $('#handover_to_id option[value="'+leave_taken_by_id+'"]').attr({disabled: true, hidden: true});
                $('#handover_to_id').val('');
            });
            $('#application_start_date, #application_end_date').on('change',function(){
                let application_start_date = $('#application_start_date').val();
                let application_end_date = $('#application_end_date').val();
                    application_start_date = new Date(application_start_date);
                    application_end_date = new Date(application_end_date);
                let Difference_In_Time = application_end_date.getTime() - application_start_date.getTime();
                let Difference_In_Days = Math.round(Difference_In_Time / (1000 * 3600 * 24)) + 1;
                $('#application_days').val(Difference_In_Days);
            });
            $('#approved_start_date, #approved_end_date').on('change',function(){
                let approved_start_date = $('#approved_start_date').val();
                let approved_end_date = $('#approved_end_date').val();
                    approved_start_date = new Date(approved_start_date);
                    approved_end_date = new Date(approved_end_date);
                let Difference_In_Time = approved_end_date.getTime() - approved_start_date.getTime();
                let Difference_In_Days = Math.round(Difference_In_Time / (1000 * 3600 * 24)) + 1;
                $('#approved_days').val(Difference_In_Days);
            });
            $('#form-submit').submit(function(e) {
                let approved_days = parseInt($('#approved_days').val());
                let remaining_leave = parseInt($('#remaining_leave').val());
                if (remaining_leave < approved_days) {
                    e.preventDefault();
                    Swal.fire("Remaining leave exceed!");
                }
            });
        });
    </script>
@endsection