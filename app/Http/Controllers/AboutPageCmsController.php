<?php

namespace App\Http\Controllers;

use App\Models\AboutPageCms;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class AboutPageCmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = AboutPageCms::orderBy('id', 'DESC')->first();
        return view('admin.modules.about.about_us', compact('data'));
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
            'banner_image' => 'required|image',
            'about_title' => 'required|string|max:255',
            'about_details' => 'required|string',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'about_image_title' => 'required|array',
            'about_image_files' => 'required|array',
            'about_image_files.*' => 'image', // Validate each file as an image
        ]);

        // Process banner image upload
        $imageFields = ['banner_image'];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $file = $request->file($field);
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/about');
                $file->move($destinationPath, $filename);
                $validatedData[$field] = 'uploads/about/' . $filename;
            } else {
                $validatedData[$field] = '';
            }
        }

        $about_image = [];

        foreach ($request->about_image_title as $key => $title) {
            if (isset($request->about_image_files[$key]) && $request->file('about_image_files.' . $key)->isValid()) {
                $file = $request->file('about_image_files.' . $key);
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/about');
                $file->move($destinationPath, $filename);
                $filePath = 'uploads/about/' . $filename;
            } else {
                $filePath = '';
            }

            $about_image[] = [
                'title' => $title,
                'image' => $filePath
            ];
        }

        $validatedData['about_image'] = json_encode($about_image);

        AboutPageCms::create($validatedData);

        return redirect()->route('about-us.index')->with('success', 'About page created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(AboutPageCms $aboutPageCms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'banner_title' => 'required|string|max:255',
            'page_title' => 'required|max:2048',
            'about_title' => 'required|string|max:255',
            'about_details' => 'required|string',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        $aboutPageCms = AboutPageCms::findOrFail($id);

        $imageFields = ['banner_image'];
        $filesystem = new Filesystem();

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $filePath = public_path($aboutPageCms->$field);

                if ($filesystem->exists($filePath)) {
                    $filesystem->delete($filePath);
                }

                $file = $request->file($field);
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/about');
                $file->move($destinationPath, $filename);
                $validatedData[$field] = 'uploads/about/' . $filename;
            }
        }

        $about_image = [];

        foreach ($request->about_image_title as $key => $title) {
            if (isset($request->about_image_files[$key]) && $request->file('about_image_files.' . $key)->isValid()) {
                $file = $request->file('about_image_files.' . $key);
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/about');
                $file->move($destinationPath, $filename);
                $filePath = 'uploads/about/' . $filename;

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

        $validatedData['about_image'] = json_encode($about_image);

        $aboutPageCms->update($validatedData);

        return redirect()->route('about-us.index')->with('success', 'About page updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutPageCms $aboutPageCms)
    {
        //
    }
}
