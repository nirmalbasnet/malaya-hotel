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
                <h2>Travel Insurance</h2>
                <ul>
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>Travel Insurance</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="inner-page">
        <div class="container">
            <main>
                @if(isset($data) && $data->count() > 0)
                    <div style="padding: 2%;">
                        {!! $data->description !!}
                    </div>
                @endif
            </main>
        </div>
    </section>
@stop