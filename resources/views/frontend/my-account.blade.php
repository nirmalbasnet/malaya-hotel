@extends('frontend.layout.master')

@section('styles')
    <style>
        .my-account-div {
            min-height: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 100px;
        }

        span.my-account {
            font-size: 30px;
            font-weight: 500;
            color: #38535d;
            border-bottom: 1px solid #38535d;
            padding-bottom: 10px;
            display: inline-block;
            margin: 0 0 25px 0;
        }

        div.buttons {
            margin-top: 15px;
        }

        .edit-account, .payment-history, .logout, .change-password {
            background: #38535d !important;
            color: #fff !important;
            border: 1px solid #38535d;
            padding: 15px 25px;
            font-size: 15px;
            font-weight: 700;
        }

        span.error {
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
                <h2>My Account</h2>
                <ul>
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>My Account</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- herobanner start -->
    <section class="inner-page">
        <div class="container">
            @if(\Illuminate\Support\Facades\Session::has('success'))
                <div class="alert alert-success">
                    {{\Illuminate\Support\Facades\Session::get('success')}}
                </div>
            @endif
            <main>
                <div class="row">
                    <div class="col-md-6">
                        <span class="my-account">My Account</span><br>
                        <span>Name: {{$user->name}}</span><br>
                        <span>Email: {{$user->email}}</span><br><br>
                        <div class="buttons">
                            <button class="edit-account">Edit My Account</button>
                            <button class="change-password">Change Password</button>
                            {{--<a href="https://www.meroshows.com/my-account/payment-history">--}}
                            {{--<button class="payment-history">View Payment History</button>--}}
                            {{--</a>--}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <form style="display: {{isset($errors) && ($errors->has('name') || $errors->has('email')) ? 'block' : 'none'}};"
                              class="edit" method="post"
                              action="{{url('my-account/update')}}" id="editForm">
                            <p style="margin-bottom: 15px;">Note: Changing email needs verification. You will get logged
                                out.</p>
                            {{csrf_field()}}
                            <div class="form-group ">
                                <input value="{{old('name', $user->name)}}" type="text" name="name" id="name"
                                       class="form-control"
                                       placeholder="Full Name">
                                @if($errors->has('name'))
                                    <span class="error">{{$errors->first('name')}}</span>
                                @endif
                            </div>

                            <div class="form-group ">
                                <input value="{{old('email', $user->email)}}" type="text" name="email" id="email"
                                       class="form-control"
                                       placeholder="Email">
                                @if($errors->has('email'))
                                    <span class="error">{{$errors->first('email')}}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>

                        <form style="display: {{isset($errors) && ($errors->has('current_password') || $errors->has('new_password') || $errors->has('confirm_password')) ? 'block' : 'none'}};"
                              class="change" method="post"
                              action="{{url('my-account/change-password')}}" id="changePassForm">
                            {{csrf_field()}}
                            <div class="form-group ">
                                <input value="{{old('current_password')}}" autocomplete="off" type="password"
                                       name="current_password" id="current_password"
                                       class="form-control" placeholder="Current Password">
                                @if($errors->has('current_password'))
                                    <span class="error">{{$errors->first('current_password')}}</span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <input value="{{old('new_password', $user->new_password)}}" autocomplete="off"
                                       type="password" name="new_password" id="new_password"
                                       class="form-control" placeholder="New Password">
                                @if($errors->has('new_password'))
                                    <span class="error">{{$errors->first('new_password')}}</span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <input value="{{old('confirm_password', $user->confirm_password)}}" type="password"
                                       name="confirm_password" id="confirm_password" class="form-control"
                                       placeholder="Confirm Password">
                                @if($errors->has('confirm_password'))
                                    <span class="error">{{$errors->first('confirm_password')}}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </section>
@stop

@section('scripts')
    <script>
        $('button.edit-account').on('click', function () {
            $('form#editForm').slideToggle('slow');
        });

        $('button.change-password').on('click', function () {
            $('form#changePassForm').slideToggle('slow');
        });
    </script>
@stop