<?php

namespace App\Http\Controllers;

use App\Models\GalleryCategory;
use Illuminate\Http\Request;

class GalleryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = GalleryCategory::orderBy('id', 'DESC')->get();
        return view('admin.modules.gallery.category', compact('data'));
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
            'name' => 'required|string|max:255',
        ]);

        GalleryCategory::create($validatedData);

        return redirect()->route('gallery-category.index')->with('success', 'Gallery category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(GalleryCategory $galleryCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $edit = GalleryCategory::findOrFail($id);
        $data = GalleryCategory::orderBy('id', 'DESC')->get();
        return view('admin.modules.gallery.category', compact('edit', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255'
        ]);
        $gallery = GalleryCategory::findOrFail($id);

        $gallery->update($validatedData);

        return redirect()->route('gallery-category.index')->with('success', 'Gallery Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $data = GalleryCategory::findOrFail($id);
        $data->delete();

        return redirect()->route('gallery-category.index')->with('success', 'Gallery Category deleted successfully.');
    }
}
