<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dummy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminDummyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dummy = Dummy::all();

        return view('admin.dummy.index', compact('dummy'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dummy = Dummy::all();
        return view('admin.dummy.create', compact('dummy'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_dummy' => 'required',
            'link_dummy' => 'nullable|url',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:6144',
        ]);

        $existingDummy = Dummy::where('nama_dummy', $request->nama_dummy)->first();


        if ($existingDummy) {
            Storage::disk('public')->delete($existingDummy->foto_dummy);
            $existingDummy->delete();
        }
        $path_image = '';
        if ($request->hasFile('foto_dummy')) {
            $path_image = $request->file('gambar')->store(
                'images/dummy',
                'public'
            );
        }
        ;

        Dummy::create([
            'nama_dummy' => $request->nama_dummy,
            'link_dummy' => $request->link_dummy,
            'foto_dummy' => $path_image,
        ]);

        return redirect('admin/dummy')->with('sukses', 'Berhasil Tambah Data!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dummy = Dummy::where('id', $id)->first();

        return view('admin.dummy.read', compact('dummy'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dummy = Dummy::where('id', $id)->first();

        return view('admin.dummy.update', compact('dummy'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_dummy' => 'required|string|max:255',
            'link_dummy' => 'nullable|url',
            'foto_dummy' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:6144',
        ]);

        $dummy = Dummy::findOrFail($id);

        $path_image = $dummy->foto_dummy;

        if ($request->hasFile('foto_dummy')) {
            // Jika ada file foto baru di-upload, simpan foto baru
            $path_image = $request->file('foto_dummy')->store('images/dummy', 'public');

            // Hapus foto lama dari storage jika ada
            if ($dummy->foto_dummy) {
                Storage::disk('public')->delete($dummy->foto_dummy);
            }
        }

        // Update data dummy dengan data yang divalidasi
        $dummy->update([
            'nama_dummy' => $validated['nama_dummy'],
            'link_dummy' => $validated['link_dummy'] ?? null,
            'foto_dummy' => $path_image,
        ]);

        return redirect('admin/dummy')->with('sukses', 'Berhasil Update Data!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dummy = Dummy::where('id', $id)->first();
        Storage::disk('public')->delete($dummy->foto_dummy);
        $dummy->delete();

        return redirect('admin/dummy')->with('sukses', 'Berhasil Hapus Data!');
    }

    public function checker($link_id)
    {
        $link = explode('/file/d/', $link_id);

        if (count($link) >= 2) {
            $link_id = $link[1];
            $check_view = strpos($link_id, '/view');
            $check_preview = strpos($link_id, '/preview');
            if ($check_view !== false) {
                $link_id = substr($link_id, 0, $check_view);
            } elseif ($check_preview !== false) {
                $link_id = substr($link_id, 0, $check_preview);
            } else {
                $link_id = null;
            }
        }

        return $link_id;
    }

    public function __construct()
    {
        $this->middleware('guest')->except('index', 'create', 'checker', 'store', 'show', 'edit', 'update', 'destroy');
    }
}
