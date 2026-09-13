@extends('layouts.app')
@section('title', 'Mission Vision')
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

    <section id="main-container" class="main-container" style="background: #f2f2f2;">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                     
                        <div class="">
                            <h3 class="border-title border-center text-center">{{ $pageCms->mission_title }}</h3>
                            <p>{!! $pageCms->mission_details !!}.</p>
                        </div>
                        <div class="">
                            <h3 class="border-title border-center text-center">{{ $pageCms->vision_title }}</h3>
                            <p>{!! $pageCms->vision_details !!}</p>
                        </div>
                        <div class="">
                            <h3 class="border-title border-center text-center">{{ $pageCms->core_values_title }}</h3>
                            <p>{!! $pageCms->core_values_details !!}
                            </p>
                        </div>
                    </div><!-- Col end -->
                </div><!-- Content row end -->

            </div><!-- Container end -->
        </div><!-- Container end -->
    </section><!-- Main container end -->
@endsection
