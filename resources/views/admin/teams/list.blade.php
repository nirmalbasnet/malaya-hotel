@extends('admin.layout.master')

@section('body')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Our Teams</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Our Teams</li>
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
                                <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-account-multiple"></i>
                                    Our Teams
                                </h6>
                            </div>
                            <div class="col-7">
                                <div class="text-right upgrade-btn create-new-tab">
                                    <a href="{{url('admin/our-team/create')}}" class="btn btn-danger text-white">Add New Team Member</a>
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
                                    <th scope="col">Name</th>
                                    <th scope="col">Designation</th>
                                    <th scope="col">Description</th>
                                    <th>Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($teams) && $teams->count() > 0)
                                    @foreach($teams as $team)
                                        <tr>
                                            <td><strong>{{$team->name}}</strong></td>
                                            <td>{{$team->designation}}</td>
                                            <td>{!! str_limit(strip_tags($team->description), 150) !!}</td>
                                            <td><img src="{{asset('public/images/teams/small/'.$team->image)}}" alt="our team"></td>
                                            <td>
                                                <a style="width: 60px;" href="{{url('admin/our-team/'.$team->id.'/edit')}}" title="edit"
                                                   class="table-action"><i
                                                            class="mdi mdi-table-edit"></i> Edit</a>
                                                <a href="#" title="delete" class="table-action delete-team"
                                                   data-id="{{$team->id}}"><i
                                                            class="mdi mdi-delete"></i> Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5">{{$teams->links()}}</td>
                                    </tr>
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
        $('.delete-team').on('click', function (e) {
            e.preventDefault();
            var teamId = $(this).data('id');
            alertify.confirm('<span style="color:maroon; text-transform: uppercase; font-weight: 600;">Delete Confirmation</span>', 'Delete This Team Member ?', function () {
                window.location = baseurl+'/admin/our-team/'+teamId+'/delete';
            }, function () {
            });
        });
    </script>
@stop