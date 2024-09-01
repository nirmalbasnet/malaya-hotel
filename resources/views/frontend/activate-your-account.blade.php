@extends('frontend.layout.master')

@section('styles')
    <style>
        .my-account-div {
            min-height: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 100px;
        }
    </style>
@stop

@section('body')
    <!-- breadcrumb start -->
    <section class="breadcrumb" style="background:url({{asset('public/frontend/images/bg/traveller.jpg')}})">
        <div class="container">
            <div class="breadcrumb-item">
                <h2>My Account</h2>
                <ul>
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>My Account</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="inner-page">
        <div class="container">
            <main>
                <div class="row">
                    <h2 class="text-center">Thank you for registering with us. Please visit your mail to activate your
                        account.</h2>
                    <p class="text-center">
                        Didn't get mail ?
                        <a href="javascript:void(0)" class="resend-activation-link"
                           data-clicked="no" data-email="{{\App\User::find($id)->email}}" style="color: blueviolet;">
                            Resend activation link
                        </a>
                    </p>
                </div>
            </main>
        </div>
    </section>
@stop

@section('scripts')
    <script>
        $('.resend-activation-link').on('click', function (e) {
            e.preventDefault();
            if ($(this).data('clicked') === 'yes') {
                return false;
            }

            $(this).data('clicked', 'yes');
            $(this).css('opacity', '0.5');
            $(this).css('cursor', 'not-allowed');
            var email = $(this).data('email');
            var element = $(this);
            $.ajax({
                url: baseurl + '/login/resend-activation-link?email=' + email,
                type: 'get',
                success: function (data) {
                    element.text('Activation link resent successfully.');
                }, error: function (data) {
                    console.log(data);
                }
            });
        });
    </script>
@stop