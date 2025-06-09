<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Arsip;
use App\Models\SaiData;
use Illuminate\Support\Facades\DB;

class ClientArpController extends Controller
{
    public function index()
    {
        $judul = SaiData::get('judul_sai');
        $judul = $judul->unique('judul_sai');
        $logoKM = DB::table('dummy')->selectRaw('foto_dummy')->where('nama_dummy', 'Logo Gasendra')->get();
        DB::statement('SET sql_mode = ""');
        $sais = DB::table('sai')
            ->selectRaw('sai.judul_sai, sai.logo_sai, sai.sub_judul_sai, sai.created_at, COUNT(arp.id) as total_arsip, sai.slug_sub_sai as unique_id')
            ->leftJoin('arp', 'sai.id', '=', 'arp.id_sai')
            ->groupBy('sai.id')
            ->get();
        $data = json_encode($sais);

        return view('client.arsip.arp_index', [
            'judul' => $judul,
            'data' => $data,
        ], compact('logoKM'));
    }

    public function show($id)
    {
        $data = Saidata::where('slug_sub_sai', $id)->first();
        if (! $data) {
            abort(404);
        }
        $arsip = Arsip::where('id_sai', $data->id)->get();
        $arp = Arsip::where('id_sai', $data->id)->count();

        return view('client.arsip.arp_show', compact('arsip', 'data', 'arp'));
    }
}
