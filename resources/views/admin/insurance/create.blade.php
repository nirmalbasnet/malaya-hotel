@extends('admin.layout.master')

@section('body')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Travel Insurance</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Travel Insurance</li>
                        </ol>
                    </nav>
                </div>
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
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-5">

                            </div>

                            <div class="col-7"></div>
                        </div>
                        <div class="col-5">
                            <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-motorbike"></i>Travel Insurance Clauses</h6>
                        </div>
                        <form action="{{isset($insurance) ? url('admin/travel-insurance/'.$insurance->id.'/update') : url('admin/travel-insurance/submit')}}" enctype="multipart/form-data" method="post"
                              id="addNewMemberForm">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="col-md-12"></label>
                                <div class="col-md-12">
                                    <textarea name="description" id="description" class="form-control">{{old('description', isset($insurance) ? $insurance->description : '')}}</textarea>
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
                                    <button type="submit" class="btn btn-success">{{isset($insurance) ? 'Update' : 'Submit'}}</button>
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
            if(CKEDITOR.instances['description'].getData() ===''){
                e.preventDefault();
                $('.description-error').html('This field is required');
            }
        });

        CKEDITOR.on('instanceReady', function (evt) {
            var editor = evt.editor;

            editor.on('focus', function (e) {
                $('.description-error').html('');
            });
        });
    </script>
@stop