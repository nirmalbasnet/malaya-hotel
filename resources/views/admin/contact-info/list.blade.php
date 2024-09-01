@extends('admin.layout.master')

@section('body')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Contact Information</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact Information</li>
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
                        </div>
                        <div class="col-5">
                            <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-contacts"></i> Contact Info</h6>
                        </div>
                        <form action="{{isset($contactInfo) ? url('admin/contact-info/'.$contactInfo->id.'/update') : url('admin/contact-info/submit')}}" enctype="multipart/form-data" method="post"
                              id="addNewMemberForm">
                            {{csrf_field()}}

                            <div class="form-group">
                                <label class="control-label col-sm-12" for="email">Mobile <span class="req">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" onfocus="removeError('mobile');" value="{{old('mobile', isset($contactInfo) ? $contactInfo->mobile : '')}}" class="form-control"
                                           id="mobile"
                                           placeholder="Enter Mobile Number" name="mobile">
                                    @if(isset($errors) && $errors->has('mobile'))
                                        <span class="validation-error">
                                            {{$errors->first('mobile')}}
                                        </span>
                                    @endif
                                    <span class="mobile-error validation-error"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-12" for="email">Landline </label>
                                <div class="col-sm-10">
                                    <input type="text" onfocus="removeError('landline');" value="{{old('landline', isset($contactInfo) ? $contactInfo->landline : '')}}" class="form-control"
                                           id="mobile"
                                           placeholder="Enter Landline Number" name="landline">
                                    @if(isset($errors) && $errors->has('landline'))
                                        <span class="validation-error">
                                            {{$errors->first('landline')}}
                                        </span>
                                    @endif
                                    <span class="landline-error validation-error"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-12" for="email">Email <span class="req">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" onfocus="removeError('email');" value="{{old('email', isset($contactInfo) ? $contactInfo->email : '')}}" class="form-control"
                                           id="email"
                                           placeholder="Enter Email Address" name="email">
                                    @if(isset($errors) && $errors->has('email'))
                                        <span class="validation-error">
                                            {{$errors->first('email')}}
                                        </span>
                                    @endif
                                    <span class="email-error validation-error"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-12" for="email">Location <span class="req">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" onfocus="removeError('location');" value="{{old('location', isset($contactInfo) ? $contactInfo->location : '')}}" class="form-control"
                                           id="location"
                                           placeholder="Enter Location" name="location">
                                    @if(isset($errors) && $errors->has('location'))
                                        <span class="validation-error">
                                            {{$errors->first('location')}}
                                        </span>
                                    @endif
                                    <span class="location-error validation-error"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-12" for="email">Opening Days &  Hours <span>[Example: Mon - Sat: 10 AM - 8 PM | Sun: 10 AM - 6 PM]</span> <span class="req">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" onfocus="removeError('opening-days-hours');" value="{{old('opening_days_hours', isset($contactInfo) ? $contactInfo->opening_days_hours : '')}}" class="form-control"
                                           id="opening-days-hours"
                                           placeholder="Enter Opening Days & Hours" name="opening_days_hours">
                                    @if(isset($errors) && $errors->has('opening_days_hours'))
                                        <span class="validation-error">
                                            {{$errors->first('opening_days_hours')}}
                                        </span>
                                    @endif
                                    <span class="opening-days-hours-error validation-error"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-12" for="email">Map Iframe <span class="req">*</span></label>
                                <div class="col-sm-10">
                                    <textarea  placeholder="Enter Google Map Iframe" name="map_iframe" id="map-iframe" onfocus="removeError('map-iframe');" class="form-control" cols="30" rows="10">{{old('map_iframe', isset($contactInfo) ? $contactInfo->map_iframe : '')}}</textarea>

                                    @if(isset($errors) && $errors->has('map_iframe'))
                                        <span class="validation-error">
                                            {{$errors->first('map_iframe')}}
                                        </span>
                                    @endif
                                    <span class="map-iframe-error validation-error"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">{{isset($contactInfo) ? 'Update' : 'Submit'}}</button>
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
    <script>
        $('#addNewMemberForm').on('submit', function (e) {
            if ($('#mobile').val() === '') {
                e.preventDefault();
                $('#mobile').css('border', '1px solid #dc3545')
                $('.mobile-error').html('This field is required');
            }

            if ($('#email').val() === '') {
                e.preventDefault();
                $('#email').css('border', '1px solid #dc3545')
                $('.email-error').html('This field is required');
            }

            if ($('#location').val() === '') {
                e.preventDefault();
                $('#location').css('border', '1px solid #dc3545')
                $('.location-error').html('This field is required');
            }

            if ($('#opening-days-hours').val() === '') {
                e.preventDefault();
                $('#opening-days-hours').css('border', '1px solid #dc3545')
                $('.opening-days-hours-error').html('This field is required');
            }

            if ($('#map-iframe').val() === '') {
                e.preventDefault();
                $('#map-iframe').css('border', '1px solid #dc3545')
                $('.map-iframe-error').html('This field is required');
            }
        });

        function removeError(element) {
            $('#'+element).css('border', '1px solid #ccc');
            $('span.'+element+'-error').html('');
        }
    </script>
@stop