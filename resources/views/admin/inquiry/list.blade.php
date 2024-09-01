@extends('admin.layout.master')

@section('body')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">User Inquiries</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">User Inquiries</li>
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
                                <h6 class="card-title m-t-40"><i class="mdi mdi-alert-circle"></i>
                                    User Inquiries
                                </h6>
                            </div>
                            <div class="col-7">

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Inquiry</th>
                                    <th scope="col">Seen By</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($data) && $data->count() > 0)
                                    @foreach($data as $datum)
                                        <tr>
                                            <td>{{$datum->name}}</td>
                                            <td>{{$datum->email}}</td>
                                            <td>{{$datum->inquiry}}</td>
                                            <td>{{\App\BackendModel\Admin::find($datum->seen_by)->name}}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4">{{$data->links()}}</td>
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
@stop