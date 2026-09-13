@php
    $siteSetting = \App\Models\SiteSetting::latest()->first();
@endphp
<footer id="footer" class="footer bg-overlay">


    <div class="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12 footer-widget footer-about">
                    <h3 class="widget-title">About Us</h3>
                    <p>{!! $siteSetting->about_us !!}</p>
                    <div class="footer-social">
                        <ul>
                            <li><a href="{{ $siteSetting->facebook_link }}"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="{{ $siteSetting->instagram_link }}"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="{{ $siteSetting->linkedin_link }}"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div><!-- Footer social end -->
                </div><!-- Col end -->

                <div class="col-md-4 col-sm-12 footer-widget">
                    <h3 class="widget-title">Useful Links</h3>
                    <ul class="list-arrow">
                        <li><a href="{{ url('about-us') }}">About us</a></li>
                        <li><a href="{{ url('faq') }}">Faq</a></li>
                        <li><a href="{{ url('business') }}">Our business</a></li>
                        <li><a href="{{ url('contact') }}">Contact us</a></li>
                    </ul>
                </div><!-- Col end -->

                <div class="col-md-4 col-sm-12 footer-widget">
                    <h3 class="widget-title">Registered Office</h3>
                    <ul class="contact-list">
                        <li><span class="icon fa fa-phone"></span><a href="tel:{{ $siteSetting->phone }}">{{ $siteSetting->phone }}</a></li>
                        <li><span class="icon fa fa-envelope"></span><a
                                href="mailto:{{ $siteSetting->email }}">{{ $siteSetting->email }}</a></li>
                        <li><span class="icon fa fa-map-marker"></span>{!! $siteSetting->corporate_office_address !!}</li>
                    </ul>
                </div><!-- Col end -->
                {{--  <div class="col-md-3 col-sm-12 footer-widget">
                    <h3 class="widget-title">Registered Office</h3>
                    <ul class="contact-list">
                        <li style="line-height: normal;"><span class="icon fa fa-map-marker"></span>{!! $siteSetting->registered_office_address !!}</li>
                    </ul>
                </div>  --}}

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