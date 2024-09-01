@extends('admin.layout.master')

@section('body')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Staffs</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Staffs</li>
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
                                <h6 class="card-title m-t-40"><i class="mdi mdi-account-key"></i>
                                    Staffs
                                </h6>
                            </div>
                            <div class="col-7">
                                <div class="text-right upgrade-btn create-new-tab">
                                    <a style="margin-bottom: 10px;" href="javascript:void(0)"
                                       class="btn btn-danger text-white" data-toggle="modal"
                                       data-target="#addNewSubAdminModal">Add New Staff</a>
                                </div>
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
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Has Roles</th>
                                    <th scope="col">Suspend</th>
                                    <th scope="col">Created On</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($subAdmins) && $subAdmins->count() > 0)
                                    @foreach($subAdmins as $subAdmin)
                                        <tr>
                                            <td>{{$subAdmin->name}}</td>
                                            <td>{{$subAdmin->username}}</td>
                                            <td>{{$subAdmin->email}}</td>
                                            <td style="text-transform: uppercase;">{{ucwords($subAdmin->has_roles)}}</td>
                                            <td style="text-transform: uppercase;">{{$subAdmin->suspend}}</td>
                                            <td>{{date('M d, Y h:i A', strtotime($subAdmin->created_at))}}</td>
                                            <td>
                                                <a href="javascript:void(0)" data-toggle="modal"
                                                   data-target="#updateSubAdminModal{{$subAdmin->id}}" title="edit"
                                                   class="table-action"><i class="mdi mdi-table-edit"></i> Edit</a>
                                                @if($subAdmin->suspend == 'no')
                                                    <a href="" title="mark inactive"
                                                       class="table-action suspend-subadmin"
                                                       data-id="{{$subAdmin->id}}"><i
                                                                class="mdi mdi-minus-box"></i> Suspend</a>
                                                @else
                                                    <a href="" title="mark active"
                                                       class="table-action activate-subadmin"
                                                       data-id="{{$subAdmin->id}}"><i
                                                                class="mdi mdi-plus-box"></i> Activate</a>
                                                @endif
                                                <a href="{{url('admin/staffs/'.$subAdmin->id.'/roles')}}"
                                                   title="roles" class="table-action" data-id="{{$subAdmin->id}}"><i
                                                            class="mdi mdi-access-point"></i> Roles</a>
                                            </td>
                                        </tr>

                                        <!-- Modal -->
                                        <div class="modal fade" id="updateSubAdminModal{{$subAdmin->id}}" tabindex="-1"
                                             role="dialog" aria-labelledby="addModalLabel"
                                             aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addModalLabel"><i class="mdi mdi-account-key"></i> Edit Staff</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="javascript:void(0)"
                                                              enctype="multipart/form-data" method="post"
                                                              id="editSubAdminForm">
                                                            {{csrf_field()}}
                                                            <div class="form-group">
                                                                <label class="col-md-12">Name</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" name="name"
                                                                           placeholder="Name of staff"
                                                                           onfocus="removeError('name')"
                                                                           value="{{$subAdmin->name}}"
                                                                           class="form-control form-control-line sub-admin-name-{{$subAdmin->id}}">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-md-12">Username</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" name="username"
                                                                           placeholder="Username of staff"
                                                                           onfocus="removeError('username')"
                                                                           value="{{$subAdmin->username}}"
                                                                           class="form-control form-control-line sub-admin-username-{{$subAdmin->id}}">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-md-12">Email</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" name="email"
                                                                           placeholder="Email of staff"
                                                                           onfocus="removeError('email')"
                                                                           value="{{$subAdmin->email}}"
                                                                           class="form-control form-control-line sub-admin-email-{{$subAdmin->id}}">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-md-12">Password</label>
                                                                <div class="col-md-12">
                                                                    <input type="password" name="password"
                                                                           placeholder="Password of staff"
                                                                           onfocus="removeError('password')"
                                                                           class="form-control form-control-line sub-admin-password-{{$subAdmin->id}}">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-sm-12">Suspend</label>
                                                                <div class="col-sm-12">
                                                                    <select name="suspend"
                                                                            class="form-control form-control-line sub-admin-suspend-{{$subAdmin->id}}">
                                                                        <option value="no" {{$subAdmin->suspend == 'no' ? 'selected' : ''}}>
                                                                            No
                                                                        </option>
                                                                        <option value="yes" {{$subAdmin->suspend == 'yes' ? 'selected' : ''}}>
                                                                            Yes
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-sm-12">
                                                                    <button type="button"
                                                                            onclick="return submitUpdateForm({{$subAdmin->id}})"
                                                                            class="btn btn-success"
                                                                            id="updateModalSubmitButton">Update
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <tr>
                                        <td colspan="7">{{$subAdmins->links()}}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addNewSubAdminModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel"><i class="mdi mdi-account-key"></i> Add New Staff</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{url('admin/sub-admins/create')}}" enctype="multipart/form-data" method="post"
                          id="addNewSubAdminForm">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label class="col-md-12">Name</label>
                            <div class="col-md-12">
                                <input type="text" name="name" placeholder="Name of staff"
                                       onfocus="removeError('name')"
                                       class="form-control form-control-line sub-admin-name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Username</label>
                            <div class="col-md-12">
                                <input type="text" name="username" placeholder="Username of staff"
                                       onfocus="removeError('username')"
                                       class="form-control form-control-line sub-admin-username">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Email</label>
                            <div class="col-md-12">
                                <input type="text" name="email" placeholder="Email of staff"
                                       onfocus="removeError('email')"
                                       class="form-control form-control-line sub-admin-email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Password</label>
                            <div class="col-md-12">
                                <input type="password" name="password" placeholder="Password of staff"
                                       onfocus="removeError('password')"
                                       class="form-control form-control-line sub-admin-password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12">Suspend</label>
                            <div class="col-sm-12">
                                <select name="suspend" class="form-control form-control-line sub-admin-suspend">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success" id="modalSubmitButton">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        function removeError(element) {
            $('.sub-admin-' + element).css('border', '1px solid #e9ecef');
        }

        $('#addNewSubAdminForm').on('submit', function (e) {
            e.preventDefault();
            var error = 0;
            if ($('.sub-admin-name').val() === '') {
                e.preventDefault();
                $('.sub-admin-name').css('border', '1px solid #dc3545');
                error = 1;
            }

            if ($('.sub-admin-username').val() === '') {
                e.preventDefault();
                $('.sub-admin-username').css('border', '1px solid #dc3545');
                error = 1;
            }

            if ($('.sub-admin-email').val() === '') {
                e.preventDefault();
                $('.sub-admin-email').css('border', '1px solid #dc3545');
                error = 1;
            }

            if ($('.sub-admin-password').val() === '') {
                e.preventDefault();
                $('.sub-admin-password').css('border', '1px solid #dc3545');
                error = 1;
            }

            if (error === 0) {
                $('#modalSubmitButton').prop('disabled', true);
                var url = baseurl + '/admin/staffs/create';
                var data = {
                    name: $('.sub-admin-name').val(),
                    username: $('.sub-admin-username').val(),
                    email: $('.sub-admin-email').val(),
                    password: $('.sub-admin-password').val(),
                    suspend: $('.sub-admin-suspend').val(),
                    _token: "{{csrf_token()}}"
                };

                $.ajax({
                    url: url,
                    type: 'post',
                    data: data,
                    success: function (data) {
                        if (data.status == 'success') {
                            window.location = baseurl + '/admin/staffs/' + data.id + '/roles';
                        } else {
                            alertify.alert(data.message);
                        }
                        $('#modalSubmitButton').prop('disabled', false);
                    }, error: function (data) {
                        console.log(data);
                        alertify.alert('Sorry ! something went wrong.');
                        $('#modalSubmitButton').prop('disabled', false);
                    }
                })
            }
        });

        function submitUpdateForm(subAdminId) {
            if ($('.sub-admin-name-' + subAdminId).val() === '') {
                $('.sub-admin-name-' + subAdminId).css('border', '1px solid #dc3545');
                return false;
            }

            if ($('.sub-admin-username-' + subAdminId).val() === '') {
                $('.sub-admin-username-' + subAdminId).css('border', '1px solid #dc3545');
                return false;
            }

            if ($('.sub-admin-email-' + subAdminId).val() === '') {
                $('.sub-admin-email-' + subAdminId).css('border', '1px solid #dc3545');
                return false;
            }

            $('#updateModalSubmitButton').prop('disabled', true);
            var url = baseurl + '/admin/staffs/'+subAdminId+'/update';
            var data = {
                name: $('.sub-admin-name-' + subAdminId).val(),
                username: $('.sub-admin-username-' + subAdminId).val(),
                email: $('.sub-admin-email-' + subAdminId).val(),
                password: $('.sub-admin-password-' + subAdminId).val(),
                suspend: $('.sub-admin-suspend-' + subAdminId).val(),
                _token: "{{csrf_token()}}"
            };

            $.ajax({
                url: url,
                type: 'post',
                data: data,
                success: function (data) {
                    if (data.status == 'success') {
                        window.location = baseurl + '/admin/staffs/' + data.id + '/roles';
                    } else {
                        alertify.alert(data.message);
                    }
                    $('#updateModalSubmitButton').prop('disabled', false);
                }, error: function (data) {
                    console.log(data);
                    alertify.alert('Sorry ! something went wrong.');
                    $('#updateModalSubmitButton').prop('disabled', false);
                }
            });
        }

        $('.suspend-subadmin').on('click', function (e) {
            e.preventDefault();
            var adminId = $(this).data('id');
            alertify.confirm('<span style="color:maroon; text-transform: uppercase; font-weight: 600;">Suspend User Confirmation</span>', 'Are you sure ?', function () {
                window.location = baseurl + '/admin/staffs/' + adminId + '/suspend';
            }, function () {
            });
        });

        $('.activate-subadmin').on('click', function (e) {
            e.preventDefault();
            var adminId = $(this).data('id');
            alertify.confirm('<span style="color:maroon; text-transform: uppercase; font-weight: 600;">Activate User Confirmation</span>', 'Are you sure ?', function () {
                window.location = baseurl + '/admin/staffs/' + adminId + '/activate';
            }, function () {
            });
        });
    </script>
@stop