<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Event::orderBy('id', 'DESC')->get();
        return view('admin.modules.event.event_list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.modules.event.event');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|max:500',
            'title' => 'required|max:2048',
            'slug' => 'string',
            'detail' => 'required|string',
            'location' => 'required|string',
            'event_time' => 'required|string',
            'event_date' => 'required|date',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        $validatedData['slug'] = Str::slug($request->title);

        // Process file uploads
        $imageFields = ['image'];

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

        Event::create($validatedData);

        return redirect()->route('event.index')->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $data = Event::findOrFail($id);
        return view('admin.modules.event.event', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'image' => 'nullable|image|max:500',
            'title' => 'required|max:2048',
            'slug' => 'string',
            'detail' => 'required|string',
            'location' => 'required|string',
            'event_time' => 'required|string',
            'event_date' => 'required|date',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        $validatedData['slug'] = Str::slug($request->title);

        $event = Event::findOrFail($id);

        // Process file uploads
        $imageFields = ['image'];
        $filesystem = new Filesystem();
        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $filePath = public_path($event->$field);

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

        $event->update($validatedData);

        return redirect()->route('event.index')->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $data = Event::findOrFail($id);
        $data->delete();

        return redirect()->route('event.index')->with('success', 'Event deleted successfully.');
    }
}
