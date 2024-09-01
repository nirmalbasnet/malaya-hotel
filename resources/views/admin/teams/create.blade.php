@extends('admin.layout.master')

@section('body')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Our Teams</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{asset('admin/our-team')}}">Our Teams</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
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
                                <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-account-multiple"></i>Create New Team Member</h6>
                            </div>
                        </div>

                        <form action="{{url('admin/our-team/submit')}}" enctype="multipart/form-data" method="post"
                              id="addNewMemberForm">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="col-md-12">Name <span class="req">*</span></label>
                                <div class="col-md-12">
                                    <input type="text" name="name" placeholder="Name of a member"
                                           onfocus="removeError('name')" value="{{old('name')}}"
                                           class="form-control form-control-line name">
                                    @if($errors->has('name'))
                                        <span class="validation-error">
                                            {{$errors->first('name')}}
                                        </span>
                                    @endif
                                    <span class="name-error validation-error"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12">Designation <span class="req">*</span></label>
                                <div class="col-md-12">
                                    <input type="text" name="designation" placeholder="Designation of a member"
                                           onfocus="removeError('designation')" value="{{old('designation')}}"
                                           class="form-control form-control-line designation">
                                    @if($errors->has('designation'))
                                        <span class="validation-error">
                                            {{$errors->first('designation')}}
                                        </span>
                                    @endif
                                    <span class="designation-error validation-error"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Image (Greater Than Or Equal To 400
                                    x 400 | Max 2 MB | PNG,JPG,JPEG,GIF) <span class="req">*</span></label>
                                <div class="col-md-12">
                                    <input onfocus="removeError('image')" type="file"
                                           class="form-control form-control-line image" name="image">
                                    <span class="image-error validation-error"></span>
                                    @if($errors->has('image'))
                                        <span class="validation-error">
                                            {{$errors->first('image')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12">Description <span class="req">*</span></label>
                                <div class="col-md-12">
                                    <textarea name="description" id="description" class="form-control">{{old('description')}}</textarea>
                                    @if($errors->has('description'))
                                        <span class="validation-error">
                                            {{$errors->first('description')}}
                                        </span>
                                    @endif
                                    <span class="description-error validation-error"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">Submit</button>
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
    <script src="https://cdn.ckeditor.com/4.11.2/basic/ckeditor.js"></script>

    <script>
        var editor = CKEDITOR.replace('description');
        $('#addNewMemberForm').on('submit', function (e) {
            if ($('.name').val() === '') {
                e.preventDefault();
                $('.name').css('border', '1px solid #dc3545');
                $('span.name-error').html('This field is required');
            }

            if ($('.designation').val() === '') {
                e.preventDefault();
                $('.designation').css('border', '1px solid #dc3545');
                $('.designation-error').html('This field is required')
            }

            if ($('.image').val() === '') {
                e.preventDefault();
                $('.image').css('border', '1px solid #dc3545');
                $('.image-error').html('This field is required');
            }

            if(CKEDITOR.instances['description'].getData() ===''){
                e.preventDefault();
                $('.description-error').html('This field is required');
            }
        });


        function removeError(element) {
            $('.' + element).css('border', '1px solid #e9ecef');
            $('span.' + element+'-error').html('');
        }

        $('.image').bind('change', function () {
            var file = this.files[0];
            var validationResult = imageValidation(file, function (result) {
                if (result === false) {
                    $('button[type=submit]').prop('disabled', true);
                }else{
                    $('button[type=submit]').prop('disabled', false);
                }
            });
        });

        function imageValidation(file, callback) {
            var _URL = window.URL || window.webkitURL;
            var error = 0;
            var imageSize = (file.size);
            if (imageSize > 2000000) {
                error = 1;
                $('span.image-error').html('<strong>Max Image Size 2 MB</strong>');
                if (callback)
                    callback(false);
            }

            var fileType = file["type"];
            var ValidImageTypes = ["image/gif", "image/jpeg", "image/png", "image/jpg, image/GIF", "image/JPEG", "image/PNG", "image/JPG"];
            if ($.inArray(fileType, ValidImageTypes) < 0) {
                error = 1;
                $('span.image-error').html('<strong>Invalid Image Extension</strong>');
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
                        if (imageWidth < 400 || imageHeight < 400) {
                            error = 1;
                            $('span.image-error').html('<strong>Invalid Image Dimension</strong>');
                            if (callback)
                                callback(false);
                        } else {
                            if (error === 0) {
                                $('span.image-error').html('');
                                if (callback)
                                    callback(true);
                            }
                        }
                    },
                        img.src = _URL.createObjectURL(file);
                }
            }
        };

        CKEDITOR.on('instanceReady', function (evt) {
            var editor = evt.editor;

            editor.on('focus', function (e) {
                $('.description-error').html('');
            });
        });
    </script>
@stop