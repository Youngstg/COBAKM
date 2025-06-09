<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Arsip;
use Illuminate\Http\Request;

class AdminArpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arsips = Arsip::with('saidata')->get();

        return view('admin.arsip.index', [
            'arsips' => Arsip::paginate(4),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $id_sai = $request->id;

        return view('admin.arsip.create', compact('id_sai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_arp' => 'required|max:255|min:3',
            'id_sai' => 'required',
            'link_arp' => 'required|url',
            'tgl_arp' => 'required|date|date_format:Y-m-d',
            'publisher_arp' => 'required|max:255|min:3',
        ], [
            'judul_arp.required' => 'Judul Arsip Tidak Boleh Kosong!.',
            'judul_arp.max' => 'Judul Hanya Menampung 255 Kata.',
            'judul_arp.min' => 'Judul Minimal 3 Kata.',
            'link_arp.required' => 'Link Harus Diisi!',
            'link_arp.url' => 'Hanya Menerima Link Gambar(Drive).',
            'tgl_arp.required' => 'Tanggal Harus Diisi Sesuai Ketentuan.',
            'tgl_arp.date' => 'Tanggal Arsip Harus Dengan Format.',
            'tgl_arp.date_format' => 'Tanggal Arsip Harus Dalam Format Tahun-Bulan-Tanggal.',
            'publisher_arp.required' => 'Publisher Arsip Harus Diisi.',
            'publisher_arp.max' => 'Publisher Arsip Hanya Menampung 255 Kata.',
            'publisher_arp.min' => 'Publisher Arsip Minimal 3 Kata.',
        ]);

        $arp = Arsip::create([
            'id_sai' => $request->id_sai,
            'judul_arp' => $request->judul_arp,
            'link_arp' => $request->link_arp,
            'tgl_arp' => $request->tgl_arp,
            'publisher_arp' => $request->publisher_arp,
        ]);
        if (auth()->user()->id_role == 888) {
            return redirect(route('admin.arsip.index'))->with('sukses', 'Berhasil Tambah Data!');
        } elseif (auth()->user()->id_role == 1000) {
            return redirect(route('penris.arsip.index'))->with('sukses', 'Berhasil Tambah Data!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $arps = Arsip::where('id', $id)->first();

        return view('admin.arsip.read', compact('arps'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $arps = Arsip::where('id', $id)->first();

        return view('admin.arsip.update', compact('arps'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul_arp' => 'required|max:255|min:3',
            'link_arp' => 'required|url',
            'tgl_arp' => 'required|date|date_format:Y-m-d',
            'publisher_arp' => 'required|max:255|min:3',
        ], [
            'judul_arp.required' => 'Judul Arsip Tidak Boleh Kosong!.',
            'judul_arp.max' => 'Judul Hanya Menampung 255 Kata.',
            'judul_arp.min' => 'Judul Minimal 3 Kata.',
            'link_arp.required' => 'Link Harus Diisi!',
            'link_arp.url' => 'Hanya Menerima Link Gambar(Drive).',
            'tgl_arp.required' => 'Tanggal Harus Diisi Sesuai Ketentuan.',
            'tgl_arp.date' => 'Tanggal Arsip Harus Dengan Format.',
            'tgl_arp.date_format' => 'Tanggal Arsip Harus Dalam Format Tahun-Bulan-Tanggal.',
            'publisher_arp.required' => 'Publisher Arsip Harus Diisi.',
            'publisher_arp.max' => 'Publisher Arsip Hanya Menampung 255 Kata.',
            'publisher_arp.min' => 'Publisher Arsip Minimal 3 Kata.',
        ]);

        $arp = Arsip::where('id', $id)->first();
        $arp->update([
            'judul_arp' => $request->judul_arp,
            'link_arp' => $request->link_arp,
            'tgl_arp' => $request->tgl_arp,
            'publisher_arp' => $request->publisher_arp,
        ]);
        if (auth()->user()->id_role == 888) {
            return redirect(route('admin.arsip.index'))->with('sukses', 'Berhasil Tambah Data!');
        } elseif (auth()->user()->id_role == 1000) {
            return redirect(route('penris.arsip.index'))->with('sukses', 'Berhasil Tambah Data!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $arp = Arsip::where('id', $id)->first();
        $arp->delete($id);

        if (auth()->user()->id_role == 888) {
            return redirect(route('admin.arsip.index'))->with('sukses', 'Berhasil Hapus Data!');
        } elseif (auth()->user()->id_role == 1000) {
            return redirect(route('penris.arsip.index'))->with('sukses', 'Berhasil Hapus Data!');
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('index', 'create', 'store', 'show', 'edit', 'update', 'destroy');
    }
}
