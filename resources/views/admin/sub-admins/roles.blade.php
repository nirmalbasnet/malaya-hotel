@extends('admin.layout.master')

@section('body')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Roles For {{ucwords($admin->name)}}</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Roles
                                For {{ucwords($admin->name)}}</li>
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
                                <h6 class="card-title m-t-40"><i class="mdi mdi-account-key"></i>
                                    Roles For {{ucwords($admin->name)}}
                                </h6>
                            </div>
                            <div class="col-7">

                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <form action="{{url('admin/staffs/'.$admin->id.'/roles/submit')}}" method="post" id="role-form">
                                {{csrf_field()}}
                                <div class="dashboard" style="padding: 10px;">
                                    <div class="form-check">
                                        <input type="checkbox"
                                               {{isset($roles) && $roles != null && in_array('Dashboard', $roles) ? 'checked' : ''}} name="roles[]"
                                               class="form-check-input" id="dashboard" value="Dashboard">
                                        <label class="form-check-label" for="dashboard">Dashboard</label>
                                    </div>
                                </div>

                                <div class="banner" style="padding: 10px;">
                                    <div class="form-check">
                                        <input name="roles[]"
                                               {{isset($roles) && $roles != null && in_array('Banner', $roles) ? 'checked' : ''}} type="checkbox"
                                               class="form-check-input" id="banner" value="Banner">
                                        <label class="form-check-label" for="banner">Banner</label>
                                    </div>
                                </div>

                                <div class="destinations" style="padding: 10px;">
                                    <div class="form-check">
                                        <input name="roles[]"
                                               {{isset($roles) && $roles != null && in_array('Destinations', $roles) ? 'checked' : ''}} type="checkbox"
                                               class="form-check-input" id="destinations" value="Destinations">
                                        <label class="form-check-label" for="destinations">Destinations</label>
                                    </div>
                                </div>

                                <div class="bookings" style="padding: 10px;">
                                    <div class="form-check">
                                        <input name="roles[]"
                                               {{isset($roles) && $roles != null && in_array('Bookings', $roles) ? 'checked' : ''}} type="checkbox"
                                               class="form-check-input" id="bookings" value="Bookings">
                                        <label class="form-check-label" for="inquiries">Bookings</label>
                                    </div>
                                </div>

                                <div class="inquiries" style="padding: 10px;">
                                    <div class="form-check">
                                        <input name="roles[]"
                                               {{isset($roles) && $roles != null && in_array('User Inquiries', $roles) ? 'checked' : ''}} type="checkbox"
                                               class="form-check-input" id="inquiries" value="User Inquiries">
                                        <label class="form-check-label" for="inquiries">User Inquiries</label>
                                    </div>
                                </div>

                                <div class="guides" style="padding: 10px;">
                                    <div class="form-check">
                                        <input name="roles[]"
                                               {{isset($roles) && $roles != null && in_array('Guides', $roles) ? 'checked' : ''}} type="checkbox"
                                               class="form-check-input" id="guides" value="Guides">
                                        <label class="form-check-label" for="guides">Guides</label>
                                    </div>
                                </div>

                                <div class="our-team" style="padding: 10px;">
                                    <div class="form-check">
                                        <input name="roles[]"
                                               {{isset($roles) && $roles != null && in_array('About Us', $roles) ? 'checked' : ''}} type="checkbox"
                                               class="form-check-input" id="about-us" value="About Us">
                                        <label class="form-check-label" for="about-us">About Us</label>
                                    </div>
                                </div>

                                <div class="our-team" style="padding: 10px;">
                                    <div class="form-check">
                                        <input name="roles[]"
                                               {{isset($roles) && $roles != null && in_array('Our Team', $roles) ? 'checked' : ''}} type="checkbox"
                                               class="form-check-input" id="our-team" value="Our Team">
                                        <label class="form-check-label" for="our-team">Our Team</label>
                                    </div>
                                </div>

                                <div class="terms-and-conditions" style="padding: 10px;">
                                    <div class="form-check">
                                        <input name="roles[]"
                                               {{isset($roles) && $roles != null && in_array('Terms & Conditions', $roles) ? 'checked' : ''}} type="checkbox"
                                               class="form-check-input" id="terms-and-conditions"
                                               value="Terms & Conditions">
                                        <label class="form-check-label" for="terms-and-conditions">Terms &
                                            Conditions</label>
                                    </div>
                                </div>

                                <div class="travel-insurance" style="padding: 10px;">
                                    <div class="form-check">
                                        <input name="roles[]"
                                               {{isset($roles) && $roles != null && in_array('Travel Insurance', $roles) ? 'checked' : ''}} type="checkbox"
                                               class="form-check-input" id="travel-insurance" value="Travel Insurance">
                                        <label class="form-check-label" for="travel-insurance">Travel Insurance</label>
                                    </div>
                                </div>

                                <div class="feedbacks" style="padding: 10px;">
                                    <div class="form-check">
                                        <input name="roles[]"
                                               {{isset($roles) && $roles != null && in_array('Feedbacks', $roles) ? 'checked' : ''}} type="checkbox"
                                               class="form-check-input" id="feedbacks" value="Feedbacks">
                                        <label class="form-check-label" for="feedbacks">Feedbacks</label>
                                    </div>
                                </div>

                                <div class="contact-info" style="padding: 10px;">
                                    <div class="form-check">
                                        <input name="roles[]"
                                               {{isset($roles) && $roles != null && in_array('Contact Info', $roles) ? 'checked' : ''}} type="checkbox"
                                               class="form-check-input" id="contact-info" value="Contact Info">
                                        <label class="form-check-label" for="contact-info">Contact Info</label>
                                    </div>
                                </div>

                                <div class="customers" style="padding: 10px;">
                                    <div class="form-check">
                                        <input name="roles[]"
                                               {{isset($roles) && $roles != null && in_array('Customers', $roles) ? 'checked' : ''}} type="checkbox"
                                               class="form-check-input" id="customers" value="Customers">
                                        <label class="form-check-label" for="customers">Customers</label>
                                    </div>
                                </div>

                                <div class="social-media-links" style="padding: 10px;">
                                    <div class="form-check">
                                        <input name="roles[]"
                                               {{isset($roles) && $roles != null && in_array('Social Media Links', $roles) ? 'checked' : ''}} type="checkbox"
                                               class="form-check-input" id="social-media-links"
                                               value="Social Media Links">
                                        <label class="form-check-label" for="social-media-links">Social Media
                                            Links</label>
                                    </div>
                                </div>

                                <div class="newsletter-subscribers" style="padding: 10px;">
                                    <div class="form-check">
                                        <input name="roles[]"
                                               {{isset($roles) && $roles != null && in_array('Newsletter Subscribers', $roles) ? 'checked' : ''}} type="checkbox"
                                               class="form-check-input" id="newsletter-subscribers"
                                               value="Newsletter Subscribers">
                                        <label class="form-check-label" for="newsletter-subscribers">Newsletter
                                            Subscribers</label>
                                    </div>
                                </div>

                                <div class="profile" style="padding: 10px;">
                                    <div class="form-check">
                                        <input name="roles[]"
                                               {{isset($roles) && $roles != null && in_array('Profile', $roles) ? 'checked' : ''}} type="checkbox"
                                               class="form-check-input" id="profile" value="Profile">
                                        <label class="form-check-label" for="profile">Profile</label>
                                    </div>
                                </div>

                                <div class="profile" style="padding: 10px;">
                                    <div class="form-check">
                                        <input name="roles[]"
                                               {{isset($roles) && $roles != null && in_array('Clients Testimony', $roles) ? 'checked' : ''}} type="checkbox"
                                               class="form-check-input" id="clients-testimony" value="Clients Testimony">
                                        <label class="form-check-label" for="clients-testimony">Clients Testimony</label>
                                    </div>
                                </div>

                                <div class="notification-emails" style="padding: 10px;">
                                    <div class="form-check">
                                        <input name="roles[]"
                                               {{isset($roles) && $roles != null && in_array('Notification Emails', $roles) ? 'checked' : ''}} type="checkbox"
                                               class="form-check-input" id="notification-emails" value="Notification Emails">
                                        <label class="form-check-label" for="notification-emails">Notification Emails</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        <a href="{{url('admin/staffs')}}"><button type="button" class="btn btn-danger">Skip</button></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $('#role-form').on('submit', function (e) {
           if($('input[type=checkbox]:checked').length === 0)
           {
               e.preventDefault();
               alertify.alert('You should choose at least one role for the staff. Or you can skip this section.');
           }
        });
    </script>
@stop