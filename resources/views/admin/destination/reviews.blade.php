@extends('admin.layout.master')

@section('body')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Reviews On {{$destination->title}}</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Destination Reviews</li>
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
                                <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-sort-variant"></i>
                                    Reviews
                                </h6>
                            </div>
                            <div class="col-7">
                                <div class="text-right upgrade-btn create-new-tab">
                                    <a href="{{url('admin/destinations')}}" class="btn btn-danger text-white">Back to
                                        List</a>
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
                                    <th>Destination</th>
                                    <th>Reviewed By</th>
                                    <th scope="col">Review</th>
                                    <th scope="col">Star</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($reviews) && $reviews->count() > 0)
                                    @foreach($reviews as $review)
                                        <tr>
                                            <td>{{$destination->title}}</td>
                                            <td>{{\App\User::find($review->user_id)->name}}</td>
                                            <td>{{$review->review}}</td>
                                            <td>{{$review->star_count}}</td>
                                            <td class="action-td">
                                                @if($review->status == 'inactive')
                                                    <a href="{{url('admin/destinations/'.$review->id.'/reviews/approve')}}"
                                                       title="approve"
                                                       class="table-action"><i class="mdi mdi-check"></i> Approve</a>
                                                @else
                                                    <a href="{{url('admin/destinations/'.$review->id.'/reviews/disapprove')}}" title="disapprove"
                                                       class="table-action"><i class="mdi mdi-close"></i> Disapprove</a>
                                                @endif
                                                <a href="#" title="delete" class="table-action delete-review"
                                                   data-id="{{$review->id}}"><i class="mdi mdi-delete"></i> Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
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
        $('.delete-review').on('click', function(e){
            e.preventDefault();
            var reviewId = $(this).data('id');
            alertify.confirm('<span style="color:maroon; text-transform: uppercase; font-weight: 600;">Delete Confirmation</span>', 'Delete This Review ?', function () {
                window.location = baseurl + '/admin/destinations/' + reviewId + '/reviews/delete';
            }, function () {
            });
        });
    </script>
@stop