<?php

namespace App\Http\Controllers;

use App\Models\MembershipCertificate;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class MembershipCertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = MembershipCertificate::orderBy('id', 'DESC')->first();
        return view('admin.modules.membership_certificate.membershipCertificate', compact('data'));
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
        // dd($request);

        $validatedData = $request->validate([
            'banner_title' => 'required|string|max:255',
            'page_title' => 'required|string|max:255',
            'banner_image' => 'required|mimes:jpeg,png,gif,svg|max:400',
            'member_title' => 'required|string|max:255',
            'certificates_title' => 'required|string|max:255',
            'member_image.*' => 'required|image|mimes:jpeg,png,gif,svg|max:400', // Accepts jpeg, png, gif, and svg
            'certification_image.*' => 'required|mimes:jpeg,png,gif,svg|max:400', // Accepts jpeg, png, gif, svg,
        ]);

        $member_images = [];
        $certification_images = [];

        foreach ($request->file('member_image') as $file) {
            $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/member_certificates'), $filename);
            $member_images[] = 'uploads/member_certificates/' . $filename;
        }

        foreach ($request->file('certification_image') as $file) {
            $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/member_certificates'), $filename);
            $certification_images[] = 'uploads/member_certificates/' . $filename;
        }

        $validatedData['member_image'] = json_encode($member_images);
        $validatedData['certificates_image'] = json_encode($certification_images);

        // dd($validatedData);
        MembershipCertificate::create($validatedData);

        return redirect()->route('membership-certificate.index')->with('success', 'Membership & Certificate created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MembershipCertificate $membershipCertificate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MembershipCertificate $membershipCertificate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $data = MembershipCertificate::findOrFail($id);

    $validatedData = $request->validate([
        'banner_title' => 'required|string|max:255',
        'page_title' => 'required|string|max:255',
        'banner_image' => 'required|mimes:jpeg,png,gif,svg|max:400',
        'member_title' => 'required|string|max:255',
        'certificates_title' => 'required|string|max:255',
        'member_image.*' => 'nullable|image|mimes:jpeg,png,gif,svg|max:2048',
        'certification_image.*' => 'nullable|image|mimes:jpeg,png,gif,svg|max:2048',
        'certification_title.*' => 'nullable|string|max:255', // Added validation for certification titles
    ]);

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
            $destinationPath = public_path('/uploads/member_certificates');
            $file->move($destinationPath, $filename);
            $validatedData[$field] = 'uploads/member_certificates/' . $filename;
        } else {
            $validatedData[$field] = $data->{$field}; // Retain the existing image path if no new image is uploaded
        }
    }

    $memberImages = [];
    if ($request->hasfile('member_image')) {
        foreach ($request->file('member_image') as $file) {
            $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/member_certificates'), $filename);
            $memberImages[] = 'uploads/member_certificates/' . $filename;
        }
    }

    if ($request->ex_members_image) {
        $filteredImages = array_filter($request->ex_members_image, function ($value) {
            return $value !== null;
        });
        $memberImages = array_merge($filteredImages, $memberImages);
    }

    $certificationImages = [];
    if ($request->hasfile('certification_image')) {
        foreach ($request->file('certification_image') as $file) {
            $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/member_certificates'), $filename);
            $certificationImages[] = 'uploads/member_certificates/' . $filename;
        }
    }

    if ($request->ex_certifications_image) {
        $filteredImages = array_filter($request->ex_certifications_image, function ($value) {
            return $value !== null;
        });
        $certificationImages = array_merge($certificationImages, $filteredImages);
    }

    $certificationImagesList = [];
    foreach ($certificationImages as $key => $image) {
        $certificationImagesList[] = [
            'image' => $image,
            'title' => $request->certification_title[$key] ?? '', // Ensure it matches the image key
        ];
    }

    $data->update([
        'banner_title' => $validatedData['banner_title'],
        'page_title' => $validatedData['page_title'],
        'banner_image' => $validatedData['banner_image'],
        'member_title' => $validatedData['member_title'],
        'certificates_title' => $validatedData['certificates_title'],
        'member_image' => json_encode($memberImages),
        'certificates_image' => json_encode($certificationImagesList),
    ]);

    return redirect()->route('membership-certificate.index')->with('success', 'Membership & Certificate updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MembershipCertificate $membershipCertificate)
    {
        //
    }
}
