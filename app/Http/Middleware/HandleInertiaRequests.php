<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Models\SiteSetting;
use App\Models\ServiceCategory;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'siteSetting' => function () {
                return \Illuminate\Support\Facades\Cache::remember('site_setting_shared', 3600, function () {
                    return SiteSetting::latest()->first();
                });
            },
            'servicesMenu' => function () {
                return \Illuminate\Support\Facades\Cache::remember('services_menu_shared', 3600, function () {
                    return ServiceCategory::select('service_categories.id', 'service_categories.name', 'service_categories.position')
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
                });
            },
            'flash' => [
                'success' => fn () => $request->session()->get('success'),
                'error' => fn () => $request->session()->get('error'),
            ],
        ]);
    }
}
