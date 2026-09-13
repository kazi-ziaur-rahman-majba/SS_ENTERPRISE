<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Team::orderBy('id', 'DESC')->get();
        return view('admin.modules.about.team', compact('data'));
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
            'destination' => 'required|max:2048',
            'image' => 'image|max:200',
            'facebook_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        // Process file uploads
        $imageFields = ['image'];

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

        Team::create($validatedData);

        return redirect()->route('team.index')->with('success', 'Team page cms created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edit = Team::findOrFail($id);
        $data = Team::orderBy('id', 'DESC')->get();
        return view('admin.modules.about.team', compact('edit', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'destination' => 'required|max:2048',
            'image' => 'image|max:200',
            'facebook_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);
        $team = Team::findOrFail($id);

        $imageFields = ['image'];
        $filesystem = new Filesystem();

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $filePath = public_path($team->$field);

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
        $team->update($validatedData);

        return redirect()->route('team.index')->with('success', 'Team updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $data = Team::findOrFail($id);
        $data->delete();

        return redirect()->route('team.index')->with('success', 'Team deleted successfully.');
    }
}
