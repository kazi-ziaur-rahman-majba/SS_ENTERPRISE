<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AboutPageCmsController;
use App\Http\Controllers\MissionVisionController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamPageCmsController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogPageCmsController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventPageCmsController;
use App\Http\Controllers\ServicePageCmsController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AboutQligenceController;
use App\Http\Controllers\HomePageCmsController;
use App\Http\Controllers\TermsConditionsCmsController;
use App\Http\Controllers\PrivacyPolicyCmsController;
use App\Http\Controllers\FaqPageCmsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OurClientController;
use App\Http\Controllers\WhatWeDoController;
use App\Http\Controllers\WorkProcessController;
use App\Http\Controllers\GalleryCategoryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GalleryPageCmsController;
use App\Http\Controllers\ContactMailController;
use App\Http\Controllers\MembershipCertificateController;
use App\Http\Controllers\SportsAffiliationCmsController;
use App\Http\Controllers\ContactPageCmsController;



Route::get('/clear-everything', function () {
    $clearCache = Artisan::call('cache:clear');
    echo 'Cache cleared<br>';

    $clearView = Artisan::call('view:clear');
    echo 'View cleared<br>';

    $clearConfig = Artisan::call('config:cache');
    echo 'Config cleared<br>';

    $clearConfig = Artisan::call('optimize:clear');
    echo 'Optimize cleared<br>';

    // Redirect after 1 second using JavaScript
    echo '<script>
            setTimeout(function() {
                window.location.href = "/";
            }, 1000); // 1000 milliseconds = 1 second
          </script>';
});


Route::controller(IndexController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/index', 'index');
    Route::get('/about-us', 'aboutUs');
    Route::get('/certification', 'achievement');
    Route::get('/sports-affiliation', 'sportsAffiliation');
    Route::get('/contact', 'contactUs');
    Route::get('/faq', 'faq');
    Route::get('/mission-vision', 'missionVision');
    Route::get('/business', 'services');
    Route::get('/service/{slug}', 'servicesDetails');
    Route::get('/blog', 'blog');
    Route::get('/blog/{slug}', 'blogDetails');
    Route::get('/team', 'team');
});
Route::post('/contact-request', [App\Http\Controllers\ContactMailController::class, 'store'])->name('contact-request.store');
Route::get('/search-data', [IndexController::class, 'searchData'])->name('search.data');

Auth::routes();
Route::get('ss-admin', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('ss-admin', 'App\Http\Controllers\Auth\LoginController@login');

Route::match(['get', 'post'], 'register', function () {
    return view('errors.404');
});
Route::match(['get', 'post'], 'login', function () {
    return view('errors.404');
});

Auth::routes([
    'login' => false,
    'register' => false,
    'verify' => true,
    'reset' => false,
]);



Route::middleware(['isAdmin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('admin_home');
    Route::get('/profile', [App\Http\Controllers\DashboardController::class, 'profile']);
    Route::post('/profile-update', [App\Http\Controllers\DashboardController::class, 'profileUpdate']);

    Route::get('/generate-sitemap', [DashboardController::class,'sitemap'])->name('sitemapGenerate');
    Route::post('/generate-sitemap-data', [DashboardController::class,'store']);

    Route::get('/change-password', [App\Http\Controllers\DashboardController::class, 'changePassword'])->name('changePassword');
    Route::post('/change-save-password/{id}', [App\Http\Controllers\DashboardController::class, 'changeDoPassword'])->name('changeDoPassword');

    Route::resource('site-settings', SiteSettingController::class);
    Route::resource('menu', MenuController::class);
    Route::resource('admin-role', AdminRoleController::class);
    Route::resource('admins', AdminController::class);
    Route::resource('about-us', AboutPageCmsController::class);
    Route::resource('mission-vision', MissionVisionController::class);
    Route::resource('team', TeamController::class);
    Route::resource('team-page-cms', TeamPageCmsController::class);
    Route::resource('blog-category', BlogCategoryController::class);
    Route::resource('blog', BlogController::class);
    Route::resource('blog-page-cms', BlogPageCmsController::class);
    Route::resource('event', EventController::class);
    Route::resource('event-page-cms', EventPageCmsController::class);
    Route::resource('gallery-category', GalleryCategoryController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('gallery-page-cms', GalleryPageCmsController::class);
    Route::resource('service', ServiceController::class);
    Route::resource('service-category', ServiceCategoryController::class);
    Route::post('/service-category/update-order', [ServiceCategoryController::class, 'updateOrder'])->name('service-category.updateOrder');

    Route::resource('service-page-cms', ServicePageCmsController::class);
    Route::resource('slider', SliderController::class);
    Route::resource('home-about-us', AboutQligenceController::class);
    Route::resource('home-page-cms', HomePageCmsController::class);
    Route::resource('terms-conditions', TermsConditionsCmsController::class);
    Route::resource('privacy-policy', PrivacyPolicyCmsController::class);
    Route::resource('faq', FaqPageCmsController::class);
    Route::resource('contact-list', ContactMailController::class);
    Route::resource('our-clients', OurClientController::class);
    Route::resource('what-we-do', WhatWeDoController::class);
    Route::resource('why-work-us', WorkProcessController::class);
    Route::resource('membership-certificate', MembershipCertificateController::class);
    Route::resource('sports-affiliation-cms', SportsAffiliationCmsController::class);
    Route::resource('contact-page-cms', ContactPageCmsController::class);
});

