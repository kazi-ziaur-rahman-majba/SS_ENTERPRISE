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
            'banner_title' => 'nullable|string|max:255',
            'page_title' => 'nullable|string|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'mission_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'vision_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'core_values_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'objective_title' => 'nullable|string|max:255',
            'objective_details' => 'nullable|string',
            'mission_title' => 'nullable|string',
            'mission_details' => 'nullable|string',
            'vision_title' => 'nullable|string',
            'vision_details' => 'nullable|string',
            'core_values_title' => 'nullable|string',
            'core_values_details' => 'nullable|string',
            'core_values_items' => 'nullable|array',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        // Process file uploads
        $imageFields = ['banner_image', 'mission_image', 'vision_image', 'core_values_image'];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $file = $request->file($field);
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/about');
                $file->move($destinationPath, $filename);
                $validatedData[$field] = 'uploads/about/' . $filename;
            } else {
                $validatedData[$field] = null;
            }
        }

        $stringFields = [
            'banner_title', 'page_title', 'objective_title', 'objective_details',
            'mission_title', 'mission_details', 'vision_title', 'vision_details',
            'core_values_title', 'core_values_details', 'meta', 'meta_description'
        ];
        foreach ($stringFields as $sField) {
            if (!isset($validatedData[$sField]) || is_null($validatedData[$sField])) {
                $validatedData[$sField] = '';
            }
        }

        if (isset($validatedData['core_values_items'])) {
            $validatedData['core_values_items'] = array_values(array_filter($validatedData['core_values_items'], function ($item) {
                return !empty($item['title']);
            }));
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
     * Show the form for creating a new resource.
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
            'banner_title' => 'nullable|string|max:255',
            'page_title' => 'nullable|string|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'mission_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'vision_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'core_values_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'objective_title' => 'nullable|string',
            'objective_details' => 'nullable|string',
            'mission_title' => 'nullable|string',
            'mission_details' => 'nullable|string',
            'vision_title' => 'nullable|string',
            'vision_details' => 'nullable|string',
            'core_values_title' => 'nullable|string',
            'core_values_details' => 'nullable|string',
            'core_values_items' => 'nullable|array',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);
        $missionVision = MissionVision::findOrFail($id);

        $imageFields = ['banner_image', 'mission_image', 'vision_image', 'core_values_image'];
        $filesystem = new Filesystem();

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                if ($missionVision->$field) {
                    $filePath = public_path($missionVision->$field);
                    if ($filesystem->exists($filePath)) {
                        $filesystem->delete($filePath);
                    }
                }

                $file = $request->file($field);
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/about');
                $file->move($destinationPath, $filename);
                $validatedData[$field] = 'uploads/about/' . $filename;
            }
        }

        $stringFields = [
            'banner_title', 'page_title', 'objective_title', 'objective_details',
            'mission_title', 'mission_details', 'vision_title', 'vision_details',
            'core_values_title', 'core_values_details', 'meta', 'meta_description'
        ];
        foreach ($stringFields as $sField) {
            if (!isset($validatedData[$sField]) || is_null($validatedData[$sField])) {
                $validatedData[$sField] = '';
            }
        }

        if (isset($validatedData['core_values_items'])) {
            $validatedData['core_values_items'] = array_values(array_filter($validatedData['core_values_items'], function ($item) {
                return !empty($item['title']);
            }));
        }

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
