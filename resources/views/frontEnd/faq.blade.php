@extends('layouts.app')
@section('title', 'Faq')
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
                <div class="col-md-8">
                    <h3 class="border-title border-left mar-t0">{{ $pageCms->title }}</h3>

                    <div class="panel-group panel-classic" id="accordionA">
                        @php
                            $faq = json_decode($pageCms->faq, true);
                        @endphp
                        @if (isset($faq))
                            @foreach ($faq as $key => $value)
                                @php
                                    if ($key == 0) {
                                        $accordionButton = '';
                                        $accordionCollapse = 'in';
                                    } else {
                                        $accordionButton = 'collapsed';
                                        $accordionCollapse = '';
                                    }
                                @endphp
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" class="{{ $accordionButton }}"
                                                data-parent="#accordionA, #accordionB" href="#collapse{{ $key }}">
                                                {{ $value['question'] }}</a>
                                        </h4>
                                    </div>
                                    <div id="collapse{{ $key }}"
                                        class="panel-collapse collapse {{ $accordionCollapse }}">
                                        <div class="panel-body">
                                            <p>{!! $value['answer'] !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <!--/ Panel  end-->



                    </div><!-- Accordion end -->

                </div><!-- Col end -->

                <div class="col-md-4">

                    <div class="sidebar sidebar-right">
                        <div class="widget recent-posts">
                            <h3 class="widget-title">Recent Posts</h3>
                            <ul class="unstyled clearfix">
                                @if (isset($blogs) && count($blogs) > 0)
                                    @foreach ($blogs as $key => $value)
                                        <li>
                                            <div class="posts-thumb pull-left">
                                                <a href="{{ url('blog/' . $value->slug) }}"><img
                                                        alt="{!! $value->title !!}" src="{{ asset($value->image) }}"></a>
                                            </div>
                                            <div class="post-info">
                                                <h4 class="entry-title">
                                                    <a href="{{ url('blog/' . $value->slug) }}">{!! Str::words(strip_tags($value->title), 15) !!}</a>
                                                </h4>
                                            </div>
                                            <div class="clearfix"></div>
                                        </li><!-- 1st post end-->
                                    @endforeach
                                @endif

                            </ul>

                        </div><!-- Recent post end -->
                    </div><!-- Sidebar end -->

                </div><!-- Col end -->

            </div><!-- Content row end -->

        </div><!-- Container end -->
    </section><!-- Main container end -->
    </section>
@endsection
