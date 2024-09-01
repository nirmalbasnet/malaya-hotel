@extends('frontend.layout.master')

@section('styles')
    <style>
    </style>
@stop

@section('body')
    <!-- breadcrumb start -->
    <section class="breadcrumb" style="background:url({{asset('public/frontend/images/bg/traveller.jpg')}})">
        <div class="container">
            <div class="breadcrumb-item">
                <h2>About Us</h2>
                <ul>
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>About Us</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="inner-page">
        <div class="container">
            <main>
                @if(isset($aboutUs) && $aboutUs->count() > 0)
                    <div style="padding: 2%;">
                        <h2 style="margin-bottom: 10px;" class="text-center">Who We Are ? And What We Do ?</h2>
                        {!! $aboutUs->description !!}
                    </div>
                @endif
            </main>
        </div>
    </section>
@stop