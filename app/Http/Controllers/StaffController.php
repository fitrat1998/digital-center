<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Staff;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use Illuminate\Support\Facades\Storage;

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


        $request->validate([
            'fullname' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'position_id' => 'required',
        ]);


        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('staffs', 'public');
        } else {
            $photoPath = null;
        }

        $staff = Staff::create([
            'fullname' => $request->fullname,
            'photo' => $photoPath,
            'position_id' => $request->position_id,
        ]);


        return redirect()->route('staffs.index')->with('success', __('messages.success_staff_add'));

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
    public function update(UpdateStaffRequest $request, $id)
    {
//        dd($request);

        $request->validate([
            'fullname' => 'sometimes|string|max:255',
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'position_id' => 'sometimes|exists:positions,id',
        ]);

        $staff = Staff::findOrFail($id);

        $data = $request->only(['fullname', 'position_id']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('staffs', 'public');

            if ($staff->photo) {
                Storage::disk('public')->delete($staff->photo);
            }
        }

        $staff->update($data);

        return redirect()->route('staffs.index')->with('success', __('messages.success_staff_edit'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $staff = Staff::find($id);

        if($staff)
        {
            if ($staff->photo) {
                Storage::disk('public')->delete($staff->photo);
            }
            $staff->delete();
        }

        return redirect()->route('staffs.index')->with('success', __('messages.success_staff_delete'));
    }
}
