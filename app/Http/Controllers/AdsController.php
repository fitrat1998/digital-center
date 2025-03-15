<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Http\Requests\StoreAdsRequest;
use App\Http\Requests\UpdateAdsRequest;
use Illuminate\Support\Facades\Storage;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ads = Ads::all();

        return view('ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ads = Ads::all();

        return view('ads.add', compact('ads'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdsRequest $request)
    {
        $request->validate([
            'title_uz' => 'required|string|max:255',
            'title_en' => 'string|max:255',
            'title_ru' => 'string|max:255',
            'description_uz' => 'required|string',
            'description_en' => 'string',
            'description_ru' => 'string',
            'photo' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('ads', 'public');
        } else {
            $photoPath = null;
        }

        $staff = Ads::create([
            'title_uz' => $request->title_uz,
            'title_en' => $request->title_en,
            'title_ru' => $request->title_ru,
            'description_uz' => $request->description_uz,
            'description_en' => $request->description_en,
            'description_ru' => $request->description_ru,
            'photo' => $photoPath ?? null,
        ]);

        return redirect()->route('ads.index')->with('success', __('messages.success_staff_add'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Ads $ads)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ads = Ads::find($id);

        return view('ads.edit', compact('ads'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdsRequest $request, $id)
    {
        $request->validate([
            'title_uz' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'title_ru' => 'nullable|string|max:255',
            'description_uz' => 'nullable|string',
            'description_en' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only([
            'title_uz', 'title_en', 'title_ru',
            'description_uz', 'description_en', 'description_ru'
        ]);

        $ads = Ads::find($id);


        foreach ($data as $key => $value) {
            if (is_null($value)) {
                unset($data[$key]);
            }
        }

        if ($request->hasFile('photo')) {
            if ($ads->photo && Storage::disk('public')->exists($ads->photo)) {
                Storage::disk('public')->delete($ads->photo);
            }
            $data['photo'] = $request->file('photo')->store('ads', 'public');
        }

        $ads->update($data);

        return redirect()->route('ads.index')->with('success', __('messages.success_ads_edit'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ads = Ads::find($id);
        if ($ads) {
            if ($ads->photo && Storage::disk('public')->exists($ads->photo)) {
                Storage::disk('public')->delete($ads->photo);
            }

            $ads->delete();
        }

        return redirect()->route('ads.index')->with('success', __('messages.success_ads_delete'));
    }
}
