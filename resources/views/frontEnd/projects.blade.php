@extends('layouts.app')
@section('title', 'Our Projects')
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
                                <li>Our Businesses</li>
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

                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="sidebar sidebar-left">
                        <div class="widget">
                            <ul class="nav nav-tabs nav-stacked service-menu">
                                @if (isset($galleryCategory) && count($galleryCategory) > 0)
                                    @foreach ($galleryCategory as $key => $value)
                                        <li class=" active"><a href="#">{{ $value->name }}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div><!-- Widget end -->

                    </div><!-- Sidebar end -->
                </div><!-- Sidebar Col end -->
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <div class="content-inner-page">
                        <div class="row">

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <!-- Slider 1 -->
                                <div id="carouselExample1" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="item active">
                                            <img src="https://stuckincustoms.smugmug.com/Portfolio/i-JSxf5Nm/0/X3/Burning-Man-Day-6%20%28202%20of%201606%29-X3.jpg" class="img-responsive"
                                                alt="Slide 1">
                                        </div>
                                        <div class="item">
                                            <img src="https://fastly.picsum.photos/id/109/900/400.jpg?hmac=4DFiUpkpoIZcQhiHhLpjeFZ31b1oe2l4MrIZwdEdQgU" class="img-responsive"
                                                alt="Slide 2">
                                        </div>
                                        <div class="item">
                                            <img src="https://via.placeholder.com/800x400" class="img-responsive"
                                                alt="Slide 3">
                                        </div>
                                    </div>
                                    <a class="left carousel-control" href="#carouselExample1" role="button"
                                        data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#carouselExample1" role="button"
                                        data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <!-- Slider 2 -->
                                <div id="carouselExample2" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="item active">
                                            <img src="https://fastly.picsum.photos/id/109/900/400.jpg?hmac=4DFiUpkpoIZcQhiHhLpjeFZ31b1oe2l4MrIZwdEdQgU" class="img-responsive"
                                                alt="Slide 1">
                                        </div>
                                        <div class="item">
                                            <img src="https://stuckincustoms.smugmug.com/Portfolio/i-JSxf5Nm/0/X3/Burning-Man-Day-6%20%28202%20of%201606%29-X3.jpg" class="img-responsive"
                                                alt="Slide 2">
                                        </div>
                                        <div class="item">
                                            <img src="https://via.placeholder.com/800x400" class="img-responsive"
                                                alt="Slide 3">
                                        </div>
                                    </div>
                                    <a class="left carousel-control" href="#carouselExample2" role="button"
                                        data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#carouselExample2" role="button"
                                        data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>



                        </div><!-- 1st row end-->
                    </div><!-- Content inner end -->
                </div><!-- Content Col end -->



            </div><!-- Main row end -->
        </div><!-- Conatiner end -->
    </section><!-- Main container end -->
@endsection

@section('css')
<style>
    /* Ensure all sliders have a fixed box size */
    .carousel {
            max-width: 100%;
            height: 300px; /* Fixed height for all devices */
            overflow: hidden; /* Hide overflow for large images */
        }

        /* Ensure all images are responsive and cover the box */
        .carousel-inner > .item > img {
            width: 100%; /* Make image responsive */
            height: 100%; /* Stretch image to fit the height */
            object-fit: cover; /* Crop the image to cover the container while maintaining aspect ratio */
            object-position: center; /* Center the image if cropping occurs */
        }
</style>
@endsection

@section('js')

@endsection
