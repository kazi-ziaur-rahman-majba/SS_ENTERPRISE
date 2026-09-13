<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Menu::orderBy('id', 'DESC')->get();
        return view('admin.modules.menu.index', compact('data'));
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
            'path' => 'required|string|max:255',
        ]);
        Menu::create($validatedData);
        return redirect()->route('menu.index')->with('success', 'Page menu saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edit = Menu::findOrFail($id);
        $data = Menu::orderBy('id', 'DESC')->get();
        return view('admin.modules.menu.index', compact('edit', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'path' => 'required|string|max:255',
        ]);

        $data = Menu::findOrFail($id);

        $data->update($validatedData);
        return redirect()->route('menu.index')->with('success', 'Page menu updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Menu::findOrFail($id);
        $data->delete();

        return redirect()->route('menu.index')->with('success', 'Page menu deleted successfully.');
    }
}
