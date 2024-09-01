@extends('admin.layout.master')

@section('styles')
    <link href="{{asset('public/admin/dist/css/style.min.css')}}" rel="stylesheet">
@stop

@section('body')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Access Denied</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Access Denied</li>
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
                                <h6 class="card-title m-t-40"><i class="fa fa-ban"></i> Access Denied
                                </h6>
                            </div>

                            <div class="col-7">

                            </div>
                        </div>

                        <hr>

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="error-box" style="position: unset;">
                                                    <div class="error-body text-center">
                                                        <h1 class="error-title text-danger"
                                                            style="color:#3c6879 !important;">
                                                            403</h1>
                                                        <h3 class="text-uppercase error-subtitle">You don't have access
                                                            to this
                                                            page !</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
@stop