<?php

namespace App\Http\Controllers;

use App\Models\FaqPageCms;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class FaqPageCmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = FaqPageCms::orderBy('id', 'DESC')->first();
        return view('admin.modules.faq.faq', compact('data'));
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
            'title' => 'required|string',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        

        $faq = [];

        foreach ($request->question as $key => $question) {
            $faq[] = [
                'question' => $question,
                'answer' => $request->answer[$key]
            ];
        }

        $validatedData['faq'] = json_encode($faq);


        // Process file uploads
        $imageFields = ['banner_image'];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $file = $request->file($field);
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/faq');
                $file->move($destinationPath, $filename);
                $validatedData[$field] = 'uploads/faq/' . $filename;
            } else {
                $validatedData[$field] = '';
            }
        }
        // dd($validatedData);
        FaqPageCms::create($validatedData);

        return redirect()->route('faq.index')->with('success', 'Faq created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FaqPageCms $faqPageCms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FaqPageCms $faqPageCms)
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
            'title' => 'required|string',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        

        $faq = [];

        foreach ($request->question as $key => $question) {
            $faq[] = [
                'question' => $question,
                'answer' => $request->answer[$key]
            ];
        }

        $validatedData['faq'] = json_encode($faq);


        // Process file uploads
        $imageFields = ['banner_image'];
        $data = FaqPageCms::findOrFail($id);
        $filesystem = new Filesystem();

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $filePath = public_path($data->$field);

                if ($filesystem->exists($filePath)) {
                    $filesystem->delete($filePath);
                }

                $file = $request->file($field);
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/faq');
                $file->move($destinationPath, $filename);
                $validatedData[$field] = 'uploads/faq/' . $filename;
            }
        }

        
        // dd($validatedData);
        $data->update($validatedData);

        return redirect()->route('faq.index')->with('success', 'Faq updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FaqPageCms $faqPageCms)
    {
        //
    }
}
