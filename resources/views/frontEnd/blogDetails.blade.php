@extends('layouts.app')
@section('title', $blog->title)
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
                                <li><a href="#">{{ $blog->title }}</a></li>
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

                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

                    <div class="post-content">
                        <div class="post-media post-image image-angle">
                            <img src="{{ url($blog->image) }}" class="img-responsive" alt="{{ $blog->title }}">
                        </div>

                        <div class="post-body">
                            <div class="entry-header">
                                <div class="post-meta">
                                    <span class="post-cat">
                                        <i class="fa fa-folder-open"></i><a href="#"> {{ $blog->category_name }}</a>
                                    </span>
                                    <span class="post-meta-date"><i class="fa fa-calendar"></i>
                                        {{ $blog->created_at->format('F d, Y') }}</span>
                                </div>
                                <h2 class="entry-title">
                                    <a href="#">{{ $blog->title }}</a>
                                </h2>
                            </div><!-- header end -->

                            <div class="entry-content">
                                <p>{!! $blog->details !!}</p>
                            </div>

                            <!-- In your Blade template -->
                            @php
                                $url = url()->current();
                                $text = 'Check out this page!';
                                $title = $blog->title;
                                $summary = Str::words(strip_tags($blog->details), 15);
                                $source = 'SS Group';
                            @endphp

                            <div class="tags-area clearfix">
                                <div class="share-items pull-right">
                                    <ul class="post-social-icons unstyled">
                                        <li class="social-icons-head">Share:</li>
                                        <li>
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($url) }}"
                                                target="_blank">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://twitter.com/intent/tweet?url={{ urlencode($url) }}&text={{ urlencode($text) }}"
                                                target="_blank">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode($url) }}&title={{ urlencode($title) }}&summary={{ urlencode($summary) }}&source={{ urlencode($source) }}"
                                                target="_blank">
                                                <i class="fa fa-linkedin"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>


                        </div><!-- post-body end -->
                    </div><!-- post content end -->

                </div><!-- Content Col end -->


                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                    <div class="sidebar sidebar-right">


                        <div class="widget recent-posts">
                            <h3 class="widget-title">Recent Posts</h3>
                            <ul class="unstyled clearfix">
                                @if (isset($blogs) && count($blogs) > 0)
                                    @foreach ($blogs as $key => $value)
                                        <li>
                                            <div class="posts-thumb pull-left">
                                                <a href="#"><img alt="img" src="{{ url($value->image) }}"></a>
                                            </div>
                                            <div class="post-info">
                                                <h4 class="entry-title">
                                                    <a href="#">{!! Str::words(strip_tags($value->title), 15) !!}</a>
                                                </h4>
                                            </div>
                                            <div class="clearfix"></div>
                                        </li><!-- 1st post end-->
                                    @endforeach
                                @endif
                            </ul>

                        </div><!-- Recent post end -->

                        <div class="widget">
                            <h3 class="widget-title">Categories</h3>
                            <ul class="arrow nav nav-tabs nav-stacked">
                                @foreach ($blogCategories as $category)
                                    <li><a href="#">{{ $category['name'] }} ({{ $category['blogs_count'] }}) </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div><!-- Categories end -->

                    </div><!-- Sidebar end -->
                </div><!-- Sidebar Col end -->

            </div><!-- Main row end -->

        </div><!-- Conatiner end -->
    </section><!-- Main container end -->
@endsection
