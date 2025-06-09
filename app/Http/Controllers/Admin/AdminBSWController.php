<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BSW;
use App\Models\LinkBSW;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// custom validation
use Illuminate\Support\Str;

class AdminBSWController extends Controller
{
    public function link_bsw($total, $request)
    {
        for ($i = 1; $i <= $total; $i++) {
            $link_bsw = linkBSW::where('id', $request['id_'.$i])->first();

            $link_bsw->update([
                'judul_link' => $request['judul_link_bsw_'.$i],
                'link' => $request['link_bsw_'.$i],
            ]);
        }
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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bsw = BSW::paginate(20);

        // Loop melalui data dan potong kolom konten
        foreach ($bsw as $item) {
            $item->konten_bsw = Str::limit(strip_tags($item->konten_bsw), 150);
        }

        return view('admin.bsw.index', [
            'bsws' => $bsw,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.bsw.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_bsw' => 'max:255|min:3',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'konten_bsw' => 'required',
        ], [
            'judul_bsw.required' => 'Judul Beasiswa tidak boleh Kosong',
            'judul_bsw.max' => 'Judul Hanya Menampung 255 Karakter',
            'judul_bsw.min' => 'Judul Minimal 3 karakter',
            'gambar_bsw.required' => 'Gambar Beasiswa tidak boleh Kosong',
            'gambar_bsw.url' => 'Harap Isiskan Link Gambar',
            'konten_bsw.required' => 'Konten Beasiswa tidak boleh Kosong',
        ]);

        $path_image = $request->file('gambar')->store(
            'images/bsw',
            'public'
        );
        $bsw = BSW::create([
            'judul_bsw' => $request->judul_bsw,
            'slug_bsw' => SlugService::createSlug(BSW::class, 'slug_bsw', $request->judul_bsw),
            'gambar_bsw' => $path_image,
            'konten_bsw' => $request->konten_bsw,
        ]);

        for ($i = 1; $i <= 5; $i++) {
            if ($request['link_bsw_'.$i] != null) {
                $link_bsw = linkBSW::create([
                    'bsw_id' => $bsw->id,
                    'judul_link' => $request['judul_link_bsw_'.$i],
                    'link' => $request['link_bsw_'.$i],
                ]);
            }
        }

        // return redirect(route('admin.beasiswa.index'));
        if (auth()->user()->id_role == 888) {
            return redirect(route('admin.beasiswa.index'))->with('sukses', 'Berhasil Tambah Data!');
        } elseif (auth()->user()->id_role == 1000) {
            return redirect(route('penris.beasiswa.index'))->with('sukses', 'Berhasil Tambah Data!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $bsws = BSW::where('slug_bsw', $slug)->first();
        $link_bsws = linkBSW::where('bsw_id', $bsws->id)->get();

        return view('admin.bsw.read', compact('bsws', 'link_bsws'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $bsws = BSW::where('slug_bsw', $slug)->first();
        $link_bsws = linkBSW::where('bsw_id', $bsws->id)->get();

        return view('admin.bsw.update', compact('bsws', 'link_bsws'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug_bsw)
    {
        $request->validate([
            'judul_bsw' => 'max:255|min:3',
            'gambar_bsw' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'konten_bsw' => 'required',
        ], [
            'judul_bsw.required' => 'Judul Beasiswa tidak boleh Kosong',
            'judul_bsw.max' => 'Judul Hanya Menampung 255 Karakter',
            'judul_bsw.min' => 'Judul Minimal 3 karakter',
            'gambar_bsw.required' => 'Gambar Beasiswa tidak boleh Kosong',
            'konten_bsw.required' => 'Konten Beasiswa tidak boleh Kosong',
        ]);

        $bsws = BSW::where('slug_bsw', $slug_bsw)->first();
        $link_bsws = linkBSW::where('bsw_id', $bsws->id)->get();
        $path_image = $bsws->gambar_bsw;
        if ($request->hasFile('gambar')) {
            $path_image = $request->file('gambar')->store('images/bsw', 'public');
            if ($bsws->gambar_bsw) {
                Storage::disk('public')->delete($bsws->gambar_bsw);
            }
        }
        $total = linkBSW::where('bsw_id', $bsws->id)->get()->count();

        // Update the record
        $bsws->update([
            'judul_bsw' => $request->judul_bsw,
            'slug_bsw' => SlugService::createSlug(BSW::class, 'slug_bsw', $request->judul_bsw),
            'gambar_bsw' => $path_image,
            'konten_bsw' => $request->konten_bsw,
        ]);

        // Update links or other data
        $this->link_bsw($total, $request);

        // Conditional redirection based on user role
        if (auth()->user()->id_role == 888) {
            return redirect(route('admin.beasiswa.index'))->with('sukses', 'Berhasil Update Data!');
        } elseif (auth()->user()->id_role == 1000) {
            return redirect(route('penris.beasiswa.index'))->with('sukses', 'Berhasil Update Data!');
        }

        // for($i = 1; $i <= $total; $i++){
        //         $link_bsw = linkBSW::where('id', $request['id_'.$i])->first();

        //         $link_bsw -> update([
        //             'judul_link' => $request['judul_link_bsw_'.$i],
        //             'link' => $request['link_bsw_'.$i]
        //         ]);
        // }
        // return redirect(route('admin.beasiswa.index'))->with('sukses', 'Berhasil Update Data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $bsw = BSW::where('slug_bsw', $slug)->first();
        Storage::disk('public')->delete($bsw->gambar_bsw);
        $bsw->delete();
        if (auth()->user()->id_role == 888) {
            return redirect(route('admin.beasiswa.index'))->with('sukses', 'Berhasil Hapus Data!');
        } elseif (auth()->user()->id_role == 1000) {
            return redirect(route('penris.beasiswa.index'))->with('sukses', 'Berhasil Hapus Data!');
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('index', 'create', 'checker', 'store', 'show', 'edit', 'update', 'destroy', 'link_bsw');
    }
}
