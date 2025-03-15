<?php

namespace App\Http\Controllers;

use App\Models\SoftwareCategory;
use App\Http\Requests\StoreSoftwareCategoryRequest;
use App\Http\Requests\UpdateSoftwareCategoryRequest;

class SoftwareCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $softwarecategories = SoftwareCategory::all();
        return view('software_categories.index', compact('softwarecategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $softwarecategories = SoftwareCategory::all();
        return view('software_categories.add', compact('softwarecategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSoftwareCategoryRequest $request)
    {

//        dd($request);

        $request->validate([
            'name_uz' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ]);

        SoftwareCategory::create([
            'name_uz' => $request->name_uz,
            'name_en' => $request->name_en,
            'name_ru' => $request->name_ru,
        ]);

        return redirect()->route('softwarecategories.index')->with('success', __('messages.success_category_add'));

    }

    /**
     * Display the specified resource.
     */
    public function show(SoftwareCategory $softwareCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = SoftwareCategory::find($id);

        return view('software_categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSoftwareCategoryRequest $request, $id)
    {
        $request->validate([
            'name_uz' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
            'name_en' => 'nullable|string|max:255',
        ]);

        $category = SoftwareCategory::findOrFail($id);

        $category->update(array_filter([
            'name_uz' => $request->name_uz,
            'name_en' => $request->name_en,
            'name_ru' => $request->name_ru,
        ]));

        return redirect()->route('softwarecategories.index')->with('success', __('messages.success_category_edit'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = SoftwareCategory::find($id);

        if ($category) {
            $category->delete();
        }

        return redirect()->route('softwarecategories.index')->with('success', __('messages.success_category_delete'));
    }
}
