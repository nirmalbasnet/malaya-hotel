<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li>
                    <!-- User Profile-->
                    <div class="user-profile d-flex no-block dropdown m-t-20">
                        <div class="user-pic">
                            <span class="logo-initial">{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->name[0]}}</span>
                        </div>
                        <div class="user-content hide-menu m-l-10">
                            <a href="javascript:void(0)" class="" id="Userdd" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <h5 class="m-b-0 user-name font-medium">{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->name}}
                                    <i class="fa fa-angle-down"></i></h5>
                                <span class="op-5 user-email">{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->email}}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Userdd">
                                <a class="dropdown-item" href="{{url('admin/profile')}}"><i
                                            class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                                <a class="dropdown-item" href="{{url('admin/logout')}}"><i
                                            class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                            </div>
                        </div>
                    </div>
                    <!-- End User Profile-->
                </li>

                @if(\App\Helpers\RoleManager::checkHasRoles('Dashboard'))
                    <li class="sidebar-item"><a
                                class="sidebar-link waves-effect waves-dark sidebar-link {{\Illuminate\Support\Facades\Request::is('admin/dashboard') ? 'active' : ''}}"
                                href="{{url('admin/dashboard')}}" aria-expanded="false"><i
                                    class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                @endif

                @if(\App\Helpers\RoleManager::checkHasRoles('Banner'))
                    <li class="sidebar-item"><a
                                class="sidebar-link waves-effect waves-dark sidebar-link {{\Illuminate\Support\Facades\Request::is('admin/banner') || \Illuminate\Support\Facades\Request::is('admin/banner/*') ? 'active' : ''}}"
                                href="{{url('admin/banner')}}" aria-expanded="false"><i
                                    class="mdi mdi-animation"></i><span
                                    class="hide-menu">Banner</span></a></li>
                @endif
                @if(\App\Helpers\RoleManager::checkHasRoles('Destinations'))
                    <li class="sidebar-item"><a
                                class="sidebar-link waves-effect waves-dark sidebar-link {{\Illuminate\Support\Facades\Request::is('admin/destinations') || \Illuminate\Support\Facades\Request::is('admin/destinations/*') ? 'active' : ''}}"
                                href="{{url('admin/destinations')}}" aria-expanded="false"><i
                                    class="mdi mdi-run-fast"></i><span
                                    class="hide-menu">Destinations @if(\App\BackendModel\DestinationReview::where('reviewed', 'no')->count() > 0)
                                    <span class="destination-notification"><i
                                                class='fa fa-bell'></i></span> @endif</span></a></li>
                @endif

                @if(\App\Helpers\RoleManager::checkHasRoles('Bookings'))
                    <li class="sidebar-item"><a
                                class="sidebar-link waves-effect waves-dark sidebar-link {{\Illuminate\Support\Facades\Request::is('admin/bookings') || \Illuminate\Support\Facades\Request::is('admin/bookings/*') ? 'active' : ''}}"
                                href="{{url('admin/bookings')}}" aria-expanded="false"><i
                                    class="mdi mdi-bookmark"></i><span
                                    class="hide-menu">Bookings @if(\App\Booking::where('acknowledged_by', null)->count() > 0)
                                    <span class="destination-notification"><i class='fa fa-bell'></i></span> @endif</span></a></li>
                @endif

                @if(\App\Helpers\RoleManager::checkHasRoles('User Inquiries'))
                    <li class="sidebar-item"><a
                                class="sidebar-link waves-effect waves-dark sidebar-link {{\Illuminate\Support\Facades\Request::is('admin/inquiries') || \Illuminate\Support\Facades\Request::is('admin/inquiries/*') ? 'active' : ''}}"
                                href="{{url('admin/inquiries')}}" aria-expanded="false"><i
                                    class="mdi mdi-alert-circle"></i><span
                                    class="hide-menu">User Inquiries @if(\App\BackendModel\Contact::where('read_status', 'unseen')->count() > 0)
                                    <span class="user-inquiries"><i class='fa fa-bell'></i></span> @endif</span></a></li>
                @endif

                @if(\App\Helpers\RoleManager::checkHasRoles('Guides'))
                    <li class="sidebar-item"><a
                                class="sidebar-link waves-effect waves-dark sidebar-link {{\Illuminate\Support\Facades\Request::is('admin/guides') || \Illuminate\Support\Facades\Request::is('admin/guides/*') ? 'active' : ''}}"
                                href="{{url('admin/guides')}}" aria-expanded="false"><i
                                    class="mdi mdi-account-convert"></i><span
                                    class="hide-menu">Guides</span></a></li>
                @endif

                @if(\App\Helpers\RoleManager::checkHasRoles('About Us'))
                    <li class="sidebar-item"><a
                                class="sidebar-link waves-effect waves-dark sidebar-link {{\Illuminate\Support\Facades\Request::is('admin/about-us') || \Illuminate\Support\Facades\Request::is('admin/about-us/*') ? 'active' : ''}}"
                                href="{{url('admin/about-us')}}" aria-expanded="false"><i
                                    class="mdi mdi-bandcamp"></i><span
                                    class="hide-menu">About Us</span></a></li>
                @endif

                @if(\App\Helpers\RoleManager::checkHasRoles('Our Team'))
                    <li class="sidebar-item"><a
                                class="sidebar-link waves-effect waves-dark sidebar-link {{\Illuminate\Support\Facades\Request::is('admin/our-team') || \Illuminate\Support\Facades\Request::is('admin/our-team/*') ? 'active' : ''}}"
                                href="{{url('admin/our-team')}}" aria-expanded="false"><i
                                    class="mdi mdi-account-multiple"></i><span
                                    class="hide-menu">Our Team</span></a></li>
                @endif
                @if(\Illuminate\Support\Facades\Auth::guard('admin')->user()->designation == 'super' || \Illuminate\Support\Facades\Auth::guard('admin')->user()->designation == 'supreme')
                    <li class="sidebar-item"><a
                                class="sidebar-link waves-effect waves-dark sidebar-link {{\Illuminate\Support\Facades\Request::is('admin/staffs') || \Illuminate\Support\Facades\Request::is('admin/staffs/*') ? 'active' : ''}}"
                                href="{{url('admin/staffs')}}" aria-expanded="false"><i
                                    class="mdi mdi-account-key"></i><span
                                    class="hide-menu">Staffs</span></a></li>
                @endif

                @if(\App\Helpers\RoleManager::checkHasRoles('Terms & Conditions'))
                    <li class="sidebar-item"><a
                                class="sidebar-link waves-effect waves-dark sidebar-link {{\Illuminate\Support\Facades\Request::is('admin/terms-and-conditions') || \Illuminate\Support\Facades\Request::is('admin/terms-and-conditions/*') ? 'active' : ''}}"
                                href="{{url('admin/terms-and-conditions')}}" aria-expanded="false"><i
                                    class="mdi mdi-bomb"></i><span
                                    class="hide-menu">Terms & Conditions</span></a></li>
                @endif
                @if(\App\Helpers\RoleManager::checkHasRoles('Travel Insurance'))
                    <li class="sidebar-item"><a
                                class="sidebar-link waves-effect waves-dark sidebar-link {{\Illuminate\Support\Facades\Request::is('admin/travel-insurance') || \Illuminate\Support\Facades\Request::is('admin/travel-insurance/*') ? 'active' : ''}}"
                                href="{{url('admin/travel-insurance')}}" aria-expanded="false">
                            <i class="mdi mdi-motorbike"></i><span
                                    class="hide-menu">Travel Insurance</span></a></li>
                @endif
                @if(\App\Helpers\RoleManager::checkHasRoles('Feedbacks'))
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{\Illuminate\Support\Facades\Request::is('admin/feedbacks') || \Illuminate\Support\Facades\Request::is('admin/feedbacks/*') ? 'active' : ''}}"
                           href="{{url('admin/feedbacks')}}" aria-expanded="false">
                            <i class="mdi mdi-hand-pointing-right"></i>
                            <span class="hide-menu">Feedbacks
                                @if(\App\BackendModel\Feedback::where('read_status', 'unseen')->count() > 0)
                                    <span class="unread-feedback-count">
                                    {{\App\BackendModel\Feedback::where('read_status', 'unseen')->count()}}
                                </span>
                                @endif
                        </span>
                        </a>
                    </li>
                @endif

                @if(\App\Helpers\RoleManager::checkHasRoles('Contact Info'))
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{\Illuminate\Support\Facades\Request::is('admin/contact-info') || \Illuminate\Support\Facades\Request::is('admin/contact-info/*') ? 'active' : ''}}"
                           href="{{url('admin/contact-info')}}" aria-expanded="false"><i
                                    class="mdi mdi-contacts"></i><span
                                    class="hide-menu">Contact Info</span></a></li>
                @endif
                @if(\App\Helpers\RoleManager::checkHasRoles('Customers'))
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{\Illuminate\Support\Facades\Request::is('admin/customers') || \Illuminate\Support\Facades\Request::is('admin/customers/*') ? 'active' : ''}}"
                           href="{{url('admin/customers')}}" aria-expanded="false"><i
                                    class="mdi mdi-account-card-details"></i><span
                                    class="hide-menu">Customers</span></a></li>
                @endif
                @if(\App\Helpers\RoleManager::checkHasRoles('Social Media Links'))
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{\Illuminate\Support\Facades\Request::is('admin/social-media-links') || \Illuminate\Support\Facades\Request::is('admin/social-media-links/*') ? 'active' : ''}}"
                           href="{{url('admin/social-media-links')}}" aria-expanded="false"><i
                                    class="mdi mdi-link-variant"></i><span
                                    class="hide-menu">Social Media Links</span></a></li>
                @endif
                @if(\App\Helpers\RoleManager::checkHasRoles('Newsletter Subscribers'))
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{\Illuminate\Support\Facades\Request::is('admin/newsletter-subscribers') || \Illuminate\Support\Facades\Request::is('admin/newsletter-subscribers/*') ? 'active' : ''}}"
                           href="{{url('admin/newsletter-subscribers')}}" aria-expanded="false"><i
                                    class="mdi mdi-email"></i><span
                                    class="hide-menu">Newsletter Subscribers</span></a></li>
                @endif

                @if(\App\Helpers\RoleManager::checkHasRoles('Clients Testimony'))
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{\Illuminate\Support\Facades\Request::is('admin/clients-testimony') || \Illuminate\Support\Facades\Request::is('admin/clients-testimony/*') ? 'active' : ''}}"
                           href="{{url('admin/clients-testimony')}}" aria-expanded="false"><i
                                    class="mdi mdi-emoticon-cool"></i><span
                                    class="hide-menu">Clients Testimony</span></a></li>
                @endif

                @if(\App\Helpers\RoleManager::checkHasRoles('Notification Emails'))
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{\Illuminate\Support\Facades\Request::is('admin/notification-emails') || \Illuminate\Support\Facades\Request::is('admin/notification-emails/*') ? 'active' : ''}}"
                           href="{{url('admin/notification-emails')}}" aria-expanded="false"><i
                                    class="mdi mdi-email-alert"></i><span
                                    class="hide-menu">Notification Emails</span></a></li>
                @endif
            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>

<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->