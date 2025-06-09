<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ATK;
use App\Models\TagATK;
use Illuminate\Support\Facades\DB;

class ClientATKController extends Controller
{
    public function index()
    {
        $articles = ATK::where('published_at', '<=', date('Y-m-d H:i:s'))->orderByDesc('published_at')->paginate(10);
        $allTag = TagATK::inRandomOrder()->limit(10)->get();
        $logoKM = DB::table('dummy')->selectRaw('foto_dummy')->where('nama_dummy', 'Logo Gasendra')->get();

        return view('client.artikel.index', compact('articles', 'allTag', 'logoKM'));
    }

    public function show(string $slug)
    {
        //
        $artikel = ATK::where('slug_atk', $slug)->first();
        if (! $artikel) {
            abort(404);
        }

        return view('client.artikel.read', compact('artikel'));
    }
}
