<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KMActivity;
use App\Models\TagATK;
use Carbon\Carbon;
use Cocur\Slugify\Slugify;
use Cviebrock\EloquentSluggable\Services\SlugService;
// slugify khusus untuk edit artikel pada method createSlug
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminKMActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function createSlug(Request $request)
    {
        if (($request->has('mode') and $request->has('id')) and $request->mode == 'edit') {
            $kmac = KMActivity::where('id', $request->id)->first();
            $slugify = new Slugify;

            // Kalau slug kmac di database sama dengan title_mac baru yang diubah ke bentuk slug
            if ($kmac->slug_kmac == $slugify->slugify($request->title)) {
                // slug kmac gak berubah, kirim ulang aja
                $slug = $kmac->slug_kmac;
            } else { // buat slug kmac baru
                $slug = SlugService::createSlug(KMActivity::class, 'slug_kmac', $request->title);
            }
        } elseif ($request->has('mode') and $request->mode == 'create') {
            $slug = SlugService::createSlug(KMActivity::class, 'slug_kmac', $request->title);
        } else {
            abort(404);
        }

        return response()->json(['slug' => $slug, 'message' => 'Slug dapat digunakan.']);
    }

    // cek slug yang dimasukkan sendiri oleh user unik/gak
    public function checkSlug(Request $request)
    {
        if ($request->has('mode') and $request->mode == 'create') {
            $kmac = KMActivity::whereSlug($request->slug)->count();
        } elseif (($request->has('mode') and $request->has('id')) and $request->mode == 'edit') {
            // kalo lagi mode edit, kecualikan data yang sedang diedit
            $kmac = KMActivity::where('id', '!=', $request->id)->whereSlug($request->slug)->count();
        } else {
            abort(404);
        }

        if ($kmac > 0) {
            return response()->json(['unique' => 0, 'message' => 'Slug tidak dapat digunakan. Silakan masukkan slug yang lain.']);
        } else {
            return response()->json(['unique' => 1, 'message' => 'Slug dapat digunakan.']);
        }
    }

    public function index()
    {
        $kmacs = KMActivity::with('tags')->get()->map(function ($activity) {
            $activity->formatted_date = Carbon::parse($activity->tgl_pelaksanaan)->locale('id')->format('j F Y, H:i');

            return $activity;
        });

        return view('admin.km-activity.index', compact('kmacs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = TagATK::all();

        return view('admin.km-activity.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if ($request['features_kmac'] == 'on') {
            $request['features_kmac'] = true;
        }

        $request->validate([
            'title_kmac' => 'required|max:255|min:3',
            'ketuplak_kmac' => 'nullable|max:255|min:3',
            'gambar_kmac' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'konten_kmac' => 'required',
            'deskripsi_kmac' => 'required|max:150|min:10',
            'tag_kmac' => 'array|exists:tag_a_t_k_s,id',
            'features_kmac' => 'nullable|boolean',
            'slug_kmac' => 'required|unique:k_m_activities,slug_kmac',
            'tgl_pelaksanaan' => 'required|date|date_format:d-m-Y H:i:s',
        ], [
            'title_kmac.required' => 'Title aktivitas harus diisi.',
            'ketuplak_kmac.required' => 'Nama ketuplak aktivitas harus diisi.',
            'konten_kmac.required' => 'Konten aktivitas harus diisi.',
            'deskripsi_kmac.required' => 'Deskripsi aktivitas harus diisi.',
            'tag_kmac.required' => 'Tag aktivitas harus diisi.',
            'slug_kmac.required' => 'Slug harus diisi.',
            'slug_kmac.unique' => 'Slug_kmac tidak dapat digunakan. Silakan masukkan slug_kmac yang lain.',
            'title_kmac.max' => 'Title aktivitas maksimal 255 karakter.',
            'deskripsi_kmac.max' => 'Deskripsi aktivitas maksimal 100 karakter.',
            'deskripsi_kmac.min' => 'Dsskripsi aktivitas manimal 10 karakter.',
            'title_kmac.min' => 'Title aktivitas minimal 3 karakter.',
            'ketuplak_kmac.max' => 'Nama ketuplak_kmac aktivitas maksimal 255 karakter.',
            'ketuplak_kmac.min' => 'Nama ketuplak_kmac aktivitas minimal 3 karakter.',
            'tgl_pelaksanaan.date' => 'Tanggal dan waktu terbit aktivitas harus dalam format tanggal dan waktu.',
            'tgl_pelaksanaan.date_format' => 'Tanggal dan waktu terbit aktivitas harus dalam format Tanggal-Bulan-Tahun Jam:Menit:Detik WIB.',
        ]);

        $slug = SlugService::createSlug(KMActivity::class, 'slug_kmac', $request->slug_kmac);

        $kmac = $request->all();
        $kmac['slug_kmac'] = $slug;

        if ($request->hasFile('gambar_kmac')) {
            $kmac['gambar_kmac'] = Storage::disk('public')->put('activity', $request->file('gambar_kmac'));
        }

        $kmac['tgl_pelaksanaan'] = date('Y-m-d H:i:s', strtotime($request->tgl_pelaksanaan));

        $kmac = KMActivity::create($kmac);

        $kmac->tags()->sync($request->tag_kmac);

        return redirect('admin/km-activity')->with('sukses', 'Berhasil Tambah Data!');
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
        $kmac = KMActivity::where('slug_kmac', $slug)->first();

        if (!$kmac) {
            abort(404);
        }

        $tags = TagATK::all();

        $tags = TagATK::get();
        $kmac_tags = [];

        foreach ($kmac->tags as $tag) {
            $kmac_tags[] = $tag->id;
        }

        return view('admin.km-activity.edit', compact('kmac', 'tags', 'kmac_tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $kmac = KMActivity::where('slug_kmac', $slug)->first();

        if (!$kmac) {
            abort(404);
        }

        if ($request['features_kmac'] == 'on') {
            $request['features_kmac'] = true;
        } else {
            $request['features_kmac'] = false;
        }

        $request->validate([
            'title_kmac' => 'required|max:255|min:3',
            'ketuplak_kmac' => 'nullable|max:255|min:3',
            'tag_kmac' => 'array|exists:tag_a_t_k_s,id',
            'gambar_kmac' => 'nullable',
            'konten_kmac' => 'required',
            'deskripsi_kmac' => 'required|max:150|min:10',
            'features_kmac' => 'nullable|boolean',
            'tgl_pelaksanaan' => 'required|date|date_format:d-m-Y H:i:s',
            'slug_kmac' => 'required|unique:k_m_activities,slug_kmac,' . $kmac->id,
        ], [
            'title_kmac.required' => 'Title aktivitas harus diisi.',
            'konten_kmac.required' => 'Konten aktvitas harus diisi.',
            'slug_kmac.required' => 'Slug harus diisi.',
            'slug_kmac.unique' => 'Slug tidak dapat digunakan. Silakan masukkan slug_kmac yang lain.',
            'title_kmac.max' => 'Title aktivitas maksimal 255 karakter.',
            'title_kmac.min' => 'Title aktivitas minimal 3 karakter.',
            'deskripsi_kmac.max' => 'Deskripsi karakter lebih dari 100',
            'deskripsi_kmac.min' => 'Deskripsi karakter kurang dari 10',
            'ketuplak_kmac.max' => 'Nama ketuplak aktvitas maksimal 255 karakter.',
            'ketuplak_kmac.min' => 'Nama ketuplak aktvitas minimal 3 karakter.',
            'tgl_pelaksanaan.date' => 'Tanggal dan waktu pelaksanaan aktvitas harus dalam format tanggal dan waktu.',
            'tgl_pelaksanaan.date_format' => 'Tanggal dan waktu pelaksanaan aktvitas harus dalam format Tanggal-Bulan-Tahun Jam:Menit:Detik WIB.',
        ]);

        $data = $request->all();

        if ($data['slug_kmac'] == $kmac->slug_kmac) {
            $data['slug_kmac'] = $request->slug_kmac;
        } else { // Value input slug diubah user
            $data['slug_kmac'] = SlugService::createSlug(KMActivity::class, 'slug_kmac', $request->slug_kmac);
        }

        if ($request->hasFile('gambar_kmac')) {
            $data['gambar_kmac'] = Storage::disk('public')->put('activity', $request->file('gambar_kmac'));
            if ($kmac->gambar_kmac) {
                Storage::disk('public')->delete($kmac->gambar_kmac);
            }
        }

        $kmac->update($data);

        $kmac->tags()->sync($request->tag_kmac);

        return redirect('admin/km-activity')->with('sukses', 'Berhasil Ubah Data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $kmac = KMActivity::where('slug_kmac', $slug)->first();

        if (!$kmac) {
            abort(404);
        }
        $kmac->tags()->detach();
        Storage::disk('public')->delete($kmac->gambar_kmac);
        $kmac->delete();

        return redirect('admin/km-activity')->with('sukses', 'Berhasil Hapus Data!');
    }
}
