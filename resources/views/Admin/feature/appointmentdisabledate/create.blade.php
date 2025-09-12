@extends('layouts.admin')
@section('title', 'Create Slot Configuration')

@section('content')

<!-- Main Content -->
<div class="main-content">
        <section class="section">
                <div class="section-body">
                        <div class="server-error">
                                @include('../Elements/flash-message')
                        </div>
                        <div class="custom-error-msg">
                        </div>
                        <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                        <div class="card">
                                                <div class="card-header">
                                                        <h4>Create Slot Configuration</h4>
                                                        <div class="card-header-action">
                                                                <a href="{{route('admin.feature.appointmentdisabledate.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                                                        </div>
                                                </div>
                                                <div class="card-body">
                                                        <form action="{{route('admin.feature.appointmentdisabledate.store')}}" method="post">
                                                        @csrf
                                                        <div class="row">
                                                                <div class="col-12 col-md-6 col-lg-6">
                                                                        <div class="form-group">
                                                                                <label for="person_id">Person <span class="span_req">*</span></label>
                                                                                <select class="form-control" name="person_id" required>
                                                                                        <option value="">Select Person</option>
                                                                                        <option value="1">Ajay</option>
                                                                                        <option value="2">Shubam</option>
                                                                                        <option value="3">Tourist</option>
                                                                                        <option value="4">Education</option>
                                                                                </select>
                                                                        </div>
                                                                </div>
                                                                <div class="col-12 col-md-6 col-lg-6">
                                                                        <div class="form-group">
                                                                                <label for="service_type">Service Type</label>
                                                                                <select class="form-control" name="service_type">
                                                                                        <option value="1">Paid</option>
                                                                                        <option value="2">Free</option>
                                                                                </select>
                                                                        </div>
                                                                </div>
                                                                <div class="col-12 col-md-6 col-lg-6">
                                                                        <div class="form-group">
                                                                                <label for="start_time">Start Time <span class="span_req">*</span></label>
                                                                                <input type="time" class="form-control" name="start_time" required>
                                                                        </div>
                                                                </div>
                                                                <div class="col-12 col-md-6 col-lg-6">
                                                                        <div class="form-group">
                                                                                <label for="end_time">End Time <span class="span_req">*</span></label>
                                                                                <input type="time" class="form-control" name="end_time" required>
                                                                        </div>
                                                                </div>
                                                                <div class="col-12 col-md-12 col-lg-12">
                                                                        <div class="form-group">
                                                                                <label for="weekend">Weekend Days</label>
                                                                                <select class="form-control" name="weekend" multiple>
                                                                                        <option value="Sun">Sunday</option>
                                                                                        <option value="Mon">Monday</option>
                                                                                        <option value="Tue">Tuesday</option>
                                                                                        <option value="Wed">Wednesday</option>
                                                                                        <option value="Thu">Thursday</option>
                                                                                        <option value="Fri">Friday</option>
                                                                                        <option value="Sat">Saturday</option>
                                                                                </select>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <div class="form-group float-right">
                                                                <button type="submit" class="btn btn-primary">Create Slot Configuration</button>
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
