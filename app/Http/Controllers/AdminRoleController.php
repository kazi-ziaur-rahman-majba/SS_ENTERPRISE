<?php

namespace App\Http\Controllers;

use App\Models\AdminRole;
use Illuminate\Http\Request;
use App\Models\Menu;

class AdminRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = AdminRole::orderBy('id', 'DESC')->get();
        $menu = Menu::orderBy('id', 'DESC')->get();
        return view('admin.modules.admin.index', compact('data', 'menu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'required|array', // Changed from 'string' to 'array'
        ]);

        $permissionIds = $request->input('permissions');
        $permissions = Menu::whereIn('id', $permissionIds)->get();

        $permissionNames = $permissions->pluck('name')->toArray();

        $validatedData['permissions'] = json_encode($permissionNames);
        $validatedData['permissions_id'] = json_encode($permissionIds);
        AdminRole::create($validatedData);
        return redirect()->route('admin-role.index')->with('success', 'Admin role saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AdminRole $adminRole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edit = AdminRole::findOrFail($id);
        $data = AdminRole::orderBy('id', 'DESC')->get();
        $menu = Menu::orderBy('id', 'DESC')->get();
        return view('admin.modules.admin.index', compact('edit', 'data', 'menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'required|array', // Changed from 'string' to 'array'
        ]);

        $permissionIds = $request->input('permissions');
        $permissions = Menu::whereIn('id', $permissionIds)->get();

        $permissionNames = $permissions->pluck('name')->toArray();

        $validatedData['permissions'] = json_encode($permissionNames);
        $validatedData['permissions_id'] = json_encode($permissionIds);

        // Find the AdminRole by ID
        $adminRole = AdminRole::findOrFail($id);

        // Update the AdminRole with the validated data
        $adminRole->update($validatedData);

        return redirect()->route('admin-role.index')->with('success', 'Admin role updated successfully.');
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
