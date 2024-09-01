@extends('admin.layout.master')

@section('styles')
    <style>
        div.add-more-div {
            font-weight: bolder;
            color: #3d3d3d;
            cursor: pointer;
            margin: 5px 0 5px 10px;
        }

        div.error-messsage {
            margin-left: 10px;
            padding: 0;
        }
    </style>
@stop


@section('body')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Destination Itineraries</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/destinations')}}">Destinations</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Itineraries</li>
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
                                    Itineraries For Destination {{ucwords($destination->title)}}
                                </h6>
                            </div>
                        </div>

                        @if(isset($destination->destinationItineraries) && $destination->destinationItineraries->count() > 0)
                            <div class="field" style="margin-bottom: 20px;">
                                <label for="" style="font-weight: bolder;">Existing Itineraries </label>
                                <div class="field-detail">
                                    @foreach($destination->destinationItineraries as $di)
                                        <span style="display: block;"><strong>Day {{$di->day}}
                                                :</strong> {{$di->itinerary}} <i class="fa fa-times delete-itinerary"
                                                                                 data-id="{{$di->id}}"
                                                                                 style="margin-left: 10px; color: red; cursor: pointer;"
                                                                                 title="delete"></i> <i
                                                    class="fa fa-edit edit-itinerary" data-id="{{$di->id}}"
                                                    style="margin-left: 10px; color: blue; cursor: pointer;"></i></span>

                                        <!-- Modal -->
                                        <div class="modal fade itinerary-update-modal" id="descModal-{{$di->id}}"
                                             tabindex="-1" role="dialog" aria-labelledby="descModalLabel"
                                             aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="descModalLabel">Destination
                                                            Itinerary</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{url('admin/destinations/'.$di->id.'/itineraries/update')}}">
                                                            {{csrf_field()}}
                                                            <div class="form-group">
                                                                <label class="col-md-12">Task</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" name="itinerary"
                                                                           placeholder="Itinerary Description"
                                                                           value="{{$di->itinerary}}"
                                                                           class="form-control form-control-line">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-md-12">Day</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" name="day"
                                                                               placeholder="Itinerary Day"
                                                                               value="{{$di->day}}"
                                                                               class="form-control form-control-line">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <button type="submit" class="btn btn-success">
                                                                            Update
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <form id="create-form" class="form-horizontal blog-form" method="post"
                              action="{{url('admin/destinations/'.$destination->id.'/itineraries/submit')}}"
                              enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"
                                          id="itinerary{{isset($destination->destinationItineraries) && $destination->destinationItineraries->count() > 0 ? $destination->destinationItineraries->count() + 1 : '1'}}">Day {{isset($destination->destinationItineraries) && $destination->destinationItineraries->count() > 0 ? $destination->destinationItineraries->count() + 1 : '1'}}</span>
                                </div>
                                <input type="text" class="form-control itinerary"
                                       placeholder="Day {{isset($destination->destinationItineraries) && $destination->destinationItineraries->count() > 0 ? $destination->destinationItineraries->count() + 1 : '1'}} Task"
                                       aria-describedby="itinerary{{isset($destination->destinationItineraries) && $destination->destinationItineraries->count() > 0 ? $destination->destinationItineraries->count() + 1 : '1'}}"
                                       name="itinerary[]">
                            </div>

                            <div class="append-itineraries">

                            </div>

                            <div class="form-group error-messsage">
                                <span class="validation-error"></span>
                            </div>

                            <div class="form-group add-more-div">
                                <i class="fa fa-plus"></i> Add More
                            </div>


                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-default">Submit</button>
                                    <a href="{{url('admin/destinations/'.$destination->id.'/featured-images')}}"><button type="button" class="btn btn-primary">Go To Images</button></a>
                                    <a href="{{url('admin/destinations')}}"><button type="button" class="btn btn-danger">Skip</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $('#create-form').on('submit', function (e) {
            if ($('input.itinerary').length === 1) {
                if ($('input.itinerary:first').val() === '') {
                    e.preventDefault();
                    $('span.validation-error').html('Error! Please check inputs');
                }
            } else {
                var error = 0;
                $('input.itinerary:not(:last)').each(function () {
                    if ($(this).val() === '') {
                        error = 1;
                    }
                });
                if (error === 1) {
                    e.preventDefault();
                    $('span.validation-error').html('Error! Please check inputs');
                }
            }
        });

        $(document).on('focus', 'input.itinerary', function () {
            $('span.validation-error').html('');
        });

        $('.add-more-div').on('click', function () {
            var error = 0;
            $('input.itinerary').each(function () {
                if ($(this).val() === '') {
                    error = 1;
                }
            });

            if (error === 1) {
                $('span.validation-error').html('Please complete previous days itinerary first');
            } else {
                var html = '';
                        @if(isset($destination->destinationItineraries) && $destination->destinationItineraries->count() > 0)
                var count = $('input.itinerary').length + parseInt("{{$destination->destinationItineraries->count()}}");
                        @else
                var count = $('input.itinerary').length;
                        @endif
                var newCount = count + 1;
                html += '<div class="input-group mb-3">\n' +
                    '<div class="input-group-prepend">\n' +
                    '<span class="input-group-text" id="itinerary' + newCount + '">Day ' + newCount + '</span>\n' +
                    '</div>\n' +
                    '<input type="text" class="form-control itinerary" placeholder="Day ' + newCount + ' Task" aria-describedby="itinerary' + newCount + '" name="itinerary[]">\n' +
                    '</div>';
                $('div.append-itineraries').append(html);
            }
        });

        $('.delete-itinerary').on('click', function (e) {
            e.preventDefault();
            var itineraryId = $(this).data('id');
            alertify.confirm('<span style="color:maroon; text-transform: uppercase; font-weight: 600;">Delete Confirmation</span>', 'Delete This Itinerary ?', function () {
                window.location = baseurl + '/admin/destinations/' + itineraryId + '/itineraries/delete';
            }, function () {
            });
        });

        $('.edit-itinerary').on('click', function (e) {
            e.preventDefault();
            var itineraryId = $(this).data('id');
            $('#descModal-' + itineraryId).modal('show');
        });
    </script>
@stop
