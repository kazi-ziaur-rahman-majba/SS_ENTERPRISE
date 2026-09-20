<?php

namespace App\Http\Controllers;

use App\Models\ContactMail;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Rules\ReCaptchaV3;
use App\Mail\ContactUs;
use Illuminate\Support\Facades\Mail;
use App\Models\SiteSetting;

class ContactMailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ContactMail::orderBy('id', 'DESC')->get();
        return view('admin.modules.contact.messages', compact('data'));
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
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string',
            'subject' => 'required|string',
            'message' => 'required|string',
        ];

        if ($request->filled('g-recaptcha-response')) {
            $rules['g-recaptcha-response'] = ['required', new ReCaptchaV3('submitContact')];
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Validation failed.', 'errors' => $validator->errors()]);
        }

        $validated = $validator->validated();

        ContactMail::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
        ]);

        $siteSetting = SiteSetting::orderBy('id', 'DESC')->first();
        if ($siteSetting && !empty($siteSetting->contact_email)) {
            $emailList = $siteSetting->contact_email;
            $recipientEmails = array_map('trim', explode(',', $emailList));
            try {
                Mail::to($recipientEmails)->send(new ContactUs($validated));
            } catch (\Exception $e) {
                // Log mail error without breaking the user response
                \Illuminate\Support\Facades\Log::error('Contact mail error: ' . $e->getMessage());
            }
        }

        return response()->json(['success' => true, 'message' => 'Contact request successfully sent']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = ContactMail::findOrFail($id);
        return view('admin.modules.contact.show-message', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactMail $contactMail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactMail $contactMail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = ContactMail::findOrFail($id);
        $data->delete();

        return redirect()->route('contact-list.index')->with('success', 'Contact deleted successfully.');
    }
}
