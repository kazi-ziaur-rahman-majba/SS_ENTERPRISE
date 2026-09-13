<?php

namespace App\Http\Controllers;

use App\Models\MissionVision;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class MissionVisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = MissionVision::orderBy('id', 'DESC')->first();
        return view('admin.modules.about.mission_vision', compact('data'));
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
            'objective_title' => 'required|string|max:255',
            'objective_details' => 'required',
            'mission_title' => 'required|string',
            'mission_details' => 'required|string',
            'vision_title' => 'required|string',
            'vision_details' => 'required|string',
            'core_values_title' => 'required|string',
            'core_values_details' => 'required|string',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        // Process file uploads
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

        MissionVision::create($validatedData);

        return redirect()->route('mission-vision.index')->with('success', 'Mission vision created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MissionVision $missionVision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MissionVision $missionVision)
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
            'banner_image' => 'image',
            'objective_title' => 'required|string',
            'objective_details' => 'required',
            'mission_title' => 'required|string',
            'mission_details' => 'required|string',
            'vision_title' => 'required|string',
            'vision_details' => 'required|string',
            'core_values_title' => 'required|string',
            'core_values_details' => 'required|string',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);
        $missionVision = MissionVision::findOrFail($id);

        $imageFields = ['banner_image'];
        $filesystem = new Filesystem();

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $filePath = public_path($missionVision->$field);

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

        
        // dd($validatedData);
        $missionVision->update($validatedData);

        return redirect()->route('mission-vision.index')->with('success', 'Mission vision updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MissionVision $missionVision)
    {
        //
    }
}
