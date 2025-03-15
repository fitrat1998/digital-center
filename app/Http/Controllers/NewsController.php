<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::all();

        return view('news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('news.add');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request)
    {
//        dd($request);

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
            $photoPath = $request->file('photo')->store('news', 'public');
        } else {
            $photoPath = null;
        }

        $staff = News::create([
            'title_uz' => $request->title_uz,
            'title_en' => $request->title_en,
            'title_ru' => $request->title_ru,
            'description_uz' => $request->description_uz,
            'description_en' => $request->description_en,
            'description_ru' => $request->description_ru,
            'photo' => $photoPath ?? null,
        ]);

        return redirect()->route('news.index')->with('success', __('messages.success_staff_add'));
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $news = News::find($id);

        return view('news.edit', compact('news'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, $id)
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

        $news = News::find($id);


        foreach ($data as $key => $value) {
            if (is_null($value)) {
                unset($data[$key]);
            }
        }

        if ($request->hasFile('photo')) {
            if ($news->photo && Storage::disk('public')->exists($news->photo)) {
                Storage::disk('public')->delete($news->photo);
            }
            $data['photo'] = $request->file('photo')->store('news', 'public');
        }

        $news->update($data);

        return redirect()->route('news.index')->with('success', __('messages.success_news_edit'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $news = News::find($id);
        if ($news) {
            if ($news->photo && Storage::disk('public')->exists($news->photo)) {
                Storage::disk('public')->delete($news->photo);
            }

            $news->delete();
        }

        return redirect()->route('news.index')->with('success', __('messages.success_news_delete'));

    }
}
