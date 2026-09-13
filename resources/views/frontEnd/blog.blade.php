@extends('layouts.app')
@section('title', 'Blog')
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

                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    @if (isset($blogs) && count($blogs) > 0)
                        @foreach ($blogs as $key => $value)
                            <div class="post">
                                <div class="post-media post-image image-angle">
                                    <img src="{{ asset($value->image) }}" class="img-responsive"
                                        alt="{!! $value->title !!}">
                                </div>

                                <div class="post-body">
                                    <div class="entry-header">
                                        <div class="post-meta">
                                            <span class="post-cat">
                                                <i class="fa fa-folder-open"></i><a href="#">
                                                    {{ $value->category_name }}</a>
                                            </span>
                                            <span class="post-meta-date"><i class="fa fa-calendar"></i>
                                                {{ $value->created_at->format('F d, Y') }}</span>

                                        </div>
                                        <h2 class="entry-title">
                                            <a href="{{ url('blog/' . $value->slug) }}">{!! Str::words(strip_tags($value->title), 15) !!}</a>
                                        </h2>
                                    </div><!-- header end -->

                                    <div class="entry-content">
                                        <p>{!! Str::words(strip_tags($value->short_details), 15) !!}</p>
                                    </div>

                                    <div class="post-footer">
                                        <a href="{{ url('blog/' . $value->slug) }}" class="btn btn-primary">Continue
                                            Reading</a>
                                    </div>

                                </div><!-- post-body end -->
                            </div><!-- 1st post end -->
                        @endforeach
                    @endif

                    <div class="paging">

                        <ul class="pagination">
                            @if ($blogs->onFirstPage())
                                <li class="disabled"><span><i class="fa fa-angle-double-left"></i></span></li>
                            @else
                                <li><a href="{{ $blogs->previousPageUrl() }}" rel="prev"><i
                                            class="fa fa-angle-double-left"></i></a>
                                </li>
                            @endif
                            @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                                @if ($page == $blogs->currentPage())
                                    <li><a class="page-number current" href="#">{{ $page }}</a></li>
                                @else
                                    <li><a class="page-number" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach

                            @if ($blogs->hasMorePages())
                                <li><a href="{{ $blogs->nextPageUrl() }}" rel="next"><i
                                            class="fa fa-angle-double-right"></i></a>
                                </li>
                            @else
                                <li class="disabled"><span><i class="fa fa-angle-double-right"></i></span></li>
                            @endif
                        </ul>
                    </div>

                </div><!-- Content Col end -->

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                    <div class="sidebar sidebar-right">


                        {{--  <div class="widget recent-posts">
                            <h3 class="widget-title">Recent Posts</h3>
                            <ul class="unstyled clearfix">
                                <li>
                                    <div class="posts-thumb pull-left">
                                        <a href="#"><img alt="img"
                                                src="{{ asset('assets/') }}/images/news/news6.jpg"></a>
                                    </div>
                                    <div class="post-info">
                                        <h4 class="entry-title">
                                            <a href="#">How Disruptive Digital Technology is Rebooting the Economics
                                                of Manufacturing</a>
                                        </h4>
                                    </div>
                                    <div class="clearfix"></div>
                                </li><!-- 1st post end-->

                                <li>
                                    <div class="posts-thumb pull-left">
                                        <a href="#"><img alt="img"
                                                src="{{ asset('assets/') }}/images/news/news5.jpg"></a>
                                    </div>
                                    <div class="post-info">
                                        <h4 class="entry-title">
                                            <a href="#">When Bringing Manufacturing Operations Back to the U.S. is
                                                the Right Choice</a>
                                        </h4>
                                    </div>
                                    <div class="clearfix"></div>
                                </li><!-- 2nd post end-->

                                <li>
                                    <div class="posts-thumb pull-left">
                                        <a href="#"><img alt="img"
                                                src="{{ asset('assets/') }}/images/news/news4.jpg"></a>
                                    </div>
                                    <div class="post-info">
                                        <h4 class="entry-title">
                                            <a href="#">The New Manufacturing Partnership to Bring Manufacturing Back
                                                to America</a>
                                        </h4>
                                    </div>
                                    <div class="clearfix"></div>
                                </li><!-- 3rd post end-->

                                <li>
                                    <div class="posts-thumb pull-left">
                                        <a href="#"><img alt="img"
                                                src="{{ asset('assets/') }}/images/news/news3.jpg"></a>
                                    </div>
                                    <div class="post-info">
                                        <h4 class="entry-title">
                                            <a href="#">Silicon Bench and Cornike Begin Construction of Large-Scale
                                                Solar Facilities for Trade</a>
                                        </h4>
                                    </div>
                                    <div class="clearfix"></div>
                                </li><!-- 3rd post end-->
                            </ul>

                        </div><!-- Recent post end -->  --}}

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
