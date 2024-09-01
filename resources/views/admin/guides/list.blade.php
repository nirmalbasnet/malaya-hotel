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
                            <li class="breadcrumb-item active" aria-current="page">Guides</li>
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
                                <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-account-convert"></i>
                                    Guides
                                </h6>
                            </div>
                            <div class="col-7">
                                <div class="text-right upgrade-btn create-new-tab">
                                    <a href="{{url('admin/guides/create')}}" class="btn btn-danger text-white">Add New Guide</a>
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
                                    <th scope="col">Category</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Facebook</th>
                                    <th scope="col">Skype</th>
                                    <th scope="col">Instagram</th>
                                    <th scope="col">Linkedin</th>
                                    <th scope="col">Created By</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($guides) && $guides->count() > 0)
                                    @foreach($guides as $guide)
                                        <tr>
                                            <td><strong>{{$guide->name}}</strong></td>
                                            <td>{{$guide->category}}</td>
                                            <td><img src="{{asset('public/images/guides/small/'.$guide->image)}}" alt="guide"></td>
                                            <td>{{$guide->fb_link}}</td>
                                            <td>{{$guide->skype_link}}</td>
                                            <td>{{$guide->insta_link}}</td>
                                            <td>{{$guide->linkedin_link}}</td>
                                            <td><p style="width: 110px;">{{\App\BackendModel\Admin::find($guide->created_by)->name}}</p></td>
                                            <td><p style="width: 115px;">{{date('M d Y h:i A', strtotime($guide->created_at))}}</p></td>
                                            <td>
                                                <a style="width: 60px;" href="{{url('admin/guides/'.$guide->id.'/edit')}}" title="edit"
                                                   class="table-action"><i
                                                            class="mdi mdi-table-edit"></i> Edit</a>
                                                <a href="#" title="delete" class="table-action delete-guide"
                                                   data-id="{{$guide->id}}"><i
                                                            class="mdi mdi-delete"></i> Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="10">{{$guides->links()}}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="10">
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
        $('.delete-guide').on('click', function (e) {
            e.preventDefault();
            var guideId = $(this).data('id');
            alertify.confirm('<span style="color:maroon; text-transform: uppercase; font-weight: 600;">Delete Confirmation</span>', 'Delete This Guide ?', function () {
                window.location = baseurl+'/admin/guides/'+guideId+'/delete';
            }, function () {
            });
        });
    </script>
@stop