<?php

namespace App\Http\Controllers;

use App\Models\EventPageCms;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class EventPageCmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = EventPageCms::orderBy('id', 'DESC')->first();
        return view('admin.modules.event.event_page_cms', compact('data'));
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
            'banner_image' => 'image|max:400',
            'detail_page_title' => 'required|max:2048',
            'detail_page_banner_image' => 'image|max:400',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        // Process file uploads
        $imageFields = ['banner_image','detail_page_banner_image'];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $file = $request->file($field);
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/event');
                $file->move($destinationPath, $filename);
                $validatedData[$field] = 'uploads/event/' . $filename;
            } else {
                $validatedData[$field] = '';
            }
        }

        EventPageCms::create($validatedData);

        return redirect()->route('event-page-cms.index')->with('success', 'Event page cms created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(EventPageCms $eventPageCms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventPageCms $eventPageCms)
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
            'banner_image' => 'image|max:400',
            'detail_page_title' => 'required|max:2048',
            'detail_page_banner_image' => 'image|max:400',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);
        $eventPageCms = EventPageCms::findOrFail($id);

        $imageFields = ['banner_image','detail_page_banner_image'];
        $filesystem = new Filesystem();

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $filePath = public_path($eventPageCms->$field);

                if ($filesystem->exists($filePath)) {
                    $filesystem->delete($filePath);
                }

                $file = $request->file($field);
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/event');
                $file->move($destinationPath, $filename);
                $validatedData[$field] = 'uploads/event/' . $filename;
            }
        }

        
        // dd($validatedData);
        $eventPageCms->update($validatedData);

        return redirect()->route('event-page-cms.index')->with('success', 'Event page cms updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventPageCms $eventPageCms)
    {
        //
    }
}
