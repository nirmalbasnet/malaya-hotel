@extends('frontend.layout.master')

@section('og')
    <meta property="og:url" content="{{\Illuminate\Support\Facades\Request::fullUrl()}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{$destination->title}}"/>
    <meta property="og:description" content="{!! substr($destination->summary, 0, 100)  !!}"/>
    <meta property="og:image" content="{{asset('public/images/destinations/thumbs/'.$destination->destinationImages->first()->image)}}"/>
    <meta property="fb:app_id" content="1546881215456241"/>
@stop

@section('styles')
    <style>
        div.star-section i {
            cursor: pointer;
            color: #ccc;
        }

        /*div.star-section i:hover {*/
        /*color: #f69c3f;*/
        /*}*/

        span.review-error {
            color: maroon;
            display: none;
        }

        .review-thanks {
            text-align: center;
            font-weight: 600;
            color: darkcyan;
        }

        .no-user-avatar {
            width: 120px;
            background: #eaeaea;
            border-radius: 50%;
            height: 120px;
            display: flex;
            justify-content: center;
            align-content: center;
            align-items: center;
        }

        .no-user-avatar span {
            font-size: 5rem;
            color: #267c5b;
            font-weight: bolder;
        }

        span.error {
            color: maroon;
            font-weight: 600;
            font-size: 15px;
        }

        form#book-form input{
            text-transform: unset;
            font-size: 15px !important;
        }

        form#inquiry-form input, form#inquiry-form textarea{
            text-transform: unset;
            font-size: 15px !important;
        }
    </style>
@stop

