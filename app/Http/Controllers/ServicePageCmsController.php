<?php

namespace App\Http\Controllers;

use App\Models\ServicePageCms;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class ServicePageCmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ServicePageCms::orderBy('id', 'DESC')->first();
        return view('admin.modules.service.service_page_cms', compact('data'));
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
            'banner_title' => 'required|string|max:255',
            'page_title' => 'required|max:2048',
            'banner_image' => 'required|image|max:400',
            'detail_page_title' => 'required|max:255',
            'detail_page_banner_image' => 'required|image|max:400',
            'how_it_works_title' => 'required|max:255',
            'why_qligence_title' => 'required|max:255',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        // Process file uploads
        $imageFields = ['banner_image','detail_page_banner_image'];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $file = $request->file($field);
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/service');
                $file->move($destinationPath, $filename);
                $validatedData[$field] = 'uploads/service/' . $filename;
            } else {
                $validatedData[$field] = '';
            }
        }

        ServicePageCms::create($validatedData);

        return redirect()->route('service-page-cms.index')->with('success', 'Service page cms created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServicePageCms $servicePageCms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServicePageCms $servicePageCms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'banner_title' => 'required|string|max:255',
            'page_title' => 'required|max:2048',
            'banner_image' => 'nullable|image|max:400',
            'detail_page_title' => 'required|max:255',
            'detail_page_banner_image' => 'nullable|image|max:400',
            'how_it_works_title' => 'required|max:255',
            'why_qligence_title' => 'required|max:255',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        // dd($validatedData);
        $servicePageCms = ServicePageCms::findOrFail($id);

        $imageFields = ['banner_image','detail_page_banner_image'];
        $filesystem = new Filesystem();

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $filePath = public_path($servicePageCms->$field);

                if ($filesystem->exists($filePath)) {
                    $filesystem->delete($filePath);
                }

                $file = $request->file($field);
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/service');
                $file->move($destinationPath, $filename);
                $validatedData[$field] = 'uploads/service/' . $filename;
            }
        }

        
        // dd($validatedData);
        $servicePageCms->update($validatedData);

        return redirect()->route('service-page-cms.index')->with('success', 'Service page cms updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServicePageCms $servicePageCms)
    {
        //
    }
}
