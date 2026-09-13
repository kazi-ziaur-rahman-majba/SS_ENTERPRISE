<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SiteSetting::orderBy('id', 'DESC')->first();
        return view('admin.modules.settings.index', compact('data'));
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
            'logo' => 'nullable|image|max:2048',
            'about_us' => 'required|string',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'corporate_office_address' => 'required|string',
            'registered_office_address' => 'required|string',
            'uk_office_address' => 'required|string',
            'facebook_link' => 'nullable|string|max:255',
            'instagram_link' => 'nullable|string|max:255',
            'linkedin_link' => 'nullable|string|max:255',
            'appointment_email' => 'nullable|string|max:255',
            'contact_email' => 'nullable|string|max:255',
        ]);

        if ($request->hasfile('logo')) {
            $image1 = $request->file('logo');
            $filenameStore = date('Ymd') . '-' . uniqid() . '.' . $image1->getClientOriginalExtension();
            $destinationPath1 = public_path() . '/uploads/site';
            $image1->move($destinationPath1, $filenameStore);
            $validatedData['logo'] = 'uploads/site/' .$filenameStore;
        }

        $siteSetting = SiteSetting::create($validatedData);

        return redirect()->route('site-settings.index')->with('success', 'Site settings saved successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(SiteSetting $siteSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SiteSetting $siteSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'about_us' => 'required|string',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'corporate_office_address' => 'required|string',
            'registered_office_address' => 'required|string',
            'uk_office_address' => 'required|string',
            'facebook_link' => 'nullable|string|max:255',
            'instagram_link' => 'nullable|string|max:255',
            'linkedin_link' => 'nullable|string|max:255',
            'appointment_email' => 'nullable|string|max:255',
            'contact_email' => 'nullable|string|max:255',
        ]);

        $siteSetting = SiteSetting::findOrFail($id);

        if ($request->hasFile('logo')) {

            $filesystem = new Filesystem();
            $filePath = public_path($siteSetting->logo);

            if ($filesystem->exists($filePath)) {
                $filesystem->delete($filePath);
            }

            $image1 = $request->file('logo');
            $filenameStore = date('Ymd') . '-' . uniqid() . '.' . $image1->getClientOriginalExtension();
            $destinationPath1 = public_path() . '/uploads/site'; // Use storage_path for the correct absolute path
            $image1->move($destinationPath1, $filenameStore);
            $validatedData['logo'] = 'uploads/site/' . $filenameStore; // Adjust the path as needed
        }

        // Update the SiteSetting record
        $siteSetting->update($validatedData);

        // Redirect or return a response
        return redirect()->route('site-settings.index')->with('success', 'Site settings updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SiteSetting $siteSetting)
    {
        //
    }
}
