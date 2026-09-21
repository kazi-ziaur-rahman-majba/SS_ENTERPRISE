<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class ServiceCategoryController extends Controller
{
    /**
     * Re-index all categories sequentially to 1, 2, 3...
     */
    private function reindexPositions()
    {
        $all = ServiceCategory::orderBy('position', 'ASC')->orderBy('id', 'ASC')->get();
        foreach ($all as $index => $cat) {
            $expectedPos = $index + 1;
            if ($cat->position != $expectedPos) {
                DB::table('service_categories')->where('id', $cat->id)->update(['position' => $expectedPos]);
            }
        }
        Cache::forget('services_menu_shared');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->reindexPositions();
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
            'short_description' => 'required|string',
            'position' => 'nullable|integer|min:1',
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

        if (empty($validatedData['position'])) {
            $maxSortOrder = (int) ServiceCategory::max('position');
            $validatedData['position'] = $maxSortOrder + 1;
        } else {
            $validatedData['position'] = (float) $validatedData['position'] - 0.5;
        }

        ServiceCategory::create($validatedData);
        $this->reindexPositions();

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
        $this->reindexPositions();
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
            'short_description' => 'required|string',
            'position' => 'nullable|integer|min:1',
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

        if (isset($request->position) && !empty($request->position)) {
            $newPos = (float) $request->position;
            $validatedData['position'] = $newPos - 0.5;
        }

        $serviceCategory->update($validatedData);

        // update category name in the service pages
        $services = Service::where('category_id', $id)->get();
        foreach ($services as $service) {
            $service->category_name = $serviceCategory->name;
            $service->save();
        }

        $this->reindexPositions();

        return redirect()->route('service-category.index')->with('success', 'Service Category updated successfully.');
    }

    public function updateOrder(Request $request)
    {
        $order = $request->input('order');

        if (is_array($order)) {
            foreach ($order as $index => $id) {
                DB::table('service_categories')->where('id', $id)->update(['position' => $index + 1]);
            }
        }

        $this->reindexPositions();

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = ServiceCategory::findOrFail($id);
        $data->delete();

        $this->reindexPositions();

        return redirect()->route('service-category.index')->with('success', 'Service Category deleted successfully.');
    }
}
