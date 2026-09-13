<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $works = json_decode($whatWeDo->works, true);
        return view(
            "frontEnd.index",
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

        return view("frontEnd.aboutUs", compact('pageCms', 'homePageCms', 'teams'));
    }
    public function achievement()
    {
        $membershipCertificate = MembershipCertificate::latest()->first();
        return view("frontEnd.achievement", compact('membershipCertificate'));
    }
    public function contactUs()
    {
        $pageCms = HomePageCms::latest()->first();
        $siteSetting = SiteSetting::latest()->first();
        return view("frontEnd.contact", compact('pageCms', 'siteSetting'));
    }
    public function faq()
    {
        $pageCms = FaqPageCms::latest()->first();
        $blogs = Blog::latest()->limit('5')->get();
        return view('frontEnd.faq', compact('pageCms','blogs'));
    }
    public function missionVision()
    {
        $pageCms = MissionVision::latest()->first();
        return view('frontEnd.missionVision', compact('pageCms'));
    }
    public function projectsDetails()
    {
        return view("frontEnd.projectsDetails");
    }
    public function projects()
    {
        $pageCms = GalleryPageCms::latest()->first();
        $galleryCategory = GalleryCategory::latest()->get();
        $gallery = Gallery::latest()->get();
        return view("frontEnd.projects", compact('pageCms', 'galleryCategory', 'gallery'));
    }
    public function services()
    {
        $pageCms = ServicePageCms::latest()->first();
        $serviceCategory = ServiceCategory::select('service_categories.*', 'services.slug')
                        ->leftJoin('services', 'services.category_id', '=', 'service_categories.id')
                        ->orderBy('services.id', 'DESC')
                        ->get();
        return view("frontEnd.services", compact('pageCms','serviceCategory'));
    }
    public function servicesDetails($slug)
    {
        $pageCms = ServicePageCms::latest()->first();
        $service = Service::where('slug', $slug)->first();
        $serviceCategory = ServiceCategory::select('service_categories.*', 'services.slug')
                        ->leftJoin('services', 'services.category_id', '=', 'service_categories.id')
                        ->orderBy('service_categories.position', 'ASC')
                        ->get();
        return view("frontEnd.servicesDetails", compact('pageCms', 'service', 'serviceCategory','slug'));
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
        return view("frontEnd.blog",$blogData);
    }
    public function blogDetails($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        $pageCms = BlogPageCms::latest()->first();
        $blogs = Blog::whereNotIn('id', [$blog->id])
            ->latest()
            ->paginate(5);
        $blogCategories = BlogCategory::withCount('blogs')->get()->toArray();
        return view("frontEnd.blogDetails", compact('pageCms', 'blog', 'blogs', 'blogCategories'));
    }
    public function team()
    {
        $pageCms = TeamPageCms::latest()->first();
        $team = Team::latest()->get();
        return view("frontEnd.team", compact('pageCms', 'team'));
    }
    public function sportsAffiliation()
    {
        return view("frontEnd.sportsAffiliation");
    }
    public function searchData(Request $request)
    {
        $searchQuery = $request->input('query');

        if ($searchQuery) {
            $blogs = Blog::select('id', 'title', 'details', 'image', 'slug', 'created_at') // Selecting only id, title, details, image, and slug columns
                ->where('title', 'like', '%' . $searchQuery . '%')
                ->orWhere('details', 'like', '%' . $searchQuery . '%')
                ->latest()
                ->get();
            $services = Service::select('id', 'title', 'detail', 'image', 'slug', 'created_at') // Selecting only id, title, detail, image, and slug columns
                ->where('title', 'like', '%' . $searchQuery . '%')
                ->orWhere('detail', 'like', '%' . $searchQuery . '%')
                ->latest()
                ->get();

            $data = [
                'blog' => $blogs,
                'service' => $services,
            ];
            return view('frontend.search_result', compact('data'));
        }
        return redirect()->back(); 
    }
}
