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
                            <li class="breadcrumb-item active" aria-current="page">Social Media Links</li>
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
                                <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-link-variant"></i>
                                    Social Media Links
                                </h6>
                            </div>
                            <div class="col-7">
                                <div class="text-right upgrade-btn create-new-tab">
                                    <a href="{{url('admin/social-media-links/create')}}" class="btn btn-danger text-white">Add / Update Social Media Link</a>
                                </div>
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
                        <div class="table-responsive">
                            <table class="table" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th scope="col">SN</th>
                                    <th scope="col">Social Media Type</th>
                                    <th scope="col">Social Media Link</th>
                                    <th scope="col">Created By</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($links) && $links->count() > 0)
                                    @php $sn = !isset($_GET['page']) || $_GET['page'] == 1 ? 0 : $_GET['page']*10 - 10; @endphp
                                    @foreach($links as $link)
                                        @php $sn++; @endphp
                                        <tr>
                                            <td>{{$sn}}</td>
                                            <td><strong>{{$link->social_media_type}}</strong></td>
                                            <td>{{$link->social_media_link}}</td>
                                            <td>{{\App\BackendModel\Admin::find($link->created_by)->name}}</td>
                                            <td>
                                                <a href="#" title="remove" class="table-action delete-social-media-link"
                                                   data-id="{{$link->id}}"><i
                                                            class="mdi mdi-delete"></i> Remove</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">
                                            <p class="text-center">No any guides found !!!</p>
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
        $('.delete-social-media-link').on('click', function (e) {
            e.preventDefault();
            var linkId = $(this).data('id');
            alertify.confirm('<span style="color:maroon; text-transform: uppercase; font-weight: 600;">Alert Confirmation</span>', 'Remove this social media ?', function () {
                window.location = baseurl + '/admin/social-media-links/' + linkId + '/remove';
            }, function () {
            });
        });
    </script>
@stop