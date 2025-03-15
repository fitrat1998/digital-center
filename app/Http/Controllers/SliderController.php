<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::all();

        return view('sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sliders = Slider::all();

        return view('sliders.add', compact('sliders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSliderRequest $request)
    {
        $validated = $request->validate([
            'title_uz' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'caption_uz' => 'required|string',
            'caption_ru' => 'required|string',
            'caption_en' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimum 2MB rasm
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('sliders', 'public');
        } else {
            $photoPath = null;
        }

        $staff = Slider::create([
            'title_uz' => $request->title_uz,
            'title_en' => $request->title_en,
            'title_ru' => $request->title_ru,
            'caption_uz' => $request->caption_uz,
            'caption_en' => $request->caption_en,
            'caption_ru' => $request->caption_ru,
            'photo' => $photoPath ?? null,
        ]);


        return redirect()->route('sliders.index')->with('success', __('messages.success_slider_add'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $slider = Slider::find($id);

        return view('sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSliderRequest $request, $id)
    {
        $validated = $request->validate([
            'title_uz' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'caption_uz' => 'nullable|string',
            'caption_ru' => 'nullable|string',
            'caption_en' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $slider = Slider::find($id);

        $updateData = $request->only(array_keys($validated));

        if ($request->hasFile('photo')) {
            if ($slider->photo) {
                Storage::disk('public')->delete($slider->photo);
            }
            $updateData['photo'] = $request->file('photo')->store('sliders', 'public');
        }

        $slider->update($updateData);

        return redirect()->route('sliders.index')->with('success', __('messages.success_slider_edit'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        if ($slider) {
            if ($slider->photo && Storage::disk('public')->exists($slider->photo)) {
                Storage::disk('public')->delete($slider->photo);
            }

            $slider->delete();
        }

        return redirect()->route('sliders.index')->with('success', __('messages.success_slider_delete'));
    }
}
