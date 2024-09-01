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
                <h2>All Tour Packages</h2>
                <ul>
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>All Tour Packages</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="inner-page">
        <div class="container">
            <main>
                <div class="category-list toptour">
                    <div class="row">
                        @if(isset($destinations) && $destinations->count() > 0)
                            @foreach($destinations as $destination)
                                <div class="col-lg-4 col-md-6">
                                    <div class="tour-item">
                                        <div class="tourimg">
                                            <a href="{{url('tour-package/'.$destination->slug)}}"><img
                                                        src="{{asset('public/images/destinations/banners/'.$destination->destinationImages->first()->image)}}"
                                                        alt="tour"></a>
                                            <ul>
                                                <li><i class="fa fa-usd" aria-hidden="true"></i>{{$destination->price}}</li>
                                                <li><i class="fa fa-clock-o" aria-hidden="true"></i>{{$destination->total_duration}}</li>
                                                <li><i class="fa fa-level-up" aria-hidden="true"></i>{{$destination->difficulty}}</li>
                                            </ul>
                                        </div>
                                        <div class="tour-content">
                                            <h3>
                                                <a href="{{url('tour-package/'.$destination->slug)}}">{{$destination->title}}</a>
                                            </h3>

                                            <div class="text">
                                                {!! substr($destination->summary, 0, 200)  !!}...
                                            </div>
                                            <div class="tour-btn">
                                                <div class="item-rating btn">
                                                    @if($destination->destinationReviews->count() == 0)
                                                        <i class="fa fa-star" style="color: #ccc;"></i>
                                                        <i class="fa fa-star" style="color: #ccc;"></i>
                                                        <i class="fa fa-star" style="color: #ccc;"></i>
                                                        <i class="fa fa-star" style="color: #ccc;"></i>
                                                        <i class="fa fa-star" style="color: #ccc;"></i>
                                                    @else
                                                        @php $sumOfRatings = 0; @endphp
                                                        @php $multiplyValue = 0; @endphp
                                                        @for($i = 0; $i <= 5; $i++)
                                                            @if($destination->destinationReviews->where('star_count', $i)->count() > 0)
                                                                @php $multiplyValue += $destination->destinationReviews->where('star_count', $i)->count() * $i; @endphp
                                                                @php $sumOfRatings += $destination->destinationReviews->where('star_count', $i)->count(); @endphp
                                                            @endif
                                                        @endfor
                                                        @php $averageStar = ceil($multiplyValue/$sumOfRatings); @endphp
                                                        @for($cnt = 1; $cnt <= $averageStar; $cnt++)
                                                            <i style="color: #f69c3f;"
                                                               class="fa fa-star"></i>
                                                        @endfor

                                                        @if($averageStar < 5)
                                                            @for($cnt = 5; $cnt > $averageStar; $cnt--)
                                                                <i style="color: #ccc;"
                                                                   class="fa fa-star"></i>
                                                            @endfor
                                                        @endif
                                                    @endif
                                                </div>
                                                <a href="{{url('tour-package/'.$destination->slug)}}" class="btn allstar-btn">
                                                    Explore
                                                    <i class="fa fa-long-arrow-right"></i>
                                                </a>
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
                                <li class="{{$page == $i ? 'active' : ''}}"><a
                                            href="{{$page == $i ? 'javascript:void(0)' : '?page='.$i}}">{{$i}}</a></li>
                            @endfor
                            <li><a href="{{$nextUrl}}"><i class="fa fa-long-arrow-right"></i></a></li>
                        </ul>
                    </div>
                @endif
            </main>
        </div>
    </section>
@stop