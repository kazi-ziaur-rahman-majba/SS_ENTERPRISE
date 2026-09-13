<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Blog::orderBy('id', 'DESC')->get();
        return view('admin.modules.blog.blog_list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $blogCategory = BlogCategory::orderBy('id', 'DESC')->get();
        return view('admin.modules.blog.blog', compact('blogCategory'));
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
            'title' => 'required|max:2048',
            'slug' => 'string',
            'details' => 'string',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        $cateName = BlogCategory::findOrFail($request->category_id);

        $validatedData['category_name'] = $cateName->name;
        $validatedData['slug'] = Str::slug($request->title);

        // Process file uploads
        $imageFields = ['image'];

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

        Blog::create($validatedData);

        return redirect()->route('blog.index')->with('success', 'Blog created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $data = Blog::findOrFail($id);
        $blogCategory = BlogCategory::orderBy('id', 'DESC')->get();
        return view('admin.modules.blog.blog', compact('blogCategory', 'data'));
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
            'title' => 'required|max:2048',
            'slug' => 'string',
            'details' => 'string',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        $cateName = BlogCategory::findOrFail($request->category_id);

        $validatedData['category_name'] = $cateName->name;
        $validatedData['slug'] = Str::slug($request->title);

        $blog = Blog::findOrFail($id);

        // Process file uploads
        $imageFields = ['image'];
        $filesystem = new Filesystem();
        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $filePath = public_path($blog->$field);

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

        $blog->update($validatedData);

        return redirect()->route('blog.index')->with('success', 'Blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $data = Blog::findOrFail($id);
        $data->delete();

        return redirect()->route('blog.index')->with('success', 'Blog deleted successfully.');
    }
}
