<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TagATK;
use Illuminate\Http\Request;

class AdminTagATKController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.tag_atk.index', [
            'tags' => TagATK::paginate(15),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.tag_atk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
        ], [
            'nama.required' => 'Nama tag harus diisi.',
            'nama.max' => 'Nama tag maksimal 255 karakter.',
        ]);

        TagATK::create([
            'nama_tag' => $request->nama,
        ]);

        return redirect('admin/tag-artikel')->with('sukses', 'Berhasil Tambah Data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $tag = TagATK::where('id', $id)->first();

        return view('admin.tag_atk.read', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $tag = TagATK::where('id', $id)->first();

        if (! $tag) {
            abort(404);
        }

        return view('admin.tag_atk.update', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tag = TagATK::where('id', $id)->first();

        if (! $tag) {
            abort(404);
        }

        $request->validate([
            'nama' => 'required|max:255',
        ], [
            'nama.required' => 'Nama tag harus diisi.',
            'nama.max' => 'Nama tag maksimal 255 karakter.',
        ]);

        $tag->update([
            'nama_tag' => $request->nama,
        ]);

        return redirect('admin/tag-artikel')->with('sukses', 'Berhasil Tambah Data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = TagATK::where('id', $id)->first();

        if (! $tag) {
            abort(404);
        }

        $tag->delete();

        return redirect('admin/tag-artikel')->with('sukses', 'Berhasil Hapus Data!');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('index', 'create', 'store', 'show', 'edit', 'update', 'destroy');
    }
}
