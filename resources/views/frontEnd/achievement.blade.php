@extends('layouts.app')
@section('title', 'Achievements')
@section('content')
<div id="banner-area" class="banner-area" style="background-image:url({{ url($membershipCertificate->banner_image) }})">
    <div class="banner-text">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="banner-heading">
                        <h1 class="border-title border-left">{{ $membershipCertificate->banner_title }}</h1>
                        <ol class="breadcrumb">
                            <li>Home</li>
                            <li><a href="#">{{ $membershipCertificate->page_title }}</a></li>
                        </ol>
                    </div>
                </div><!-- Col end -->
            </div><!-- Row end -->
        </div><!-- Container end -->
    </div><!-- Banner text end -->
</div><!-- Banner area end -->

    <section class="network-section">
        <div class="network-bg" style="background-image: url('{{ asset('assets/') }}/images/background/ntwork-bg.jpg');">
            <div class="container">
                <div class="row justify-content-center">
                    <h2 class="border-title border-center text-center" style="color:#fff;"> {{ $membershipCertificate->member_title }}
                    </h2>
                    @php
                        $member = json_decode($membershipCertificate->member_image, true);
                    @endphp
                    @if (isset($member))
                        @foreach ($member as $key => $item)
                    <div class="col-md-4 mb-4 mb-md-5">
                        <div class="achievements-bg" style="min-height:20px; height:120px;">
                            <div class="achievements-logo"><img class="achievements-img"
                                    src="{{ url($item) }}">
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
    <section class="network-section">
        <div class="network-bg" style="background-image: url('{{ asset('assets/') }}/images/background/10.jpg');">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 text-center">
                        <h2 class="border-title border-center"> {{ $membershipCertificate->certificates_title }}</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-3">
                        @php
                        $certifications = json_decode($membershipCertificate->certificates_image, true);
                    @endphp

                    @if (is_array($certifications))
                        @foreach ($certifications as $key => $item)
                        <div class="col-md-4 mb-md-6">
                            <div class="certification-bg">
                                <div class="certification-logo"><img class="certification-img"
                                        src="{{ url($item['image']) }}">
                                </div>
                            </div>
                            <h5 class="text-center p-1">{{ $item['title'] }}</h5>
                        </div>
                        @endforeach
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection
@section('css')
    <style>
        .network-bg {
            padding: 40px 40px;
        }
        
        .certification-bg {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px #00224c;
            padding: 5px;
            min-height: 225px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .certification-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
        }
        
        .certification-img {
            max-width: 80%;
            max-height: 80%;
        }
        .achievements-bg {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa; /* Example background color */
            height: 120px; /* Fixed height */
        }
    
        .achievements-logo {
            width: 100%; /* Full width of the parent */
            height: 100%; /* Full height of the parent */
            overflow: hidden; /* Hide any overflow */
            display: flex;
            align-items: center;
            justify-content: center;
        }
    
        .achievements-img {
            max-width: 100%; /* Scale down to fit the width */
            max-height: 100%; /* Scale down to fit the height */
            object-fit: contain; /* Maintain aspect ratio and contain within parent */
        }
        .network-section {
            position: relative;
            padding-top: 0;
            padding-bottom: 0;
        }
        
    </style>
@endsection
