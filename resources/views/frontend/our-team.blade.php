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
                <h2>Our Team</h2>
                <ul>
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>Our Team</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="inner-page">
        <div class="container">
            <main>
                @if(isset($ourTeam) && $ourTeam->count() > 0)
                    @foreach($ourTeam as $ot)
                        <div class="teamlist">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="teampf">
                                        <img src="{{asset('public/images/teams/big/'.$ot->image)}}" alt="teampf">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="teamcontent">
                                        <div class="contact-title">
                                            <h3>{{$ot->name}}</h3>
                                            <span>{{$ot->designation}}</span>
                                        </div>
                                        <div class="text">
                                            {!! $ot->description !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </main>
        </div>
    </section>
@stop