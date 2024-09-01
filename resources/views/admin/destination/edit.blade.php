@extends('admin.layout.master')

@section('styles')
@stop


@section('body')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Destinations</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/destinations')}}">Destinations</a></li>
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
                                <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-run-fast"></i>
                                    Edit Destination
                                </h6>
                            </div>
                        </div>

                        <form id="create-form" class="form-horizontal blog-form" method="post"
                              action="{{url('admin/destinations/'.$destination->id.'/update')}}"
                              enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Title <span class="req">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{old('title', $destination->title)}}" class="form-control"
                                           id="title"
                                           placeholder="Enter Title" name="title">
                                    @if(isset($errors) && $errors->has('title'))
                                        <span class="validation-error">
                                            {{$errors->first('title')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Trip Destination <span class="req">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{old('trip_destination', $destination->trip_destination)}}" class="form-control"
                                           id="trip_destination"
                                           placeholder="Enter Trip Destination" name="trip_destination">
                                    @if(isset($errors) && $errors->has('trip_destination'))
                                        <span class="validation-error">
                                            {{$errors->first('trip_destination')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Total Duration <span class="req">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{old('total_duration', $destination->total_duration)}}" class="form-control"
                                           id="total_duration"
                                           placeholder="Enter Total Duration" name="total_duration">
                                    @if(isset($errors) && $errors->has('total_duration'))
                                        <span class="validation-error">
                                            {{$errors->first('total_duration')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Difficulty <span class="req">*</span></label>
                                <div class="col-sm-10">
                                    <select name="difficulty" class="form-control form-control-line">
                                        <option value="easy" {{old('difficulty', $destination->difficulty) == 'easy' ? 'selected' : ''}}>Easy
                                        </option>
                                        <option value="medium" {{old('difficulty', $destination->difficulty) == 'medium' ? 'selected' : ''}}>
                                            Medium
                                        </option>
                                        <option value="hard" {{old('difficulty', $destination->difficulty) == 'hard' ? 'selected' : ''}}>
                                            Hard
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Primary Activities <span class="req">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{old('primary_activities', $destination->primary_activities)}}" class="form-control"
                                           id="primary_activities"
                                           placeholder="Enter Primary Activities" name="primary_activities">
                                    @if(isset($errors) && $errors->has('primary_activities'))
                                        <span class="validation-error">
                                            {{$errors->first('primary_activities')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Group Size <span class="req">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{old('group_size', $destination->group_size)}}" class="form-control"
                                           id="group_size"
                                           placeholder="Enter Group Size" name="group_size">
                                    @if(isset($errors) && $errors->has('group_size'))
                                        <span class="validation-error">
                                            {{$errors->first('group_size')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Transportation <span class="req">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{old('transportation', $destination->transportation)}}" class="form-control"
                                           id="transportation"
                                           placeholder="Enter Transportation Mediums" name="transportation">
                                    @if(isset($errors) && $errors->has('transportation'))
                                        <span class="validation-error">
                                            {{$errors->first('transportation')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="price">Price <span class="req">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{old('price', $destination->price)}}" class="form-control"
                                           id="price"
                                           placeholder="Enter Price" name="price">
                                    @if(isset($errors) && $errors->has('price'))
                                        <span class="validation-error">
                                            {{$errors->first('price')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="top">Mark As Top <span class="req">*</span></label>
                                <div class="col-sm-10">
                                    <select name="top" class="form-control form-control-line">
                                        <option value="no" {{old('top', $destination->top) == 'no' ? 'selected' : ''}}>No
                                        </option>
                                        <option value="yes" {{old('top', $destination->top) == 'yes' ? 'selected' : ''}}>
                                            Yes
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Summary <span class="req">*</span></label>
                                <div class="col-sm-10">
                                    <textarea name="summary" id="summary"
                                              onfocus="removeError();">{{old('summary', $destination->summary)}}</textarea>
                                    @if(isset($errors) && $errors->has('summary'))
                                        <span class="validation-error summary-error">
                                            {{$errors->first('summary')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Review <span class="req">*</span></label>
                                <div class="col-sm-10">
                                    <textarea name="review" id="review"
                                              onfocus="removeError();">{{old('review', $destination->review)}}</textarea>
                                    @if(isset($errors) && $errors->has('review'))
                                        <span class="validation-error review-error">
                                            {{$errors->first('review')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">Update</button>
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
            $(this).next('span').remove();
        });

        $('select').on('click', function () {
            $(this).next('span').remove();
        });
    </script>

    <script src="https://cdn.ckeditor.com/4.11.2/basic/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('summary');

        CKEDITOR.on('instanceReady', function (evt) {
            var editor = evt.editor;

            editor.on('focus', function (e) {
                $('.summary-error').remove();
            });
        });

        CKEDITOR.replace('review');

        CKEDITOR.on('instanceReady', function (evt) {
            var editor = evt.editor;

            editor.on('focus', function (e) {
                $('.review-error').remove();
            });
        });
    </script>
@stop
