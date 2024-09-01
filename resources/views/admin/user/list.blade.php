@extends('admin.layout.master')

@section('body')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Customers</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Customers</li>
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
                                <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-account-card-details"></i>
                                    Customers
                                </h6>
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
                        <div class="table-responsive">
                            <table class="table" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th scope="col">SN</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Account Verification</th>
                                    <th>Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($users) && $users->count() > 0)
                                    @php $sn = !isset($_GET['page']) || $_GET['page'] == 1 ? 0 : $_GET['page']*10 - 10; @endphp
                                    @foreach($users as $user)
                                        @php $sn++; @endphp
                                        <tr>
                                            <td>{{$sn}}</td>
                                            <td><strong>{{$user->name}}</strong></td>
                                            <td>{{$user->email}}</td>
                                            <td><span style="text-transform: uppercase;">{{$user->email_status}}</span></td>
                                            <td><span style="text-transform: uppercase;">{{$user->status}}</span></td>
                                            <td>
                                                @if($user->status == 'active')
                                                    <a href="#" title="change status" class="table-action change-status"
                                                       data-id="{{$user->id}}" data-status="active">
                                                        <i class="fa fa-pause-circle"></i>
                                                        Suspend User
                                                    </a>
                                                @else
                                                    <a href="#" title="change status" class="table-action change-status"
                                                       data-id="{{$user->id}}" data-status="suspend">
                                                        <i class="fa fa-play-circle"></i>
                                                        Activate User
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="6">{{$users->links()}}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="6">
                                            <p class="text-center">No any guides found !!!</p>
                                        </td>
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

@stop

@section('scripts')
    <script>
        $('.change-status').on('click', function (e) {
            e.preventDefault();
            var userId = $(this).data('id');
            var status = $(this).data('status');
            var message = '';
            if(status === 'active')
                message = 'Suspend This Customer ?';
            else
                message = 'Reactivate This Customer ?';
            alertify.confirm('<span style="color:maroon; text-transform: uppercase; font-weight: 600;">Alert Confirmation</span>', message, function () {
                window.location = baseurl + '/admin/customers/' + userId + '/change-status';
            }, function () {
            });
        });
    </script>
@stop