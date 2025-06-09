<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ali;
use App\Models\Arsip;
use App\Models\ATK;
use App\Models\BSW;
use App\Models\KMActivity;
use App\Models\OP;
use App\Models\Ormawa;
use App\Models\Podcast;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class AdminCMSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'admin.index',
            [
                'atk_count' => ATK::count(),
                // 'op_count' => OP::count(),
                'user_count' => User::count(),
                // 'bsw_count' => BSW::count(),
                // 'arp_count' => Arsip::count(),
                // 'ali_count' => Ali::count(),
                'transaksi_count' => Transaksi::count(),
                'podcast_count' => Podcast::count(),
                'produk_count' => Produk::count(),
                'ormawa_count' => Ormawa::count(),
                'activity_count' => KMActivity::count(),
                'cms_route' => auth()->user()->id_role == 888 ? 'admin.'
                    : (auth()->user()->id_role == 1111 ? 'ekraf.' : ''),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function __construct()
    {
        $this->middleware('guest')->except('index', 'create', 'store', 'show', 'edit', 'update', 'destroy');
    }
}
