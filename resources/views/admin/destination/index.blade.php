@extends('admin.layout.master')

@section('styles')
    <style>
        span.review-count {
            padding: 0 6px;
            background: #ddd;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 600;
        }
    </style>
@stop

@section('body')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Destinations</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Destinations</li>
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
                            @if(\App\BackendModel\DestinationReview::where('reviewed', 'no')->count() > 0)
                                <div class="col-12">
                                    <div class="col-12 alert alert-danger notification-message" style="height: 45px;">
                                        <div class="message">
                                            @php $notReviewed = \App\BackendModel\DestinationReview::where('status', 'inactive')->first(); @endphp
                                            <p>Some reviews need approval ! <a href="{{url('admin/destinations/'.$notReviewed->destination_id.'/reviews')}}">Review now</a></p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="col-5">
                                <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-run-fast"></i>
                                    Destinations
                                </h6>
                            </div>
                            <div class="col-7">
                                <div class="text-right upgrade-btn create-new-tab">
                                    <a href="{{url('admin/destinations/create')}}" class="btn btn-danger text-white">Add
                                        New Destination</a>
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
                                    <th scope="col">Title</th>
                                    <th scope="col">Difficulty</th>
                                    <th scope="col">Group Size</th>
                                    <th scope="col">Created By</th>
                                    <th scope="col">Marked As Top</th>
                                    <th scope="col">Publish</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($destinations) && $destinations->count() > 0)
                                    @foreach($destinations as $destination)
                                        <tr>
                                            <td>{{$destination->title}}</td>
                                            <td>{{ucwords($destination->difficulty)}}</td>
                                            <td>{{$destination->group_size}}</td>
                                            <td>{{ucwords(\App\BackendModel\Admin::find($destination->created_by)->name)}}</td>
                                            <td>{{ucwords($destination->top)}}</td>
                                            <td>{{ucwords($destination->publish)}}</td>
                                            <td>
                                                <a href="{{url('admin/destinations/'.$destination->id.'/edit')}}"
                                                   title="edit"
                                                   class="table-action"><i
                                                            class="mdi mdi-table-edit"></i> Edit</a>
                                                <a href="{{url('admin/destinations/'.$destination->id.'/view')}}"
                                                   title="view"
                                                   class="table-action"><i
                                                            class="mdi mdi-eye"></i> Details</a>
                                                <a href="{{url('admin/destinations/'.$destination->id.'/featured-images')}}"
                                                   title="images"
                                                   class="table-action"><i
                                                            class="mdi mdi-image"></i> Images</a>
                                                <a href="{{url('admin/destinations/'.$destination->id.'/itineraries')}}"
                                                   title="itineraries"
                                                   class="table-action"><i
                                                            class="mdi mdi-view-list"></i> Itineraries</a>

                                                <a href="{{url('admin/destinations/'.$destination->id.'/reviews')}}"
                                                   title="reviews"
                                                   class="table-action"><i
                                                            class="mdi mdi-sort-variant"></i> Reviews <span
                                                            class="review-count">{{$destination->destinationReviews->count()}}</span></a>

                                                @if($destination->top == 'yes')
                                                    <a href="{{url('admin/destinations/'.$destination->id.'/untop')}}"
                                                       title="Mark as normal"
                                                       class="table-action"><i
                                                                class="mdi mdi-check"></i> Mark As Normal</a>
                                                @else
                                                    <a href="{{url('admin/destinations/'.$destination->id.'/top')}}"
                                                       title="Mark as top"
                                                       class="table-action"><i
                                                                class="mdi mdi-check"></i> Mark As Top</a>
                                                @endif

                                                @if($destination->publish == 'yes')
                                                    <a href="{{url('admin/destinations/'.$destination->id.'/unpublish')}}"
                                                       title="Unpublish"
                                                       class="table-action"><i
                                                                class="mdi mdi-check"></i> Unpublish</a>
                                                @else
                                                    <a href="{{url('admin/destinations/'.$destination->id.'/publish')}}"
                                                       title="Publish"
                                                       class="table-action"><i
                                                                class="mdi mdi-check"></i> Publish</a>
                                                @endif

                                                <a href="#" title="delete" class="table-action delete-destination"
                                                   data-id="{{$destination->id}}"><i
                                                            class="mdi mdi-delete"></i> Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="7">{{$destinations->links()}}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="7">
                                            <p class="text-center">No any destination found !!!</p>
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
        $('.delete-destination').on('click', function (e) {
            e.preventDefault();
            var destinationId = $(this).data('id');
            alertify.confirm('<span style="color:maroon; text-transform: uppercase; font-weight: 600;">Delete Confirmation</span>', 'Delete This Destination ?', function () {
                window.location = baseurl + '/admin/destinations/' + destinationId + '/delete';
            }, function () {
            });
        });

        $('.order-up-banner').on('click', function (e) {
            e.preventDefault();
            var bannerId = $(this).data('id');
            alertify.confirm('<span style="color:maroon; text-transform: uppercase; font-weight: 600;">Order Up Confirmation</span>', 'Are you sure ?', function () {
                window.location = baseurl + '/admin/banner/' + bannerId + '/orderup';
            }, function () {
            });
        });

        $('.order-down-banner').on('click', function (e) {
            e.preventDefault();
            var bannerId = $(this).data('id');
            alertify.confirm('<span style="color:maroon; text-transform: uppercase; font-weight: 600;">Order Down Confirmation</span>', 'Are you sure ?', function () {
                window.location = baseurl + '/admin/banner/' + bannerId + '/orderdown';
            }, function () {
            });
        });

        $('.inactivate-banner').on('click', function (e) {
            e.preventDefault();
            var bannerId = $(this).data('id');
            alertify.confirm('<span style="color:maroon; text-transform: uppercase; font-weight: 600;">Inactivate Banner Confirmation</span>', 'Are you sure ?', function () {
                window.location = baseurl + '/admin/banner/' + bannerId + '/inactivate';
            }, function () {
            });
        });

        $('.activate-banner').on('click', function (e) {
            e.preventDefault();
            var bannerId = $(this).data('id');
            alertify.confirm('<span style="color:maroon; text-transform: uppercase; font-weight: 600;">Activate Banner Confirmation</span>', 'Are you sure ?', function () {
                window.location = baseurl + '/admin/banner/' + bannerId + '/activate';
            }, function () {
            });
        });
    </script>
@stop