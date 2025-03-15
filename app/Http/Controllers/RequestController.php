<?php

namespace App\Http\Controllers;

use App\Models\Request as RequestModel;
use App\Http\Requests\StoreRequestRequest;
use App\Http\Requests\UpdateRequestRequest;
use Illuminate\Http\Request;


class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = RequestModel::all();

        return view('requests.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function accept(Request $request)
    {
        $req = RequestModel::find($request->accept_id);

        if ($req) {
            $req->update([
                'comment' => $request->comment,
                'status' => 'accepted',
            ]);
            return redirect()->back()->with('success', __('messages.requests.accept'));
        }


        return redirect()->back();
    }

    public function reject(Request $request)
    {
        $req = RequestModel::find($request->reject_id);

        if ($req) {
            $req->update([
                'comment' => $request->comment,
                'status' => 'rejected',
            ]);
            return redirect()->back()->with('danger', __('messages.requests.reject'));
        }

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequestRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequestRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }
}
