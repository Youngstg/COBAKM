<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\kbt;
use Illuminate\Http\Request;

class ClientKabinetController extends Controller
{
    public function index()
    {
        $kbts = kbt::orderByDesc('tahun_kbt')->get();
        return view('client.km.tentang.index', compact('kbts'));
    }

    public function show(string $slug, Request $request)
    {
        $kbt = kbt::where('slug_kbt', $slug)->first();
        $kbts = kbt::orderByDesc('tahun_kbt')->get();

        if (!$kbt) {
            abort(404);
        }

        // Get the list of kbt objects, ordered by 'tahun_kbt'

        // Find the current index based on the 'tahun_kbt' of the selected kbt
        $currentIndex = $kbts->search(function ($item) use ($kbt) {
            return $item->getKey() == $kbt->getKey();
        });

        // If the 'slideIndex' query parameter is present, override the current index
        if ($request->has('slideIndex')) {
            $currentIndex = $request->query('slideIndex');
        } else {
            $kbts1 = $kbts->sortBy('tahun')->values();
            $kbt = $kbts1->firstWhere('status_kbt', true);
            if ($kbt) {
                $currentIndex = $kbts->search($kbt);
            } else {
                $currentIndex = null; // or set a default value if needed
            }
        }


        return view('client.km.kabinet.index', compact('kbt', 'kbts', 'currentIndex'));
    }


}
