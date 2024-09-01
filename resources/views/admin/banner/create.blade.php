@extends('admin.layout.master')

@section('body')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Banners</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{asset('admin/banner')}}">Banners</a></li>
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
                                <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-animation"></i>Create
                                    Homepage
                                    Banner
                                </h6>
                            </div>
                        </div>

                        <form action="{{url('admin/banner/submit')}}" enctype="multipart/form-data" method="post"
                              id="addNewBannerForm">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="col-md-12">Banner Text <span class="req">*</span></label>
                                <div class="col-md-12">
                                    <input type="text" name="text" placeholder="Text to show on banner"
                                           onfocus="removeError('banner-text')" value="{{old('text')}}"
                                           class="form-control form-control-line banner-text">
                                    @if($errors->has('text'))
                                        <span class="validation-error">
                                            {{$errors->first('text')}}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Banner Image (Greater Than Or Equal To 1920
                                    x 1050 | Max 2
                                    MB) <span class="req">*</span></label>
                                <div class="col-md-12">
                                    <input onfocus="removeError('banner-image')" type="file"
                                           class="form-control form-control-line banner-image" name="image">
                                    <span class="banner-image-error form-error"></span>
                                    @if($errors->has('image'))
                                        <span class="validation-error">
                                            {{$errors->first('image')}}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Status <span class="req">*</span></label>
                                <div class="col-sm-12">
                                    <select name="status" class="form-control form-control-line banner-status">
                                        <option value="active" {{old('status') == 'active' ? 'selected' : ''}}>Active
                                        </option>
                                        <option value="inactive" {{old('status') == 'inactive' ? 'selected' : ''}}>
                                            Inactive
                                        </option>
                                    </select>
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
    <script>
        $('#addNewBannerForm').on('submit', function (e) {
            if ($('.banner-text').val() === '') {
                e.preventDefault();
                $('.banner-text').css('border', '1px solid #dc3545')
            }

            if ($('.banner-image').val() === '') {
                e.preventDefault();
                $('.banner-image').css('border', '1px solid #dc3545')
            }

            if ($('.banner-image-error').html() !== '') {
                e.preventDefault();
                $('.banner-image').css('border', '1px solid #dc3545')
            }
        });


        function removeError(element) {
            $('.' + element).css('border', '1px solid #e9ecef');
        }

        $('.banner-image').bind('change', function () {
            var _URL = window.URL || window.webkitURL;
            var error = 0;
            var imageSize = (this.files[0].size);
            if (imageSize > 2000000) {
                error = 1;
                $('span.validation-error').html('');
                $('.banner-image-error').html('<strong>Max Image Size 2 MB</strong>');
            }

            if (error === 0) {

                var file, img;
                if ((file = this.files[0])) {
                    img = new Image();
                    var imageWidth = 0;
                    var imageHeight = 0;
                    img.onload = function () {
                        imageWidth = this.width;
                        imageHeight = this.height;
                        if (imageWidth < 1920 || imageHeight < 1050) {
                            error = 1;
                            $('span.validation-error').html('');
                            $('.banner-image-error').html('<strong>Invalid Image Dimension</strong>');
                        } else {
                            if (error === 0) {
                                $('.banner-image-error').html('');
                            }
                        }
                    };
                    img.src = _URL.createObjectURL(file);
                }
            }
        });
    </script>
@stop