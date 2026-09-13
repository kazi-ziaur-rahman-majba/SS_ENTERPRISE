<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\GalleryCategory;
use Illuminate\Filesystem\Filesystem;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Gallery::orderBy('id', 'DESC')->get();
        return view('admin.modules.gallery.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $galleryCategory = GalleryCategory::orderBy('id', 'DESC')->get();
        return view('admin.modules.gallery.index', compact('galleryCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|string|max:255',
            'category_name' => 'nullable|string',
            'image' => 'required|image|max:500',
        ]);

        $cateName = GalleryCategory::findOrFail($request->category_id);

        $validatedData['category_name'] = $cateName->name;

        // Process file uploads
        $imageFields = ['image'];

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

        Gallery::create($validatedData);

        return redirect()->route('gallery.index')->with('success', 'Gallery created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $data = Gallery::findOrFail($id);
        $galleryCategory = GalleryCategory::orderBy('id', 'DESC')->get();
        return view('admin.modules.gallery.index', compact('galleryCategory', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|string|max:255',
            'category_name' => 'nullable|string',
            'image' => 'nullable|image|max:500',
        ]);

        $cateName = GalleryCategory::findOrFail($request->category_id);

        $validatedData['category_name'] = $cateName->name;

        $gallery = Gallery::findOrFail($id);

        // Process file uploads
        $imageFields = ['image'];
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

        $gallery->update($validatedData);

        return redirect()->route('gallery.index')->with('success', 'Gallery updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $data = Gallery::findOrFail($id);
        $data->delete();

        return redirect()->route('gallery.index')->with('success', 'Gallery deleted successfully.');
    }
}
