<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Service::orderBy('id', 'DESC')->get();
        return view('admin.modules.service.service_list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = ServiceCategory::orderBy('id', 'DESC')->get();
        return view('admin.modules.service.service', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'category_id' => 'required|string|max:255',
            'category_name' => 'nullable|string',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string',
            'detail' => 'required|string',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        $cateName = ServiceCategory::findOrFail($request->category_id);

        $validatedData['category_name'] = $cateName->name;
        $validatedData['slug'] = Str::slug($request->title);

        $images = [];

        foreach ($request->about_image_title as $key => $title) {
            if (isset($request->about_image_files[$key]) && $request->file('about_image_files.' . $key)->isValid()) {
                $file = $request->file('about_image_files.' . $key);
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/service');
                $file->move($destinationPath, $filename);
                $filePath = 'uploads/service/' . $filename;
            } else {
                $filePath = '';
            }

            $images[] = [
                'title' => $title,
                'image' => $filePath
            ];
        }

        $validatedData['image'] = json_encode($images);

        Service::create($validatedData);

        return redirect()->route('service.index')->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $data = Service::findOrFail($id);
        $category = ServiceCategory::orderBy('id', 'DESC')->get();
        return view('admin.modules.service.service', compact('category', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|string|max:255',
            'category_name' => 'nullable|string',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string',
            'detail' => 'required|string',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        $cateName = ServiceCategory::findOrFail($request->category_id);

        $validatedData['category_name'] = $cateName->name;
        $validatedData['slug'] = Str::slug($request->title);

        $service = Service::findOrFail($id);
        $filesystem = new Filesystem();

        $about_image = [];

        foreach ($request->about_image_title as $key => $title) {
            if (isset($request->about_image_files[$key]) && $request->file('about_image_files.' . $key)->isValid()) {
                $file = $request->file('about_image_files.' . $key);
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/service');
                $file->move($destinationPath, $filename);
                $filePath = 'uploads/service/' . $filename;

                // Delete the old image if exists
                if (!empty($request->ex_about_image[$key])) {
                    $oldFilePath = public_path($request->ex_about_image[$key]);
                    if ($filesystem->exists($oldFilePath)) {
                        $filesystem->delete($oldFilePath);
                    }
                }
            } else {
                $filePath = $request->ex_about_image[$key] ?? '';
            }

            $about_image[] = [
                'title' => $title,
                'image' => $filePath
            ];
        }

        $validatedData['image'] = json_encode($about_image);
        // dd($validatedData);
        $service->update($validatedData);

        return redirect()->route('service.index')->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $data = Service::findOrFail($id);
        $data->delete();

        return redirect()->route('service.index')->with('success', 'Service deleted successfully.');
    }
}
