@extends('admin.layout.master')

@section('body')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Profile</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('public/admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-7">
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row align-items-center">
                            <div class="col-5">
                                <h6 class="card-title m-t-40"><i class="ti-user m-r-5 m-l-5"></i> Profile
                                </h6>
                            </div>

                            <div class="col-7">

                            </div>
                        </div>

                        <hr>

                        <div class="admin-profile-edit-form">
                            <div class="row">
                                <div class="col-xs-12">
                                    <label for="name">Name: </label>
                                    <input readonly type="text" id="name" value="{{$admin->name}}" class="form-control">
                                </div>

                                <div class="col-xs-6">
                                    <label for="admin-profile-edit-icon"></label>
                                    <span title="edit" id="admin-profile-edit-icon" class="admin-profile-edit-icon"><i
                                                class="mdi mdi-tooltip-edit"></i></span>
                                </div>

                                <div class="col-xs-2 ai">
                                    <label for="admin-profile-edit-icon"></label>
                                    <span title="done" id="admin-profile-edit-icon" class="admin-profile-check-icon"><i
                                                class="mdi mdi-comment-check"></i></span>
                                </div>

                                <div class="col-xs-2 ai">
                                    <label for="admin-profile-edit-icon"></label>
                                    <span title="cancel" id="admin-profile-edit-icon"
                                          class="admin-profile-close-icon"><i class="mdi mdi-close-box"></i></span>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="username">Username: </label>
                                    <input readonly type="text" id="username" value="{{$admin->username}}"
                                           class="form-control">
                                </div>

                                <div class="col-xs-6">
                                    <label for="admin-profile-edit-icon"></label>
                                    <span title="edit" id="admin-profile-edit-icon" class="admin-profile-edit-icon"><i
                                                class="mdi mdi-tooltip-edit"></i></span>
                                </div>

                                <div class="col-xs-2 ai">
                                    <label for="admin-profile-edit-icon"></label>
                                    <span title="done" id="admin-profile-edit-icon" class="admin-profile-check-icon"><i
                                                class="mdi mdi-comment-check"></i></span>
                                </div>

                                <div class="col-xs-2 ai">
                                    <label for="admin-profile-edit-icon"></label>
                                    <span title="cancel" id="admin-profile-edit-icon"
                                          class="admin-profile-close-icon"><i class="mdi mdi-close-box"></i></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="email">Email: </label>
                                    <input readonly type="text" id="email" value="{{$admin->email}}"
                                           class="form-control">
                                </div>

                                <div class="col-xs-6">
                                    <label for="admin-profile-edit-icon"></label>
                                    <span title="edit" id="admin-profile-edit-icon" class="admin-profile-edit-icon"><i
                                                class="mdi mdi-tooltip-edit"></i></span>
                                </div>

                                <div class="col-xs-2 ai">
                                    <label for="admin-profile-edit-icon"></label>
                                    <span title="done" id="admin-profile-edit-icon" class="admin-profile-check-icon"><i
                                                class="mdi mdi-comment-check"></i></span>
                                </div>

                                <div class="col-xs-2 ai">
                                    <label for="admin-profile-edit-icon"></label>
                                    <span title="cancel" id="admin-profile-edit-icon"
                                          class="admin-profile-close-icon"><i class="mdi mdi-close-box"></i></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="password">Password: </label>
                                    <input readonly type="password" id="password" value="{{$admin->password}}"
                                           class="form-control">
                                </div>

                                <div class="col-xs-6">
                                    <label for="admin-profile-edit-icon"></label>
                                    <span title="edit" id="admin-profile-edit-icon" class="admin-profile-edit-icon"><i
                                                class="mdi mdi-tooltip-edit"></i></span>
                                </div>

                                <div class="col-xs-2 ai">
                                    <label for="admin-profile-edit-icon"></label>
                                    <span title="done" id="admin-profile-edit-icon" class="admin-profile-check-icon"><i
                                                class="mdi mdi-comment-check"></i></span>
                                </div>

                                <div class="col-xs-2 ai">
                                    <label for="admin-profile-edit-icon"></label>
                                    <span title="cancel" id="admin-profile-edit-icon"
                                          class="admin-profile-close-icon"><i class="mdi mdi-close-box"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        var password = "{{$admin->password}}";
        var name = "{{$admin->name}}";
        var username = "{{$admin->username}}";
        var email = "{{$admin->email}}";
        $('.admin-profile-edit-icon').on('click', function () {
            $(this).parent('div').prev('div').children('input').prop('readonly', false);
            $(this).parent('div').prev('div').children('input').css({
                'border-bottom': '1px solid rgb(233, 236, 239)',
                transition: 'opacity 1s ease-in-out'
            });
            $(this).parent('div').prev('div').children('input').focus();
            var tmpStr = $(this).parent('div').prev('div').children('input').val();
            $(this).parent('div').prev('div').children('input').val('');
            if ($(this).parent('div').prev('div').children('input').attr('type') !== 'password')
                $(this).parent('div').prev('div').children('input').val(tmpStr);
            $(this).parent('div').hide('slow');

            $(this).parent('div').next('div.ai').show('slow');
            $(this).parent('div').next('div.ai').next('div.ai').show('slow');
        });

        $('.admin-profile-check-icon').on('click', function () {
            var field = $(this).parent('div').prev('div').prev('div').children('input').attr('id');
            var value = $(this).parent('div').prev('div').prev('div').children('input').val();
            if (value === '') {
                return false;
            }

            if (field === 'email') {
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if(!regex.test(value))
                {
                    alertify.alert('Invalid Email Format');
                    return false;
                }
            }

            if(field === 'username'){
                if(/^[A-Za-z0-9]+$/.test(value) === false){
                    alertify.alert('Username Should Only Contain Alphabets And Numbers');
                    return false;
                }
            }


            $(this).parent('div.ai').hide('slow');
            $(this).parent('div.ai').next('div.ai').hide('slow');
            $(this).parent('div.ai').prev('div').show('slow');
            $(this).parent('div').prev('div').prev('div').children('input').css('border', 'none');

            var element = $(this).parent('div').prev('div').prev('div').children('input');
            $.ajax({
                url: baseurl + '/admin/profile/update?field=' + field + '&value=' + value,
                type: 'get',
                success: function (data) {
                    element.val(data);
                    if (field === 'name') {
                        name = data;
                        $(document).find('#Userdd h5').html(name + ' <i class="fa fa-angle-down"></i>');
                        $(document).find('span.logo-initial').html(name[0]);
                    }

                    if (field === 'username') {
                        username = data;
                    }

                    if (field === 'email') {
                        email = data;
                        $(document).find('#Userdd span').html(email);
                    }

                    if (field === 'password') {
                        password = data;
                    }

                }, error: function (data) {
                    alertify.alert("Error ! Please Try Again");

                    if (field === 'name') {
                        element.val(name);
                    }

                    if (field === 'username') {
                        element.val(username);
                    }

                    if (field === 'email') {
                        element.val(email);
                    }

                    if (field === 'password') {
                        element.val(password);
                    }
                }
            });
        });

        $('.admin-profile-close-icon').on('click', function () {
            $(this).parent('div.ai').hide('slow');
            $(this).parent('div.ai').prev('div.ai').hide('slow');
            $(this).parent('div.ai').prev('div').prev('div').show('slow');
            if ($(this).parent('div').prev('div').prev('div').prev('div').children('input').attr('id') === 'password')
                $(this).parent('div').prev('div').prev('div').prev('div').children('input').val(password);

            if ($(this).parent('div').prev('div').prev('div').prev('div').children('input').attr('id') === 'name')
                $(this).parent('div').prev('div').prev('div').prev('div').children('input').val(name);

            if ($(this).parent('div').prev('div').prev('div').prev('div').children('input').attr('id') === 'username')
                $(this).parent('div').prev('div').prev('div').prev('div').children('input').val(username);

            if ($(this).parent('div').prev('div').prev('div').prev('div').children('input').attr('id') === 'email')
                $(this).parent('div').prev('div').prev('div').prev('div').children('input').val(email);


            $(this).parent('div').prev('div').prev('div').prev('div').children('input').css('border', 'none');
        });
    </script>
@stop