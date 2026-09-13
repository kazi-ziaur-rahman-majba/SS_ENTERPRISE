@extends('layouts.app')
@section('title', 'Projects')
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
            <div class="row text-center">
                <div class="col-md-12">
                    <div class="isotope-nav" data-isotope-nav="isotope">
                        <ul>
                            <li><a href="#" class="active" data-filter="*">Show All</a></li>
                            @if (isset($galleryCategory))
                                @foreach ($galleryCategory as $key => $value)
                                    <li><a href="#" data-filter=".{{ $value->name }}">{{ $value->name }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div><!-- Isotope filter end -->
                </div><!-- Filter col end -->
            </div><!-- Filter row end -->

            <div id="isotope" class="isotope">
                @if (isset($gallery))
                @foreach ($gallery as $key => $value)
                    <div class="col-md-4 col-sm-6 col-xs-12 {{ $value->category_name }} isotope-item">
                        <div class="isotope-img-container">
                            <a class="gallery-popup" href="{{ asset($value->image) }}">
                                <img class="img-responsive" src="{{ asset($value->image) }}" alt="">
                                <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                            </a>
                        </div>
                    </div><!-- Isotope item 1 end -->
                @endforeach
            @endif
               

                
            </div><!-- Isotope end -->

        </div><!-- Conatiner end -->
    </section><!-- Main container end -->
@endsection
@section('css')
    <style>
        .isotope-img-container {
            position: relative;
            overflow: hidden;
            /* Ensures that any overflow is hidden */
            height: 250px;
            /* Set the desired fixed height */
        }
    </style>
@endsection
