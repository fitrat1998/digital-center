<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Request as Req;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('super admin')) {

            $count = Req::where(function ($query) {
                $query->whereNull('status')
                    ->orWhere('status', 'waiting');
            })->count();


            return view('adminsuper.index', compact('count'));
        } elseif ($user->hasRole('admin')) {

            $count = Req::where(function ($query) {
                $query->whereNull('status')
                    ->orWhere('status', 'waiting');
            })->count();

            return view('admin.index', compact('count'));
        }

        return view('dashboard');

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Home $home)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Home $home)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Home $home)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Home $home)
    {
        //
    }
}
