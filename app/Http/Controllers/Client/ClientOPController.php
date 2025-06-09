<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Dummy;
use App\Models\OP;
use Illuminate\Support\Facades\DB;

class ClientOPController extends Controller
{
    //
    // public function index()
    // {
    //     //
    //     return view('client.op.index', [
    //         'ops' => OP::orderByDesc('created_at')->paginate(10),
    //         'judul' => 'Semua Aset Operasional'
    //     ]);
    // }
    // public function indexKategori(string $kategori)
    // {
    //     //
    //     if (! in_array($kategori, ['barang', 'ruangan'])) {
    //         abort(404);
    //     }

    //     $cat = ($kategori == 'barang') ? 1 : 2;
    //     $ops = OP::where('kategori_op', $cat)->orderByDesc('created_at')->paginate(10);
    //     $pinjam = Dummy::where('nama_dummy', 'Link Peminjaman Operasional')->first();
    //     $pengembalian = Dummy::where('nama_dummy', 'Link Pengembalian Operasional')->first();
    //     $logoKM = DB::table('dummy')->selectRaw('foto_dummy')->where('nama_dummy', 'Logo Gasendra')->get();

    //     return view('client.op.index_'.$kategori, compact('ops', 'pinjam', 'pengembalian'));
    // }

    public function indexAlur()
    {
        $banding = Dummy::where('nama_dummy', 'Banding UKT')->first();
        $pikr = Dummy::where('nama_dummy', 'PIK-R')->first();
        $sukma = Dummy::where('nama_dummy', 'Sukma KM')->first();

        return view('client.alur_sistem.index', compact('banding', 'pikr', 'sukma'));
    }

    public function indexKritik()
    {
        $kritik = Dummy::where('nama_dummy', 'Kritik Saran')->first();

        return view('client.kritik_saran.index', compact('kritik'));
    }

    // public function show(string $kategori, $id)
    // {
    //     //
    //     $cat = ($kategori == "barang") ? 1 : 2;
    //     $op = OP::where('kategori_op', $cat)->first();

    //     if(!in_array($kategori, ['barang','ruangan']) or !$op)
    //         abort(404);

    //     return view('client.op.show', compact('op'));
    // }
}
