@extends('admin.layout.master')

@section('styles')
    <style>
        div.field:nth-child(odd) {
            background: #ddd;
        }

        div.field {
            padding: 1%;
        }

        div.field label {
            font-weight: bolder;
            font-size: 18px;
        }
    </style>
@stop


@section('body')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Destination Details</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/destinations')}}">Destinations</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Details</li>
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
                                <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-run-fast"></i>
                                    Details For Destination {{ucwords($destination->title)}}
                                </h6>
                            </div>

                            <div class="col-7">
                                <div class="text-right upgrade-btn create-new-tab">
                                    <a href="{{url('admin/destinations')}}" class="btn btn-danger text-white">View List</a>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center">
                            <div class="col-12">
                                <div class="field">
                                    <label for="">Title</label>
                                    <div class="field-detail">
                                        {{$destination->title}}
                                    </div>
                                </div>

                                <div class="field">
                                    <label for="">Trip Destination</label>
                                    <div class="field-detail">
                                        {{$destination->trip_destination}}
                                    </div>
                                </div>

                                <div class="field">
                                    <label for="">Total Duration</label>
                                    <div class="field-detail">
                                        {{$destination->total_duration}}
                                    </div>
                                </div>

                                <div class="field">
                                    <label for="">Difficulty </label>
                                    <div class="field-detail">
                                        {{$destination->difficulty}}
                                    </div>
                                </div>

                                <div class="field">
                                    <label for="">Primary Activities </label>
                                    <div class="field-detail">
                                        {{$destination->primary_activities}}
                                    </div>
                                </div>

                                <div class="field">
                                    <label for="">Group Size </label>
                                    <div class="field-detail">
                                        {{$destination->group_size}}
                                    </div>
                                </div>

                                <div class="field">
                                    <label for="">Transportation </label>
                                    <div class="field-detail">
                                        {{$destination->transportation}}
                                    </div>
                                </div>

                                <div class="field">
                                    <label for="">Price </label>
                                    <div class="field-detail">
                                        {{$destination->price}}
                                    </div>
                                </div>

                                <div class="field">
                                    <label for="">Marked As Top </label>
                                    <div class="field-detail">
                                        {{$destination->top}}
                                    </div>
                                </div>

                                <div class="field">
                                    <label for="">Summary </label>
                                    <div class="field-detail">
                                        {!! $destination->summary !!}
                                    </div>
                                </div>

                                <div class="field">
                                    <label for="">Review </label>
                                    <div class="field-detail">
                                        {!! $destination->review !!}
                                    </div>
                                </div>

                                @if(isset($destination->destinationImages) && $destination->destinationImages->count() > 0)
                                    <div class="field">
                                        <label for="">Images </label>
                                        <div class="field-detail">
                                            <div class="row">
                                                @foreach($destination->destinationImages as $di)
                                                    <div class="col-md-4">
                                                        <img src="{{asset('public/images/destinations/thumbs/'.$di->image)}}"
                                                             alt="destination-image">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif


                                @if(isset($destination->destinationItineraries) && $destination->destinationItineraries->count() > 0)
                                    <div class="field">
                                        <label for="">Itineraries </label>
                                        <div class="field-detail">
                                            @foreach($destination->destinationItineraries as $di)
                                                <span style="display: block;"><strong>Day {{$di->day}}:</strong> {{$di->itinerary}}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
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

    </script>
@stop
