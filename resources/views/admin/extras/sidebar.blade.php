@php
    $userEmail = Auth::user()->email ?? null;
    if ($userEmail) {
        $adminInfo = App\Models\Admin::where('email', $userEmail)->first();
        if ($adminInfo) {
            $adminRole = App\Models\AdminRole::where('id', $adminInfo->role_id)->first();
            if ($adminRole) {
                $permissionsIds = json_decode($adminRole->permissions_id, true);

                $permissions = App\Models\Menu::whereIn('id', $permissionsIds)->pluck('path')->toArray();
                $permissions = array_map(function ($path) {
                    return ltrim($path, '/');
                }, $permissions);
            } else {
                $permissions = [];
            }
        } else {
            $permissions = [];
        }
    } else {
        $permissions = [];
    }
@endphp

{{--  {{ dd(in_array('admin', $permissions)) }}  --}}

<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/images/sslogo.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">SS Group</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        @if (in_array('dashboard', $permissions))
            <li><a href="{{ route('admin_home') }}">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i></div>
                    <div class="menu-title">Dashboard</div>
                </a></li>
        @endif
        @if (in_array('home-about-us', $permissions) ||
                in_array('slider', $permissions) ||
                in_array('what-we-do', $permissions) ||
                in_array('our-clients', $permissions) ||
                in_array('why-work-us', $permissions) ||
                in_array('home-page-cms', $permissions))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="fadeIn animated bx bx-category"></i>
                    </div>
                    <div class="menu-title">Home</div>
                </a>
                <ul>
                    @if (in_array('home-about-us', $permissions))
                        <li><a href="{{ route('home-about-us.index') }}"> <i class="bx bx-right-arrow-alt"></i>About
                                us</a></li>
                    @endif
                    @if (in_array('slider', $permissions))
                        <li><a href="{{ route('slider.index') }}"> <i class="bx bx-right-arrow-alt"></i>Slider</a></li>
                    @endif
                    @if (in_array('what-we-do', $permissions))
                        <li><a href="{{ route('what-we-do.index') }}"> <i class="bx bx-right-arrow-alt"></i>What we
                                do</a>
                        </li>
                    @endif
                    @if (in_array('our-clients', $permissions))
                        <li><a href="{{ route('our-clients.index') }}"> <i class="bx bx-right-arrow-alt"></i>Our
                                clients</a>
                        </li>
                    @endif
                    @if (in_array('why-work-us', $permissions))
                        <li><a href="{{ route('why-work-us.index') }}"> <i class="bx bx-right-arrow-alt"></i>Why work
                                us</a>
                        </li>
                    @endif
                    @if (in_array('home-page-cms', $permissions))
                        <li><a href="{{ route('home-page-cms.index') }}"> <i class="bx bx-right-arrow-alt"></i>Home page
                                cms</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if (in_array('about-us', $permissions) ||
                in_array('mission-vision', $permissions) ||
                in_array('team', $permissions) ||
                in_array('team-page-cms', $permissions))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="fadeIn animated bx bx-info-circle"></i>
                    </div>
                    <div class="menu-title">About Page</div>
                </a>
                <ul>
                    @if (in_array('about-us', $permissions))
                        <li><a href="{{ route('about-us.index') }}"> <i class="bx bx-right-arrow-alt"></i>About Us</a>
                        </li>
                    @endif
                    @if (in_array('mission-vision', $permissions))
                        <li><a href="{{ route('mission-vision.index') }}"> <i class="bx bx-right-arrow-alt"></i>Mission
                                Vision</a></li>
                    @endif
                    @if (in_array('team', $permissions))
                        <li><a href="{{ route('team.index') }}"> <i class="bx bx-right-arrow-alt"></i>Team</a></li>
                    @endif
                    @if (in_array('team-page-cms', $permissions))
                        <li><a href="{{ route('team-page-cms.index') }}"> <i class="bx bx-right-arrow-alt"></i>Team
                                Page CMS</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if (in_array('service', $permissions) ||
                in_array('service-category', $permissions) ||
                in_array('service-page-cms', $permissions))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="fadeIn animated bx bx-receipt"></i>
                    </div>
                    <div class="menu-title">Our Business Page</div>
                </a>
                <ul>
                    @if (in_array('service', $permissions))
                        <li><a href="{{ route('service.index') }}"> <i class="bx bx-right-arrow-alt"></i>Our Business</a>
                        </li>
                    @endif
                    @if (in_array('service-category', $permissions))
                        <li><a href="{{ route('service-category.index') }}"> <i
                                    class="bx bx-right-arrow-alt"></i>Our Business
                                Category</a></li>
                    @endif
                    @if (in_array('service-page-cms', $permissions))
                        <li><a href="{{ route('service-page-cms.index') }}"> <i
                                    class="bx bx-right-arrow-alt"></i>Our Business Page
                                CMS</a>
                    @endif
            </li>
    </ul>
    </li>
    @endif
    @if (in_array('gallery', $permissions) ||
            in_array('gallery-category', $permissions) ||
            in_array('gallery-page-cms', $permissions))
        <li> <a class="has-arrow" href="javascript:;">
            <div class="parent-icon"><i class="bx bx-spreadsheet"></i>
            </div>
            <div class="menu-title">Project Page</div>
        </a>
            <ul>
                @if (in_array('gallery', $permissions))
                    <li><a href="{{ route('gallery.index') }}"> <i class="bx bx-right-arrow-alt"></i>Project</a>
                    </li>
                @endif
                @if (in_array('gallery-category', $permissions))
                    <li><a href="{{ route('gallery-category.index') }}"> <i class="bx bx-right-arrow-alt"></i>Project
                            Category</a>
                    </li>
                @endif
                @if (in_array('gallery-page-cms', $permissions))
                    <li><a href="{{ route('gallery-page-cms.index') }}"> <i class="bx bx-right-arrow-alt"></i>Project
                            Page CMS</a>
                    </li>
                @endif
            </ul>
        </li>
    @endif
    @if (in_array('blog', $permissions) ||
            in_array('blog-category', $permissions) ||
            in_array('blog-page-cms', $permissions) ||
            in_array('event', $permissions) ||
            in_array('event-page-cms', $permissions))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-menu"></i>
                </div>
                <div class="menu-title">Insights Page</div>
            </a>
            <ul>
                <li> <a class="has-arrow" href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Blog</a>
                    <ul>
                        @if (in_array('blog', $permissions))
                            <li><a href="{{ route('blog.index') }}"> <i class="bx bx-right-arrow-alt"></i>Blog</a>
                            </li>
                        @endif
                        @if (in_array('blog-category', $permissions))
                            <li><a href="{{ route('blog-category.index') }}"> <i class="bx bx-right-arrow-alt"></i>Blog
                                    Category</a>
                            </li>
                        @endif
                        @if (in_array('blog-page-cms', $permissions))
                            <li><a href="{{ route('blog-page-cms.index') }}"> <i class="bx bx-right-arrow-alt"></i>Blog
                                    Page CMS</a>
                            </li>
                        @endif
                    </ul>
                </li>

                {{--  <li> <a class="has-arrow" href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Event</a>
                    <ul>
                        @if (in_array('event', $permissions))
                            <li><a href="{{ route('event.index') }}"> <i class="bx bx-right-arrow-alt"></i>Event</a>
                            </li>
                        @endif
                        @if (in_array('event-page-cms', $permissions))
                            <li><a href="{{ route('event-page-cms.index') }}"> <i
                                        class="bx bx-right-arrow-alt"></i>Event
                                    Page CMS</a>
                            </li>
                        @endif
                    </ul>
                </li>  --}}

            </ul>
        </li>
    @endif

    @if (in_array('membership-certificate', $permissions))
        <li><a href="{{ route('membership-certificate.index') }}">
                <div class="parent-icon"><i class="fadeIn animated bx bx-user"></i></div>
                <div class="menu-title">Membership & Certificate</div>
            </a>
        </li>
    @endif
    @if (in_array('contact-list', $permissions) || in_array('admins', $permissions) || in_array('admin-role', $permissions))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fadeIn animated bx bx-user"></i></div>
                <div class="menu-title">User Management</div>
            </a>
            <ul>

                @if (in_array('contact-list', $permissions))
                    <li><a href="{{ route('contact-list.index') }}"><i class="bx bx-right-arrow-alt"></i>Contact
                            List</a></li>
                @endif
                @if (in_array('admins', $permissions))
                    <li><a href="{{ route('admins.index') }}"><i class="bx bx-right-arrow-alt"></i>Admin</a></li>
                @endif
                @if (in_array('admin-role', $permissions))
                    <li><a href="{{ route('admin-role.index') }}"><i class="bx bx-right-arrow-alt"></i>Admin
                            Role</a></li>
                @endif
            </ul>
        </li>
    @endif

    @if (in_array('site-settings', $permissions) ||
            in_array('menu', $permissions) ||
            in_array('terms-conditions', $permissions) ||
            in_array('privacy-policy', $permissions) ||
            in_array('faq', $permissions))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fadeIn animated lni lni-cog"></i>
                </div>
                <div class="menu-title">Configure CMS</div>
            </a>
            <ul>
                @if (in_array('site-settings', $permissions))
                    <li><a href="{{ route('site-settings.index') }}"> <i class="bx bx-right-arrow-alt"></i>Site
                            Settings</a>
                @endif
                @if (in_array('menu', $permissions))
                    <li><a href="{{ route('menu.index') }}"> <i class="bx bx-right-arrow-alt"></i>Menu
                            Settings</a>
                    </li>
                @endif
                @if (in_array('terms-conditions', $permissions))
                    <li><a href="{{ route('terms-conditions.index') }}"> <i class="bx bx-right-arrow-alt"></i>Terms
                            and Conditions</a>
                    </li>
                @endif
                @if (in_array('privacy-policy', $permissions))
                    <li><a href="{{ route('privacy-policy.index') }}"> <i class="bx bx-right-arrow-alt"></i>Privacy
                            Policy</a>
                    </li>
                @endif
                @if (in_array('faq', $permissions))
                    <li><a href="{{ route('faq.index') }}"> <i class="bx bx-right-arrow-alt"></i>Faq</a>
                    </li>
                @endif
            </ul>
        </li>
    @endif


    <li>
        <a href="{{ route('sitemapGenerate') }}">
            <div class="parent-icon"><i class='bx bx-message-square'></i>
            </div>
            <div class="menu-title">Generate & Publish Sitemap</div>
        </a>
    </li>
    <li class="all-clear-cache">
        <a href="{{ url('clear-everything') }}" class="btn btn-info" target="_blank">
            <div class="parent-icon"><i class='fadeIn animated lni lni-bar-chart'></i>
            </div>
            <div class="menu-title">Clear All Cache</div>
        </a>
    </li>
    </ul>
    <!--end navigation-->
</div>
<style>
    .all-clear-cache .menu-title {
        color: #fff;
        transition: color 0.3s ease;
    }

    .all-clear-cache:hover .menu-title {
        color: #000 !important;
    }
</style>
