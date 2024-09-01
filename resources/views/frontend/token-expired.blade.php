@extends('frontend.layout.master')

@section('styles')
    <style>
        div.link-expired-div {
            min-height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-content: center;
            align-items: center;
        }

        div.link-expired-div div.input-span {
            width: 300px;
            margin: 10px;
        }

        div.link-expired-div div.input-span span.error {
            font-weight: 600;
            color: maroon;
        }

        div.link-expired-div button {
            width: 300px;
            height: 40px;
            border: none;
        }
    </style>
@stop

@section('body')
    <!-- breadcrumb start -->
    <section class="breadcrumb" style="background:url({{asset('public/frontend/images/bg/traveller.jpg')}})">
        <div class="container">
            <div class="breadcrumb-item">
                <h2>Token Expired</h2>
                <ul>
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>Token Expired</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="inner-page">
        <div class="container">
            <main>
                <div class="link-expired-div">
                    <h1>Oops ! the activation link expired</h1>
                    <div class="input-span">
                        <input type="text" class="email form-control" placeholder="Enter your email">
                        <span class="error"></span>
                    </div>
                    <a class="resend-activation-link" data-clicked="no">
                        <button>Resend Activation Link</button>
                    </a>
                </div>
            </main>
        </div>
    </section>
@stop

@section('scripts')
    <script>
        $('.resend-activation-link').on('click', function (e) {
            e.preventDefault();
            if ($('input.email').val() === '') {
                $('span.error').html('Please enter your email !');
                return false;
            }
            if ($(this).data('clicked') === 'yes') {
                return false;
            }

            $(this).data('clicked', 'yes');
            $(this).css('opacity', '0.5');
            $(this).css('cursor', 'not-allowed');
            var email = $('input.email').val();
            var element = $(this);
            $.ajax({
                url: baseurl + '/login/resend-activation-link?email=' + email,
                type: 'get',
                success: function (data) {
                    if (data === 'not-found') {
                        $('span.error').html('Email not found !');
                        element.data('clicked', 'no');
                        element.css('opacity', '1');
                        element.css('cursor', 'default');
                    } else {
                        $('h1').html('Activation link resent successfully. <a href="javascript:void(0)" style="color: blue;\n' +
                            'font-size: 20px;\n' +
                            'display: block;\n' +
                            'text-align: center;">Check Your Email</a>');
                    }
                }, error: function (data) {
                    console.log(data);
                }
            });
        });

        $('input.email').on('focus', function () {
            $(this).next('span.error').html('');
        });
    </script>
@stop