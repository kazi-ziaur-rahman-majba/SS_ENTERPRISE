<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\AdminRole;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Admin::orderBy('id', 'DESC')->get();
        return view('admin.modules.admin.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $adminRole = AdminRole::orderBy('id', 'DESC')->get();
        return view('admin.modules.admin.create', compact('adminRole'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'role_id' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $role = AdminRole::findOrFail($request->role_id);

        $name = $request->first_name . ' ' . $request->last_name;

        $validatedData['name'] = $name;
        $validatedData['role_name'] = $role->name;
        //    dd($validatedData);
        Admin::create($validatedData);

        $data = new UserProfile();

        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name ? $request->last_name : null;
        $data->phone = $request->phone ? $request->phone : null;
        $data->email = $request->email;
        $data->address = $request->address ? $request->address : null;
        $data->save();

        User::create([
            'name' => $name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admins.index')->with('success', 'Admin saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $adminRole = AdminRole::orderBy('id', 'DESC')->get();
        $data = Admin::findOrFail($id);
        $profInfo = UserProfile::where('email', $data->email)->first();
        // dd($profInfo);
        return view('admin.modules.admin.create', compact('adminRole', 'data', 'profInfo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'role_id' => 'required',
            'first_name' => 'required|string',
            'last_name' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'required|email', // Added unique rule for email
            'address' => 'nullable|string',
            'password' => 'nullable|string|min:6', // Added validation for password
        ]);

        $admin = Admin::findOrFail($id);
        $role = AdminRole::findOrFail($request->role_id);
        $name = $request->first_name . ' ' . ($request->last_name ?? '');
        $validatedData['name'] = $name;
        $validatedData['role_name'] = $role->name;

        // Update the Admin record
        $admin->update($validatedData);

        // Update the associated UserProfile record
        $data = UserProfile::where('email', $admin->email)->firstOrFail();
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->save();

        // Update the associated User record
        $user = User::where('email', $admin->email)->firstOrFail();
        $user->name = $name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('admins.index')->with('success', 'Admin updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = AdminRole::findOrFail($id);
        $data->delete();

        return redirect()->route('admin-role.index')->with('success', 'Admin role deleted successfully.');
    }
}