@section('body')
    <!-- breadcrumb start -->
    <section class="breadcrumb" style="background:url({{asset('public/frontend/images/bg/traveller.jpg')}})">
        <div class="container">
            <div class="breadcrumb-item">
                <h2>{{$destination->title}}</h2>
                <ul>
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>Tour Package</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @if(\Illuminate\Support\Facades\Session::has('review-redirect-message'))
                        <p class="review-thanks">Thank you for your review. It will get approved soon.</p>
                    @endif
                    <main>
                        <div class="detail-banner">
                            <div class="detail-slider owl-carousel">
                                @if(isset($destination->destinationImages) && $destination->destinationImages->count() > 0)
                                    @foreach($destination->destinationImages as $di)
                                        <div class="detail-item">
                                            <img src="{{asset('public/images/destinations/banners/'.$di->image)}}"
                                                 alt="details-slider">
                                            <div class="slider-caption">
                                                <span>Malaya Holidays</span>
                                                <h4>{{$destination->title}}</h4>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="social-share">
                            <div class="contact-title">
                                <h3>Share in social</h3>
                            </div>
                            @include('frontend.sharer')
                        </div>
                        <div class="details-tab">

                            <div class="custom-tab">
                                <ul>
                                    <li class="custom-link {{ !\Illuminate\Support\Facades\Session::has('review-redirect-message') ?  'current' : ''}}"
                                        data-tab="summarytab">Summary
                                    </li>
                                    @if(isset($destination->destinationItineraries) && $destination->destinationItineraries->count() > 0)
                                        <li class="custom-link" data-tab="itenarytab">Itenanry</li>
                                    @endif
                                    <li class="custom-link {{ \Illuminate\Support\Facades\Session::has('review-redirect-message') ?  'current' : ''}}"
                                        data-tab="review">Review
                                    </li>
                                </ul>
                                <div class="tabcontent">
                                    <div id="summarytab"
                                         class="tabpane {{ !\Illuminate\Support\Facades\Session::has('review-redirect-message') ?  'current' : ''}}">
                                        <div class="summary-content">
                                            <h4>{{$destination->title}}</h4>
                                            <div class="text">
                                                {!! $destination->summary !!}
                                            </div>

                                            <div class="text">
                                                {!! $destination->review !!}
                                            </div>
                                        </div>
                                    </div>
                                    @if(isset($destination->destinationItineraries) && $destination->destinationItineraries->count() > 0)
                                        <div id="itenarytab" class="tabpane">
                                            <div class="summary-content">
                                                <ul>
                                                    @foreach($destination->destinationItineraries as $destIti)
                                                        <li>
                                                            <h4>Day {{$destIti->day}}</h4>
                                                            <div class="text">
                                                                {{$destIti->itinerary}}
                                                            </div>
                                                            <span>{{$destIti->day}}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                    <div id="review"
                                         class="tabpane {{ \Illuminate\Support\Facades\Session::has('review-redirect-message') ?  'current' : ''}}">
                                        <div class="summary-content">
                                            <div class="reviewsummary">
                                                @if(isset($destination->destinationReviews) && $destination->destinationReviews->where('status', 'active')->count() > 0)
                                                    @foreach($destination->destinationReviews->where('status', 'active') as $activeReview)
                                                        <div class="review-list">
                                                            <div class="reviewer-info">
                                                                <div class="reviewer-img">
                                                                    @if(\App\User::find($activeReview->user_id)->avatar != null)
                                                                        <img src="{{\App\User::find($activeReview->user_id)->avatar}}"
                                                                             alt="user">
                                                                    @else
                                                                        <div class="no-user-avatar">
                                                                            <span>{{\App\User::find($activeReview->user_id)->name[0]}}</span>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <div class="text">
                                                                    <h4>{{\App\User::find($activeReview->user_id)->name}}</h4>
                                                                    <div class="reviewer-rating">
                                                                        @if($activeReview->star_count == 0)
                                                                            <i style="color: #ccc;"
                                                                               class="fa fa-star"></i>
                                                                            <i style="color: #ccc;"
                                                                               class="fa fa-star"></i>
                                                                            <i style="color: #ccc;"
                                                                               class="fa fa-star"></i>
                                                                            <i style="color: #ccc;"
                                                                               class="fa fa-star"></i>
                                                                            <i style="color: #ccc;"
                                                                               class="fa fa-star"></i>
                                                                        @else
                                                                            @for($cnt = 1; $cnt <= $activeReview->star_count; $cnt++)
                                                                                <i style="color: #f69c3f;"
                                                                                   class="fa fa-star"></i>
                                                                            @endfor

                                                                            @if($activeReview->star_count < 5)
                                                                                @for($cnt = 5; $cnt > $activeReview->star_count; $cnt--)
                                                                                    <i style="color: #ccc;"
                                                                                       class="fa fa-star"></i>
                                                                                @endfor
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="reviewer-content">
                                                                {!! $activeReview->review !!}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <form method="post" id="review-form"
                                                  action="{{url('tour-package/'.$destination->slug.'/submit-review')}}">
                                                {{csrf_field()}}
                                                <div class="contact-title">
                                                    <h3>Leave Review</h3>
                                                </div>
                                                <div class="form-group">
                                                    <label>Message :</label>
                                                    <textarea class="form-control" name="review" placeholder="Message"
                                                              aria-rowspan="5" id="review"></textarea>
                                                    <span class="review-error"><strong>Please enter your review !</strong></span>
                                                </div>

                                                <div class="form-group">
                                                    <label>Rating :</label>
                                                    <div class="star-section">
                                                        <i class="fa fa-star review-star review-star-1"
                                                           data-value="1"></i>
                                                        <i class="fa fa-star review-star review-star-2"
                                                           data-value="2"></i>
                                                        <i class="fa fa-star review-star review-star-3"
                                                           data-value="3"></i>
                                                        <i class="fa fa-star review-star review-star-4"
                                                           data-value="4"></i>
                                                        <i class="fa fa-star review-star review-star-5"
                                                           data-value="5"></i>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="page_url"
                                                       value="{{\Illuminate\Support\Facades\Request::fullUrl()}}">
                                                <button type="submit" class="btn allstar-btn">Submit</button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </main>
                </div>
                <div class="col-md-4">
                    <div id="secondary" class="sidebar">
                        <div class="sidebar-widget">
                            <div class="sidebar-title">
                                <h3>Tirp Facts</h3>
                            </div>
                            <div class="sidebar-content">
                                <ul>
                                    <li><label>Trip Destination:</label> {{$destination->trip_destination}}</li>
                                    <li><label>Total duration:</label> {{$destination->total_duration}}</li>
                                    <li><label>Difficulty:</label> {{ucwords($destination->difficulty)}}</li>
                                    <li><label>Primary Activities:</label> {{$destination->primary_activities}}</li>
                                    <li><label>Group size :</label> {{$destination->group_size}}</li>
                                    <li><label>Transportation:</label> {{$destination->transportation}}</li>
                                    <li><label>Total Price:</label> {{$destination->price}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-widget">
                            <div class="sidebar-title">
                                <h3>Book This Trip</h3>
                            </div>
                            <div class="booking-form">
                                <span class="thank-you-message" style="display: none; color: #267c5b; font-weight: 600;">Thank You. We&apos;ll get back to you soon.</span>
                                <form id="book-form" method="post">
                                    <div class="form-group">
                                        <input value="{{\Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->name : ''}}" type="text" name="booker_name" id="booker-name" placeholder="Your name"
                                               autocomplete="off">
                                        <span class="error"></span>
                                    </div>
                                    <div class="form-group">
                                        <input value="{{\Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->email : ''}}" type="email" name="booker_email" id="booker-email"
                                               placeholder="Your email">
                                        <span class="error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label>How many people ?</label>
                                        <div class="select-group">
                                            <select class="niceSelect form-control" id="no-of-people"
                                                    name="no_of_people">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="more than 15">More than 15</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn allstar-btn" id="book-form-submit">Book Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="sidebar-widget">
                            <div class="sidebar-title">
                                <h3>Quick Inquiry</h3>
                            </div>
                            <div class="booking-form">
                                <span class="inquiry-thank-you-message" style="display: none; color: #267c5b; font-weight: 600;">Thank You. We&apos;ll get back to you soon.</span>
                                <form id="inquiry-form">
                                    <div class="form-group">
                                        <input value="{{\Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->name : ''}}" type="text" name="name" id="name" placeholder="Your name" autocomplete="off">
                                        <span class="error"></span>
                                    </div>
                                    <div class="form-group">
                                        <input value="{{\Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->email : ''}}" type="text" id="email" name="email" placeholder="Your email">
                                        <span class="error"></span>
                                    </div>
                                    {{--<div class="form-group">--}}
                                        {{--<input type="text" name="Phone number" placeholder="Phone numbers"--}}
                                               {{--autocomplete="off">--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<input type="text" name="number of people" placeholder="Number of people">--}}
                                    {{--</div>--}}
                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="Inquiry*" name="inquiry" id="inquiry" rows="5"></textarea>
                                        <span class="error"></span>
                                    </div>
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn allstar-btn" id="inquiry-form-submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @if(isset($randomDestination) && $randomDestination->count() > 0)
                            <div class="sidebar-widget">
                                <div class="sidebar-title">
                                    <h3>Related Trips</h3>
                                </div>
                                <div class="sidebar-content">
                                    <ul>
                                        @foreach($randomDestination as $randDest)
                                            <li>
                                                <a href="{{url('tour-package/'.$randDest->slug)}}">{{$randDest->title}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('scripts')
    <script>
        $('.review-star').on('click', function () {
            var value = $(this).data('value');

            $('#review-form').find('input.star_count').remove();
            $('#review-form').append('<input type="hidden" class="star_count" value="' + value + '" name="star_count" />');

            // if (value > 1) {
            //     for (var i = 1; i <= value; i++) {
            //         $('.review-star-' + i).css('color', '#f69c3f');
            //     }
            //
            //     for (var j = 5; j > value; j--) {
            //         $('.review-star-' + i).css('color', '#ccc');
            //     }
            // }
            //
            // if (value === 1) {
            //     $('.review-star-1').css('color', '#f69c3f');
            //     for (var k = 2; k <= 5; k++) {
            //         $('.review-star-' + k).css('color', '#ccc');
            //     }
            // }

            for (var i = 1; i <= value; i++) {
                $('.review-star-' + i).css('color', '#f69c3f');
            }

            for (var j = 5; j > value; j--) {
                $('.review-star-' + j).css('color', '#ccc');
            }

        });

        $('#review-form').on('submit', function (e) {
            if ($('textarea#review').val() === '') {
                e.preventDefault();
                $('span.review-error').show();
            }
        });

        $('textarea#review').on('focus', function (e) {
            e.preventDefault();
            $('span.review-error').hide();

        });

        function validateEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(email)) {
                return false;
            } else {
                return true;
            }
        }

        $('#book-form').on('submit', function (e) {
            e.preventDefault();
            var error = 0;
            if ($('#booker-name').val() === '') {
                e.preventDefault();
                $('#booker-name').next('span.error').html('Enter your name');
                error = 1;
            }

            if ($('#booker-email').val() === '') {
                e.preventDefault();
                $('#booker-email').next('span.error').html('Enter your email');
                error = 1;
            }

            if ($('#booker-email').val() !== '') {
                var test = validateEmail($('#booker-email').val());
                if (!test) {
                    e.preventDefault();
                    $('#booker-email').next('span.error').html('Please enter valid email');
                    error = 1;
                }
            }

            if ($('#no-of-people').val() === '') {
                e.preventDefault();
                $('#no-of-people').next('span.error').html('Choose group size');
                error = 1;
            }

            if (error === 0) {
                $('#book-form-submit').prop('disabled', true);
                var formData = $('#book-form').serialize();
                $.ajax({
                    url: baseurl + '/tour-package/' + "{{$destination->id}}" + '/book?'+formData,
                    type: 'get',
                    success:function(data){
                        $('span.thank-you-message').show();
                        $('#booker-name').val('');
                        $('#booker-email').val('');
                        $('#no-of-people').val(1);
                        $('#book-form-submit').prop('disabled', false);
                    }, error: function (data) {
                        $('#book-form-submit').prop('disabled', false);
                    }
                });
            }
        });

        $('#book-form input').on('focus', function () {
            $(this).next('span.error').html('');
        });

        $('#inquiry-form').on('submit', function (e) {
            e.preventDefault();
            var error = 0;
            if ($('#name').val() === '') {
                e.preventDefault();
                $('#name').next('span.error').html('Enter your name');
                error = 1;
            }

            if ($('#email').val() === '') {
                e.preventDefault();
                $('#email').next('span.error').html('Enter your email');
                error = 1;
            }

            if ($('#inquiry').val() === '') {
                e.preventDefault();
                $('#inquiry').next('span.error').html('Enter your email');
                error = 1;
            }

            if ($('#email').val() !== '') {
                var test = validateEmail($('#email').val());
                if (!test) {
                    e.preventDefault();
                    $('#email').next('span.error').html('Please enter valid email');
                    error = 1;
                }
            }

            if (error === 0) {
                $('#inquiry-form-submit').prop('disabled', true);
                var formData = $('#inquiry-form').serialize();
                $.ajax({
                    url: baseurl + '/tour-package/' + "{{$destination->id}}" + '/inquiry?'+formData,
                    type: 'get',
                    success:function(data){
                        $('span.inquiry-thank-you-message').show();
                        $('#name').val('');
                        $('#email').val('');
                        $('#inquiry').val('');
                        $('#inquiry-form-submit').prop('disabled', false);
                    }, error: function (data) {
                        $('#inquiry-form-submit').prop('disabled', false);
                    }
                });
            }
        });

        $('#inquiry-form input').on('focus', function () {
            $(this).next('span.error').html('');
        });

        $('#inquiry-form textarea').on('focus', function () {
            $(this).next('span.error').html('');
        });
    </script>
@stop