<?php

namespace App\Http\Controllers;

use App\Models\GalleryPageCms;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class GalleryPageCmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = GalleryPageCms::orderBy('id', 'DESC')->first();
        return view('admin.modules.gallery.page_cms', compact('data'));
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
            'banner_image' => 'image|max:400',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        // Process file uploads
        $imageFields = ['banner_image'];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $file = $request->file($field);
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/gallery');
                $file->move($destinationPath, $filename);
                $validatedData[$field] = 'uploads/gallery/' . $filename;
            } else {
                $validatedData[$field] = '';
            }
        }

        GalleryPageCms::create($validatedData);

        return redirect()->route('gallery-page-cms.index')->with('success', 'Gallery page cms created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(GalleryPageCms $galleryPageCms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GalleryPageCms $galleryPageCms)
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
            'banner_image' => 'image|max:400',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        $gallery = GalleryPageCms::findOrFail($id);

        $imageFields = ['banner_image'];
        $filesystem = new Filesystem();

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $filePath = public_path($gallery->$field);

                if ($filesystem->exists($filePath)) {
                    $filesystem->delete($filePath);
                }

                $file = $request->file($field);
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/gallery');
                $file->move($destinationPath, $filename);
                $validatedData[$field] = 'uploads/gallery/' . $filename;
            }
        }

        
        // dd($validatedData);
        $gallery->update($validatedData);

        return redirect()->route('gallery-page-cms.index')->with('success', 'Gallery page cms updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GalleryPageCms $galleryPageCms)
    {
        //
    }
}
