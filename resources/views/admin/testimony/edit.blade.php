@extends('admin.layout.master')

@section('body')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Clients Testimony</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{asset('admin/clients-testimony')}}">Clients
                                    Testimony</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                                <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-link-variant"></i>Create
                                    Clients Testimony</h6>
                            </div>
                        </div>

                        <form action="{{url('admin/clients-testimony/'.$testimony->id.'/update')}}"
                              enctype="multipart/form-data" method="post"
                              id="addNewTestimonyForm">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="col-md-12">Name <span class="req">*</span></label>
                                <div class="col-md-12">
                                    <input type="text" name="name" placeholder="Name of client"
                                           value="{{old('name', $testimony->name)}}"
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
                                <label class="col-md-12">Company</label>
                                <div class="col-md-12">
                                    <input type="text" name="company" placeholder="Company of client"
                                           value="{{old('company', $testimony->company)}}"
                                           class="form-control form-control-line company">
                                    @if($errors->has('company'))
                                        <span class="validation-error">
                                            {{$errors->first('company')}}
                                        </span>
                                    @endif
                                    <span class="company-error validation-error"></span>
                                </div>
                            </div>

                            @if($testimony->image != null)
                                <div class="form-group">
                                    <label for="existing-image" class="col-md-12">Existing Image</label>
                                    <div class="col-md-12">
                                        <img src="{{asset('public/images/clients-testimony/small/'.$testimony->image)}}" alt="client" id="existing-image">
                                    </div>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Image (Greater Than Or Equal To 400
                                    x 400 | Max 2
                                    MB | PNG,JPG,JPEG,GIF) </label>
                                <div class="col-md-12">
                                    <input type="file" value="" class="form-control image"
                                           id="image" name="image">
                                    @if(isset($errors) && $errors->has('image'))
                                        <span class="validation-error">
                                            {{$errors->first('image')}}
                                        </span>
                                    @endif
                                </div>
                                <span class="image-error validation-error"></span>
                            </div>


                            <div class="form-group">
                                <label class="col-md-12">Status</label>
                                <div class="col-md-12">
                                    <select name="status" id="status">
                                        <option value="active" {{old('status', $testimony->status) == 'active' ? 'selected' : ''}}>Active</option>
                                        <option value="inactive" {{old('status', $testimony->status) == 'inactive' ? 'selected' : ''}}>In Active</option>
                                    </select>
                                    @if($errors->has('status'))
                                        <span class="validation-error">
                                            {{$errors->first('status')}}
                                        </span>
                                    @endif
                                    <span class="status-error validation-error"></span>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Description <span
                                            class="req">*</span></label>
                                <div class="col-sm-12">
                                    <textarea name="description" id="description">{!! old('description', $testimony->description) !!}</textarea>
                                    @if(isset($errors) && $errors->has('description'))
                                        <span class="validation-error description-error">
                                            {{$errors->first('description')}}
                                        </span>
                                    @endif
                                    <span class="description-error validation-error"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">Update</button>
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
        $('input').on('focus', function () {
            $(this).next('span').html('');
        });

        $('select').on('click', function () {
            $(this).next('span').html('');
        });
    </script>

    <script src="https://cdn.ckeditor.com/4.11.2/basic/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');

        CKEDITOR.on('instanceReady', function (evt) {
            var editor = evt.editor;

            editor.on('focus', function (e) {
                $('.description-error').html('');
            });
        });
    </script>

    <script>
        $('form#addNewTestimonyForm').on('submit', function (e) {
            if ($('input.name').val() === '') {
                e.preventDefault();
                $('span.name-error').html('Please enter client name');
            }

            if (CKEDITOR.instances['description'].getData() === '') {
                e.preventDefault();
                $('.description-error').html('Please enter testimony description');
            }
        });

        $('.image').bind('change', function () {
            var file = this.files[0];
            var validationResult = imageValidation(file, function (result) {
                if (result === false) {
                    $('button[type=submit]').prop('disabled', true);
                } else {
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
    </script>
@stop