@extends('layouts.app')
@section('title', 'Teams')
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
            <h2 class="border-title">Our Team</h2>
        </div>
        <!--/ Title row end -->

        <!-- First row -->
    <div class="row">
        <div class="col-md-3">
        </div><!-- Col end -->
        @foreach($team->take(2) as $member)
            <div class="col-md-3">
                <div class="ts-team-wrapper">
                    <div class="team-img-wrapper">
                        <img alt="{{ $member->name }}" src="{{ asset($member->image) }}" class="img-responsive">
                    </div>
                    <div class="ts-team-content-classic">
                        <h3 class="ts-name">{{ $member->name }}</h3>
                        <p class="ts-designation">{{ $member->destination }}</p>
                        <p class="ts-description">{{ $member->description }}</p>
                        <div class="team-social-icons">
                            @if($member->facebook_link)
                                <a target="_blank" href="{{ $member->facebook_link }}"><i class="fa fa-facebook"></i></a>
                            @endif
                            @if($member->twitter_link)
                                <a target="_blank" href="{{ $member->twitter_link }}"><i class="fa fa-twitter"></i></a>
                            @endif
                            @if($member->instagram_link)
                                <a target="_blank" href="{{ $member->instagram_link }}"><i class="fa fa-instagram"></i></a>
                            @endif
                            @if($member->linkedin_link)
                                <a target="_blank" href="{{ $member->linkedin_link }}"><i class="fa fa-linkedin"></i></a>
                            @endif
                        </div>
                        <!--/ social-icons-->
                    </div>
                </div>
                <!--/ Team wrapper end -->
            </div><!-- Col end -->
        @endforeach
    </div><!-- First row end -->

    <div class="gap-40"></div>

    <!-- Second row -->
    <div class="row">
        @foreach($team->skip(2) as $member)
            <div class="col-md-3">
                <div class="ts-team-wrapper">
                    <div class="team-img-wrapper">
                        <img alt="{{ $member->name }}" src="{{ asset($member->image) }}" class="img-responsive">
                    </div>
                    <div class="ts-team-content-classic">
                        <h3 class="ts-name">{{ $member->name }}</h3>
                        <p class="ts-designation">{{ $member->destination }}</p>
                        <div class="team-social-icons">
                            @if($member->facebook_link)
                                <a target="_blank" href="{{ $member->facebook_link }}"><i class="fa fa-facebook"></i></a>
                            @endif
                            @if($member->twitter_link)
                                <a target="_blank" href="{{ $member->twitter_link }}"><i class="fa fa-twitter"></i></a>
                            @endif
                            @if($member->instagram_link)
                                <a target="_blank" href="{{ $member->instagram_link }}"><i class="fa fa-instagram"></i></a>
                            @endif
                            @if($member->linkedin_link)
                                <a target="_blank" href="{{ $member->linkedin_link }}"><i class="fa fa-linkedin"></i></a>
                            @endif
                        </div>
                        <!--/ social-icons-->
                    </div>
                </div>
                <!--/ Team wrapper end -->
            </div><!-- Col end -->
        @endforeach
    </div><!-- Second row end -->

    </div><!-- Container end -->
</section><!-- Main container end -->
@endsection
