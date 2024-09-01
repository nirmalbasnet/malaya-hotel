@extends('frontend.layout.master')

@section('styles')
    <style>
    </style>
@stop

@section('body')
    <!-- breadcrumb start -->
    <section class="breadcrumb" style="background:url({{asset('public/frontend/images/bg/traveller.jpg')}})">
        <div class="container">
            <div class="breadcrumb-item">
                <h2>All Top Destinations</h2>
                <ul>
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>Top Destination</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="inner-page">
        <div class="container">
            <main>
                <div class="category-list top-destination">
                    <div class="row">
                        @if(isset($destinations) && $destinations->count() > 0)
                            @foreach($destinations as $destination)
                                <div class="col-lg-4 col-md-6">
                                    <div class="dest-item">
                                        <div class="dest-img">
                                            <a href="{{url('top-destination/'.$destination->slug)}}"><img
                                                        src="{{asset('public/images/destinations/banners/'.$destination->destinationImages->first()->image)}}"
                                                        alt="tour"></a>
                                            <div class="dest-caption">
                                                <h3>
                                                    <a href="{{url('top-destination/'.$destination->slug)}}">{{$destination->title}}</a>
                                                </h3>

                                                <div class="dest-btn">
                                                    <a href="{{url('top-destination/'.$destination->slug)}}"
                                                       class="btn allstar-btn">Explore <i
                                                                class="fa fa-long-arrow-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div style="min-height: 300px;">

                            </div>
                        @endif
                    </div>
                </div>

                @if($count > 6)
                    @php $lastPage = $destinations->lastPage(); @endphp
                    <div class="pagination">
                        <ul>
                            @php $page = isset($_GET['page']) ? $_GET['page'] : 1; @endphp
                            @if($page > 1)
                                @php $prevUrl = '?page='.($page-1); @endphp
                            @else
                                @php $prevUrl = 'javascript:void(0)'; @endphp
                            @endif

                            @if($page < $lastPage)
                                @php $nextUrl = '?page='.($page+1); @endphp
                            @else
                                @php $nextUrl = 'javascript:void(0)'; @endphp
                            @endif
                            <li><a href="{{$prevUrl}}"><i class="fa fa-long-arrow-left"></i></a></li>
                            @for($i = 1; $i <= $lastPage; $i++)
                                <li class="{{$page == $i ? 'active' : ''}}"><a href="{{$page == $i ? 'javascript:void(0)' : '?page='.$i}}">{{$i}}</a></li>
                            @endfor
                            <li><a href="{{$nextUrl}}"><i class="fa fa-long-arrow-right"></i></a></li>
                        </ul>
                    </div>
                @endif
            </main>
        </div>
    </section>
@stop