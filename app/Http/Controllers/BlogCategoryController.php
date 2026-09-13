<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = BlogCategory::orderBy('id', 'DESC')->get();
        return view('admin.modules.blog.category', compact('data'));
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



        BlogCategory::create($validatedData);

        return redirect()->route('blog-category.index')->with('success', 'Blog category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $edit = BlogCategory::findOrFail($id);
        $data = BlogCategory::orderBy('id', 'DESC')->get();
        return view('admin.modules.blog.category', compact('edit', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255'
        ]);
        $blogCategory = BlogCategory::findOrFail($id);

        $blogCategory->update($validatedData);

        return redirect()->route('blog-category.index')->with('success', 'Blog Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $data = BlogCategory::findOrFail($id);
        $data->delete();

        return redirect()->route('blog-category.index')->with('success', 'Blog Category deleted successfully.');
    }
}
