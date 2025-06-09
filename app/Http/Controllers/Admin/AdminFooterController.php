<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use App\Models\kbt;
use Illuminate\Http\Request;

class AdminFooterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.footer.index', [
            'footers' => Footer::all(),
            'logos' => kbt::where('status_kbt', true)->select('nama_kbt', 'logo_kbt')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.footer.create', [
            'footer' => Footer::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'alamat_sekre' => 'nullable|string|max:200',
            'no_cp' => 'nullable|array',
            'email' => 'nullable|email',
            'sosmed' => 'nullable|array',
            'hak_cipta' => 'required|string',
        ]);

        Footer::create($validated);

        return redirect()->route('admin.footer.index')->with('success', 'Footer created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $footer = Footer::findOrFail($id);

        return view('admin.footer.edit', compact('footer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $footer = Footer::findOrFail($id);

        $validated = $request->validate([
            'alamat_sekre' => 'nullable|string|max:200',
            'no_cp' => 'nullable|array',
            'email' => 'nullable|email',
            'sosmed' => 'nullable|array',
            'hak_cipta' => 'required|string|max:255',
        ]);
        $footer->update($validated);

        return redirect()->route('admin.footer.index')->with('success', 'Footer updated successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footer = Footer::findOrFail($id);
        $footer->delete();

        return redirect()->route('admin.footer.index')->with('success', 'Footer deleted successfully.');
    }
}
