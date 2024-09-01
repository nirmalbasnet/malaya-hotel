@extends('admin.layout.master')

@section('styles')
    <style>
        div.add-more-div {
            font-weight: bolder;
            display: none;
            color: #3d3d3d;
            cursor: pointer;
            margin: 5px 0 5px 10px;
        }

        div.more-images {
            display: none;
        }

        div.error-messsage {
            margin-left: 10px;
            padding: 0;
        }

        div.delete-destination-images{
            cursor: pointer;
            position: relative;
        }

        div.delete-destination-images i{
            position: absolute;
            padding: 6px 8px;
            background: red;
        }
    </style>
@stop


@section('body')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Destination Featured Images</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/destinations')}}">Destinations</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Featured Images</li>
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
                                    Featured Images For Destination {{ucwords($destination->title)}}
                                </h6>
                            </div>
                        </div>

                        @if(isset($destination->destinationImages) && $destination->destinationImages->count() > 0)
                            <div class="images-div">
                                <label for="" style="font-weight: bolder;">Existing Images</label>
                                <div class="row" style="margin-bottom: 20px;">
                                    @foreach($destination->destinationImages as $di)
                                        <div class="col-md-4">
                                            <div class="delete-destination-images" data-id="{{$di->id}}" title="delete">
                                                <i class="fa fa-times"></i>
                                            </div>
                                            <img src="{{asset('public/images/destinations/thumbs/'.$di->image)}}"
                                                 alt="destination-image">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <form id="create-form" class="form-horizontal blog-form" method="post"
                              action="{{url('admin/destinations/'.$destination->id.'/featured-images/submit')}}"
                              enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Image 1 (Greater Than Or Equal To 1920
                                    x 1050 | Max 2
                                    MB | PNG,JPG,JPEG,GIF) <span class="req">*</span></label>
                                <div class="col-md-12">
                                    <input type="file" value="{{old('image_1')}}" class="form-control image"
                                           id="image_1" name="image[]" data-number="1">
                                    @if(isset($errors) && $errors->has('image_1'))
                                        <span class="validation-error">
                                            {{$errors->first('image_1')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group more-images">
                                <label for="example-email" class="col-md-12">Image 2 (Greater Than Or Equal To 1920
                                    x 1050 | Max 2
                                    MB | PNG,JPG,JPEG,GIF)</label>
                                <div class="col-md-12">
                                    <input type="file" value="{{old('image_2')}}" class="form-control image"
                                           id="image_2" name="image[]" data-number="2">
                                    @if(isset($errors) && $errors->has('image_2'))
                                        <span class="validation-error">
                                            {{$errors->first('image_2')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group more-images">
                                <label for="example-email" class="col-md-12">Image 3 (Greater Than Or Equal To 1920
                                    x 1050 | Max 2
                                    MB | PNG,JPG,JPEG,GIF)</label>
                                <div class="col-md-12">
                                    <input type="file" value="{{old('image_3')}}" class="form-control image"
                                           id="image_3" name="image[]" data-number="3">
                                    @if(isset($errors) && $errors->has('image_3'))
                                        <span class="validation-error">
                                            {{$errors->first('image_3')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group more-images">
                                <label for="example-email" class="col-md-12">Image 4 (Greater Than Or Equal To 1920
                                    x 1050 | Max 2
                                    MB | PNG,JPG,JPEG,GIF)</label>
                                <div class="col-md-12">
                                    <input type="file" value="{{old('image_4')}}" class="form-control image"
                                           id="image_4" name="image[]" data-number="4">
                                    @if(isset($errors) && $errors->has('image_4'))
                                        <span class="validation-error">
                                            {{$errors->first('image_4')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group more-images">
                                <label for="example-email" class="col-md-12">Image 5 (Greater Than Or Equal To 1920
                                    x 1050 | Max 2
                                    MB | PNG,JPG,JPEG,GIF)</label>
                                <div class="col-md-12">
                                    <input type="file" value="{{old('image_5')}}" class="form-control image"
                                           id="image_5" name="image[]" data-number="5">
                                    @if(isset($errors) && $errors->has('image_5'))
                                        <span class="validation-error">
                                            {{$errors->first('image_5')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group more-images">
                                <label for="example-email" class="col-md-12">Image 6 (Greater Than Or Equal To 1920
                                    x 1050 | Max 2
                                    MB | PNG,JPG,JPEG,GIF)</label>
                                <div class="col-md-12">
                                    <input type="file" value="{{old('image_6')}}" class="form-control image"
                                           id="image_6" name="image[]" data-number="6">
                                    @if(isset($errors) && $errors->has('image_6'))
                                        <span class="validation-error">
                                            {{$errors->first('image_6')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group more-images">
                                <label for="example-email" class="col-md-12">Image 7 (Greater Than Or Equal To 1920
                                    x 1050 | Max 2
                                    MB | PNG,JPG,JPEG,GIF)</label>
                                <div class="col-md-12">
                                    <input type="file" value="{{old('image_7')}}" class="form-control image"
                                           id="image_7" name="image[]" data-number="7">
                                    @if(isset($errors) && $errors->has('image_7'))
                                        <span class="validation-error">
                                            {{$errors->first('image_7')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group more-images">
                                <label for="example-email" class="col-md-12">Image 8 (Greater Than Or Equal To 1920
                                    x 1050 | Max 2
                                    MB | PNG,JPG,JPEG,GIF)</label>
                                <div class="col-md-12">
                                    <input type="file" value="{{old('image_8')}}" class="form-control image"
                                           id="image_8" name="image[]" data-number="8">
                                    @if(isset($errors) && $errors->has('image_8'))
                                        <span class="validation-error">
                                            {{$errors->first('image_8')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group more-images">
                                <label for="example-email" class="col-md-12">Image 9 (Greater Than Or Equal To 1920
                                    x 1050 | Max 2
                                    MB | PNG,JPG,JPEG,GIF)</label>
                                <div class="col-md-12">
                                    <input type="file" value="{{old('image_9')}}" class="form-control image"
                                           id="image_9" name="image[]" data-number="9">
                                    @if(isset($errors) && $errors->has('image_9'))
                                        <span class="validation-error">
                                            {{$errors->first('image_9')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group more-images">
                                <label for="example-email" class="col-md-12">Image 10 (Greater Than Or Equal To 1920
                                    x 1050 | Max 2
                                    MB | PNG,JPG,JPEG,GIF)</label>
                                <div class="col-md-12">
                                    <input type="file" value="{{old('image_10')}}" class="form-control image"
                                           id="image_10" name="image[]" data-number="10">
                                    @if(isset($errors) && $errors->has('image_5'))
                                        <span class="validation-error">
                                            {{$errors->first('image_10')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group error-messsage">
                                <span class="validation-error"></span>
                            </div>

                            <div class="form-group add-more-div">
                                <i class="fa fa-plus"></i> Add More
                            </div>


                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">Submit</button>
                                    <a href="{{url('admin/destinations/'.$destination->id.'/itineraries')}}"><button type="button" class="btn btn-primary">Go To Itineraries</button></a>
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
        function imageValidation(file, imgNum, callback) {
            var _URL = window.URL || window.webkitURL;
            var error = 0;
            var imageSize = (file.size);
            if (imageSize > 2000000) {
                error = 1;
                $('span.validation-error').html('<strong>Max Image Size 2 MB</strong>');
                if (callback)
                    callback(false);
            }

            var fileType = file["type"];
            var ValidImageTypes = ["image/gif", "image/jpeg", "image/png", "image/jpg, image/GIF", "image/JPEG", "image/PNG", "image/JPG"];
            if ($.inArray(fileType, ValidImageTypes) < 0) {
                error = 1;
                $('span.validation-error').html('<strong>Invalid Image Extension</strong>');
                if (callback)
                    callback(false);
            }

            if (error === 0) {
                var file, img;
                if ((file = file)) {
                    img = new Image();
                    var imageWidth = 0;
                    var imageHeight = 0;
                    img.onload = function () {
                        imageWidth = this.width;
                        imageHeight = this.height;
                        if (imageWidth < 1920 || imageHeight < 1050) {
                            error = 1;
                            $('span.validation-error').html('<strong>Invalid Image Dimension</strong>');
                            if (callback)
                                callback(false);
                        } else {
                            if (error === 0) {
                                $('span.validation-error').html('');
                                if (callback)
                                    callback(true);
                            }
                        }
                    },
                        img.src = _URL.createObjectURL(file);
                }
            }
        };

        $('.image').bind('change', function () {
            var file = this.files[0];
            var imgNum = $(this).data('number');
            var validationResult = imageValidation(file, imgNum, function (result) {
                if (result == true) {
                    $('div.add-more-div').show();
                }
            });
        });

        $('#create-form').on('submit', function () {
            if ($('#image_1').val() == '') {
                $('span.validation-error').html('At Least One Image Is Required');
                return false;
            }
            if ($('span.validation-error').html() !== '') {
                return false;
            }
        });

        $('.add-more-div').on('click', function () {
            $('div.more-images:hidden:first').show();
            $(this).hide();
        });

        $('div.delete-destination-images').on('click', function(){
            var element = $(this);
            var destinationId = $(this).data('id');
            if($('div.delete-destination-images').length === 1)
            {
                var message = 'Delete This Image ? Your destination will get unpublished.';
            }else{
                var message = 'Delete This Image ?';
            }
            alertify.confirm('<span style="color:maroon; text-transform: uppercase; font-weight: 600;">Delete Confirmation</span>', ''+message+'', function () {
                $.ajax({
                    url: baseurl + '/admin/destinations/'+destinationId+'/featured-images/delete',
                    type: 'get',
                    success: function (data) {
                        if (data === 'success') {
                            element.parent('div').remove();
                            if($('.delete-destination-images').length === 0){
                                $('div.images-div').remove();
                            }
                        } else {
                            alertify.alert('Oops! something went wrong. Please try later.')
                        }
                    }, error: function (data) {
                        alertify.alert('Oops! something went wrong. Please try later.')
                    }
                });
            }, function () {
            });
        });
    </script>
@stop
