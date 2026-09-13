<?php

namespace App\Http\Controllers;

use App\Models\WorkProcess;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class WorkProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = WorkProcess::orderBy('id', 'DESC')->get();
        return view('admin.modules.home.work_process.work_process_list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.modules.home.work_process.work_process');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|max:500',
            'title' => 'required|max:2048',
            'detail' => 'required|string',
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

        WorkProcess::create($validatedData);

        return redirect()->route('why-work-us.index')->with('success', 'Why work us created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkProcess $workProcess)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $data = WorkProcess::findOrFail($id);
        return view('admin.modules.home.work_process.work_process', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'image' => 'nullable|image|max:500',
            'title' => 'required|max:2048',
            'detail' => 'required|string',
        ]);


        $work = WorkProcess::findOrFail($id);

        // Process file uploads
        $imageFields = ['image'];
        $filesystem = new Filesystem();
        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $filePath = public_path($work->$field);

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

        $work->update($validatedData);

        return redirect()->route('why-work-us.index')->with('success', 'Why work us updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $data = WorkProcess::findOrFail($id);
        $data->delete();

        return redirect()->route('why-work-us.index')->with('success', 'Why work us deleted successfully.');
    }
}
