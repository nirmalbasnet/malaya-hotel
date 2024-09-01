@extends('admin.layout.master')

@section('body')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Newsletter Subscribers</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Newsletter Subscribers</li>
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
                                <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-email"></i>
                                    Newsletter Subscribers
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
                                    <th scope="col">Email</th>
                                    <th scope="col">Subscribed On</th>
                                    <th>Email Verification</th>
                                    <th>Subscription Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($subscribers) && $subscribers->count() > 0)
                                    @php $sn = !isset($_GET['page']) || $_GET['page'] == 1 ? 0 : $_GET['page']*10 - 10; @endphp
                                    @foreach($subscribers as $subscriber)
                                        @php $sn++; @endphp
                                        <tr>
                                            <td>{{$sn}}</td>
                                            <td><strong>{{$subscriber->email}}</strong></td>
                                            <td>{{date('M d Y h:i A', strtotime($subscriber->created_at))}}</td>
                                            <td><span style="text-transform: uppercase;">{{$subscriber->verify_status == 'yes' ? 'verified' : 'pending'}}</span></td>
                                            <td><span style="text-transform: uppercase;">{{$subscriber->status}}</span>
                                            </td>
                                            <td>
                                                @if($subscriber->status == 'active')
                                                    <a href="#" title="change status" class="table-action change-status"
                                                       data-id="{{$subscriber->id}}" data-status="active">
                                                        <i class="fa fa-pause-circle"></i>
                                                        Suspend Subscription
                                                    </a>
                                                @else
                                                    <a href="#" title="change status" class="table-action change-status"
                                                       data-id="{{$subscriber->id}}" data-status="suspend">
                                                        <i class="fa fa-play-circle"></i>
                                                        Reactivate Subscription
                                                    </a>
                                                @endif

                                                <a href="#" title="delete subscriber" class="table-action delete-subscriber"
                                                   data-id="{{$subscriber->id}}">
                                                    <i class="fa fa-trash"></i>
                                                    Delete Subscriber
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="6">{{$subscribers->links()}}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="6">
                                            <p class="text-center">No any subscribers found !!!</p>
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
            if (status === 'active')
                message = 'Suspend This Subscription ?';
            else
                message = 'Reactivate This Subscription ?';
            alertify.confirm('<span style="color:maroon; text-transform: uppercase; font-weight: 600;">Alert Confirmation</span>', message, function () {
                window.location = baseurl + '/admin/newsletter-subscribers/' + userId + '/change-status';
            }, function () {
            });
        });


        $('.delete-subscriber').on('click', function (e) {
            e.preventDefault();
            var subscriberId = $(this).data('id');
            alertify.confirm('<span style="color:maroon; text-transform: uppercase; font-weight: 600;">Alert Confirmation</span>', 'Delete This Subscriber ?', function () {
                window.location = baseurl + '/admin/newsletter-subscribers/' + subscriberId + '/delete';
            }, function () {
            });
        });
    </script>
@stop