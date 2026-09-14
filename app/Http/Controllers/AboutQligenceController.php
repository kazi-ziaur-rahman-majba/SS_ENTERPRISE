<?php

namespace App\Http\Controllers;

use App\Models\AboutQligence;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class AboutQligenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = AboutQligence::orderBy('id', 'DESC')->first();
        return view('admin.modules.home.about_qligence.about_qligence', compact('data'));
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
    // Validate the request data
    $validatedData = $request->validate([
        'title' => 'required|max:255',
        'sub_title' => 'nullable|string|max:255',
        'detail' => 'required|string',
        'button_title' => 'nullable|string|max:255',
        'button_link' => 'nullable|string',
        'check_1' => 'nullable|string|max:255',
        'check_2' => 'nullable|string|max:255',
        'check_3' => 'nullable|string|max:255',
        'check_4' => 'nullable|string|max:255',
        'check_5' => 'nullable|string|max:255',
        'check_6' => 'nullable|string|max:255',
        'experience_years' => 'nullable|string|max:255',
        'experience_label' => 'nullable|string|max:255',
        'trust_title_one' => 'nullable|string|max:255',
        'trust_detail_one' => 'nullable|string',
        'trust_title_two' => 'nullable|string|max:255',
        'trust_detail_two' => 'nullable|string',
        'trust_title_three' => 'nullable|string|max:255',
        'trust_detail_three' => 'nullable|string',
        'expertise_detail' => 'nullable|string',
        'expertise_title_one' => 'nullable|string|max:255',
        'expertise_detail_one' => 'nullable|string',
        'expertise_title_two' => 'nullable|string|max:255',
        'expertise_detail_two' => 'nullable|string',
        'expertise_title_three' => 'nullable|string|max:255',
        'expertise_detail_three' => 'nullable|string',
        'image_title' => 'nullable|string|max:255',
        'safety_detail' => 'nullable|string',
        'safety_title_one' => 'nullable|string|max:255',
        'safety_detail_one' => 'nullable|string',
        'safety_title_two' => 'nullable|string|max:255',
        'safety_detail_two' => 'nullable|string',
        'safety_title_three' => 'nullable|string|max:255',
        'safety_detail_three' => 'nullable|string',
        'first_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,svg,bmp,avif|max:2000',
        'second_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,svg,bmp,avif|max:2000',
        'third_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,svg,bmp,avif|max:2000',
        'safety_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,svg,bmp,avif|max:2000',
    ], [
        'first_image.uploaded' => 'The main image failed to upload because it exceeds the server limit of 2MB. Please select an image smaller than 2MB.',
        'first_image.max' => 'The main image must not exceed 2MB in size.',
        'safety_image.uploaded' => 'The safety image failed to upload because it exceeds the server limit of 2MB. Please select an image smaller than 2MB.',
        'safety_image.max' => 'The safety image must not exceed 2MB in size.',
    ]);

    // Process file uploads
    $imageFields = ['first_image', 'second_image', 'third_image', 'safety_image'];

    foreach ($imageFields as $field) {
        if ($request->hasFile($field) && $request->file($field)->isValid()) {
            $file = $request->file($field);
            $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/home');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $file->move($destinationPath, $filename);
            $validatedData[$field] = 'uploads/home/' . $filename;
        } else {
            unset($validatedData[$field]);
        }
    }

    // Create the record
    AboutQligence::create($validatedData);

    // Redirect with success message
    return redirect()->route('home-about-us.index')->with('success', 'About us created successfully.');
}


    /**
     * Display the specified resource.
     */
    public function show(AboutQligence $aboutQligence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AboutQligence $aboutQligence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'sub_title' => 'nullable|string|max:255',
            'detail' => 'required|string',
            'button_title' => 'nullable|string|max:255',
            'button_link' => 'nullable|string',
            'check_1' => 'nullable|string|max:255',
            'check_2' => 'nullable|string|max:255',
            'check_3' => 'nullable|string|max:255',
            'check_4' => 'nullable|string|max:255',
            'check_5' => 'nullable|string|max:255',
            'check_6' => 'nullable|string|max:255',
            'experience_years' => 'nullable|string|max:255',
            'experience_label' => 'nullable|string|max:255',
            'trust_title_one' => 'nullable|string|max:255',
            'trust_detail_one' => 'nullable|string',
            'trust_title_two' => 'nullable|string|max:255',
            'trust_detail_two' => 'nullable|string',
            'trust_title_three' => 'nullable|string|max:255',
            'trust_detail_three' => 'nullable|string',
            'expertise_detail' => 'nullable|string',
            'expertise_title_one' => 'nullable|string|max:255',
            'expertise_detail_one' => 'nullable|string',
            'expertise_title_two' => 'nullable|string|max:255',
            'expertise_detail_two' => 'nullable|string',
            'expertise_title_three' => 'nullable|string|max:255',
            'expertise_detail_three' => 'nullable|string',
            'image_title' => 'nullable|string|max:255',
            'safety_detail' => 'nullable|string',
            'safety_title_one' => 'nullable|string|max:255',
            'safety_detail_one' => 'nullable|string',
            'safety_title_two' => 'nullable|string|max:255',
            'safety_detail_two' => 'nullable|string',
            'safety_title_three' => 'nullable|string|max:255',
            'safety_detail_three' => 'nullable|string',
            'first_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,svg,bmp,avif|max:2000',
            'second_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,svg,bmp,avif|max:2000',
            'third_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,svg,bmp,avif|max:2000',
            'safety_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,svg,bmp,avif|max:2000',
        ], [
            'first_image.uploaded' => 'The main image failed to upload because it exceeds the server limit of 2MB. Please select an image smaller than 2MB.',
            'first_image.max' => 'The main image must not exceed 2MB in size.',
            'safety_image.uploaded' => 'The safety image failed to upload because it exceeds the server limit of 2MB. Please select an image smaller than 2MB.',
            'safety_image.max' => 'The safety image must not exceed 2MB in size.',
        ]);


        $work = AboutQligence::findOrFail($id);

        // Process file uploads
        $imageFields = ['first_image','second_image','third_image','safety_image'];
        $filesystem = new Filesystem();
        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                if (!empty($work->$field)) {
                    $filePath = public_path($work->$field);
                    if ($filesystem->exists($filePath)) {
                        $filesystem->delete($filePath);
                    }
                }

                $file = $request->file($field);
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/home');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $file->move($destinationPath, $filename);
                $validatedData[$field] = 'uploads/home/' . $filename;
            } else {
                unset($validatedData[$field]);
            }
        }

        $work->update($validatedData);

        return redirect()->route('home-about-us.index')->with('success', 'About us updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutQligence $aboutQligence)
    {
        //
    }
}
