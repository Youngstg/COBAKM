<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Ali;
use App\Models\BSW;
use App\Models\LinkBSW;
use App\Models\Penristek;
use App\Models\SaiData;
use Illuminate\Support\Facades\DB;

class ClientSaiDataController extends Controller
{
    public function index()
    {
        $bsws = BSW::all();
        $alis = Ali::inRandomOrder()->take(10)->get();
        $sai = SaiData::all();
        $logoKM = DB::table('dummy')->selectRaw('foto_dummy')->where('nama_dummy', 'Logo Gasendra')->get();
        $penristeks = Penristek::all();

        return view('client.saidata.index', compact('bsws', 'alis', 'penristeks', 'sai'));
    }

    public function bsw()
    {
        $bsws = BSW::all();

        return view('client.beasiswa.index', compact('bsws'));
    }

    public function bsw_detail(string $slug)
    {
        //
        $bsw = BSW::where('slug_bsw', $slug)->first();
        $links = LinkBSW::where('bsw_id', $bsw->id)->get();
        if (! $bsw) {
            abort(404);
        }

        return view('client.beasiswa.read', compact('bsw', 'links'));
    }
}
