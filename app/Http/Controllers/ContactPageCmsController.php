<?php

namespace App\Http\Controllers;

use App\Models\ContactPageCms;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class ContactPageCmsController extends Controller
{
    public function index()
    {
        $data = ContactPageCms::first() ?? new ContactPageCms([
            'banner_title' => 'Contact Us',
            'page_title' => 'Contact',
        ]);
        return view('admin.modules.contact_cms.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'banner_title' => 'nullable|string|max:255',
            'page_title' => 'nullable|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        $data = ContactPageCms::first();

        if ($request->hasFile('banner_image') && $request->file('banner_image')->isValid()) {
            $filesystem = new Filesystem();
            if ($data && $data->banner_image && $filesystem->exists(public_path($data->banner_image))) {
                $filesystem->delete(public_path($data->banner_image));
            }

            $file = $request->file('banner_image');
            $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/contact');
            $file->move($destinationPath, $filename);
            $validatedData['banner_image'] = 'uploads/contact/' . $filename;
        }

        if ($data) {
            $data->update($validatedData);
        } else {
            ContactPageCms::create($validatedData);
        }

        return redirect()->back()->with('success', 'Contact Page CMS updated successfully.');
    }

    public function update(Request $request, $id)
    {
        return $this->store($request);
    }
}
