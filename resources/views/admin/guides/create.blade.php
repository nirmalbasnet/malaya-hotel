@extends('admin.layout.master')

@section('body')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Guides</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{asset('admin/guides')}}">Guides</a></li>
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
                                <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-account-convert"></i>Create New Guide</h6>
                            </div>
                        </div>

                        <form action="{{url('admin/guides/submit')}}" enctype="multipart/form-data" method="post"
                              id="addNewGuideForm">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="col-md-12">Name <span class="req">*</span></label>
                                <div class="col-md-12">
                                    <input type="text" name="name" placeholder="Name of a guide"
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
                                <label class="col-md-12">Category <span class="req">*</span></label>
                                <div class="col-md-12">
                                    <select name="category" id="category" class="form-control category" onfocus="removeError('category');">
                                        <option value="Travel Guide">Travel Guide</option>
                                    </select>
                                    @if($errors->has('category'))
                                        <span class="validation-error">
                                            {{$errors->first('category')}}
                                        </span>
                                    @endif
                                    <span class="category-error validation-error"></span>
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
                                <label class="col-md-12">Facebook Link (Ex. http://www.example.com/...)</label>
                                <div class="col-md-12">
                                    <input type="text" name="fb_link" placeholder="Facebook link of a guide"
                                           onfocus="removeError('fblink')" value="{{old('fb_link')}}"
                                           class="form-control form-control-line fblink">
                                    @if($errors->has('fb_link'))
                                        <span class="validation-error">
                                            {{$errors->first('fb_link')}}
                                        </span>
                                    @endif
                                    <span class="fblink-error validation-error"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12">Skype Link (Ex. http://www.example.com/...)</label>
                                <div class="col-md-12">
                                    <input type="text" name="skype_link" placeholder="Skype link of a guide"
                                           onfocus="removeError('skypelink')" value="{{old('skype_link')}}"
                                           class="form-control form-control-line skypelink">
                                    @if($errors->has('skype_link'))
                                        <span class="validation-error">
                                            {{$errors->first('skype_link')}}
                                        </span>
                                    @endif
                                    <span class="skypelink-error validation-error"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12">Instagram Link (Ex. http://www.example.com/...)</label>
                                <div class="col-md-12">
                                    <input type="text" name="insta_link" placeholder="Instagram link of a guide"
                                           onfocus="removeError('instalink')" value="{{old('insta_link')}}"
                                           class="form-control form-control-line instalink">
                                    @if($errors->has('insta_link'))
                                        <span class="validation-error">
                                            {{$errors->first('insta_link')}}
                                        </span>
                                    @endif
                                    <span class="instalink-error validation-error"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12">Linkedin Link (Ex. http://www.example.com/...)</label>
                                <div class="col-md-12">
                                    <input type="text" name="linkedin_link" placeholder="Linkedin link of a guide"
                                           onfocus="removeError('linkedinlink')" value="{{old('linkedin_link')}}"
                                           class="form-control form-control-line linkedinlink">
                                    @if($errors->has('linkedin_link'))
                                        <span class="validation-error">
                                            {{$errors->first('linkedin_link')}}
                                        </span>
                                    @endif
                                    <span class="linkedinlink-error validation-error"></span>
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
        function isValidUrl(url){
            if(/^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test(url)) {
                return true;
            } else {
                return false;
            }
        }

        $('#addNewGuideForm').on('submit', function (e) {
            if ($('.name').val() === '') {
                e.preventDefault();
                $('.name').css('border', '1px solid #dc3545');
                $('span.name-error').html('This field is required');
            }

            if ($('.category').val() === '') {
                e.preventDefault();
                $('.category').css('border', '1px solid #dc3545');
                $('.category-error').html('This field is required')
            }

            if ($('.image').val() === '') {
                e.preventDefault();
                $('.image').css('border', '1px solid #dc3545');
                $('.image-error').html('This field is required');
            }

            if($('.fblink').val() !== '')
            {
                if(!isValidUrl($('.fblink').val()))
                {
                    e.preventDefault();
                    $('.fblink').css('border', '1px solid #dc3545');
                    $('.fblink-error').html('Invalid format');
                }
            }

            if($('.skypelink').val() !== '')
            {
                if(!isValidUrl($('.skypelink').val()))
                {
                    e.preventDefault();
                    $('.skypelink').css('border', '1px solid #dc3545');
                    $('.skypelink-error').html('Invalid format');
                }
            }

            if($('.instalink').val() !== '')
            {
                if(!isValidUrl($('.instalink').val()))
                {
                    e.preventDefault();
                    $('.instalink').css('border', '1px solid #dc3545');
                    $('.instalink-error').html('Invalid format');
                }
            }

            if($('.linkedinlink').val() !== '')
            {
                if(!isValidUrl($('.linkedinlink').val()))
                {
                    e.preventDefault();
                    $('.linkedinlink').css('border', '1px solid #dc3545');
                    $('.linkedinlink-error').html('Invalid format');
                }
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
    </script>
@stop