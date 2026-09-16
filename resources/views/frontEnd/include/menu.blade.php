@php
    $siteSetting = \App\Models\SiteSetting::latest()->first();
    $service = \App\Models\ServiceCategory::select('service_categories.*', 'services.slug')
        ->leftJoin('services', 'services.category_id', '=', 'service_categories.id')
        ->orderBy('service_categories.position', 'ASC')
        ->get();
@endphp
<header id="header" class="header">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <div class="logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ url($siteSetting->logo) }}" alt="logo">
                    </a>
                </div><!-- logo end -->
            </div><!-- Navbar header end -->

            <div class="site-nav-inner">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <nav class="collapse navbar-collapse navbar-responsive-collapse pull-right">

                    <ul class="nav navbar-nav">
                        <li class="{{ Request::is('/') ? 'active' : '' }}">
                            <a href="{{ url('/') }}">Home</a>
                        </li>

                        <li class="dropdown {{ Request::is('about-us', 'mission-vision', 'team') ? 'active' : '' }}">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">About Us <i
                                    class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li class="{{ Request::is('about-us') ? 'active' : '' }}"><a
                                        href="{{ url('about-us') }}">About Us</a></li>
                                <li class="{{ Request::is('mission-vision') ? 'active' : '' }}"><a
                                        href="{{ url('mission-vision') }}">Mission & Vision</a></li>
                                {{--  <li class="{{ Request::is('team') ? 'active' : '' }}"><a href="{{ url('team') }}">Our
                                        Team</a></li>  --}}
                            </ul>
                        </li>

                        <li class="dropdown {{ Request::is('service*') ? 'active' : '' }}">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Our Businesses <i
                                    class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                @if (isset($service) && count($service) > 0)
                                    @foreach ($service as $key => $value)
                                        <li class="{{ Request::is('service/' . $value->slug) ? 'active' : '' }}">
                                            <a href="{{ url('service/' . $value->slug) }}">{{ $value->name }}</a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>

                        <li class="{{ Request::is('certification') ? 'active' : '' }}">
                            <a href="{{ url('certification') }}">Certification</a>
                        </li>
                        <li class="{{ Request::is('sports-affiliation') ? 'active' : '' }}">
                            <a href="{{ url('sports-affiliation') }}">Sports Affiliation</a>
                        </li>

                        <li class="{{ Request::is('contact') ? 'active' : '' }}">
                            <a href="{{ url('contact') }}">Contact</a>
                        </li>

                        <li style="display: flex; align-items: center; justify-content: center; padding: 15px 5px;">
                            <span style="border-right: 1px solid #cbd5e1; height: 16px; display: inline-block;"></span>
                        </li>

                        <li class="nav-search">
                            <span id="search"><i class="fa fa-search"></i></span>
                        </li>
                    </ul>

                    <!--/ Nav ul end -->

                </nav>
                <!--/ Collapse end -->

                <!-- Search form start -->
                <div class="search" style="display: none;">
                    <form class="search_form" method="get" action="{{ route('search.data') }}">
                        <input type="text" name="query" class="form-control"
                            placeholder="Type what you want and enter">
                        <span class="search-close">&times;</span>
                    </form>
                </div>
                <!-- Search form end -->


            </div><!-- Site nav inner end -->

        </div><!-- Row end -->
    </div><!-- Container end -->
</header>
