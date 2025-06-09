<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\kbt;
use Illuminate\Support\Facades\DB;

class ClientProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logoKM = DB::table('dummy')->selectRaw('foto_dummy')->where('nama_dummy', 'Logo Gasendra')->get();

        return view('client.profile.kabinet', [
            'kbts' => kbt::all(),
        ]);
    }

    public function show(string $notuse, string $nama_kbt)
    {

        $kbts = kbt::where('nama_kbt', $nama_kbt)->first();
        if (!$kbts) {
            abort(404);
        }

        return view('client.profile.organigram', compact('kbts', 'logos'));
    }
}
