<?php

namespace App\Http\Controllers;

use App\Models\TermsConditionsCms;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class TermsConditionsCmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = TermsConditionsCms::orderBy('id', 'DESC')->first();
        return view('admin.modules.terms_conditions.page_cms', compact('data'));
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
            'details' => 'required|string',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        // Process file uploads
        $imageFields = ['banner_image'];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $file = $request->file($field);
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/terms_conditions');
                $file->move($destinationPath, $filename);
                $validatedData[$field] = 'uploads/terms_conditions/' . $filename;
            } else {
                $validatedData[$field] = '';
            }
        }

        TermsConditionsCms::create($validatedData);

        return redirect()->route('terms-conditions.index')->with('success', 'Terms and Conditions created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TermsConditionsCms $termsConditionsCms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TermsConditionsCms $termsConditionsCms)
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
            'details' => 'required|string',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        $data = TermsConditionsCms::findOrFail($id);

        $imageFields = ['banner_image'];
        $filesystem = new Filesystem();

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $filePath = public_path($data->$field);

                if ($filesystem->exists($filePath)) {
                    $filesystem->delete($filePath);
                }

                $file = $request->file($field);
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/terms_conditions');
                $file->move($destinationPath, $filename);
                $validatedData[$field] = 'uploads/terms_conditions/' . $filename;
            }
        }

        
        // dd($validatedData);
        $data->update($validatedData);

        return redirect()->route('terms-conditions.index')->with('success', 'Terms and Conditions updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TermsConditionsCms $termsConditionsCms)
    {
        //
    }
}
