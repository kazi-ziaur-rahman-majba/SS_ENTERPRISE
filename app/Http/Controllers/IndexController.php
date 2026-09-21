<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\AboutPageCms;
use App\Models\AboutQligence;
use App\Models\BlogCategory;
use App\Models\Blog;
use App\Models\BlogPageCms;
use App\Models\Event;
use App\Models\EventPageCms;
use App\Models\FaqPageCms;
use App\Models\GalleryCategory;
use App\Models\Gallery;
use App\Models\GalleryPageCms;
use App\Models\HomePageCms;
use App\Models\ContactPageCms;
use App\Models\MembershipCertificate;
use App\Models\MissionVision;
use App\Models\OurClient;
use App\Models\PrivacyPolicyCms;
use App\Models\ServiceCategory;
use App\Models\Service;
use App\Models\ServicePageCms;
use App\Models\SiteSetting;
use App\Models\Slider;
use App\Models\Team;
use App\Models\TeamPageCms;
use App\Models\TermsConditionsCms;
use App\Models\WhatWeDo;
use App\Models\WorkProcess;
use App\Models\SportsAffiliationCms;
use Cache;
use Log;

class IndexController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        $aboutUs = AboutQligence::latest()->first();
        $blog = Blog::latest()->limit('10')->get();
        $event = Event::latest()->get();
        $whatWeDo = WhatWeDo::latest()->first();
        $gallery = Gallery::latest()->get();
        $galleryCat = GalleryCategory::latest()->get();
        $workProcess = WorkProcess::latest()->get();
        $ourClient = OurClient::latest()->get();
        $homePageCms = HomePageCms::latest()->first();
        $works = $whatWeDo ? (is_array($whatWeDo->works) ? $whatWeDo->works : json_decode($whatWeDo->works ?? '[]', true)) : [];
        
        return Inertia::render(
            'FrontEnd/Home',
            compact(
                'sliders',
                'aboutUs',
                'blog',
                'event',
                'whatWeDo',
                'works',
                'gallery',
                'galleryCat',
                'workProcess',
                'ourClient',
                'homePageCms'
            )
        );
    }

    public function aboutUs()
    {
        $pageCms = AboutPageCms::latest()->first();
        $homePageCms = HomePageCms::latest()->first();
        $teams = Team::latest()->get();

        return Inertia::render('FrontEnd/AboutUs', compact('pageCms', 'homePageCms', 'teams'));
    }

    public function achievement()
    {
        $membershipCertificate = MembershipCertificate::latest()->first();
        return Inertia::render('FrontEnd/Achievement', compact('membershipCertificate'));
    }

    public function contactUs()
    {
        $pageCms = Cache::remember('contact_page_cms_data', 3600, function () {
            return ContactPageCms::first() ?? new ContactPageCms([
                'banner_title' => 'Contact Us',
                'page_title' => 'Contact',
            ]);
        });
        $siteSetting = Cache::remember('site_setting_contact', 3600, function () {
            return SiteSetting::latest()->first();
        });
        return Inertia::render('FrontEnd/Contact', compact('pageCms', 'siteSetting'));
    }

    public function faq()
    {
        $pageCms = FaqPageCms::latest()->first();
        $blogs = Blog::latest()->limit('5')->get();
        return Inertia::render('FrontEnd/Faq', compact('pageCms', 'blogs'));
    }

    public function missionVision()
    {
        $pageCms = MissionVision::latest()->first();
        return Inertia::render('FrontEnd/MissionVision', compact('pageCms'));
    }

    public function services()
    {
        $pageCms = ServicePageCms::latest()->first();
        $serviceCategory = ServiceCategory::select('service_categories.id', 'service_categories.name', 'service_categories.icon', 'service_categories.image', 'service_categories.short_description', 'service_categories.position')
                        ->selectSub(function ($query) {
                            $query->select('slug')
                                ->from('services')
                                ->whereColumn('services.category_id', 'service_categories.id')
                                ->orderBy('id', 'ASC')
                                ->limit(1);
                        }, 'slug')
                        ->orderBy('service_categories.position', 'ASC')
                        ->orderBy('service_categories.id', 'ASC')
                        ->get();

        foreach ($serviceCategory as $cat) {
            if (empty($cat->slug)) {
                $cat->slug = \Illuminate\Support\Str::slug($cat->name);
            }
        }

        return Inertia::render('FrontEnd/Services', compact('pageCms', 'serviceCategory'));
    }

    public function servicesDetails($slug)
    {
        $pageCms = ServicePageCms::latest()->first();
        $service = Service::where('slug', $slug)->first();
        $serviceCategory = ServiceCategory::select('service_categories.id', 'service_categories.name', 'service_categories.icon', 'service_categories.image', 'service_categories.short_description', 'service_categories.position')
                        ->selectSub(function ($query) {
                            $query->select('slug')
                                ->from('services')
                                ->whereColumn('services.category_id', 'service_categories.id')
                                ->orderBy('id', 'ASC')
                                ->limit(1);
                        }, 'slug')
                        ->orderBy('service_categories.position', 'ASC')
                        ->orderBy('service_categories.id', 'ASC')
                        ->get();

        foreach ($serviceCategory as $cat) {
            if (empty($cat->slug)) {
                $cat->slug = \Illuminate\Support\Str::slug($cat->name);
            }
        }

        return Inertia::render('FrontEnd/ServiceDetails', compact('pageCms', 'service', 'serviceCategory', 'slug'));
    }

    public function blog()
    {
        $cacheKey = 'blog_page_data';
        $cacheExpirationTime = 60 * 60; // 1 hour

        $blogData = Cache::remember($cacheKey, $cacheExpirationTime, function () {
            $blogs = Blog::latest()->paginate(10);
            $pageCms = BlogPageCms::latest()->first();
            $blogCategories = BlogCategory::withCount('blogs')->get()->toArray();

            return compact('pageCms', 'blogs', 'blogCategories');
        });

        return Inertia::render('FrontEnd/Blog', $blogData);
    }

    public function blogDetails($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        $pageCms = BlogPageCms::latest()->first();
        $blogs = Blog::whereNotIn('id', [$blog ? $blog->id : 0])
            ->latest()
            ->paginate(5);
        $blogCategories = BlogCategory::withCount('blogs')->get()->toArray();

        return Inertia::render('FrontEnd/BlogDetails', compact('pageCms', 'blog', 'blogs', 'blogCategories'));
    }

    public function team()
    {
        $pageCms = TeamPageCms::latest()->first();
        $teams = Team::latest()->get();
        return Inertia::render('FrontEnd/AboutUs', compact('pageCms', 'teams'));
    }

    public function sportsAffiliation()
    {
        $pageCms = Cache::remember('sports_affiliation_cms_data', 3600, function () {
            return SportsAffiliationCms::latest()->first();
        });
        return Inertia::render('FrontEnd/SportsAffiliation', compact('pageCms'));
    }

    public function searchData(Request $request)
    {
        $searchQuery = $request->input('query');

        if ($searchQuery) {
            $blogs = Blog::select('id', 'title', 'details', 'image', 'slug', 'created_at')
                ->where('title', 'like', '%' . $searchQuery . '%')
                ->orWhere('details', 'like', '%' . $searchQuery . '%')
                ->latest()
                ->get();
            $services = Service::select('id', 'title', 'detail', 'image', 'slug', 'created_at')
                ->where('title', 'like', '%' . $searchQuery . '%')
                ->orWhere('detail', 'like', '%' . $searchQuery . '%')
                ->latest()
                ->get();

            $data = [
                'blog' => $blogs,
                'service' => $services,
            ];
            return Inertia::render('FrontEnd/SearchResult', compact('data'));
        }

        return redirect()->back(); 
    }
}
