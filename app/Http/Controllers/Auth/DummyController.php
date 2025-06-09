<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DummyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.log');
    }

    public function login(Request $request)
    {

        if ($request->email == 'or 1=1' || $request->email == "admin' or 1=1" || $request->password == 'or 1=1' || $request->password == "admin' or 1=1" || $request->email == 'test@example.com') {
            return redirect('backup');
        }

        return redirect()->route('login')->withErrors(['failed' => 'Password atau Email salah']);

    }

    public function backup()
    {
        return view('auth.backup');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
