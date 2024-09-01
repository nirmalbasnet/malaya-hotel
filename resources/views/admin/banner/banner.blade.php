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
                            <li class="breadcrumb-item active" aria-current="page">Banners</li>
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
                                <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-animation"></i> Homepage
                                    Banner
                                </h6>
                            </div>
                            <div class="col-7">
                                <div class="text-right upgrade-btn create-new-tab">
                                    <a href="{{url('admin/banner/create')}}" class="btn btn-danger text-white">Add New Banner</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Order</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Text</th>
                                    <th scope="col">status</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($banners) && $banners->count() > 0)
                                    @foreach($banners as $banner)
                                        <tr>
                                            <td><strong>{{$banner->order_number}}</strong></td>
                                            <td><img src="{{asset('public/images/banners/'.$banner->image)}}" alt="banner"
                                                     style="width: 100px; height: 60px;"></td>
                                            <td>{{$banner->text}}</td>
                                            <td>{{ucwords($banner->status)}}</td>
                                            <td>
                                                <a href="{{url('admin/banner/'.$banner->id.'/edit')}}" title="edit"
                                                   class="table-action"><i
                                                            class="mdi mdi-table-edit"></i> Edit</a>
                                                <a href="#" title="delete" class="table-action delete-banner"
                                                   data-id="{{$banner->id}}"><i
                                                            class="mdi mdi-delete"></i> Delete</a>
                                                @if($banner->order_number != 1)
                                                    <a href="" title="order up" class="table-action order-up-banner" data-id="{{$banner->id}}"><i
                                                                class="mdi mdi-menu-up"></i> Order Up</a>
                                                @endif

                                                @if($banner->order_number != \App\BackendModel\Banner::count())
                                                    <a href="" title="order down" class="table-action order-down-banner" data-id="{{$banner->id}}"><i
                                                                class="mdi mdi-menu-down"></i> Order Down</a>
                                                @endif
                                                @if($banner->status == 'active')
                                                    <a href="" title="mark inactive" class="table-action inactivate-banner" data-id="{{$banner->id}}"><i
                                                                class="mdi mdi-minus-box"></i> Mark Inactive</a>
                                                @else
                                                    <a href="" title="mark active" class="table-action activate-banner" data-id="{{$banner->id}}"><i
                                                                class="mdi mdi-plus-box"></i> Mark Active</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5">{{$banners->links()}}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="5">
                                            <p class="text-center">No any banners found !!!</p>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')
    <script>
        $('.delete-banner').on('click', function (e) {
            e.preventDefault();
            var bannerId = $(this).data('id');
            alertify.confirm('<span style="color:maroon; text-transform: uppercase; font-weight: 600;">Delete Confirmation</span>', 'Delete This Banner ?', function () {
                window.location = baseurl+'/admin/banner/'+bannerId+'/delete';
            }, function () {
            });
        });

        $('.order-up-banner').on('click', function (e) {
            e.preventDefault();
            var bannerId = $(this).data('id');
            alertify.confirm('<span style="color:maroon; text-transform: uppercase; font-weight: 600;">Order Up Confirmation</span>', 'Are you sure ?', function () {
                window.location = baseurl+'/admin/banner/'+bannerId+'/orderup';
            }, function () {
            });
        });

        $('.order-down-banner').on('click', function (e) {
            e.preventDefault();
            var bannerId = $(this).data('id');
            alertify.confirm('<span style="color:maroon; text-transform: uppercase; font-weight: 600;">Order Down Confirmation</span>', 'Are you sure ?', function () {
                window.location = baseurl+'/admin/banner/'+bannerId+'/orderdown';
            }, function () {
            });
        });

        $('.inactivate-banner').on('click', function (e) {
            e.preventDefault();
            var bannerId = $(this).data('id');
            alertify.confirm('<span style="color:maroon; text-transform: uppercase; font-weight: 600;">Inactivate Banner Confirmation</span>', 'Are you sure ?', function () {
                window.location = baseurl+'/admin/banner/'+bannerId+'/inactivate';
            }, function () {
            });
        });

        $('.activate-banner').on('click', function (e) {
            e.preventDefault();
            var bannerId = $(this).data('id');
            alertify.confirm('<span style="color:maroon; text-transform: uppercase; font-weight: 600;">Activate Banner Confirmation</span>', 'Are you sure ?', function () {
                window.location = baseurl+'/admin/banner/'+bannerId+'/activate';
            }, function () {
            });
        });
    </script>
@stop