<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\KMActivity;
use App\Models\TagATK;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClientTagATKController extends Controller
{
    //
    public function index(string $slug)
    {
        //
        $tag = TagATK::where('slug_tag', $slug)->first();
        $articles = TagATK::find($tag->id)
            ->atk()->where('published_at', '<=', date('Y-m-d H:i:s'))
            ->orderByDesc('published_at')
            ->paginate(10);
        $judul = 'Tag: ' . $tag->nama_tag;
        $allTag = TagATK::inRandomOrder()->limit(10)->get();
        $logoKM = DB::table('dummy')->selectRaw('foto_dummy')->where('nama_dummy', 'Logo Gasendra')->get();
        if (!$tag) {
            abort(404);
        }

        return view('client.artikel.index', compact('articles', 'judul', 'allTag'));
    }
}
