@extends('admin.layout.master')

@section('styles')
    <style>
        input.form-control{
            width: 25% !important;
        }
    </style>
@stop

@section('body')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Notification Emails</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Notification Emails</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-7">
            </div>

            @if(\Illuminate\Support\Facades\Session::has('message'))
                <div class="col-12 alert alert-success response-message">
                    <div class="message">
                        <p>{{\Illuminate\Support\Facades\Session::get('message')}}</p>
                    </div>

                    <div class="close-response-message">
                        <i class="fa fa-times"></i>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-5">

                            </div>

                            <div class="col-7"></div>
                        </div>
                        <div class="col-5">
                            <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-email-alert"></i>Notification
                                Emails</h6>
                        </div>
                        <form action="{{isset($data) ? url('admin/notification-emails/'.$data->id.'/update') : url('admin/notification-emails/submit')}}"
                              enctype="multipart/form-data" method="post"
                              id="notificationEmailForm">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="col-md-12">Email For Destination Review Alert</label>
                                <div class="col-md-12">
                                    <input class="form-control"
                                           value="{{old('destination_review_alert', isset($data) ? $data->destination_review_alert : '')}}"
                                           type="text" name="destination_review_alert">
                                    @if($errors->has('destination_review_alert'))
                                        <span class="validation-error">{{$errors->first('destination_review_alert')}}</span>
                                    @endif
                                    <span class="destination-review-alert-error validation-error"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12">Email For Booking Alert</label>
                                <div class="col-md-12">
                                    <input class="form-control"
                                           value="{{old('booking_alert', isset($data) ? $data->booking_alert : '')}}"
                                           type="text" name="booking_alert">
                                    @if($errors->has('booking_alert'))
                                        <span class="validation-error">{{$errors->first('booking_alert')}}</span>
                                    @endif
                                    <span class="booking-alert-error validation-error"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12">Email For Destination Inquiries</label>
                                <div class="col-md-12">
                                    <input class="form-control"
                                           value="{{old('inquiry_alert', isset($data) ? $data->inquiry_alert : '')}}"
                                           type="text" name="inquiry_alert">
                                    @if($errors->has('inquiry_alert'))
                                        <span class="validation-error">{{$errors->first('inquiry_alert')}}</span>
                                    @endif
                                    <span class="inquiry-alert-error validation-error"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12">Email For Feedback Alerts</label>
                                <div class="col-md-12">
                                    <input class="form-control"
                                           value="{{old('feedback_alert', isset($data) ? $data->feedback_alert : '')}}"
                                           type="text" name="feedback_alert">
                                    @if($errors->has('feedback_alert'))
                                        <span class="validation-error">{{$errors->first('feedback_alert')}}</span>
                                    @endif
                                    <span class="feedback-alert-error validation-error"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit"
                                            class="btn btn-success">{{isset($data) ? 'Update' : 'Submit'}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
@stop