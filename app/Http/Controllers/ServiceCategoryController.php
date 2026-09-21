<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ServiceCategory::orderBy('position', 'ASC')->orderBy('id', 'ASC')->get();
        return view('admin.modules.service.category', compact('data'));
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
            'icon' => 'required|image|max:400',
            'image' => 'required|image|max:400',
            'short_description' => 'required|max:255',
        ]);

        // Process file uploads
        $imageFields = ['icon', 'image'];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $file = $request->file($field);
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/service');
                $file->move($destinationPath, $filename);
                $validatedData[$field] = 'uploads/service/' . $filename;
            } else {
                $validatedData[$field] = '';
            }
        }

        // Determine the new position value
        $maxSortOrder = ServiceCategory::max('position');
        $validatedData['position'] = $maxSortOrder + 1;

        ServiceCategory::create($validatedData);

        \Illuminate\Support\Facades\Cache::forget('services_menu_shared');

        return redirect()->route('service-category.index')->with('success', 'Service Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceCategory $serviceCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edit = ServiceCategory::findOrFail($id);
        $data = ServiceCategory::orderBy('position', 'ASC')->orderBy('id', 'ASC')->get();
        return view('admin.modules.service.category', compact('edit', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|max:400',
            'image' => 'nullable|image|max:400',
            'short_description' => 'required|max:255',
        ]);
        $serviceCategory = ServiceCategory::findOrFail($id);

        $imageFields = ['icon', 'image'];
        $filesystem = new Filesystem();

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $filePath = public_path($serviceCategory->$field);

                if ($filesystem->exists($filePath)) {
                    $filesystem->delete($filePath);
                }

                $file = $request->file($field);
                $filename = date('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/service');
                $file->move($destinationPath, $filename);
                $validatedData[$field] = 'uploads/service/' . $filename;
            }
        }


        // dd($validatedData);
        // Update the position if provided
        if (isset($validatedData['position'])) {
            $newSortOrder = $validatedData['position'];

            // Adjust positions of other items if necessary
            ServiceCategory::where('id', '!=', $id)
                ->where('position', '>=', $newSortOrder)
                ->increment('position');

            $validatedData['position'] = $newSortOrder;
        }

        $serviceCategory->update($validatedData);

        // update category name in the service pages
        $services = Service::where('category_id', $id)->get();
        foreach ($services as $service) {
            $service->category_name = $serviceCategory->name;
            $service->save();
        }

        \Illuminate\Support\Facades\Cache::forget('services_menu_shared');

        return redirect()->route('service-category.index')->with('success', 'Service Category updated successfully.');
    }

    public function updateOrder(Request $request)
    {
        $order = $request->input('order');

        foreach ($order as $index => $id) {
            // Assuming you have a sort_order or similar column in your table
            \DB::table('service_categories')->where('id', $id)->update(['position' => $index + 1]);
        }

        \Illuminate\Support\Facades\Cache::forget('services_menu_shared');

        return response()->json(['success' => true]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = ServiceCategory::findOrFail($id);
        $data->delete();

        \Illuminate\Support\Facades\Cache::forget('services_menu_shared');

        return redirect()->route('service-category.index')->with('success', 'Service Category deleted successfully.');
    }
}
