<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SaiData;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
// custom validation
use Illuminate\Support\Facades\Storage;

class AdminSaiDataController extends Controller
{
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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.saidata.index', [
            'sais' => SaiData::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sais = SaiData::get();

        return view('admin.saidata.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255|min:3',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sub_judul' => 'required|string|max:255|min:3',
            'desk_sub' => 'required|string|max:255|min:3',
        ], [
            'judul.required' => 'Judul Saidata Masih Kosong.',
            'judul.max' => 'Judul Hanya Menampung 255 Karakter.',
            'judul.min' => 'Judul Minimal 3 Karakter.',
            'logo.required' => 'Logo Sai Tidak Boleh Kosong.',
            'logo.image' => 'File harus berupa gambar.',
            'logo.mimes' => 'Gambar harus memiliki format jpeg, png, jpg, gif, atau svg.',
            'logo.max' => 'Ukuran gambar maksimal adalah 2MB.',
            'sub_judul.required' => 'Sub Judul Masih Kosong.',
            'sub_judul.max' => 'Sub Judul Hanya Menampung 255 Karakter.',
            'sub_judul.min' => 'Sub Minimal 3 Karakter.',
            'desk_sub.required' => 'Deskripsi Masih Kosong.',
            'desk_sub.max' => 'Deskripsi Hanya Menampung 255 Karakter.',
            'desk_sub.min' => 'Deskripsi Minimal 3 Karakter.',
        ]);

        // Handle file upload
        $link_logo = $request->file('logo')->store('images/saidata/', 'public');

        $sai = SaiData::create([
            'judul_sai' => $validated['judul'],
            'logo_sai' => $link_logo,
            'sub_judul_sai' => $validated['sub_judul'],
            'desk_sub_judul_sai' => $validated['desk_sub'],
            'slug_sub_sai' => SlugService::createSlug(SaiData::class, 'slug_sub_sai', $validated['sub_judul']),
        ]);

        $redirect_route = auth()->user()->id_role == 888 ? 'admin.saidata.index' : 'penris.saidata.index';

        return redirect(route($redirect_route))->with('sukses', 'Berhasil Tambah Data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sais = SaiData::where('id', $id)->first();

        return view('admin.saidata.read', compact('sais'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sais = SaiData::where('id', $id)->first();

        return view('admin.saidata.update', compact('sais'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255|min:3',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sub_judul' => 'required|string|max:255|min:3',
            'desk_sub' => 'required|string|max:255|min:3',
        ], [
            'judul.required' => 'Judul Saidata Masih Kosong.',
            'judul.max' => 'Judul Hanya Menampung 255 Karakter.',
            'judul.min' => 'Judul Minimal 3 Karakter.',
            'logo.image' => 'File harus berupa gambar.',
            'logo.mimes' => 'Gambar harus memiliki format jpeg, png, jpg, gif, atau svg.',
            'logo.max' => 'Ukuran gambar maksimal adalah 2MB.',
            'sub_judul.required' => 'Sub Judul Masih Kosong.',
            'sub_judul.max' => 'Sub Judul Hanya Menampung 255 Karakter.',
            'sub_judul.min' => 'Sub Minimal 3 Karakter.',
            'desk_sub.required' => 'Deskripsi Masih Kosong.',
            'desk_sub.max' => 'Deskripsi Hanya Menampung 255 Karakter.',
            'desk_sub.min' => 'Deskripsi Minimal 3 Karakter.',
        ]);

        $sais = SaiData::findOrFail($id);

        $link_logo = $sais->logo_sai; // Default to existing logo
        if ($request->hasFile('logo')) {
            // Store new logo and delete old one
            $link_logo = $request->file('logo')->store('images/saidata/logo', 'public');
            if ($sais->logo_sai) {
                Storage::disk('public')->delete($sais->logo_sai);
            }
        }

        $sais->update([
            'judul_sai' => $validated['judul'],
            'logo_sai' => $link_logo,
            'sub_judul_sai' => $validated['sub_judul'],
            'desk_sub_judul_sai' => $validated['desk_sub'],
        ]);

        $redirect_route = auth()->user()->id_role == 888 ? 'admin.saidata.index' : 'penris.saidata.index';

        return redirect(route($redirect_route))->with('sukses', 'Berhasil Update Data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $saidata = SaiData::where('id', $id)->first();
        Storage::disk('public')->delete($saidata->logo_sai);
        $saidata->delete();
        if (auth()->user()->id_role == 888) {
            return redirect(route('admin.saidata.index'))->with('sukses', 'Berhasil Hapus Data!');
        } elseif (auth()->user()->id_role == 1000) {
            return redirect(route('penris.saidata.index'))->with('sukses', 'Berhasil Hapus Data!');
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('index', 'create', 'checker', 'store', 'show', 'edit', 'update', 'destroy');
    }
}
