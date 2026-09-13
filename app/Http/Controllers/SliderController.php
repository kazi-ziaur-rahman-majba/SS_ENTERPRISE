<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Slider::orderBy('id', 'DESC')->get();
        return view('admin.modules.slider.slider_list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.modules.slider.slider');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'nullable|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'image' => 'required|image|max:500',
            'button_text' => 'nullable|string',
            'button_link' => 'nullable|string',
            'text_position' => 'required|string|max:255',
        ]);

        // Process file uploads
        $imageFields = ['image'];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $file = $request->file($field);
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/slider');
                $file->move($destinationPath, $filename);
                $validatedData[$field] = 'uploads/slider/' . $filename;
            } else {
                $validatedData[$field] = '';
            }
        }

        Slider::create($validatedData);

        return redirect()->route('slider.index')->with('success', 'Slider created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $data = Slider::findOrFail($id);
        return view('admin.modules.slider.slider', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $validatedData = $request->validate([
            'title' => 'nullable|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:500',
            'button_text' => 'nullable|string',
            'button_link' => 'nullable|string',
            'text_position' => 'required|string|max:255',
        ]);
        $slider = Slider::findOrFail($id);

        $imageFields = ['image'];
        $filesystem = new Filesystem();

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $filePath = public_path($slider->$field);

                if ($filesystem->exists($filePath)) {
                    $filesystem->delete($filePath);
                }

                $file = $request->file($field);
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/slider');
                $file->move($destinationPath, $filename);
                $validatedData[$field] = 'uploads/slider/' . $filename;
            }
        }

        
        // dd($validatedData);
        $slider->update($validatedData);

        return redirect()->route('slider.index')->with('success', 'Slider updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $data = Slider::findOrFail($id);
        $data->delete();

        return redirect()->route('slider.index')->with('success', 'Slider deleted successfully.');
    }
}
