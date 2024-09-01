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
                <div class="row" style="justify-content: center;">
                    <div class="newsletter-image">
                        <img src="{{asset('public/frontend/images/nl.png')}}" alt="">
                    </div>
                    <h2 class="text-center">Thank you for subscribing our news letter. Your subscription has been
                        verified and active now.</h2>
                </div>
            </main>
        </div>
    </section>
@stop

@section('scripts')
    <script>
    </script>
@stop