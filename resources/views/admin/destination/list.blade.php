@extends('admin.layout.master')

@section('body')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Banners</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blogs</li>
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
                                <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-blogger"></i>
                                    Blogs
                                </h6>
                            </div>
                            <div class="col-7">
                                <div class="text-right upgrade-btn create-new-tab">
                                    <a href="javascript:void(0)" class="btn btn-danger text-white" data-toggle="modal"
                                       data-target="#viewBlogCategory">View Blog Category</a>
                                    <a href="javascript:void(0)" class="btn btn-danger text-white" data-toggle="modal"
                                       data-target="#addNewBlogCategory">Add New Blog Category</a>
                                    <a href="{{url('admin/blogs/create')}}" class="btn btn-danger text-white">Add New
                                        Blog</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Detail</th>
                                    <th scope="col">Feature</th>
                                    <th scope="col">Publish</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($blogs) && $blogs->count() > 0)
                                    @foreach($blogs as $blog)
                                        <tr>
                                            <td>{{$blog->title}}</td>
                                            <td>{{\App\BackendModel\BlogCategory::find($blog->category_id)->category}}</td>
                                            <td><img style="width: 100px; height: 60px;"
                                                     src="{{asset('public/blogs/thumbs/'.$blog->image)}}" alt=""></td>
                                            <td style="text-align: justify;"><a href="#" class="show-modal-content"
                                                                                data-id="{{$blog->id}}">{!! str_limit(strip_tags($blog->description), 150) !!}</a>
                                            </td>
                                            <td>{{ucwords($blog->feature)}}</td>
                                            <td>{{ucwords($blog->publish)}}</td>
                                            <td class="action-td">
                                                <a href="{{url('admin/blogs/'.$blog->id.'/edit')}}" title="edit"
                                                   class="table-action"><i class="mdi mdi-table-edit"></i> Edit</a>
                                                <a href="#" title="delete" class="table-action delete-blog"
                                                   data-id="{{$blog->id}}"><i class="mdi mdi-delete"></i> Delete</a>
                                                <a href="#" title="feature" class="table-action feature-blog"
                                                   data-id="{{$blog->id}}"><i class="mdi mdi-trending-up"></i>
                                                    Feature</a>
                                                <a href="#" title="publish" class="table-action publish-blog"
                                                   data-id="{{$blog->id}}"><i class="mdi mdi-publish"></i>
                                                    Publish</a>
                                                <a href="javascript:void(0)" title="views" class="table-action views">
                                                    <i class="mdi mdi-eye"></i>
                                                    {{$blog->views}}
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Modal -->
                                        <div class="modal fade blog-description-modal" id="descModal-{{$blog->id}}"
                                             tabindex="-1" role="dialog" aria-labelledby="descModalLabel"
                                             aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="descModalLabel">Blog
                                                            Description</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <strong>{{$blog->title}}</strong>
                                                        <p style="text-align: justify;">
                                                            {!! $blog->description !!}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <tr>
                                        <td colspan="7">{{$blogs->links()}}</td>
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

    <!-- Modal -->
    <div class="modal fade" id="addNewBlogCategory" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add New Blog Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" enctype="multipart/form-data" method="post"
                          id="addNewBannerForm">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label class="col-md-12">Category</label>
                            <div class="col-md-12">
                                <input type="text" name="category" placeholder="Add New Blog Category"
                                       onfocus="removeError('blog-category')"
                                       class="form-control form-control-line blog-category">
                                <span class="form-error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="viewBlogCategory" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Blog Categories</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if(isset($blogCategories) && $blogCategories->count() > 0)
                        <ul class="blog-categories-ul">
                            @foreach($blogCategories as $blogCategory)
                                <li>{{$blogCategory->category}} <span data-status="unclicked"
                                                                      class="fa fa-times delete-blog-category"
                                                                      data-id="{{$blogCategory->id}}"></span></li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-center">No any data found !!!</p>
                    @endif
                    <span class="delete-blog-category-error"></span>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $('#addNewBlogCategory').on('submit', function (e) {
            if ($('.blog-category').val() === '') {
                e.preventDefault();
                $('.blog-category').css('border', '1px solid #dc3545')
            } else {
                e.preventDefault();
                $.ajax({
                    url: baseurl + '/admin/blogs/category/create?category=' + $('.blog-category').val(),
                    type: 'get',
                    success: function (data) {
                        if (data == 'success') {
                            window.location.reload();
                        } else {
                            $('.blog-category').css('border', '1px solid #dc3545');
                            $('.blog-category').next('span.form-error').html(data);
                        }
                    }, error: function (data) {
                        $('.blog-category').next('span.form-error').html('Error ! Please try again !!');
                    }
                });
            }
        });

        function removeError(elememt) {
            $('.' + elememt).css('border', '1px solid #e9ecef');
            $('.' + elememt).next('span.form-error').html('');
        }

        $('.delete-blog-category').on('click', function () {
            $('.delete-blog-category-error').html('');
            if ($(this).data('status') == 'clicked') {
                return false;
            }
            $(this).attr('data-status', 'clicked');
            var element = $(this);
            var catId = $(this).data('id');
            $.ajax({
                url: baseurl + '/admin/blogs/category/delete?cid=' + catId,
                type: 'get',
                success: function (data) {
                    if (data == 'success') {
                        element.parent('li').remove();
                    } else {
                        $('.delete-blog-category-error').html(data);
                    }
                    element.attr('data-status', 'unclicked');
                }, error: function (data) {
                    $('.delete-blog-category-error').html('Error ! Please try again !!');
                    element.attr('data-status', 'unclicked');
                }
            });
        });

        $('.delete-blog').on('click', function (e) {
            e.preventDefault();
            var blogId = $(this).data('id');
            alertify.confirm('<span style="color:maroon; text-transform: uppercase; font-weight: 600;">Delete Confirmation</span>', 'Delete This Blog ?', function () {
                window.location = baseurl + '/admin/blogs/' + blogId + '/delete';
            }, function () {
            });
        });

        $('.feature-blog').on('click', function (e) {
            e.preventDefault();
            var element = $(this);
            var blogId = $(this).data('id');
            $.ajax({
                url: baseurl + '/admin/blogs/' + blogId + '/feature',
                type: 'get',
                success: function (data) {
                    element.parent('td').prev('td').html(data);
                }, error: function (data) {
                    alertify.alert('Error ! Please Try Again');
                }
            });
        });

        $('.publish-blog').on('click', function (e) {
            e.preventDefault();
            var element = $(this);
            var blogId = $(this).data('id');
            $.ajax({
                url: baseurl + '/admin/blogs/' + blogId + '/publish',
                type: 'get',
                success: function (data) {
                    element.parent('td').prev('td').html(data);
                }, error: function (data) {
                    alertify.alert('Error ! Please Try Again');
                }
            });
        });

        $('.show-modal-content').on('click', function (e) {
            e.preventDefault();
            $('div.modal-body img').css('width', '100%').css('height', '100%');
            var id = $(this).data('id');
            $('#descModal-' + id).modal('show');
        });
    </script>
@stop