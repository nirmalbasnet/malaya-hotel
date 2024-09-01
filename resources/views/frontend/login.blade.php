@extends('frontend.layout.master')

@section('styles')
    <style>
        span.error {
            font-weight: 600;
            color: maroon;
            float: left;
        }

        div.validation-error-message p {
            font-weight: 600;
            color: maroon;
        }
    </style>
@stop

@section('body')
    <!-- breadcrumb start -->
    <section class="breadcrumb" style="background:url({{asset('public/frontend/images/bg/traveller.jpg')}})">
        <div class="container">
            <div class="breadcrumb-item">
                <h2>Login</h2>
                <ul>
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>Login</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- login form -->

    <section class="inner-page">
        <div class="container">
            <main>
                <div class="login-form" style="margin: 30px auto !important;">
                    <div class="col-md-12 col-sm-12">
                        <div class="navbar-brand">
                            <img src="{{asset('public/frontend/images/logo.png')}}" class="img-responsive" alt="logo">
                        </div>
                    </div>

                    @if(\Illuminate\Support\Facades\Session::has('login-validation-message'))
                        <div class="validation-error-message">
                            @if(\Illuminate\Support\Facades\Session::get('login-validation-message') == 'You have not activated your account')
                                <p>
                                    <i class="fa fa-ban"></i> {{\Illuminate\Support\Facades\Session::get('login-validation-message')}}
                                    <a href="javascript:void(0)" class="resend-activation-link" data-clicked="no"
                                       data-email="{{old('email')}}" style="color: blueviolet;">Resend activation link</a>
                                </p>
                            @else
                                <p>
                                    <i class="fa fa-ban"></i> {{\Illuminate\Support\Facades\Session::get('login-validation-message')}}
                                </p>
                            @endif
                        </div>
                    @endif

                    <form action="{{url('login')}}" id="loginForm" method="post">
                        {{csrf_field()}}
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="text" name="email" id="email" placeholder="Enter your email" autocomplete="off"
                                       class="form-control" value="{{old('email')}}">
                                <span class="error"></span>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="password" name="password" id="password" placeholder="Enter your password"
                                       class="form-control" value="{{old('password')}}">
                                <span class="error"></span>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <div class="button-box">
                                <input checked="" data-toggle="toggle" type="checkbox" name="remember">
                                <span>Remember Me </span><span class="pull-right"><a href="#">Forgot password ?</a></span>
                            </div>
                            <button type="submit" class="login-btn btn allstar-btn">Login</button>
                        </div>
                    </form>
                    <div class="col-md-12 col-sm-12">
                        <div class="doyou">
                            <span>Don't have an account ?</span><span><a href="{{url('register')}}">Create new account</a></span>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <div class="social-register">
                                <a href="{{url('social-login/facebook')}}"><i class="fa fa-facebook"></i></a>
                                <a href="{{url('social-login/google')}}"><i class="fa fa-google-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </section>
@stop

@section('scripts')
    <script>
        $('#loginForm').on('submit', function (e) {
            if ($('#email').val() === '') {
                e.preventDefault();
                showError('#email', 'Enter your email');
            }

            if ($('#password').val() === '') {
                e.preventDefault();
                showError('#password', 'Enter your password');
            }

            if ($('#email').val() !== '') {
                var test = validateEmail($('#email').val());
                if (!test) {
                    e.preventDefault();
                    showError('#email', 'Enter valid email');
                }
            }
        });

        function showError(element, message) {
            $(element).next('span.error').html(message);
        }

        $('#loginForm input').on('focus', function () {
            $(this).next('span.error').html('');
        });

        function validateEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(email)) {
                return false;
            } else {
                return true;
            }
        }

        $('.resend-activation-link').on('click', function (e) {
            e.preventDefault();
            if ($(this).data('clicked') === 'yes') {
                return false;
            }

            $(this).data('clicked', 'yes');
            $(this).css('opacity', '0.5');
            $(this).css('cursor', 'not-allowed');
            var email = $(this).data('email');
            var element = $(this);
            $.ajax({
                url: baseurl + '/login/resend-activation-link?email=' + email,
                type: 'get',
                success: function (data) {
                    element.text('Activation link resent successfully.');
                }, error: function (data) {
                    console.log(data);
                }
            });
        });
    </script>
@stop