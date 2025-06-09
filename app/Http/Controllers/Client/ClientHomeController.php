<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ATK;
use App\Models\BSW;
use App\Models\kbt;
use App\Models\KMActivity;
use App\Models\Ormawa;
use App\Models\Podcast;

class ClientHomeController extends Controller
{
    public function index()
    {
        $atks = ATK::where("features_atk", true)
            ->orderByDesc("published_at")
            ->limit(10)
            ->get();
        $bsws = BSW::limit(10)->get();
        $logos = kbt::where('status_kbt', true)->select('nama_kbt', 'logo_kbt')->get();
        $activities = KMActivity::where("features_kmac", true)->get();
        $ormawas = Ormawa::whereNotNull("image")->get();
        $featuredPodcasts = Podcast::where("features_podcast", true)->get();

        return view(
            "client.index",
            compact(
                "atks",
                "bsws",
                "logos",
                "activities",
                "ormawas",
                "featuredPodcasts"
            )
        );
    }
}
