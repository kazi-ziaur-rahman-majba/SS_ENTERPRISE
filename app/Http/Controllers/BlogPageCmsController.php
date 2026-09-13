<?php

namespace App\Http\Controllers;

use App\Models\BlogPageCms;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class BlogPageCmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = BlogPageCms::orderBy('id', 'DESC')->first();
        return view('admin.modules.blog.blog_page_cms', compact('data'));
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
            'detail_page_title' => 'required|max:2048',
            'detail_page_banner_image' => 'image|max:400',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        // Process file uploads
        $imageFields = ['banner_image','detail_page_banner_image'];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $file = $request->file($field);
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/blog');
                $file->move($destinationPath, $filename);
                $validatedData[$field] = 'uploads/blog/' . $filename;
            } else {
                $validatedData[$field] = '';
            }
        }

        BlogPageCms::create($validatedData);

        return redirect()->route('blog-page-cms.index')->with('success', 'Blog page cms created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogPageCms $blogPageCms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPageCms $blogPageCms)
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
            'detail_page_title' => 'required|max:2048',
            'detail_page_banner_image' => 'image|max:400',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);
        $blogPageCms = BlogPageCms::findOrFail($id);

        $imageFields = ['banner_image','detail_page_banner_image'];
        $filesystem = new Filesystem();

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $filePath = public_path($blogPageCms->$field);

                if ($filesystem->exists($filePath)) {
                    $filesystem->delete($filePath);
                }

                $file = $request->file($field);
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/blog');
                $file->move($destinationPath, $filename);
                $validatedData[$field] = 'uploads/blog/' . $filename;
            }
        }

        
        // dd($validatedData);
        $blogPageCms->update($validatedData);

        return redirect()->route('blog-page-cms.index')->with('success', 'Blog page cms updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPageCms $blogPageCms)
    {
        //
    }
}
