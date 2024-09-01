<!DOCTYPE html>
<html lang="en">

<!--head start-->

<head>
    <!--meta tag start-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--title-->
    <title>Malaya holidays</title>

    @yield('og')

    <!-- faveicon start   -->
    <link rel="icon" type="image/png" href="{{asset('public/frontend/images/favicon.png')}}" sizes="32x32">

    @include('frontend.include.styles')

    <style>
        .ajs-header {
            display: none;
        }

        button.newsletter-subscription-submit:disabled{
            opacity: 0.5;
            cursor: not-allowed !important;
        }
    </style>

    @yield('styles')

</head>
<!--head end-->

<body>

@include('frontend.include.partials.header')

@yield('body')

@include('frontend.include.partials.footer')

@include('frontend.include.scripts')
<script>
    function validateSubscriptionEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test(email)) {
            return false;
        } else {
            return true;
        }
    }

    var baseurl = "{{url('/')}}";
    $('#subscriber-form').on('submit', function (e) {
        e.preventDefault();
        if ($('#subscriber-form input.subscriber-email').val() === '') {
            $('span.subscriptionFormError').html('Enter your subscription email');
        }

        if ($('#subscriber-form input.subscriber-email').val() !== '') {
            var test = validateSubscriptionEmail($('#subscriber-form input.subscriber-email').val());
            if (!test) {
                e.preventDefault();
                $('span.subscriptionFormError').html('Enter valid email');
            } else {
                $('#subscriber-form button').prop('disabled', true);
                $.ajax({
                    url: baseurl + '/submit-subscription-email?email=' + btoa($('#subscriber-form input.subscriber-email').val()),
                    type: 'get',
                    success: function (data) {
                        if (data === 'exists')
                            alertify.alert('This email is already registered for subscription');
                        else
                            alertify.alert('Thank You ! Please visit your mail and verify your subscription');
                        $('#subscriber-form button').prop('disabled', false);
                    }, error: function (data) {
                        alertify.alert('Oops ! something went wrong. Please try again.')
                        $('#subscriber-form button').prop('disabled', false);
                    }
                });
            }
        }
    });

    $('#subscriber-form input.subscriber-email').on('focus', function () {
        $('span.subscriptionFormError').html('');
    });
</script>
@yield('scripts')

</body>

</html>

