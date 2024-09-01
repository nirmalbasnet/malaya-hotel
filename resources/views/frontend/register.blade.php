@extends('frontend.layout.master')

@section('styles')
    <style>
        span.error {
            font-weight: 600;
            color: maroon;
            float: left;
        }

        span.controller-validation-error {
            font-weight: 600;
            color: maroon;
            float: left;
        }
    </style>
@stop

@section('body')
    <section class="breadcrumb" style="background:url({{asset('public/frontend/images/bg/traveller.jpg')}})">
        <div class="container">
            <div class="breadcrumb-item">
                <h2>Register</h2>
                <ul>
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>Register</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- register form -->
    <section class="inner-page">
        <div class="container">
            <main>
                <div class="login-form register-form"  style="margin: 30px auto !important;">
                    <div class="col-md-12 col-sm-12">
                        <div class="navbar-brand">
                            <img src="{{asset('public/frontend/images/logo.png')}}" class="img-responsive" alt="logo">
                        </div>
                    </div>
                    <form action="{{url('register')}}" id="registerForm" method="post">
                        {{csrf_field()}}
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="text" value="{{old('first_name')}}" name="first_name" id="first_name"
                                       placeholder="First Name" autocomplete="off"
                                       class="form-control">
                                <span class="error"></span>
                                @if($errors->has('first_name'))
                                    <span class="controller-validation-error">{{$errors->first('first_name')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="text" value="{{old('last_name')}}" name="last_name" id="last_name"
                                       placeholder="Last Name" autocomplete="off"
                                       class="form-control">
                                <span class="error"></span>
                                @if($errors->has('last_name'))
                                    <span class="controller-validation-error">{{$errors->first('last_name')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="text" value="{{old('email')}}" name="email" id="email" placeholder="Email"
                                       autocomplete="off"
                                       class="form-control">
                                <span class="error"></span>
                                @if($errors->has('email'))
                                    <span class="controller-validation-error">{{$errors->first('email')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="password" value="{{old('password')}}" name="password" id="password"
                                       placeholder="Password" class="form-control">
                                <span class="error"></span>
                                @if($errors->has('password'))
                                    <span class="controller-validation-error">{{$errors->first('password')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <button type="submit" class="login-btn btn allstar-btn">Register</button>
                        </div>
                    </form>
                    <div class="col-md-12 col-sm-12">
                        <div class="doyou">
                            <span>Do you have an account ?</span><span><a href="{{url('login')}}">login here</a></span>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </section>
@stop

@section('scripts')
    <script>
        $('#registerForm').on('submit', function (e) {
            if ($('#first_name').val() === '') {
                e.preventDefault();
                showError('#first_name', 'Enter your first name');
            }

            if ($('#last_name').val() === '') {
                e.preventDefault();
                showError('#last_name', 'Enter your last name');
            }

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

        $('#registerForm input').on('focus', function () {
            $(this).next('span.error').html('');
            $(this).next('span').next('span.controller-validation-error').html('');
        });

        function validateEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(email)) {
                return false;
            } else {
                return true;
            }
        }
    </script>
@stop