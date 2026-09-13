<?php

namespace App\Http\Controllers;

use App\Models\WhatWeDo;
use Illuminate\Http\Request;

class WhatWeDoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = WhatWeDo::orderBy('id', 'DESC')->first();
        return view('admin.modules.home.what_we_do.what_we_do', compact('data'));
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
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'image' => 'required|image|max:500',
        ]);

        // dd($request);
        $how_it_works_detail = [];

        foreach ($request->work_title as $key => $value) {
            $icon = '';

            // Check if the icon file exists in the request for the current key
            if ($request->hasFile("icon.$key") && $request->file("icon.$key")->isValid()) {
                $file = $request->file("icon.$key");
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/home');
                $file->move($destinationPath, $filename);
                $icon = 'uploads/home/' . $filename;
            }

            $how_it_works_detail[] = [
                'title' => $value,
                'icon' => $icon,
                'detail' => $request->detail[$key]
            ];
        }

        $validatedData['works'] = json_encode($how_it_works_detail);




        // Process file uploads
        $imageFields = ['image'];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $file = $request->file($field);
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/home');
                $file->move($destinationPath, $filename);
                $validatedData[$field] = 'uploads/home/' . $filename;
            } else {
                $validatedData[$field] = '';
            }
        }
        // dd($validatedData);
        WhatWeDo::create($validatedData);

        return redirect()->route('what-we-do.index')->with('success', 'What we do created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(WhatWeDo $whatWeDo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WhatWeDo $whatWeDo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Validate incoming request
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'sub_title' => 'required|string|max:255',
        'image' => 'nullable|image|max:500', // Make image nullable for updates
    ]);

    $whatWeDo = WhatWeDo::findOrFail($id);

    $how_it_works_detail = [];

    foreach ($request->work_title as $key => $value) {
        $icon = '';

        // Check if the icon file exists in the request for the current key
        if ($request->hasFile("icon.$key") && $request->file("icon.$key")->isValid()) {
            $file = $request->file("icon.$key");
            $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/home');
            $file->move($destinationPath, $filename);
            $icon = 'uploads/home/' . $filename;
        } else {
            // If no new icon is uploaded, keep the old one
            $icon = $request->old_icons[$key] ?? '';
        }

        $how_it_works_detail[] = [
            'title' => $value,
            'icon' => $icon,
            'detail' => $request->detail[$key]
        ];
    }

    $validatedData['works'] = json_encode($how_it_works_detail);

    // Process file upload for the main image
    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        $file = $request->file('image');
        $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path('/uploads/home');
        $file->move($destinationPath, $filename);
        $validatedData['image'] = 'uploads/home/' . $filename;
    } else {
        // If no new image is uploaded, keep the old one
        $validatedData['image'] = $whatWeDo->image;
    }

    // Update the existing WhatWeDo instance
    $whatWeDo->update($validatedData);

    return redirect()->route('what-we-do.index')->with('success', 'What we do updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WhatWeDo $whatWeDo)
    {
        //
    }
}
