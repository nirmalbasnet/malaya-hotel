@extends('admin.layout.master')

@section('body')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Social Media Links</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{asset('admin/social-media-links')}}">Social Media Links</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create / Update</li>
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
                                <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-link-variant"></i>Create / Update Social Media Links</h6>
                            </div>
                        </div>

                        <form action="{{url('admin/social-media-links/submit')}}" enctype="multipart/form-data" method="post"
                              id="addNewMemberForm">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="col-md-12">Facebook</label>
                                <div class="col-md-12">
                                    <input type="text" name="facebook" placeholder="Facebook page link"
                                           onfocus="removeError('facebook')" value="{{\App\BackendModel\SocialMedia::where('social_media_type', 'facebook')->count() > 0 ? \App\BackendModel\SocialMedia::where('social_media_type', 'facebook')->first()->social_media_link : ''}}"
                                           class="form-control form-control-line facebook">
                                    @if($errors->has('facebook'))
                                        <span class="validation-error">
                                            {{$errors->first('facebook')}}
                                        </span>
                                    @endif
                                    <span class="facebook-error validation-error"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12">Twitter</label>
                                <div class="col-md-12">
                                    <input type="text" name="twitter" placeholder="Twitter page link"
                                           onfocus="removeError('twitter')" value="{{\App\BackendModel\SocialMedia::where('social_media_type', 'twitter')->count() > 0 ? \App\BackendModel\SocialMedia::where('social_media_type', 'twitter')->first()->social_media_link : ''}}"
                                           class="form-control form-control-line twitter">
                                    @if($errors->has('twitter'))
                                        <span class="validation-error">
                                            {{$errors->first('twitter')}}
                                        </span>
                                    @endif
                                    <span class="twitter-error validation-error"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12">Youtube</label>
                                <div class="col-md-12">
                                    <input type="text" name="youtube" placeholder="Youtube channel link"
                                           onfocus="removeError('youtube')" value="{{\App\BackendModel\SocialMedia::where('social_media_type', 'youtube')->count() > 0 ? \App\BackendModel\SocialMedia::where('social_media_type', 'youtube')->first()->social_media_link : ''}}"
                                           class="form-control form-control-line youtube">
                                    @if($errors->has('youtube'))
                                        <span class="validation-error">
                                            {{$errors->first('youtube')}}
                                        </span>
                                    @endif
                                    <span class="youtube-error validation-error"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12">Instagram</label>
                                <div class="col-md-12">
                                    <input type="text" name="instagram" placeholder="Instagram page link"
                                           onfocus="removeError('instagram')" value="{{\App\BackendModel\SocialMedia::where('social_media_type', 'instagram')->count() > 0 ? \App\BackendModel\SocialMedia::where('social_media_type', 'instagram')->first()->social_media_link : ''}}"
                                           class="form-control form-control-line instagram">
                                    @if($errors->has('instagram'))
                                        <span class="validation-error">
                                            {{$errors->first('instagram')}}
                                        </span>
                                    @endif
                                    <span class="instagram-error validation-error"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">Create / Update</button>
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
        function isUrlValid(url) {
            return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
        }

        $('#addNewMemberForm').on('submit', function (e) {
            if ($('.facebook').val() !== '') {
                if(!isUrlValid($('.facebook').val()))
                {
                    e.preventDefault();
                    $('.facebook').css('border', '1px solid #dc3545');
                    $('span.facebook-error').html('Invalid Format');
                }
            }

            if ($('.twitter').val() !== '') {
                if(!isUrlValid($('.twitter').val()))
                {
                    e.preventDefault();
                    $('.twitter').css('border', '1px solid #dc3545');
                    $('span.twitter-error').html('Invalid Format');
                }
            }

            if ($('.youtube').val() !== '') {
                if(!isUrlValid($('.youtube').val()))
                {
                    e.preventDefault();
                    $('.youtube').css('border', '1px solid #dc3545');
                    $('span.youtube-error').html('Invalid Format');
                }
            }

            if ($('.instagram').val() !== '') {
                if(!isUrlValid($('.instagram').val()))
                {
                    e.preventDefault();
                    $('.instagram').css('border', '1px solid #dc3545');
                    $('span.instagram-error').html('Invalid Format');
                }
            }
        });


        function removeError(element) {
            $('.' + element).css('border', '1px solid #e9ecef');
            $('span.' + element+'-error').html('');
        }
    </script>
@stop