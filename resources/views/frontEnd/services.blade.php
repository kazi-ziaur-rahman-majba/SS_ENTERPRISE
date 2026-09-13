@extends('layouts.app')
@section('title', 'Our Business')
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
                @php
                    $counter = 0;
                @endphp

                @foreach ($serviceCategory as $service)
                    <div class="col-md-4">
                        <div class="ts-service-box">
                            <div class="ts-service-image-wrapper image-angle">
                                <img class="img-responsive" src="{{ asset($service->image) }}" alt="">
                            </div>
                            <div class="ts-service-box-img pull-left">
                                <img src="{{ asset($service->icon) }}" alt="" />
                            </div>
                            <div class="ts-service-info">
                                <h3 class="service-box-title">
                                    <a href="{{ url('service', $service->slug) }}">{{ $service->name }}</a>
                                </h3>
                                <p>{{ $service->short_description }}</p>
                                <p><a class="learn-more" href="{{ url('service', $service->slug) }}"><i
                                            class="fa fa-caret-right"></i> Learn More</a></p>
                            </div>
                        </div><!-- Service end -->
                    </div><!-- Col end -->

                    @php
                        $counter++;
                    @endphp

                    @if ($counter % 3 == 0)
                        <div class="gap-30"></div>
                    @endif
                @endforeach


            </div><!-- Main row end -->

        </div><!-- Conatiner end -->
    </section><!-- Main container end -->
@endsection
