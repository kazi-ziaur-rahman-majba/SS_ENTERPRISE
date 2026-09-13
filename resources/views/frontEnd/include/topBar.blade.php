@php
    $siteSetting = \App\Models\SiteSetting::latest()->first();
@endphp
<div id="top-bar" class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <ul class="top-info">
                    <li><i class="fa fa-phone">&nbsp;</i>
                        <p class="info-text">{{ $siteSetting->phone }}</p>
                    </li>
                    <li><i class="fa fa-envelope-o">&nbsp;</i>
                        <p class="info-text"><a href="tel:{{ $siteSetting->email }}" >{{ $siteSetting->email }}</a></p>
                    </li>
                </ul>
            </div>
            <!--/ Top info end -->

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 top-social text-right">
                <ul class="unstyled">
                    <li>
                        <a title="Facebook" href="{{ $siteSetting->facebook_link }}">
                            <span class="social-icon"><i class="fa fa-facebook"></i></span>
                        </a>
                        <a title="Linkdin" href="{{ $siteSetting->linkedin_link }}">
                            <span class="social-icon"><i class="fa fa-linkedin"></i></span>
                        </a>
                        <a title="Instagram" href="{{ $siteSetting->instagram_link }}">
                            <span class="social-icon"><i class="fa fa-instagram"></i></span>
                        </a>
                    </li>
                </ul>
            </div>
            <!--/ Top social end -->
        </div>
        <!--/ Content row end -->
    </div>
    <!--/ Container end -->
</div>