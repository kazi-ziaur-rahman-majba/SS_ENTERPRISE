<?php

namespace App\Http\Controllers;

use App\Models\OurClient;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class OurClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = OurClient::orderBy('id', 'DESC')->get();
        return view('admin.modules.home.our_clients.our_clients', compact('data'));
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
            'image' => 'required|image',
        ]);

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

        OurClient::create($validatedData);

        return redirect()->route('our-clients.index')->with('success', 'Our clients created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(OurClient $ourClient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $edit = OurClient::findOrFail($id);
        $data = OurClient::orderBy('id', 'DESC')->get();
        return view('admin.modules.home.our_clients.our_clients', compact('edit', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $OurClient = OurClient::findOrFail($id);

        $imageFields = ['image'];
        $filesystem = new Filesystem();

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $filePath = public_path($OurClient->$field);

                if ($filesystem->exists($filePath)) {
                    $filesystem->delete($filePath);
                }

                $file = $request->file($field);
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/home');
                $file->move($destinationPath, $filename);
                $validatedData[$field] = 'uploads/home/' . $filename;
            }
        }

        
        // dd($validatedData);
        $OurClient->update($validatedData);

        return redirect()->route('our-clients.index')->with('success', 'Our clients updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $data = OurClient::findOrFail($id);
        $data->delete();

        return redirect()->route('our-clients.index')->with('success', 'Our clients deleted successfully.');
    }
}
