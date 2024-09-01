<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5">
            <a class="navbar-brand" href="{{asset('admin/dashboard')}}">
                <b class="logo-icon">
                    <img src="{{asset('public/admin/assets/images/logo-icon.png')}}" alt="Malaya" class="dark-logo"/>
                    <img src="{{asset('public/admin/assets/images/logo-light-icon.png')}}" alt="Malaya" class="light-logo"/>
                </b>
                <span class="logo-text">
                    <img style="margin-top: 7px; margin-left: 5px;" src="{{asset('public/admin/assets/images/text-logo.png')}}" alt="Malaya Holidays"
                                  class="dark-logo"/>
                    <img style="margin-top: 7px; margin-left: 5px;" src="{{asset('public/admin/assets/images/text-logo.png')}}" class="light-logo"
                                  alt="Malaya Holidays"/>
                </span>
            </a>
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                        class="ti-menu ti-close"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-left mr-auto">
                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== -->
                {{--<li class="nav-item search-box"><a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i--}}
                                {{--class="ti-search"></i></a>--}}

                {{--</li>--}}
            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-right">
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href=""
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="logo-initial">{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->name[0]}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated">
                        <a class="dropdown-item" href="{{url('admin/profile')}}"><i class="ti-user m-r-5 m-l-5"></i> My
                            Profile</a>

                        <a class="dropdown-item" href="{{url('admin/logout')}}"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>

                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>
<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->