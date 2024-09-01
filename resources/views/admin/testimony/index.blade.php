@extends('admin.layout.master')

@section('body')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Clients Testimony</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Clients Testimony</li>
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
                                <h6 class="card-title m-t-40"><i class="mdi mdi-emoticon-cool"></i>
                                    Clients Testimony
                                </h6>
                            </div>
                            <div class="col-7">
                                <div class="text-right upgrade-btn create-new-tab">
                                    <a style="margin-bottom: 10px;" href="{{url('admin/clients-testimony/add')}}"
                                       class="btn btn-danger text-white">Add New Testimony</a>
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
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created By</th>
                                    {{--<th scope="col">Created At</th>--}}
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($testimonies) && $testimonies->count() > 0)
                                    @foreach($testimonies as $testimony)
                                        <tr>
                                            <td>{{$testimony->name}}</td>
                                            <td>{{$testimony->company}}</td>
                                            @if(isset($testimony->image) && $testimony->image != null)
                                                <td>
                                                    <img src="{{asset('public/images/clients-testimony/small/'.$testimony->image)}}"
                                                         alt="client"></td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td style="width: 250px;">{!! \Illuminate\Support\Str::words($testimony->description, 20,'...')  !!}</td>
                                            <td style="text-transform: uppercase;">{{ucwords($testimony->status)}}</td>
                                            {{--<td>{{date('M d, Y', strtotime($testimony->created_at))}}</td>--}}
                                            <td>{{\App\BackendModel\Admin::find($testimony->created_by)->name}}</td>
                                            <td>
                                                <a href="{{url('admin/clients-testimony/'.$testimony->id.'/edit')}}" title="edit"
                                                   class="table-action"><i class="mdi mdi-table-edit"></i> Edit</a>
                                                @if($testimony->status == 'active')
                                                    <a href="{{url('admin/clients-testimony/'.$testimony->id.'/inactivate')}}" title="mark inactive"
                                                       class="table-action inactivate-testimony"
                                                       data-id="{{$testimony->id}}"><i
                                                                class="mdi mdi-minus-box"></i> Inavtivate</a>
                                                @else
                                                    <a href="{{url('admin/clients-testimony/'.$testimony->id.'/activate')}}" title="mark active"
                                                       class="table-action activate-testimony"
                                                       data-id="{{$testimony->id}}"><i
                                                                class="mdi mdi-plus-box"></i> Activate</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="8">{{$testimonies->links()}}</td>
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