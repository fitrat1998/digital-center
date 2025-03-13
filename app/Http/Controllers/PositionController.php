<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Position;
use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::all();

        return view('positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();

        return view('positions.add', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePositionRequest $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'name_uz' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
        ], [
            'department_id.required' => __('messages.validation.department_required'),
            'department_id.exists' => __('messages.validation.department_exists'),
            'name_uz.required' => __('messages.validation.name_uz_required'),
            'name_en.required' => __('messages.validation.name_en_required'),
            'name_ru.required' => __('messages.validation.name_ru_required'),
        ]);

        $position = Position::create([
            'department_id' => $request->department_id,
            'name_uz' => $request->name_uz,
            'name_en' => $request->name_en,
            'name_ru' => $request->name_ru,
        ]);

        return redirect()->route('positions.index')->with('success', __('messages.success_position_add'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $position = Position::find($id);

        $departments = Department::all();

        return view('positions.edit', compact('departments', 'position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePositionRequest $request, $id)
    {

        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'name_uz' => 'nullable|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
        ], [
            'department_id.required' => __('messages.validation.department_required'),
            'department_id.exists' => __('messages.validation.department_exists'),
            'name_uz.required' => __('messages.validation.name_uz_required'),
            'name_en.required' => __('messages.validation.name_en_required'),
            'name_ru.required' => __('messages.validation.name_ru_required'),
        ]);

        $position = Position::find($id);

        $position->update(array_filter($request->only(['department_id', 'name_uz', 'name_en', 'name_ru'])));

        return redirect()->route('positions.index')->with('success', __('messages.success_position_edit'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $position = Position::find($id);

        if($position)
        {
            $position->delete();
        }

        return redirect()->route('positions.index')->with('success', __('messages.success_position_delete'));
    }
}
