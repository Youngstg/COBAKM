<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ali;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// custom validation
use Illuminate\Support\Facades\Storage;

class AdminAliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    public function index()
    {
        return view('admin.alumni.index', [
            'alis' => DB::table('alis')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $alis = Ali::get();

        return view('admin.alumni.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255|min:3',
            'jabatan' => 'required|max:255|min:3',
            'kp' => 'required|max:255|min:3',
            'pkj' => 'required|max:255|min:3',
            'thn' => 'required|numeric',
            'prodi' => 'required|max:255|min:3',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama.required' => 'Input tidak boleh Kosong',
            'nama.min' => 'Input Minimal 3 karakter',
            'nama.max' => 'Input Hanya Menampung 255 Karakter',
            'jabatan.required' => 'Input tidak boleh Kosong',
            'jabatan.min' => 'Input Minimal 3 karakter',
            'jabatan.max' => 'Input Hanya Menampung 255 Karakter',
            'kp.required' => 'Input Praktik tidak boleh Kosong',
            'kp.min' => 'Input Minimal 3 karakter',
            'kp.max' => 'Input Hanya Menampung 255 Karakter',
            'pkj.required' => 'Input tidak boleh Kosong',
            'pkj.min' => 'Input Minimal 3 karakter',
            'pkj.max' => 'Input Hanya Menampung 255 Karakter',
            'prodi.required' => 'Input tidak boleh Kosong',
            'prodi.min' => 'Input Minimal 3 karakter',
            'prodi.max' => 'Input Hanya Menampung 255 Karakter',
            'thn.required' => 'Input tidak boleh Kosong',
            'thn.number' => 'Input hanya dapat menerima angka',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Gambar harus memiliki format jpeg, png, jpg, gif, atau svg.',
            'foto.max' => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        $link_gambar_ali = $request->file('foto')->store('images/alumni', 'public');

        Ali::create([
            'nama_ali' => $request->nama,
            'jabatan_ali' => $request->jabatan,
            'kp_ali' => $request->kp,
            'pkj_ali' => $request->pkj,
            'thn_ali' => $request->thn,
            'prodi_ali' => $request->prodi,
            'foto_ali' => $link_gambar_ali,
        ]);

        if (auth()->user()->id_role == 888) {
            return redirect(route('admin.alumni.index'))->with('sukses', 'Berhasil Tambah Data!');
        } elseif (auth()->user()->id_role == 1000) {
            return redirect(route('penris.alumni.index'))->with('sukses', 'Berhasil Tambah Data!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $alis = Ali::where('id', $id)->first();

        return view('admin.alumni.read', compact('alis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $alis = Ali::where('id', $id)->first();

        return view('admin.alumni.update', compact('alis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama' => 'required|max:255|min:3',
            'jabatan' => 'required|max:255|min:3',
            'kp' => 'required|max:255|min:3',
            'pkj' => 'required|max:255|min:3',
            'thn' => 'required|numeric',
            'prodi' => 'required|max:255|min:3',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama.required' => 'Input tidak boleh Kosong',
            'nama.min' => 'Input Minimal 3 karakter',
            'nama.max' => 'Input Hanya Menampung 255 Karakter',
            'jabatan.required' => 'Input tidak boleh Kosong',
            'jabatan.min' => 'Input Minimal 3 karakter',
            'jabatan.max' => 'Input Hanya Menampung 255 Karakter',
            'kp.required' => 'Input Praktik tidak boleh Kosong',
            'kp.min' => 'Input Minimal 3 karakter',
            'kp.max' => 'Input Hanya Menampung 255 Karakter',
            'pkj.required' => 'Input tidak boleh Kosong',
            'pkj.min' => 'Input Minimal 3 karakter',
            'pkj.max' => 'Input Hanya Menampung 255 Karakter',
            'prodi.required' => 'Input tidak boleh Kosong',
            'prodi.min' => 'Input Minimal 3 karakter',
            'prodi.max' => 'Input Hanya Menampung 255 Karakter',
            'thn.required' => 'Input tidak boleh Kosong',
            'thn.number' => 'Input hanya dapat menerima angka',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Gambar harus memiliki format jpeg, png, jpg, gif, atau svg.',
            'foto.max' => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        $alis = Ali::where('id', $id)->first();
        $link_foto = $alis->foto_ali;
        if ($request->hasFile('foto')) {
            $link_foto = $request->file('foto')->store('images/alumni/foto', 'public');
            if ($alis->foto_ali) {
                Storage::disk('public')->delete($alis->foto_ali);
            }
        }

        $alis->update([
            'nama_ali' => $validated['nama'],
            'jabatan_ali' => $validated['jabatan'],
            'kp_ali' => $validated['kp'],
            'pkj_ali' => $validated['pkj'],
            'thn_ali' => $validated['thn'],
            'prodi_ali' => $validated['prodi'],
            'foto_ali' => $link_foto,
        ]);

        $redirect_route = auth()->user()->id_role == 888 ? 'admin.alumni.index' : 'penris.alumni.index';

        return redirect(route($redirect_route))->with('sukses', 'Berhasil Update Data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $alis = Ali::where('id', $id)->first();
        Storage::disk('public')->delete($alis->foto_ali);
        $alis->delete();
        if (auth()->user()->id_role == 888) {
            return redirect(route('admin.alumni.index'))->with('sukses', 'Berhasil Hapus Data!');
        } elseif (auth()->user()->id_role == 1000) {
            return redirect(route('penris.alumni.index'))->with('sukses', 'Berhasil Hapus Data!');
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('index', 'create', 'checker', 'store', 'show', 'edit', 'update', 'destroy');
    }
}
