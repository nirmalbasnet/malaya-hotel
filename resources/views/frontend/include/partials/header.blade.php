@php $contactDetails = \App\BackendModel\ContactInfo::first(); @endphp
<!-- header start -->
<header class="site-header">
    <div class="search-header">
        <div class="searchbox">
            <button class="close">×</button>
            <form>
                <input type="search" placeholder="Search …">
                <button type="submit"><i class="fa fa-search"></i>
                </button>
            </form>
        </div>
    </div>
    <div class="top_header">
        <div class="container">
            <div class="top_header_left">
                <p style="font-size: 12px;"><i class="fa fa-phone"></i> Call Us :
                    @if($contactDetails->landline != null && $contactDetails->mobile != null)
                        {{$contactDetails->landline.' | '.$contactDetails->mobile}}
                    @elseif($contactDetails->landline == null && $contactDetails->mobile != null)
                        {{$contactDetails->mobile}}
                    @elseif($contactDetails->landline != null && $contactDetails->mobile == null)
                        {{$contactDetails->landline}}
                    @else
                        Not Available
                    @endif
                </p>
            </div>
            <div class="top_header_right">
                <div class="rightul" data-select2-id="88">
                    <ul data-select2-id="87">
                        @if(\Illuminate\Support\Facades\Auth::guest())
                            <li class="login"><a href="{{url('login')}}"><i class="fa fa-power-off"></i> &nbsp;&nbsp;login</a>
                            </li>
                            <li class="register"><a href="{{url('register')}}"><i class="fa fa-plus-circle"></i>
                                    register</a>
                            </li>
                        @else
                            <li class="login"><a href="{{url('my-account')}}"><i class="fa fa-briefcase"></i> &nbsp;&nbsp;My Account</a>
                            </li>
                            <li class="login"><a href="{{url('logout')}}"><i class="fa fa-sign-out"></i> &nbsp;&nbsp;Logout</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div id="master-head" class="master-head">
            <div class="toggle-button">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="menu-wrap">
                <a class="logo-link" href="{{url('/')}}">
                    <img src="{{asset('public/frontend/images/logo.png')}}" alt="logo">
                </a>
                <div class="menu">
                    <ul class="primary-menu">
                        <li class="{{\Illuminate\Support\Facades\Request::is('/') ? 'menu-item-has-current' : ''}}">
                            <a href="{{url('/')}}">Home</a>
                        </li>

                        <li class="{{\Illuminate\Support\Facades\Request::is('top-destination/*') ? 'menu-item-has-current' : ''}}">
                            <a href="{{url('top-destination/lists/all')}}">Top Destinations</a>
                        </li>

                        <li class="{{\Illuminate\Support\Facades\Request::is('tour-package/*') ? 'menu-item-has-current' : ''}}">
                            <a href="{{url('tour-package/lists/all')}}">Tour Packages</a>
                        </li>

                        <li class="menu-item-has-children {{\Illuminate\Support\Facades\Request::is('about-us') || \Illuminate\Support\Facades\Request::is('our-team') || \Illuminate\Support\Facades\Request::is('terms-and-conditions') || \Illuminate\Support\Facades\Request::is('travel-insurance') ? 'menu-item-has-current' : ''}}">
                            <a href="javascript:void(0)">About</a>
                            <ul>
                                <li>
                                    <a href="{{url('about-us')}}">About Us</a>
                                </li>

                                <li>
                                    <a href="{{url('our-team')}}">our team</a>
                                </li>
                                {{--<li>--}}
                                    {{--<a href="{{url('reviews')}}">our reviewer</a>--}}
                                {{--</li>--}}
                                <li>
                                    <a href="{{url('terms-and-conditions')}}">Terms & Conditions</a>
                                </li>
                                <li>
                                    <a href="{{url('travel-insurance')}}">Travel Insurance</a>
                                </li>


                            </ul>
                        </li>
                        <li class="{{\Illuminate\Support\Facades\Request::is('feedback') ? 'menu-item-has-current' : ''}}">
                            <a href="{{url('feedback')}}">Feedback</a>
                        </li>


                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>