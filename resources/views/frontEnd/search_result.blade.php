@extends('layouts.app')
@section('title', 'Search')

@section('content')
    <div id="banner-area" class="banner-area" style="background-image:url({{ asset('assets/') }}/images/banner/banner1.jpg)">
        <div class="banner-text">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="banner-heading">
                            <h1 class="border-title border-left">Search</h1>
                            <ol class="breadcrumb">
                                <li>Home</li>
                                <li><a href="#">Search</a></li>
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
                @if ($data['blog']->isEmpty() && $data['service']->isEmpty())
                    <div class="col-lg-12">
                        <div class="alert alert-info" role="alert">
                            No data available at the moment.
                        </div>
                    </div>
                @else
                    @foreach ($data as $typeName => $collection)
                        @php
                            $counter = 0;
                        @endphp
                        @foreach ($collection as $item)
                            @php
                                $details = $item->detail ?? $item->details;
                                $img = $item->image;

                                if ($typeName == 'service') {
                                    $images = json_decode($item->image, true);
                                    $img = !empty($images) ? $images[0]['image'] : 'default_image_path.jpg'; // Fallback to a default image if none is found
                                }
                            @endphp

                            <div class="col-md-4">
                                <div class="ts-service-box">
                                    <div class="ts-service-image-wrapper image-angle">
                                        <img class="img-responsive img-query" src="{{ url($img) }}"
                                            alt="{{ $item->title }}">
                                    </div>
                                    <div class="ts-service-info">
                                        <h3 class="service-box-title"><a href="{{ url($typeName . '/' . $item->slug) }}">
                                                {!! Str::words(strip_tags($item->title), 7) !!}
                                            </a>
                                        </h3>
                                        <p>{!! Str::words(strip_tags($details), 15) !!}</p>
                                        <p><a class="learn-more" href="{{ url($typeName . '/' . $item->slug) }}"><i
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
                    @endforeach
                @endif


            </div><!-- Main row end -->

        </div><!-- Conatiner end -->
    </section><!-- Main container end -->
@endsection
@section('css')
    <style>
        .ts-service-info {
            margin-left: 0;
        }

        .img-query {
            height: 235px;
        }
    </style>
@endsection
