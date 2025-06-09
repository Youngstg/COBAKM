<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ATK;
use App\Models\TagATK;
use Carbon\Carbon;
use Cocur\Slugify\Slugify;
// slugify khusus untuk edit artikel pada method createSlug
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminATKController extends Controller
{
    // Buat slug berdasarkan judul
    public function createSlug(Request $request)
    {
        if (($request->has('mode') and $request->has('id')) and $request->mode == 'edit') {
            $atk = ATK::where('id', $request->id)->first();
            $slugify = new Slugify;

            // Kalau slug atk di database sama dengan judul baru yang diubah ke bentuk slug
            if ($atk->slug_atk == $slugify->slugify($request->judul)) {
                // slug atk gak berubah, kirim ulang aja
                $slug = $atk->slug_atk;
            } else { // buat slug atk baru
                $slug = SlugService::createSlug(ATK::class, 'slug_atk', $request->judul);
            }
        } elseif ($request->has('mode') and $request->mode == 'create') {
            $slug = SlugService::createSlug(ATK::class, 'slug_atk', $request->judul);
        } else {
            abort(404);
        }

        return response()->json(['slug' => $slug, 'message' => 'Slug dapat digunakan.']);
    }

    // cek slug yang dimasukkan sendiri oleh user unik/gak
    public function checkSlug(Request $request)
    {
        if ($request->has('mode') and $request->mode == 'create') {
            $atk = ATK::whereSlug($request->slug)->count();
        } elseif (($request->has('mode') and $request->has('id')) and $request->mode == 'edit') {
            // kalo lagi mode edit, kecualikan data yang sedang diedit
            $atk = ATK::where('id', '!=', $request->id)->whereSlug($request->slug)->count();
        } else {
            abort(404);
        }

        if ($atk > 0) {
            return response()->json(['unique' => 0, 'message' => 'Slug tidak dapat digunakan. Silakan masukkan slug yang lain.']);
        } else {
            return response()->json(['unique' => 1, 'message' => 'Slug dapat digunakan.']);
        }
    }

    //  public function checker($link_id)
    //  {
    //      $link = explode("/file/d/", $link_id);

    //      if (count($link) >= 2) {
    //          $link_id = $link[1];
    //          $check_view = strpos($link_id, '/view');
    //          $check_preview = strpos($link_id, '/preview');
    //          if ($check_view !== false)
    //              $link_id = substr($link_id, 0, $check_view);
    //          elseif ($check_preview !== false)
    //              $link_id = substr($link_id, 0, $check_preview);
    //          else
    //              $link_id = null;
    //      }
    //      return $link_id;
    //  }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.atk.index', [
            'articles' => ATK::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $tags = TagATK::get();

        return view('admin.atk.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if ($request['features_atk'] == 'on') {
            $request['features_atk'] = true;
        } else {
            $request['features_atk'] = false;
        }

        $request->validate([
            'judul' => 'required|max:255|min:3',
            'penulis' => 'required|max:255|min:3',
            'tag_artikel' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'konten' => 'required',
            'features_atk' => 'nullable|boolean',
            'slug' => 'required|unique:a_t_k_s,slug_atk',
            'tgl_publish' => 'nullable|date|date_format:d-m-Y H:i:s|after_or_equal:now',
        ], [
            'judul.required' => 'Judul artikel harus diisi.',
            'penulis.required' => 'Nama penulis artikel harus diisi.',
            'konten.required' => 'Konten artikel harus diisi.',
            'slug.required' => 'Slug harus diisi.',
            'slug.unique' => 'Slug tidak dapat digunakan. Silakan masukkan slug yang lain.',
            'judul.max' => 'Judul artikel maksimal 255 karakter.',
            'judul.min' => 'Judul artikel minimal 3 karakter.',
            'penulis.max' => 'Nama penulis artikel maksimal 255 karakter.',
            'penulis.min' => 'Nama penulis artikel minimal 3 karakter.',
            'gambar.url' => 'Gambar artikel harus dalam bentuk URL/Link.',
            'tgl_publish.date' => 'Tanggal dan waktu terbit artikel harus dalam format tanggal dan waktu.',
            'tgl_publish.date_format' => 'Tanggal dan waktu terbit artikel harus dalam format Tanggal-Bulan-Tahun Jam:Menit:Detik WIB.',
            'tgl_publish.after_or_equal' => 'Tanggal dan waktu terbit artikel harus lebih dari tanggal dan waktu sekarang.',
        ]);

        // Validasi slug di BE
        // Slug yang sesuai format/belum ada di DB bakal tetap
        // Slug yang gak sesuai format/ada di DB bakal diubah sama eloquent sluggable
        $slug = SlugService::createSlug(ATK::class, 'slug_atk', $request->slug);

        // $link = explode("/file/d/", $request->gambar);

        // if (count($link) >= 2) {
        //     $link_id = $link[1];
        //     $check_view = strpos($link_id, '/view');
        //     $check_preview = strpos($link_id, '/preview');
        //     if ($check_view !== false)
        //         $link_id = substr($link_id, 0, $check_view);
        //     elseif ($check_preview !== false)
        //         $link_id = substr($link_id, 0, $check_preview);
        //     else
        //         $link_id = NULL;
        // }
        // else
        //     $link_id = $request->gambar;
        if ($request->hasFile('gambar')) {
            $path_image = $request->file('gambar')->store('images/atk', 'public');
        } else {
            $path_image = null;
        }

        $create = [
            'judul_atk' => $request->judul,
            'penulis_atk' => $request->penulis,
            'gambar_atk' => $path_image,
            'konten_atk' => $request->konten,
            'features_atk' => $request->features_atk,
            'slug_atk' => $slug,
        ];

        if ($request->filled('tgl_publish')) {
            $create['published_at'] = date('Y-m-d H:i:s', strtotime($request->tgl_publish));
        } else {
            $create['published_at'] = Carbon::now()->format('Y-m-d H:i:s');
        }

        $atk = ATK::create($create);

        if ($request->has('tag_artikel')) {
            $atk->tagatk()->sync((array) $request->input('tag_artikel'));
        }

        return redirect('admin/artikel')->with('sukses', 'Berhasil Tambah Data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        //
        $artikel = ATK::where('slug_atk', $slug)->first();

        if (!$artikel) {
            abort(404);
        }

        return view('admin.atk.read', compact('artikel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        //
        $artikel = ATK::where('slug_atk', $slug)->first();

        if (!$artikel) {
            abort(404);
        }

        $tags = TagATK::get();
        $artikel_tags = [];

        foreach ($artikel->tagatk as $tag) {
            $artikel_tags[] = $tag->id;
        }

        return view('admin.atk.update', compact('artikel', 'tags', 'artikel_tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        //
        $atk = ATK::where('slug_atk', $slug)->first();

        if (!$atk) {
            abort(404);
        }

        if ($request['features_atk'] == 'on') {
            $request['features_atk'] = true;
        } else {
            $request['features_atk'] = false;
        }

        $request->validate([
            'judul' => 'required|max:255|min:3',
            'penulis' => 'required|max:255|min:3',
            'tag_artikel' => 'nullable',
            'gambar' => 'nullable',
            'konten' => 'required',
            'features_atk' => 'nullable|boolean',
            'slug' => 'required|unique:a_t_k_s,slug_atk,' . $atk->id,
            'tgl_publish' => 'nullable|date|date_format:d-m-Y H:i:s|after_or_equal:' . $atk->created_at,
        ], [
            'judul.required' => 'Judul artikel harus diisi.',
            'penulis.required' => 'Nama penulis artikel harus diisi.',
            'konten.required' => 'Konten artikel harus diisi.',
            'slug.required' => 'Slug harus diisi.',
            'slug.unique' => 'Slug tidak dapat digunakan. Silakan masukkan slug yang lain.',
            'judul.max' => 'Judul artikel maksimal 255 karakter.',
            'judul.min' => 'Judul artikel minimal 3 karakter.',
            'penulis.max' => 'Nama penulis artikel maksimal 255 karakter.',
            'penulis.min' => 'Nama penulis artikel minimal 3 karakter.',
            'gambar.url' => 'Gambar artikel harus dalam bentuk URL/Link.',
            'tgl_publish.date' => 'Tanggal dan waktu terbit artikel harus dalam format tanggal dan waktu.',
            'tgl_publish.date_format' => 'Tanggal dan waktu terbit artikel harus dalam format Tanggal-Bulan-Tahun Jam:Menit:Detik WIB.',
            'tgl_publish.after_or_equal' => 'Tanggal dan waktu terbit artikel harus lebih dari tanggal dan waktu dibuatnya artikel. (' . $atk->created_at->format('d-m-Y H:i:s') . ')',
        ]);

        // Validasi slug di BE
        if ($request->slug == $atk->slug_atk) {
            // Kalau slug yang dikirim sama dengan yang di database
            // Berarti value input slug tidak diubah user
            $slug = $request->slug;
        } else { // Value input slug diubah user
            // Slug yang sesuai format/belum ada di DB bakal tetap
            // Slug yang gak sesuai format/ada di DB bakal diubah sama eloquent sluggable
            $slug = SlugService::createSlug(ATK::class, 'slug_atk', $request->slug);
        }

        // if (strpos($request->gambar, 'https://drive.google.com')!==false){
        //     $link = explode("/file/d/", $request->gambar);
        //     if (count($link) >= 2){
        //         $link_id = $link[1];
        //         $check_view = strpos($link_id, '/view');
        //         $check_preview = strpos($link_id, '/preview');
        //         if ($check_view !== false){
        //             $link_id = substr($link_id, 0, $check_view);
        //         }elseif ($check_preview !== false){
        //             $link_id = substr($link_id, 0, $check_preview);
        //         }else{
        //             $link_id = $request->gambar;
        //         }
        //     }
        // }else{
        //     $link_id = $request->gambar;
        // }
        $path_name = $atk->gambar_atk;
        if ($request->hasFile('gambar')) {
            $path_name = $request->file('gambar')->store('images/op', 'public');
            if ($atk->gambar_atk) {
                Storage::disk('public')->delete($atk->gambar_atk);
            }
        }

        $update = [
            'judul_atk' => $request->judul,
            'penulis_atk' => $request->penulis,
            'gambar_atk' => $path_name,
            'konten_atk' => $request->konten,
            'features_atk' => $request->features_atk,
            'slug_atk' => $slug,
        ];

        $atk->update($update);

        if ($request->has('tag_artikel')) {
            $atk->tagatk()->sync((array) $request->input('tag_artikel'));
        }

        return redirect('admin/artikel')->with('sukses', 'Berhasil Ubah Data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        //
        $atk = ATK::where('slug_atk', $slug)->first();

        if (!$atk) {
            abort(404);
        }
        if ($atk->gambar_atk) {
            Storage::disk('public')->delete($atk->gambar_atk);
        }
        $atk->delete();

        return redirect('admin/artikel')->with('sukses', 'Berhasil Hapus Data!');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('index', 'create', 'checker', 'store', 'show', 'edit', 'update', 'destroy', 'checkSlug', 'createSlug');
    }
}
