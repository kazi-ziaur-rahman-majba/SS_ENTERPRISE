@extends('layouts.app')
@section('title', 'Projects Details')
@section('content')
<div id="banner-area" class="banner-area" style="background-image:url({{ asset('assets/') }}/images/banner/banner2.jpg)">
    <div class="banner-text">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="banner-heading">
                        <h1 class="border-title border-left">Projects Single</h1>
                        <ol class="breadcrumb">
                            <li>Home</li>
                            <li>Projects</li>
                            <li><a href="#">Projects Single 1</a></li>
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
            <div class="col-md-12">
                <div id="page-slider" class="owl-carousel owl-theme page-slider page-slider-small">
                    <div class="item">
                        <img src="{{ asset('assets/') }}/images/projects/project1.jpg" alt="" />
                    </div>

                    <div class="item">
                        <img src="{{ asset('assets/') }}/images/projects/project2.jpg" alt="" />
                    </div>
                </div><!-- Page slider end -->

                <h2 class="project-title">Capital Teltway Building</h2>
            </div><!-- Slider col end -->

        </div><!-- Row end -->

        <div class="gap-20"></div>

        <div class="row">
            <div class="col-sm-3">
                <ul class="project-info unstyled">
                    <li>
                        <div class="project-info-label">Client</div>
                        <div class="project-info-content">Pransbay Powers Authority</div>
                    </li>
                    <li>
                        <div class="project-info-label">Architect</div>
                        <div class="project-info-content">Dlarke Pelli Incorp</div>
                    </li>
                    <li>
                        <div class="project-info-label">Location</div>
                        <div class="project-info-content">McLean, VA</div>
                    </li>
                    <li>
                        <div class="project-info-label">Size</div>
                        <div class="project-info-content">65,000 SF</div>
                    </li>
                    <li>
                        <div class="project-info-label">Year Completed</div>
                        <div class="project-info-content">2014</div>
                    </li>
                    <li>
                        <div class="project-info-label">Categories</div>
                        <div class="project-info-content">Commercial, Interiors</div>
                    </li>
                    <li>
                        <div class="project-link">
                            <a class="btn btn-primary" target="_blank" href="#">View Project</a>
                        </div>
                    </li>
                </ul>

            </div><!-- Content Col end -->

            <div class="col-sm-9">
                <div class="content-inner-page">

                    <p>Duis semper lacus scelerisque, aliquam leo quis, porttitor leo. Etiam lobortis dapibus
                        libero vel porttitor. Nulla tempor elit nec feugiat tempus.Phasellus at quam id elit
                        hendrerit semper feugiat id nunc. Morbi quis justo velit. Duis semper lacus scelerisque,
                        aliquam leo quis, porttitor leo. Fusce lectus ex, pretium efficitur suscipit sed,
                        faucibus vel elit Integer adipiscing erat eget risus sollicitudin pellentesque et non
                        erat. Maecenas nibh dolor, malesuada et bibendum a, sagittis accumsan ipsum.
                        Pellentesque ultrices ultrices sapien, nec tincidunt nunc posuere ut. Lorem ipsum dolor
                        sit amet, consectetur adipiscing elit.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis semper lacus scelerisque,
                        aliquam leo quis, porttitor leo. Fusce lectus ex, pretium efficitur suscipit sed,
                        faucibus vel elit Integer adipiscing erat eget risus sollicitudin pellentesque et non
                        erat. Proin suscipit convallis facilisis. Fusce lectus ex, pretium efficitur suscipit
                        sed, faucibus vel elit. Sed eu vestibulum leo. Phasellus at quam id elit hendrerit
                        semper feugiat id nunc ultrices ultrices sapien.</p>
                    <ul class="list-arrow">
                        <li>Street Level Lorem ipsum dolor sit amet, consectetur adipiscing elit</li>
                        <li>One and Two Apartment ipsum dolor sit amet, consectetur adipiscing elit</li>
                        <li>Street Level Lorem ipsum dolor sit amet, consectetur adipiscing elit</li>
                        <li>A countried and green ipsum dolor sit amet, consectetur adipiscing elit</li>
                        <li>A Five Storied Lorem ipsum dolor sit amet, consectetur adipiscing elit</li>
                    </ul>



                </div><!-- Content inner end -->
            </div><!-- Content Col end -->


        </div><!-- Row end -->
    </div><!-- Conatiner end -->
</section><!-- Main container end -->
@endsection
