<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\kbt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Str;

// cuxtom validation

class AdminKbtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kbts = kbt::paginate(10);

        return view('admin.kabinet.index', compact('kbts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.kabinet.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request['status_kbt'] == 'on') {
            $request['status_kbt'] = true;
        }

        $request->validate([
            'nama_kbt' => 'required|min:3|max:255|',
            'logo_kbt' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:6144',
            'foto_kbt' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10204',
            'nama_presma' => 'required|min:3|max:255',
            'prodi_presma' => 'required|min:3|max:255',
            'tahun_kbt' => 'required|numeric|min:4',
            'desk_kbt' => 'nullable|min:3',
            'status_kbt' => 'nullable|boolean',
        ], [
            'nama_kabinet.required' => 'Nama Kabinet Masih Kosong.',
            'nama_kabinet.max' => 'Nama Kabinet Hanya Menampung 255 Karakter.',
            'nama_kabinet.min' => 'Nama Kabinet Minimal 3 Karakter.',
            'logo_kbt.mimes' => 'Logo hanya mendukung format jpeg, jpg, png, gif, dan svg',
            'log_kbt.max' => 'Ukuran Logo lebih dari 6MB',
            'nama_presma.required' => 'Nama Presma harus diisi.',
            'prodi_presma.required' => 'Prodi Presma harus diisi.',
            'foto_kbt.max' => 'Ukuran Foto Kabinet lebih dari 10MB',
            'foto_kbt.mimes' => 'Foto hanya mendukung format jpeg, jpg, png, gif, dan svg',
            'tahun_kbt.max' => 'Tahun kabinet hanya 4 karakter.',
        ]);

        $kbt = $request->all();

        $kbt = $request->all();
        if (isset($kbt['status_kbt']) && $kbt['status_kbt'] == true) {
            kbt::where('status_kbt', true)->update(['status_kbt' => false]);
        }

        $kbt['slug_kbt'] = Str::slug($kbt['nama_kbt']);
        if ($request->hasFile('logo_kbt')) {
            $logoPath = $request->file('logo_kbt')->store('public/kbt/logo');
            $kbt['logo_kbt'] = Storage::url($logoPath);
        }

        if ($request->hasFile('foto_kbt')) {
            $fotoPath = $request->file('foto_kbt')->store('public/kbt/foto');
            $kbt['foto_kbt'] = Storage::url($fotoPath);
        }


        kbt::create($kbt);

        return redirect(route('admin.kabinet.index'));
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
    public function edit(string $slug)
    {
        $kbt = kbt::where('slug_kbt', $slug)->first();

        return view('admin.kabinet.update', compact('kbt'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $slug)
    {
        $kbt = kbt::where('slug_kbt', $slug)->first();

        if (!$kbt) {
            abort(404);
        }

        if ($request['status_kbt'] == 'on') {
            $request['status_kbt'] = true;
        } else {
            $request['status_kbt'] = false;
        }

        $request->validate([
            'nama_kbt' => 'required|min:3|max:255|',
            'logo_kbt' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:6144',
            'foto_kbt' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10204',
            'nama_presma' => 'required|min:3|max:255',
            'prodi_presma' => 'required|min:3|max:255',
            'tahun_kbt' => 'required|numeric|min:4',
            'desk_kbt' => 'nullable|min:3',
            'status_kbt' => 'nullable|boolean',
        ], [
            'nama_kabinet.required' => 'Nama Kabinet Masih Kosong.',
            'nama_kabinet.max' => 'Nama Kabinet Hanya Menampung 255 Karakter.',
            'nama_kabinet.min' => 'Nama Kabinet Minimal 3 Karakter.',
            'logo_kbt.mimes' => 'Logo hanya mendukung format jpeg, jpg, png, gif, dan svg',
            'log_kbt.max' => 'Ukuran Logo lebih dari 6MB',
            'nama_presma.required' => 'Nama Presma harus diisi.',
            'prodi_presma.required' => 'Prodi Presma harus diisi.',
            'foto_kbt.max' => 'Ukuran Foto Kabinet lebih dari 10MB',
            'foto_kbt.mimes' => 'Foto hanya mendukung format jpeg, jpg, png, gif, dan svg',
            'tahun_kbt.max' => 'Tahun kabinet hanya 4 karakter.',
        ]);

        $data = $request->all();

        if (isset($data['status_kbt']) && $data['status_kbt'] == true) {
            kbt::where('status_kbt', true)->update(['status_kbt' => false]);
        }

        if ($request->hasFile('logo_kbt')) {
            $logoPath = $request->file('logo_kbt')->store('public/kbt/logo');
            if ($kbt->logo_kbt) {
                Storage::delete(str_replace('/storage', 'public', $kbt->logo_kbt));
            }
            $data['logo_kbt'] = Storage::url($logoPath);
        }

        if ($request->hasFile('foto_kbt')) {
            $fotoPath = $request->file('foto_kbt')->store('public/kbt/foto');
            if ($kbt->foto_kbt) {
                Storage::delete(str_replace('/storage', 'public', $kbt->foto_kbt));
            }
            $data['foto_kbt'] = Storage::url($fotoPath);
        }

        $kbt->update($data);

        return redirect('admin/kabinet')->with('sukses', 'Berhasil Ubah Data!');

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        //
        $kbt = kbt::where('slug_kbt', $slug)->first();
        Storage::delete(str_replace('/storage', 'public', $kbt->logo_kbt));
        Storage::delete(str_replace('/storage', 'public', $kbt->foto_kbt));
        $kbt->delete();

        return redirect(route('admin.kabinet.index'))->with('sukses', 'Berhasil Hapus Data!');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('index', 'create', 'checker', 'store', 'show', 'edit', 'update', 'destroy');
    }
}
