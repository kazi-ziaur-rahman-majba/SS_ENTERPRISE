@extends('layouts.app')
@section('title', 'About Us')
@section('meta')
    <meta name="description" content="{!! $pageCms->meta_description !!}" />
    <meta property="og:title" content="{{ $pageCms->meta }} " />
    <meta property="og:description" content="{!! $pageCms->meta_description !!}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{ $pageCms->meta }} " />
    <meta name="twitter:description" content="{!! $pageCms->meta_description !!}" />
@endsection
@section('content')
    <div id="banner-area" class="banner-area" style="background-image:url({{ url($pageCms->banner_image) }})">
        <div class="banner-text">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="banner-heading">
                            <h1 class="border-title border-left">{{ $pageCms->banner_title }}</h1>
                            <ol class="breadcrumb">
                                <li>Home</li>
                                <li><a href="#">{{ $pageCms->page_title }}</a></li>
                            </ol>
                        </div>
                    </div><!-- Col end -->
                </div><!-- Row end -->
            </div><!-- Container end -->
        </div><!-- Banner text end -->
    </div><!-- Banner area end -->


    <section id="main-container" class="main-container">
        <div class="container">

            <div class="row">
                <div class="col-md-6">
                    <h3 class="border-title border-left">{{ $pageCms->about_title }}</h3>
                    <p>{!! $pageCms->about_details !!}</p>

                </div><!-- Col end -->
                @php
                    $image = json_decode($pageCms->about_image, true);
                @endphp
                @if (isset($image))


                    <div class="col-md-6">

                        <div id="page-slider" class="owl-carousel owl-theme page-slider small-bg">

                            @foreach ($image as $key => $value)
                                <div class="item"
                                    style="background-image:url({{ asset($value['image']) }})">
                                    <div class="container">
                                        <div class="box-slider-content">
                                            <div class="box-slider-text">
                                                <h2 class="box-slide-title">{{ $value['title'] }}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- Item 1 end -->
                            @endforeach



                        </div><!-- Page slider end-->


                    </div><!-- Col end -->
                @endif
            </div><!-- Content row end -->

        </div><!-- Container end -->
    </section><!-- Main container end -->
@if (isset($teams))
    

    {{--  <section id="ts-team" class="ts-team">
        <div class="container">
            <div class="row text-center">
                <h2 class="border-title">Our Team</h2>
            </div>

            <div class="row">

                <div id="team-slide" class="owl-carousel owl-theme team-slide">
                    @foreach ($teams as $key => $team)
                      <div class="item">
                        <div class="ts-team-wrapper">
                            <div class="team-img-wrapper">
                                <img alt="" src="{{ asset($team->image) }}"
                                    class="img-responsive">
                            </div>
                            <div class="ts-team-content-classic">
                                <h3 class="ts-name">{{ $team->name }}</h3>
                                <p class="ts-designation">{{ $team->destination }}</p>
                                <div class="team-social-icons">
                                    <a target="_blank" href="{{ $team->facebook_link }}"><i class="fa fa-facebook"></i></a>
                                    <a target="_blank" href="{{ $team->twitter_link }}"><i class="fa fa-twitter"></i></a>
                                    <a target="_blank" href="{{ $team->instagram_link }}"><i class="fa fa-instagram"></i></a>
                                    <a target="_blank" href="{{ $team->linkedin_link }}"><i class="fa fa-linkedin"></i></a>
                                </div>
                                <!--/ social-icons-->
                            </div>
                        </div>
                        <!--/ Team wrapper end -->
                    </div><!-- Team 1 end -->  
                    @endforeach
                    

                    

                </div>
            </div>
        </div>
    </section>  --}}
    <!--/ Team end -->
    @endif
@endsection
