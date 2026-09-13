@extends('layouts.app')
@section('title', 'Home')
@section('meta')
    <meta name="description" content="{!! $homePageCms->meta_description !!}" />
    <meta property="og:title" content="{{ $homePageCms->meta }} " />
    <meta property="og:description" content="{!! $homePageCms->meta_description !!}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{ $homePageCms->meta }} " />
    <meta name="twitter:description" content="{!! $homePageCms->meta_description !!}" />
@endsection
@section('content')
    <!-- Carousel -->
    <div id="main-slide" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators visible-lg visible-md">
            @foreach ($sliders as $index => $slider)
                <li data-target="#main-slide" data-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}">
                </li>
            @endforeach
        </ol>
        <!--/ Indicators end-->

        <!-- Carousel inner -->
        <div class="carousel-inner">
            @foreach ($sliders as $index => $slider)
                <div class="item {{ $index == 0 ? 'active' : '' }}"
                    style="background-image:url({{ asset($slider->image) }})">
                    <div class="slider-content text-{{ $slider->text_position }}">
                        <div class="col-md-12">
                            <h3 class="slide-title animated3">{{ $slider->title }}</h3>
                            <h3 class="slide-sub-title animated3">{{ $slider->sub_title ?? $slider->subtitle }}</h3>
                            <p class="animated3">
                                <a href="{{ $slider->button_link ?? $slider->link ?? '#' }}"
                                    class="slider btn btn-primary border">{{ $slider->button_text ?? 'Learn More' }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div><!-- Carousel inner end-->

        <!-- Controllers -->
        <a class="left carousel-control" href="#main-slide" data-slide="prev">
            <span><i class="fa fa-angle-left"></i></span>
        </a>
        <a class="right carousel-control" href="#main-slide" data-slide="next">
            <span><i class="fa fa-angle-right"></i></span>
        </a>
    </div>

    <!--/ Carousel end -->

    <section class="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-xs-12">
                    <h3 class="call-to-action-title">{{ $homePageCms->slider_bottom_title }}</h3>
                </div>

                <div class="col-md-2 col-xs-12">
                    <div class="call-to-action-btn-angle">
                        <a href="{{ $homePageCms->slider_bottom_link }}"><i
                                class="fa fa-paper-plane"></i>{{ $homePageCms->slider_bottom_link_title }}</a>
                    </div>
                </div>
            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- Call to action end -->

    <section id="ts-features" class="ts-features">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="intro-feature">
                        <h3>{{ $aboutUs->title }}</h3>
                        <p>{!! $aboutUs->detail !!}</p>
                        <p><a class="intro-link" href="{{ $aboutUs->button_link }}"><i class="fa fa-caret-right"> </i>
                                {{ $aboutUs->button_title }}</a>
                        </p>
                        {{--  <div class="img-box">
                            <div class="img-box-small">{{ $aboutUs->image_title }}</div>
                            <figure><img class="img-responsive" src="{{ asset($aboutUs->first_image) }}" alt="">
                            </figure>
                            <figure><img class="img-responsive" src="{{ asset($aboutUs->second_image) }}" alt="">
                            </figure>
                            <figure><img class="img-responsive" src="{{ asset($aboutUs->third_image) }}" alt="">
                            </figure>
                        </div>  --}}
                    </div><!-- Intro box end -->
                </div><!-- Col end -->

                <div class="col-sm-6">

                    <div class="featured-tab">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a class="animated fadeIn" href="#tab_a" data-toggle="tab">
                                    <span class="tab-head">
                                        <span class="tab-text-title">Trust</span>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a class="animated fadeIn" href="#tab_b" data-toggle="tab">
                                    <span class="tab-head">
                                        <span class="tab-text-title">Expertise</span>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a class="animated fadeIn" href="#tab_c" data-toggle="tab">
                                    <span class="tab-head">
                                        <span class="tab-text-title">Safety</span>
                                    </span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active animated fadeInRight" id="tab_a">
                                <div class="tab-wrapper">
                                    @if ($aboutUs->trust_title_one)
                                        <div class="ts-service-box">
                                            <span class="ts-service-icon"><i class="fa fa-trophy"> </i></span>
                                            <div class="ts-service-box-content">
                                                <h3>{{ $aboutUs->trust_title_one }}</h3>
                                                <p>{!! $aboutUs->trust_detail_one !!}</p>
                                            </div>
                                        </div><!-- Service 1 end -->
                                    @endif
                                    @if ($aboutUs->trust_title_two)
                                        <div class="ts-service-box">
                                            <span class="ts-service-icon"><i class="fa fa-sliders"> </i></span>
                                            <div class="ts-service-box-content">
                                                <h3>{{ $aboutUs->trust_title_two }}</h3>
                                                <p>{!! $aboutUs->trust_detail_two !!}</p>
                                            </div>
                                        </div><!-- Service 2 end -->
                                    @endif
                                    @if ($aboutUs->trust_title_three)
                                        <div class="ts-service-box">
                                            <span class="ts-service-icon"><i class="fa fa-thumbs-up"> </i></span>
                                            <div class="ts-service-box-content">
                                                <h3>{{ $aboutUs->trust_title_three }}</h3>
                                                <p>{!! $aboutUs->trust_detail_three !!}</p>
                                            </div>
                                        </div><!-- Service 3 end -->
                                    @endif
                                </div><!-- Tab wrapper end -->
                            </div><!-- Tab pane 1 end -->

                            <div class="tab-pane animated fadeInRight" id="tab_b">
                                <p>{!! $aboutUs->expertise_detail !!}</p>
                                @if ($aboutUs->expertise_title_one)
                                    <div class="ts-service-box">
                                        <span class="ts-service-icon"><i class="fa fa-users"> </i></span>
                                        <div class="ts-service-box-content">
                                            <h3>{{ $aboutUs->expertise_title_one }}</h3>
                                            <p>{!! $aboutUs->expertise_detail_one !!}</p>
                                        </div>
                                    </div><!-- Service 1 end -->
                                @endif
                                @if ($aboutUs->expertise_title_two)
                                    <div class="ts-service-box">
                                        <span class="ts-service-icon">
                                            <i class="fa fa-hourglass"> </i>
                                        </span>
                                        <div class="ts-service-box-content">
                                            <h3>{{ $aboutUs->expertise_title_two }}</h3>
                                            <p>{!! $aboutUs->expertise_detail_two !!}</p>
                                        </div>
                                    </div><!-- Service 2 end -->
                                @endif
                            </div><!-- Tab pane 2 end -->

                            <div class="tab-pane animated fadeInLeft" id="tab_c">
                                <img class="pull-left" src="{{ asset($aboutUs->safety_image) }}" alt="" />
                                <p>{!! $aboutUs->safety_detail !!}
                                </p>
                            </div><!-- Tab pane 3 end -->
                        </div><!-- tab content -->
                    </div><!-- Featured tab end -->

                </div><!-- Col end -->
            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- Feature are end -->

    <section id="ts-service-area" class="ts-service-area" style="padding: 0">
        <div class="container">
            <div class="row text-center">
                <h2 class="border-title">{{ $whatWeDo->title }}</h2>
                <p class="border-sub-title">
                    {{ $whatWeDo->sub_title }}
                </p>
            </div>
            <!--/ Title row end -->
            @if (isset($works) && count($works) > 0)
                <div class="row">
                    <!-- First Column: First 3 Services -->
                    <div class="col-md-4">
                        @foreach (array_slice($works, 0, 3) as $work)
                            <div class="ts-service-box">
                                <div class="ts-service-box-img pull-left">
                                    <img src="{{ asset($work['icon']) }}" alt="{{ $work['title'] }}" />
                                </div>
                                <div class="ts-service-box-info">
                                    <h3 class="service-box-title"><a href="#">{{ $work['title'] }}</a></h3>
                                    <p>{!! $work['detail'] !!}</p>
                                </div>
                            </div><!-- Service end -->
                        @endforeach
                    </div><!-- Col end -->

                    <!-- Center Column: Image -->
                    <div class="col-md-4 text-center">
                        <img class="service-center-img img-responsive" src="{{ asset($whatWeDo->image) }}"
                            alt="" />
                    </div><!-- Col end -->

                    <!-- Third Column: Remaining Services -->
                    <div class="col-md-4">
                        @foreach (array_slice($works, 3) as $work)
                            <div class="ts-service-box">
                                <div class="ts-service-box-img pull-left">
                                    <img src="{{ asset($work['icon']) }}" alt="{{ $work['title'] }}" />
                                </div>
                                <div class="ts-service-box-info">
                                    <h3 class="service-box-title"><a href="#">{{ $work['title'] }}</a></h3>
                                    <p>{!! $work['detail'] !!}</p>
                                </div>
                            </div><!-- Service end -->
                        @endforeach
                    </div><!-- Col end -->
                </div><!-- Content row end -->
            @endif

        </div>
        <!--/ Container end -->
    </section><!-- Service end -->

    <section id="project-area" class="project-area">
        <div class="container">
            <div class="row">
                <h2 class="title">{{ $homePageCms->project_title }}</h2>
            </div>
            <!--/ Title row end -->

            <div class="row">
                <div class="isotope-nav" data-isotope-nav="isotope">
                    <ul>
                        <li><a href="#" class="active" data-filter="*">Show All</a></li>
                        @if (isset($galleryCat))
                            @foreach ($galleryCat as $key => $value)
                                <li><a href="#" data-filter=".{{ $value->name }}">{{ $value->name }}</a></li>
                            @endforeach
                        @endif

                    </ul>
                </div><!-- Isotope filter end -->
            </div><!-- Filter row end -->
        </div>
        <!--/ Container end -->

        <div id="isotope" class="isotope">
            @if (isset($gallery))
                @foreach ($gallery as $key => $value)
                    <div class="col-md-3 col-sm-6 col-xs-12 {{ $value->category_name }} isotope-item">
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

        <div class="general-btn text-center">
            <a class="btn btn-primary"
                href="{{ $homePageCms->project_button_link }}">{{ $homePageCms->project_button_title }}</a>
        </div>

    </section><!-- Project area end -->

    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="border-title border-left">{{ $homePageCms->why_work_us_title }}</h3>

                    <div class="panel-group" id="accordion">
                        @if (isset($workProcess))
                            @foreach ($workProcess as $key => $value)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" class="{{ $key == 0 ? '' : 'collapsed' }} "
                                                data-parent="#accordion" href="#collapse{{ $key }}">
                                                {{ $value->title }}</a>
                                        </h4>
                                    </div>
                                    <div id="collapse{{ $key }}"
                                        class="panel-collapse collapse {{ $key == 0 ? 'in' : '' }}">
                                        <div class="panel-body">
                                            <img class="pull-left" src="{{ asset($value->image) }}"
                                                alt="{{ $value->title }}" />
                                            <p>{!! $value->detail !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Panel {{ $key + 1 }} end-->
                            @endforeach
                        @endif




                    </div>
                    <!--/ Accordion end -->
                </div><!-- Col end -->
                @if (isset($ourClient))


                    <div class="col-md-6">
                        <h3 class="border-title border-left">{{ $homePageCms->client_title }}</h3>
                        <div class="row all-clients">
                            @foreach ($ourClient as $img)
                                <div class="col-sm-4">
                                    <figure class="clients-logo">
                                        <a href="#">
                                            <img class="img-responsive" src="{{ asset($img->image) }}"
                                                alt="{{ $img->title }}" />
                                            <figcaption>{{ $img->title }}</figcaption>
                                        </a>
                                    </figure>
                                </div><!-- Client end -->
                            @endforeach
                        </div><!-- Clients row end -->
                    </div><!-- Col end -->

                @endif
            </div>
            <!--/ Content row end -->
        </div>
        <!--/ Container end -->
    </section><!-- Content end -->


    <!--/ News end -->

    <section id="news" class="news">
        <div class="container">
            <div class="row text-center">
                <h2 class="border-title">{{ $homePageCms->news_title }}</h2>
                <p class="border-sub-title">
                    {{ $homePageCms->news_sub_title }}
                </p>
            </div>
            <!--/ Title row end -->

            <div class="row">
                @if (isset($blog) && count($blog) > 0)
                    @foreach ($blog as $key => $value)
                        <div class="col-md-4 col-xs-12">
                            <div class="latest-post">
                                <div class="latest-post-media">
                                    <a href="{{ url('blog/' . $value->slug) }}" class="latest-post-img image-angle">
                                        <img class="img-responsive" src="{{ url($value->image) }}"
                                            style="height: 240px;" alt="{!! Str::words(strip_tags($value->title), 7) !!}">
                                    </a>
                                </div>
                                <div class="post-body">
                                    <h4 class="post-title">
                                        <a href="{{ url('blog/' . $value->slug) }}">{!! Str::words(strip_tags($value->title), 10) !!}</a>
                                    </h4>
                                    <div class="latest-post-meta">
                                        <span class="post-item-date">
                                            <i class="fa fa-calendar"></i> {{ $value->created_at->format('F d, Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div><!-- Latest post end -->
                        </div>
                    @endforeach
                @endif



            </div>
            <!--/ Content row end -->

            <div class="general-btn text-center">
                <a class="btn btn-primary"
                    href="{{ $homePageCms->news_button_link }}">{{ $homePageCms->news_button_title }}</a>
            </div>

        </div>
        <!--/ Container end -->
    </section>
    <!--/ News end -->

@endsection
@section('css')
    <style>
        .isotope-img-container {
            position: relative;
            overflow: hidden;
            height: 250px;
        }

        .ts-service-box .ts-service-box-info p {
            text-align: justify !important;
        }
    </style>
@endsection
