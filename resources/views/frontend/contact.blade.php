@extends('frontend.layout.master')

@section('styles')
    <style>
        span.error {
            color: maroon;
            font-weight: 600;
        }
    </style>
@stop

@section('body')
    <!-- breadcrumb start -->
    <section class="breadcrumb" style="background:url({{asset('public/frontend/images/bg/traveller.jpg')}})">
        <div class="container">
            <div class="breadcrumb-item">
                <h2>Leave Feedback</h2>
                <ul>
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>Feedback</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="inner-page">
        <div class="container">
            <main>
                <div class="contact-page">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="contact-title">
                                <h3>Contact info</h3>
                            </div>
                            <div class="contact-info">
                                <p>
                                    <i class="fa fa-phone"></i>
                                    @if($contactInfo->landline != null && $contactInfo->mobile != null)
                                        {{$contactInfo->landline.' | '.$contactInfo->mobile}}
                                    @elseif($contactInfo->landline == null && $contactInfo->mobile != null)
                                        {{$contactInfo->mobile}}
                                    @elseif($contactInfo->landline != null && $contactInfo->mobile == null)
                                        {{$contactInfo->landline}}
                                    @else
                                        Not Available
                                    @endif
                                </p>
                                <p>
                                    <i class="fa fa-envelope"></i>{{$contactInfo->email != null ? $contactInfo->email : 'Not Available'}}
                                </p>
                                <p>
                                    <i class="fa fa-map-marker"> </i>{{$contactInfo->location != null ? $contactInfo->location : 'Not Available'}}
                                </p>
                                <p>
                                    <i class="fa fa-clock-o"></i>{{$contactInfo->opening_days_hours != null ? $contactInfo->opening_days_hours : 'Not Available'}}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            @if(\Illuminate\Support\Facades\Session::has('feedback-thanks'))
                                <div class="alert alert-success">
                                    <p>{{\Illuminate\Support\Facades\Session::get('feedback-thanks')}}</p>
                                </div>
                            @endif
                            <div class="contact-title">
                                <h3>Get in touch</h3>
                            </div>
                            <form id="feedbackForm" method="post" action="{{url('feedback/submit')}}">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-sm-6 ">
                                        <div class="form-group">
                                            <label>Name :</label>
                                            <input type="text" name="name" class="form-control" placeholder="name">
                                            <span class="error"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Email :</label>
                                            <input type="text" name="email" class="form-control" placeholder="email">
                                            <span class="error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Message :</label>
                                            <textarea rows="6" name="message" class="form-control"></textarea>
                                            <span class="error"></span>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn allstar-btn">Send Now</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if($contactInfo->map_iframe != null)
                        <div class="contact-map" style="border:2px solid #bcbcbc">
                            {!! $contactInfo->map_iframe !!}
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </section>
@stop

@section('scripts')
    <script>
        function validateEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(email)) {
                return false;
            } else {
                return true;
            }
        }

        $('#feedbackForm').on('submit', function (e) {
            if ($('input[name=name]').val() === '') {
                e.preventDefault();
                $('input[name=name]').next('span.error').html('Please enter your name');
            }

            if ($('input[name=email]').val() === '') {
                e.preventDefault();
                $('input[name=email]').next('span.error').html('Please enter your email');
            }

            if ($('textarea[name=message]').val() === '') {
                e.preventDefault();
                $('textarea[name=message]').next('span.error').html('Please enter your message');
            }

            if ($('input[name=email]').val() !== '') {
                var test = validateEmail($('input[name=email]').val());
                if (!test) {
                    e.preventDefault();
                    $('input[name=email]').next('span.error').html('Please enter valid email');
                }
            }
        });

        $('form#feedbackForm input').on('focus', function () {
            var check = checkLogin();
            if (check)
                $(this).next('span.error').html('');
            else {
                {{\Illuminate\Support\Facades\Session::put('redirectToFeedback', 'true')}}
                $(this).blur();
                window.location = baseurl + '/login';
            }
        });

        $('form#feedbackForm textarea').on('focus', function () {
            var check = checkLogin();
            if (check)
                $(this).next('span.error').html('');
            else {
                {{\Illuminate\Support\Facades\Session::put('redirectToFeedback', 'true')}}
                $(this).blur();
                window.location = baseurl + '/login';
            }
        });

        function checkLogin() {
            @if(\Illuminate\Support\Facades\Auth::guest())
                return false;
            @else
                return true;
            @endif
        }
    </script>
@stop