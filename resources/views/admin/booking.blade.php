@extends('admin.layout.master')

@section('body')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Bookings</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Bookings</li>
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
                                <h6 class="card-title m-t-40"><i class="mdi mdi-bookmark"></i>
                                    Bookings
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
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Destination</th>
                                    <th scope="col">Booker Name</th>
                                    <th scope="col">Booker Email</th>
                                    <th scope="col">Acknowledged By</th>
                                    <th scope="col">Booked Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($bookings) && $bookings->count() > 0)
                                    @foreach($bookings as $booking)
                                        <tr>
                                            <td>
                                                <a href="{{url('admin/destinations/'.$booking->destination_id.'/view')}}">{{\App\BackendModel\Destination::find($booking->destination_id)->title}}</a>
                                            </td>
                                            <td>{{$booking->booker_name}}</td>
                                            <td>{{$booking->booker_email}}</td>
                                            <td style="text-transform: uppercase;">{{$booking->acknowledged_by == null ? 'Not Ack. Yet' : \App\BackendModel\Admin::find($booking->acknowledged_by)->name}}</td>
                                            <td style="text-transform: uppercase;">{{date('M d Y h:i A', strtotime($booking->created_at))}}</td>
                                            <td>
                                                @if($booking->acknowledged_by == null)
                                                    <a href="{{url('admin/booking/acknowledge/'.$booking->id)}}"
                                                       title="Acknowledge"
                                                       class="table-action"><i class="mdi mdi-check"></i>
                                                        Acknowledge</a>
                                                @else
                                                    <a href="javascript:void(0)" style="cursor: not-allowed; opacity: 0.5;"
                                                       title="Acknowledged"
                                                       class="table-action"><i class="mdi mdi-check"></i>
                                                        Acknowledged</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="6">{{$bookings->links()}}</td>
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
@stop