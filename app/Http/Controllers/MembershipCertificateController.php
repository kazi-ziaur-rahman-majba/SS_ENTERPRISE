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
        $validatedData = $request->validate([
            'banner_title' => 'required|string|max:255',
            'page_title' => 'required|string|max:255',
            'banner_image' => 'nullable|mimes:jpeg,png,gif,svg,webp|max:2048',
            'member_title' => 'required|string|max:255',
            'certificates_title' => 'required|string|max:255',
            'member_image.*' => 'nullable|image|mimes:jpeg,png,gif,svg,webp|max:2048',
            'certification_image.*' => 'nullable|image|mimes:jpeg,png,gif,svg,webp|max:2048',
            'certification_title.*' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('banner_image') && $request->file('banner_image')->isValid()) {
            $file = $request->file('banner_image');
            $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/member_certificates'), $filename);
            $validatedData['banner_image'] = 'uploads/member_certificates/' . $filename;
        } else {
            $validatedData['banner_image'] = '';
        }

        $member_images = [];
        if ($request->hasFile('member_image')) {
            foreach ($request->file('member_image') as $file) {
                if ($file && $file->isValid()) {
                    $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/member_certificates'), $filename);
                    $member_images[] = 'uploads/member_certificates/' . $filename;
                }
            }
        }

        $certification_list = [];
        if ($request->hasFile('certification_image')) {
            foreach ($request->file('certification_image') as $key => $file) {
                if ($file && $file->isValid()) {
                    $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/member_certificates'), $filename);
                    $certification_list[] = [
                        'image' => 'uploads/member_certificates/' . $filename,
                        'title' => $request->certification_title[$key] ?? '',
                    ];
                }
            }
        }

        $validatedData['member_image'] = json_encode($member_images);
        $validatedData['certificates_image'] = json_encode($certification_list);

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
            'banner_image' => 'nullable|mimes:jpeg,png,gif,svg,webp|max:2048',
            'member_title' => 'required|string|max:255',
            'certificates_title' => 'required|string|max:255',
            'member_image.*' => 'nullable|image|mimes:jpeg,png,gif,svg,webp|max:2048',
            'certification_image.*' => 'nullable|image|mimes:jpeg,png,gif,svg,webp|max:2048',
            'certification_title.*' => 'nullable|string|max:255',
        ]);

        // Process Banner Image
        if ($request->hasFile('banner_image') && $request->file('banner_image')->isValid()) {
            $filesystem = new Filesystem();
            if ($data->banner_image && $filesystem->exists(public_path($data->banner_image))) {
                $filesystem->delete(public_path($data->banner_image));
            }

            $file = $request->file('banner_image');
            $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/member_certificates'), $filename);
            $validatedData['banner_image'] = 'uploads/member_certificates/' . $filename;
        } else {
            $validatedData['banner_image'] = $data->banner_image;
        }

        // Process Member Images
        $memberImages = [];
        if ($request->ex_members_image && is_array($request->ex_members_image)) {
            foreach ($request->ex_members_image as $exImg) {
                if (!empty($exImg)) {
                    $memberImages[] = $exImg;
                }
            }
        }
        if ($request->hasFile('member_image')) {
            foreach ($request->file('member_image') as $file) {
                if ($file && $file->isValid()) {
                    $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/member_certificates'), $filename);
                    $memberImages[] = 'uploads/member_certificates/' . $filename;
                }
            }
        }

        // Process Certification Images & Titles
        $certificationList = [];
        $titles = $request->certification_title ?? [];
        $exImages = $request->ex_certifications_image ?? [];
        $newFiles = $request->file('certification_image') ?? [];

        $totalRows = max(count($titles), count($exImages), count($newFiles));

        for ($i = 0; $i < $totalRows; $i++) {
            $title = $titles[$i] ?? '';
            $imgPath = null;

            if (isset($newFiles[$i]) && $newFiles[$i] && $newFiles[$i]->isValid()) {
                $file = $newFiles[$i];
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/member_certificates'), $filename);
                $imgPath = 'uploads/member_certificates/' . $filename;
            } elseif (!empty($exImages[$i])) {
                $imgPath = $exImages[$i];
            }

            if ($imgPath) {
                $certificationList[] = [
                    'image' => $imgPath,
                    'title' => $title,
                ];
            }
        }

        if (is_array($newFiles)) {
            foreach ($newFiles as $k => $file) {
                if ($k >= $totalRows && $file && $file->isValid()) {
                    $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/member_certificates'), $filename);
                    $certificationList[] = [
                        'image' => 'uploads/member_certificates/' . $filename,
                        'title' => $titles[$k] ?? '',
                    ];
                }
            }
        }

        $data->update([
            'banner_title' => $validatedData['banner_title'],
            'page_title' => $validatedData['page_title'],
            'banner_image' => $validatedData['banner_image'],
            'member_title' => $validatedData['member_title'],
            'certificates_title' => $validatedData['certificates_title'],
            'member_image' => json_encode($memberImages),
            'certificates_image' => json_encode($certificationList),
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
