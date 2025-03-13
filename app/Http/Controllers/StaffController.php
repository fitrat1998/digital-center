<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Staff;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffs = Staff::all();

        return view('staffs.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $staffs = Staff::all();
        $positions = Position::all();

        return view('staffs.add', compact('staffs', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStaffRequest $request)
    {
        dd($request);

        $request->validate([
            'fullname' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'position_id' => 'required|exists:positions,id',
        ], [
            'fullname.required' => __('messages.validation.fullname_required'),
            'fullname.string' => __('messages.validation.fullname_string'),
            'fullname.max' => __('messages.validation.fullname_max'),

            'photo.required' => __('messages.validation.photo_required'),
            'photo.image' => __('messages.validation.photo_image'),
            'photo.mimes' => __('messages.validation.photo_mimes'),
            'photo.max' => __('messages.validation.photo_max'),

            'position_id.required' => __('messages.validation.position_required'),
            'position_id.exists' => __('messages.validation.position_exists'),
        ]);


        $staff = Staff::create([
            'fullname' => $request->fullname,
            'photo' => $request->fullname,
            'position_id' => $request->fullname,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $staff = Staff::find($id);
        $positions = Position::all();

        return view('staffs.edit', compact('staff', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStaffRequest $request, Staff $staff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        //
    }
}
