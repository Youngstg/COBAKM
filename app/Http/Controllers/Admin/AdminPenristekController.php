<?php

namespace App\Http\Controllers\Admin;

use App\Models\Penristek;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
// cuxtom validation

// carbon
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminPenristekController extends Controller
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
        //
        return view('admin.penristek.index', [
            'penristeks' => DB::table('penristek')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.penristek.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'max:255|min:3',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'required|min:3',
            'link_penristek' => 'required',
        ], [
            'judul.required' => 'Judul tidak boleh Kosong',
            'judul.max' => 'Judul Hanya Menampung 255 Karakter',
            'judul.min' => 'Judul Minimal 3 karakter',
            'gambar.required' => 'Gambar tidak boleh Kosong',
            'gambar.url' => 'Harap Isikan Link Gambar',
            'deskripsi.min' => 'Deskripsi Minimal 3 karakter',
            'link_penristek.url' => 'Harap Isikan Link Penristek',
        ]);

        setlocale(LC_TIME, 'id_ID');

        $currentDateTime = Carbon::now();

        $tgl_up = strftime('%A, %e %B %Y', strtotime($currentDateTime));
        $link_gambar = $request->file('gambar')->store('images/penristek', 'public');
        $penristek = penristek::create([
            'judul' => $request->judul,
            'tgl_up' => $tgl_up,
            'slug' => SlugService::createSlug(Penristek::class, 'slug', $request->judul),
            'gambar' => $link_gambar,
            'deskripsi' => $request->deskripsi,
            'link_penristek' => $request->link_penristek,
        ]);

        if (auth()->user()->id_role == 888) {
            return redirect(route('admin.penristek.index'))->with('sukses', 'Berhasil Tambah Data!');
        } elseif (auth()->user()->id_role == 1000) {
            return redirect(route('penris.penristek.index'))->with('sukses', 'Berhasil Tambah Data!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $penristek = penristek::where('slug', $slug)->first();

        return view('admin.penristek.read', compact('penristek'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $penristek = penristek::where('slug', $slug)->first();

        return view('admin.penristek.update', compact('penristek'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255|min:3',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'required|string|min:3',
            'link_penristek' => 'required',
        ], [
            'judul.required' => 'Judul tidak boleh Kosong',
            'judul.max' => 'Judul Hanya Menampung 255 Karakter',
            'judul.min' => 'Judul Minimal 3 karakter',
            'gambar.required' => 'Gambar tidak boleh Kosong',
            'gambar.image' => 'Harap unggah file gambar yang valid',
            'gambar.mimes' => 'Jenis file gambar harus berupa jpeg, png, jpg, gif, atau svg',
            'gambar.max' => 'Ukuran gambar maksimal adalah 2MB',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
            'deskripsi.min' => 'Deskripsi Minimal 3 karakter',
            'link_penristek.url' => 'Harap Isikan Link Penristek yang valid',
        ]);

        $penristek = penristek::where('slug', $slug)->firstOrFail();

        if ($request->hasFile('gambar')) {
            $link_gambar = $request->file('gambar')->store('images/penristek', 'public');
            Storage::disk('public')->delete($penristek->gambar);
        } else {
            $link_gambar = $penristek->gambar;
        }

        $penristek->update([
            'judul' => $validated['judul'],
            'gambar' => $link_gambar,
            'deskripsi' => $validated['deskripsi'],
            'link_penristek' => $validated['link_penristek'],
        ]);

        $redirect_route = auth()->user()->id_role == 888 ? 'admin.penristek.index' : 'penris.penristek.index';

        return redirect(route($redirect_route))->with('sukses', 'Berhasil Update Data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pns = penristek::where('id', $id)->first();
        Storage::disk('public')->delete($pns->gambar);
        $pns->delete();
        if (auth()->user()->id_role == 888) {
            return redirect(route('admin.penristek.index'))->with('sukses', 'Berhasil Hapus Data!');
        } elseif (auth()->user()->id_role == 1000) {
            return redirect(route('penris.penristek.index'))->with('sukses', 'Berhasil Hapus Data!');
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('index', 'create', 'checker', 'store', 'show', 'edit', 'update', 'destroy');
    }
}
