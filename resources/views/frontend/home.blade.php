@extends('frontend.layout.master')

@section('styles')
    <style>
        div.no-image p {
            font-size: 15rem;
        }
    </style>
@stop

@section('body')
    <!-- herobanner start -->
    <section class="hero-banner">
        <div class="hero-slider owl-carousel">
            @if(isset($banners) && $banners->count() > 0)
                @foreach($banners as $banner)
                    <div class="hero-item" style="background:url({{asset('public/images/banners/'.$banner->image)}});">
                        <!-- <div class="overlay"></div> -->
                        <div class="slider-caption">
                            <span>Malaya Holidays</span>
                            <h4>{{$banner->text}}</h4>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>


        <div class="booktab">
            <div class="flightbook-form" id="flightbook-form">
                <ul>
                    <li class="tab-link current" data-tab="flighttab"><i class="fa fa-plane"></i>Flight</li>
                    <li class="tab-link" data-tab="tourtab"><i class="fa fa-suitcase"></i>Tours</li>
                </ul>
                <div class="tabcontent">
                    <div id="flighttab" class="booktab-content current">
                        <form>
                            <div class="row">
                                <div class="col-sm-12 col-md-5 col-lg-4">
                                    <div class="row">

                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group left-icon">
                                                <input type="text" class="form-control" placeholder="From">
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group left-icon">
                                                <input type="text" class="form-control" placeholder="To">
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-5 col-lg-4">
                                    <div class="row">

                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group left-icon">
                                                <input type="date" class="form-control dpd1" placeholder="Check In">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group left-icon">
                                                <input type="date" class="form-control dpd2" placeholder="Check Out">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <div class="form-group left-icon right-icon">
                                        <select class="form-control">
                                            <option selected="">Adults</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                        </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-2 search-btn">
                                    <button class="btn allstar-btn">Book Now</button>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div id="tourtab" class="booktab-content">
                        <form>
                            <div class="row">
                                <div class="col-sm-12 col-md-3 col-lg-4">
                                    <div class="form-group left-icon">
                                        <input type="text" class="form-control" placeholder="From">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group left-icon">
                                        <input type="date" class="form-control dpd1" placeholder="Check In">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>

                                <div class=" col-sm-12 col-md-6 col-lg-3">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group left-icon right-icon">
                                                <select class="form-control">
                                                    <option selected="">Adults</option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                </select>
                                                <i class="fa fa-angle-down"></i>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group left-icon right-icon">
                                                <select class="form-control">
                                                    <option selected="">Kids</option>
                                                    <option>0</option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                </select>
                                                <i class="fa fa-angle-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-2 search-btn">
                                    <button class="btn allstar-btn">Book Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- destination start -->
    @if(isset($topDestinations) && $topDestinations->count() > 0)
        <section class="top-destination section">
            <div class="container">
                <div class="title">
                    <h2>top destination</h2>
                    <span class="seprator"></span>
                </div>
                <div class="destination-slider owl-carousel">
                    @foreach($topDestinations as $td)
                        <div class="dest-item">
                            <div class="dest-img">
                                <a href="{{url('top-destination/'.$td->slug)}}"><img
                                            src="{{asset('public/images/destinations/thumbs/'.$td->destinationImages->first()->image)}}"
                                            alt="tour"></a>
                                <div class="dest-caption">
                                    <h3><a href="{{url('top-destination/'.$td->slug)}}">{{$td->title}}</a></h3>

                                    <div class="dest-btn">
                                        <a href="{{url('top-destination/'.$td->slug)}}" class="btn allstar-btn">Explore
                                            <i
                                                    class="fa fa-long-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="viewall-btn">
                    <a href="{{url('top-destination/lists/all')}}" class="btn allstar-btn">Explore all</a>
                </div>
            </div>
        </section>
    @endif

    <!-- service start -->
    {{--<section class="service section">--}}
    {{--<div class="container">--}}
    {{--<div class="title">--}}
    {{--<h2>Our Featured</h2>--}}
    {{--<span class="seprator"></span>--}}
    {{--</div>--}}
    {{--<div class="service-inner">--}}
    {{--<div class="row">--}}
    {{--<div class="col-lg-3 col-md-6">--}}
    {{--<div class="service-item">--}}
    {{--<div class="service-icon">--}}
    {{--<i class="fa fa-dollar"></i>--}}
    {{--</div>--}}
    {{--<div class="service-text">--}}
    {{--<h4>Best Price Guarantee</h4>--}}

    {{--<div class="text">--}}
    {{--Lorem ipsum dolor sit amet, ad duo fugit aeque fabulas, in lucilius prodesset pri.--}}
    {{--Veniam--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-lg-3 col-md-6">--}}
    {{--<div class="service-item">--}}
    {{--<div class="service-icon">--}}
    {{--<i class="fa fa-lock"></i>--}}
    {{--</div>--}}
    {{--<div class="service-text">--}}
    {{--<h4>safe and secure</h4>--}}
    {{--<div class="text">--}}
    {{--Lorem ipsum dolor sit amet, ad duo fugit aeque fabulas, in lucilius prodesset pri.--}}
    {{--Veniam--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-lg-3 col-md-6">--}}
    {{--<div class="service-item">--}}
    {{--<div class="service-icon">--}}
    {{--<i class="fa fa-thumbs-up"></i>--}}
    {{--</div>--}}
    {{--<div class="service-text">--}}
    {{--<h4>Best Travel Agency</h4>--}}
    {{--<div class="text">--}}
    {{--Lorem ipsum dolor sit amet, ad duo fugit aeque fabulas, in lucilius prodesset pri.--}}
    {{--Veniam--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-lg-3 col-md-6">--}}
    {{--<div class="service-item">--}}
    {{--<div class="service-icon">--}}
    {{--<i class="fa fa-bars"></i>--}}
    {{--</div>--}}
    {{--<div class="service-text">--}}
    {{--<h4>Travel Guidelines</h4>--}}
    {{--<div class="text">--}}
    {{--Lorem ipsum dolor sit amet, ad duo fugit aeque fabulas, in lucilius prodesset pri.--}}
    {{--Veniam--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</section>--}}
    <!-- counter start -->
    <section class="counter section" id="counter"
             style="background:url({{asset('public/frontend/images/bg/traveller.jpg')}})">
        <div class="container">
            <div class="counter-inner">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counter-item">
                            <div class="counter-icon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <div class="counter-text">
                                <h3 class="count">{{\App\BackendModel\Destination::where('top', 'yes')->where('publish', 'yes')->count()}}</h3>
                                <h4>
                                    Top Destinations
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counter-item">
                            <div class="counter-icon">
                                <i class="fa fa-rocket"></i>
                            </div>
                            <div class="counter-text">
                                <h3 class="count">{{\App\User::count()}}</h3>
                                <h4>
                                    Users
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counter-item">
                            <div class="counter-icon">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="counter-text">
                                <h3 class="count">{{\App\BackendModel\Destination::where('top', 'no')->where('publish', 'yes')->count()}}</h3>
                                <h4>
                                    Tours
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counter-item">
                            <div class="counter-icon">
                                <i class="fa fa-hourglass-2"></i>
                            </div>
                            <div class="counter-text">
                                <h3 class="count">{{\App\BackendModel\Guides::count()}}</h3>
                                <h4>
                                    Guides
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @if(isset($normalDestinations) && $normalDestinations->count() > 0)
        <!-- tour package start -->
        <section class="toptour section">
            <div class="container">
                <div class="title">
                    <h2>tour package</h2>
                    <span></span>
                </div>
                <div class="package-slider owl-carousel">
                    @foreach($normalDestinations as $normalDestination)
                        <div class="tour-item">
                            <div class="tourimg">
                                <a href="{{url('tour-package/'.$normalDestination->slug)}}"><img
                                            src="{{asset('public/images/destinations/thumbs/'.$normalDestination->destinationImages->first()->image)}}"
                                            alt="tour"></a>
                                <ul>
                                    <li><i class="fa fa-usd" aria-hidden="true"></i>{{$normalDestination->price}}</li>
                                    <li><i class="fa fa-clock-o"
                                           aria-hidden="true"></i>{{$normalDestination->total_duration}}</li>
                                    <li><i class="fa fa-level-up"
                                           aria-hidden="true"></i>{{$normalDestination->difficulty}}</li>
                                </ul>
                            </div>
                            <div class="tour-content">
                                <h3>
                                    <a href="{{url('tour-package/'.$normalDestination->slug)}}">{{$normalDestination->title}}</a>
                                </h3>

                                <div class="text">
                                    {!! substr($normalDestination->summary, 0, 200)  !!}...
                                </div>
                                <div class="tour-btn">
                                    <div class="item-rating btn">
                                        @if($normalDestination->destinationReviews->count() == 0)
                                            <i class="fa fa-star" style="color: #ccc;"></i>
                                            <i class="fa fa-star" style="color: #ccc;"></i>
                                            <i class="fa fa-star" style="color: #ccc;"></i>
                                            <i class="fa fa-star" style="color: #ccc;"></i>
                                            <i class="fa fa-star" style="color: #ccc;"></i>
                                        @else
                                            @php $sumOfRatings = 0; @endphp
                                            @php $multiplyValue = 0; @endphp
                                            @for($i = 0; $i <= 5; $i++)
                                                @if($normalDestination->destinationReviews->where('star_count', $i)->count() > 0)
                                                    @php $multiplyValue += $normalDestination->destinationReviews->where('star_count', $i)->count() * $i; @endphp
                                                    @php $sumOfRatings += $normalDestination->destinationReviews->where('star_count', $i)->count(); @endphp
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
                                    <a href="{{url('tour-package/'.$normalDestination->slug)}}" class="btn allstar-btn">Explore
                                        <i class="fa fa-long-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="viewall-btn">
                    <a href="{{url('tour-package/lists/all')}}" class="btn allstar-btn">Explore all</a>
                </div>
            </div>

        </section>
    @endif

    @if(isset($guides) && $guides->count() > 0)
        <!-- guide start -->
        <section class="guide section">
            <div class="container">
                <div class="title">
                    <h2>Our Guide</h2>
                    <span></span>
                </div>
                <div class="guide-slider owl-carousel">
                    @foreach($guides as $guide)
                        <div class="guide-item">
                            <div class="guideimg">
                                <img src="{{asset('public/images/guides/big/'.$guide->image)}}" alt="guide">
                            </div>
                            <div class="guide-content">
                                <h3><a href="#">{{$guide->name}}</a></h3>
                                <span>{{$guide->category}}</span>
                                <div class="guide-social">
                                    @if(isset($guide->fb_link) && $guide->fb_link != 'N/A')
                                        <a href="{{$guide->fb_link}}" target="_blank"><i class="fa fa-facebook"></i></a>
                                    @else
                                        <a href="javascript:void(0)"><i class="fa fa-facebook"></i></a>
                                    @endif

                                    @if(isset($guide->skype_link) && $guide->skype_link != 'N/A')
                                        <a href="{{$guide->skype_link}}" target="_blank"><i class="fa fa-skype"></i></a>
                                    @else
                                        <a href="javascript:void(0)"><i class="fa fa-skype"></i></a>
                                    @endif

                                    @if(isset($guide->insta_link) && $guide->insta_link != 'N/A')
                                        <a href="{{$guide->insta_link}}" target="_blank"><i class="fa fa-instagram"></i></a>
                                    @else
                                        <a href="javascript:void(0)"><i class="fa fa-instagram"></i></a>
                                    @endif

                                    @if(isset($guide->linkedin_link) && $guide->linkedin_link != 'N/A')
                                        <a href="{{$guide->linkedin_link}}" target="_blank"><i
                                                    class="fa fa-linkedin"></i></a>
                                    @else
                                        <a href="javascript:void(0)"><i class="fa fa-linkedin"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if(isset($testimonies) && $testimonies->count() > 0)
        <!-- review start -->
        <section class="review section" style="background:url({{asset('public/frontend/images/bg/traveller.jpg')}})">
            <div class="container">
                <div class="title">
                    <h2>WHAT OUR CLIENT SAY</h2>
                    <span></span>
                </div>
                <div class="review-slider owl-carousel">
                    @foreach($testimonies as $testimony)
                        <div class="review-item">

                            <div class="review-thumb">
                                @if(isset($testimony->image) && $testimony->image != null)
                                    <img src="{{asset('public/images/clients-testimony/big/'.$testimony->image)}}">
                                @else
                                    <img src="{{asset('public/images/clients-testimony/no-image.png')}}">
                                @endif
                            </div>
                            <div class="review-content">
                                <div class="content">
                                    {!! $testimony->description !!}
                                </div>
                                <div class="reviewer-info">
                                    <h4>{{$testimony->name}}</h4>
                                    <span>{{$testimony->company}}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@stop