<?php

namespace App\Http\Controllers;

use App\Models\HomePageCms;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class HomePageCmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = homePageCms::orderBy('id', 'DESC')->first();
        return view('admin.modules.home.page_cms', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'slider_bottom_title' => 'nullable|string|max:255',
            'slider_bottom_link_title' => 'nullable|string|max:255',
            'slider_bottom_link' => 'nullable|string|max:500',
            'project_title' => 'nullable|string|max:255',
            'project_button_title' => 'nullable|string|max:255',
            'project_button_link' => 'nullable|string|max:255',
            'why_work_us_title' => 'nullable|string|max:255',
            'client_title' => 'nullable|string|max:255',
            'news_title' => 'nullable|string|max:255',
            'news_sub_title' => 'nullable|string|max:255',
            'news_button_title' => 'nullable|string|max:255',
            'news_button_link' => 'nullable|string|max:255',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'stat_1_number' => 'nullable|string|max:255',
            'stat_1_label' => 'nullable|string|max:255',
            'stat_2_number' => 'nullable|string|max:255',
            'stat_2_label' => 'nullable|string|max:255',
            'stat_3_number' => 'nullable|string|max:255',
            'stat_3_label' => 'nullable|string|max:255',
            'stat_4_number' => 'nullable|string|max:255',
            'stat_4_label' => 'nullable|string|max:255',
        ]);
        
        

        HomePageCms::updateOrCreate(['id' => 1], $validatedData);

        return redirect()->route('home-page-cms.index')->with('success', 'Home page cms created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(HomePageCms $homePageCms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HomePageCms $homePageCms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'slider_bottom_title' => 'nullable|string|max:255',
            'slider_bottom_link_title' => 'nullable|string|max:255',
            'slider_bottom_link' => 'nullable|string|max:500',
            'project_title' => 'nullable|string|max:255',
            'project_button_title' => 'nullable|string|max:255',
            'project_button_link' => 'nullable|string|max:255',
            'why_work_us_title' => 'nullable|string|max:255',
            'client_title' => 'nullable|string|max:255',
            'news_title' => 'nullable|string|max:255',
            'news_sub_title' => 'nullable|string|max:255',
            'news_button_title' => 'nullable|string|max:255',
            'news_button_link' => 'nullable|string|max:255',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'stat_1_number' => 'nullable|string|max:255',
            'stat_1_label' => 'nullable|string|max:255',
            'stat_2_number' => 'nullable|string|max:255',
            'stat_2_label' => 'nullable|string|max:255',
            'stat_3_number' => 'nullable|string|max:255',
            'stat_3_label' => 'nullable|string|max:255',
            'stat_4_number' => 'nullable|string|max:255',
            'stat_4_label' => 'nullable|string|max:255',
        ]);

        HomePageCms::updateOrCreate(['id' => $id], $validatedData);

        return redirect()->route('home-page-cms.index')->with('success', 'Home page cms updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HomePageCms $homePageCms)
    {
        //
    }
}
