@extends('layouts.app')
@section('title', $service->category_name)
@section('meta')
    <meta name="description" content="{!! $pageCms->meta_description !!}" />
    <meta property="og:title" content="{{ $pageCms->meta }} " />
    <meta property="og:description" content="{!! $pageCms->meta_description !!}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{ $pageCms->meta }} " />
    <meta name="twitter:description" content="{!! $pageCms->meta_description !!}" />
@endsection
@section('content')
    <div id="banner-area" class="banner-area" style="background-image:url({{ url($pageCms->detail_page_banner_image) }})">
        <div class="banner-text">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="banner-heading">
                            <h1 class="border-title border-left">{{ $pageCms->detail_page_title }}</h1>
                            <ol class="breadcrumb">
                                <li>Home</li>
                                <li>Our Businesses</li>
                                <li><a href="#">{{ $service->category_name }}</a></li>
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

                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="sidebar sidebar-left">
                        <div class="widget">
                            <ul class="nav nav-tabs nav-stacked service-menu">
                                @if (isset($serviceCategory) && count($serviceCategory) > 0)
                                    @foreach ($serviceCategory as $key => $value)
                                        <li class="@if ($value->slug == $slug) active @endif"><a
                                                href="{{ url('service/' . $value->slug) }}">{{ $value->name }}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div><!-- Widget end -->

                    </div><!-- Sidebar end -->
                </div><!-- Sidebar Col end -->

                <div class="col-lg-9 col-md-9 col-sm-12">
                    <div class="content-inner-page">
                        {{--  @php
                        $image = json_decode($service->image, true);
                        @endphp
                        @if (isset($image))
                            <div id="page-slider" class="owl-carousel owl-theme page-slider page-slider-small">
                                @foreach ($image as $key => $value)
                                <div class="item">
                                    <img src="{{ asset($value['image']) }}" alt="{{ $value['title'] }}" />
                                    <div class="page-slider-caption">
                                        <h3>{{ $value['title'] }}</h3>
                                    </div>
                                </div>
                                @endforeach
                                
                            </div><!-- Page slider end -->
                        @endif
                        <div class="gap-30"></div>  --}}

                        <h2 class="border-title border-left">{{ $service->title }}</h2>

                        <div class="row">
                            <div class="col-md-12">
                                <p>
                                    {!! $service->detail !!}
                                </p>
                            </div><!-- col end -->
                        </div><!-- 1st row end-->

                    </div><!-- Content inner end -->
                </div><!-- Content Col end -->


            </div><!-- Main row end -->
        </div><!-- Conatiner end -->
    </section><!-- Main container end -->
@endsection
