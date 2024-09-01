@extends('admin.layout.master')

@section('styles')
    <style>
        .parent {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@stop

@section('body')
    @if(\App\Helpers\RoleManager::checkHasRoles('Dashboard'))
        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-5">
                    <h4 class="page-title">Dashboard</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-7">
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="parent">
                <div class="child">
                    <h3>This is a dahboard page !</h3>
                </div>
            </div>
        </div>
    @else
        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-5">
                    <h4 class="page-title">Dashboard</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
                                                                Welcome</h1>
                                                            <h1 class=""
                                                                style="color:#3c6879 !important;">
                                                                {{\Illuminate\Support\Facades\Auth::guard('admin')->user()->name}}</h1>
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
    @endif
@stop