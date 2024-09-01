@php $contactDetails = \App\BackendModel\ContactInfo::first(); @endphp
<!-- footer start -->
<footer class="site-footer section">
    <div class="container">
        <div class="footer-wrap">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h4>Malaya pvt.ltd</h4>
                        <div class="content">
                            <address>
                                <p>
                                    <i class="fa fa-map-marker"></i> {{isset($contactDetails->location) && $contactDetails->location != null ? $contactDetails->location : 'N/A'}}
                                </p>
                                <p>
                                    @if($contactDetails->landline != null && $contactDetails->mobile != null)
                                        <i class="fa fa-phone"></i> {{$contactDetails->landline.' | '.$contactDetails->mobile}}
                                    @elseif($contactDetails->landline == null && $contactDetails->mobile != null)
                                        <i class="fa fa-phone"></i> {{$contactDetails->mobile}}
                                    @elseif($contactDetails->landline != null && $contactDetails->mobile == null)
                                        <i class="fa fa-phone"></i> {{$contactDetails->landline}}
                                    @else
                                        <i class="fa fa-phone"></i> Not Available
                                    @endif
                                </p>
                                <p>
                                    <i class="fa fa-envelope"></i> {{isset($contactDetails->email) && $contactDetails->email != null ? $contactDetails->email : 'N/A'}}
                                </p>
                            </address>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget mrt">
                        <h4>Quik links</h4>
                        <div class="content">
                            <ul class="footer-link">
                                <li><a href="{{url('/')}}">Home</a></li>
                                <li><a href="{{url('top-destination/lists/all')}}">Top Destinations</a></li>
                                <li><a href="{{url('tour-package/lists/all')}}">Tour Packages</a></li>
                                <li><a href="{{url('feedback')}}">Leave Feedback</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget mrt">
                        <h4>Malaya Holidays</h4>
                        <div class="content">
                            <ul class="footer-link">
                                <li><a href="{{url('about-us')}}">About Us</a></li>
                                <li><a href="{{url('our-team')}}">Our Team</a></li>
                                <li><a href="{{url('terms-and-conditions')}}">Terms & Conditions</a></li>
                                <li><a href="{{url('travel-insurance')}}">Travel Insurance</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h4>Newsletter</h4>
                        <div class="content">
                            <div class="footer-social">
                                @if(\App\BackendModel\SocialMedia::where('social_media_type', 'twitter')->first() != null)
                                    <a href="{{\App\BackendModel\SocialMedia::where('social_media_type', 'twitter')->first()->social_media_link}}"
                                       target="_blank">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                @else
                                    <a href="javascript:void(0)">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                @endif

                                @if(\App\BackendModel\SocialMedia::where('social_media_type', 'youtube')->first() != null)
                                    <a href="{{\App\BackendModel\SocialMedia::where('social_media_type', 'youtube')->first()->social_media_link}}"
                                       target="_blank">
                                        <i class="fa fa-youtube"></i>
                                    </a>
                                @else
                                    <a href="javascript:void(0)">
                                        <i class="fa fa-youtube"></i>
                                    </a>
                                @endif

                                @if(\App\BackendModel\SocialMedia::where('social_media_type', 'facebook')->first() != null)
                                    <a href="{{\App\BackendModel\SocialMedia::where('social_media_type', 'facebook')->first()->social_media_link}}"
                                       target="_blank">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                @else
                                    <a href="javascript:void(0)">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                @endif
                            </div>
                            <form id="subscriber-form">
                                <div class="input-group">
                                    <input type="text" placeholder="Your Email address..." value="{{\Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->email : ''}}" class="form-control subscriber-email">
                                    <button type="submit" class="newsletter-subscription-submit">Subscribe</button>
                                </div>
                                <span style="color: maroon; font-weight: 600;" class="subscriptionFormError"></span>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- copyright start -->
<div class="copyright">
    <div class="container">
        <div class="copyright-wrap">
            <p>Copyright © 2018. Malaya pvt.ltd</p>
            <p>Made by : <a href="#">Dristicode pvt ltd</a></p>
        </div>
    </div>
</div>
