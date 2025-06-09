<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Ali;
use App\Models\Dummy;
use Illuminate\Support\Facades\DB;

class ClientAliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alis = Ali::all();
        $dummy = Dummy::where('nama_dummy', 'Alumni Sheet')->first();
        $logoKM = DB::table('dummy')->selectRaw('foto_dummy')->where('nama_dummy', 'Logo Gasendra')->get();

        return view('client.alumni.alumni_index', compact('alis', 'dummy', 'logoKM'));
    }
}
