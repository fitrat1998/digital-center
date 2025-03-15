<?php

namespace App\Http\Controllers;

use App\Models\Software;
use App\Http\Requests\StoreSoftwareRequest;
use App\Http\Requests\UpdateSoftwareRequest;
use App\Models\SoftwareCategory;
use Illuminate\Support\Facades\Storage;

class SoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $softwares = Software::all();

        return view('softwares.index', compact('softwares'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = SoftwareCategory::all();

        return view('softwares.add', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSoftwareRequest $request)
    {
//        dd($request);
        $request->validate([
            'title_uz' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'description_uz' => 'nullable|string',
            'description_en' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required',
        ]);

        $photoPath = $request->file('photo')->store('uploads/softwares', 'public');

        Software::create([
            'title_uz' => $request->title_uz,
            'title_en' => $request->title_en,
            'title_ru' => $request->title_ru,
            'description_uz' => $request->description_uz,
            'description_en' => $request->description_en,
            'description_ru' => $request->description_ru,
            'photo' => $photoPath,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('softwares.index')->with('success', __('messages.success_software_add'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Software $software)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = SoftwareCategory::all();

        $software = Software::find($id);

        return view('softwares.edit', compact('categories', 'software'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSoftwareRequest $request, $id)
    {
        $validated = $request->validate([
            'title_uz' => 'nullable|string|max:255',
            'title_ru' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_uz' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'description_en' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'nullable|exists:software_categories,id',
        ]);

        $software = Software::find($id);


        $data = $request->only(array_keys($validated));

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('softwares', 'public');
            $data['photo'] = $photoPath;
        }

        $software->update($data);


        return redirect()->route('softwares.index')->with('success', __('messages.success_software_edit'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $software = Software::find($id);
        if ($software) {
            if ($software->photo && Storage::disk('public')->exists($software->photo)) {
                Storage::disk('public')->delete($software->photo);
            }

            $software->delete();
        }

        return redirect()->route('news.index')->with('success', __('messages.success_software_delete'));
    }
}
