@extends('admin.layout.loginMaster')
@section('main-body')
    <div class="login-screen">
        <div class="login-wrapper">
            <form name="checkin-form" onsubmit="return validateId()" action="{{url('admin/login/validate')}}"
                  method="post">
                @if(\Session::has('message'))--}}
                <div class="alert alert-success">
                    <i class="fa fa-times pull-right closeMessage"></i>
                    <p class="text-center">{{\Session::get('message')}}</p>
                </div>
                @endif
                @if(Session::has('error'))
                    <h4 class="text-center" style="color: darkred;"><i
                                class="fa fa-warning"></i> {{ Session::get('error') }}</h4>
                @endif
                {{csrf_field()}}
                <div class="login-container">
                    <div class="login-box">
                        <a href="{{url('admin')}}" class="login-logo">
                            <img src="{{asset('public/admin/assets/images/admin-login-logo.png')}}" alt="rentonnepal">
                        </a>
                        <div class="form-group">
                            <input type="text" placeholder="email / username" name="username" id="focusedInput"
                                   value="{{ old('username') }}" class="form-control"/>
                            @if ($errors->has('username'))
                                <span class="help-block has-error" style="color: darkred; text-align: left;">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="password" name="password"
                                   id="focusedInput" value="{{ old('password') }}"/>
                            @if ($errors->has('password'))
                                <span class="help-block" style="color: darkred; text-align: left;">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn">Login</button>
                        </div>
                        <div class="error clearfix">
                            <h4 class="showError">Email address cannot be empty !</h4>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop

@section('scripts')
    <script>
        function validateId() {
            if ($('input[name=username]').val() == '') {
                $('div.error').show();
                $('h4.showError').html('Email address cannot be empty !');
                return false;
            } else if ($('input[name=password]').val() == '') {
                $('div.error').show();
                $('h4.showError').html('Password cannot be empty !');
                return false;
            } else {
                $('div.error').hide();
                return true;
            }
        }
    </script>
@stop
