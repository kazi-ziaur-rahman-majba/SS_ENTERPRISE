@php
    $siteSetting = \App\Models\SiteSetting::latest()->first();
@endphp
<footer id="footer" class="footer bg-overlay">
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <!-- Column 1: Logo & About -->
                <div class="col-md-3 col-sm-6 footer-widget footer-about">
                    <div class="footer-logo mb-3">
                        @if(!empty($siteSetting->logo))
                            <img src="{{ asset($siteSetting->logo) }}" alt="{{ $siteSetting->name }}" style="max-height: 55px; border-radius: 50%; padding: 2px; background: rgba(255,255,255,0.1);">
                        @else
                            <img src="{{ asset('assets/images/sslogo.png') }}" alt="SS Group" style="max-height: 55px;">
                        @endif
                    </div>
                    <p>{!! $siteSetting->about_us ?? 'SS Group is also commonly known as SS Group of Companies is a blending of various corporate houses.' !!}</p>
                    <div class="footer-social">
                        <ul>
                            @if(!empty($siteSetting->facebook_link))<li><a href="{{ $siteSetting->facebook_link }}" target="_blank"><i class="fa fa-facebook"></i></a></li>@endif
                            @if(!empty($siteSetting->linkedin_link))<li><a href="{{ $siteSetting->linkedin_link }}" target="_blank"><i class="fa fa-linkedin"></i></a></li>@endif
                            @if(!empty($siteSetting->instagram_link))<li><a href="{{ $siteSetting->instagram_link }}" target="_blank"><i class="fa fa-instagram"></i></a></li>@endif
                        </ul>
                    </div><!-- Footer social end -->
                </div><!-- Col end -->

                <!-- Column 2: Useful Links -->
                <div class="col-md-3 col-sm-6 footer-widget">
                    <h3 class="widget-title">USEFUL LINKS</h3>
                    <ul class="list-arrow">
                        <li><a href="{{ url('about-us') }}">About Us</a></li>
                        <li><a href="{{ url('business') }}">Our Businesses</a></li>
                        <li><a href="{{ url('certification') }}">Certification</a></li>
                        <li><a href="{{ url('sports-affiliation') }}">Sports Affiliation</a></li>
                        <li><a href="{{ url('contact') }}">Contact Us</a></li>
                    </ul>
                </div><!-- Col end -->

                <!-- Column 3: Registered Address -->
                <div class="col-md-3 col-sm-6 footer-widget">
                    <h3 class="widget-title">REGISTERED ADDRESS</h3>
                    <ul class="contact-list">
                        @if(!empty($siteSetting->phone))
                            <li><span class="icon fa fa-phone"></span><a href="tel:{{ $siteSetting->phone }}">{{ $siteSetting->phone }}</a></li>
                        @endif
                        @if(!empty($siteSetting->email))
                            <li><span class="icon fa fa-envelope"></span><a href="mailto:{{ $siteSetting->email }}">{{ $siteSetting->email }}</a></li>
                        @endif
                        @if(!empty($siteSetting->registered_office_address))
                            <li><span class="icon fa fa-map-marker"></span>{!! $siteSetting->registered_office_address !!}</li>
                        @endif
                    </ul>
                </div><!-- Col end -->

                <!-- Column 4: Corporate Office -->
                <div class="col-md-3 col-sm-6 footer-widget">
                    <h3 class="widget-title">CORPORATE OFFICE</h3>
                    <ul class="contact-list">
                        @if(!empty($siteSetting->corporate_office_address))
                            <li><span class="icon fa fa-map-marker"></span>{!! $siteSetting->corporate_office_address !!}</li>
                        @endif
                    </ul>
                </div><!-- Col end -->

            </div><!-- Row end -->
        </div><!-- Container end -->
    </div><!-- Footer main end -->

    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <div class="copyright-info">
                        <span>Copyright © {{ date('Y') }} SS Group. All Rights Reserved.</span>
                    </div>
                </div>
            </div><!-- Row end -->

            <div id="back-to-top" data-spy="affix" data-offset-top="10" class="back-to-top affix">
                <button class="btn btn-primary" title="Back to Top">
                    <i class="fa fa-angle-double-up"></i>
                </button>
            </div>

        </div><!-- Container end -->
    </div><!-- Copyright end -->

</footer>