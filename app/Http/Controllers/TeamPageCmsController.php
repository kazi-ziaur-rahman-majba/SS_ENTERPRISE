<?php

namespace App\Http\Controllers;

use App\Models\TeamPageCms;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class TeamPageCmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = TeamPageCms::orderBy('id', 'DESC')->first();
        return view('admin.modules.about.team_page_cms', compact('data'));
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
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
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

        TeamPageCms::create($validatedData);

        return redirect()->route('team-page-cms.index')->with('success', 'Team page cms created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TeamPageCms $teamPageCms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeamPageCms $teamPageCms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $validatedData = $request->validate([
            'banner_title' => 'required|string|max:255',
            'page_title' => 'required|max:2048',
            'banner_image' => 'image',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);
        $teamPageCms = TeamPageCms::findOrFail($id);

        $imageFields = ['banner_image'];
        $filesystem = new Filesystem();

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $filePath = public_path($teamPageCms->$field);

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
        $teamPageCms->update($validatedData);

        return redirect()->route('team-page-cms.index')->with('success', 'Team page cms updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TeamPageCms $teamPageCms)
    {
        //
    }
}
