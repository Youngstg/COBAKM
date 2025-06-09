<?php

namespace App\Http\Controllers\Admin;

use App\Models\ItemTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class AdminTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Transaksi::query();

        if ($request->has('search')) {
            $query->where('id', 'like', '%' . $request->input('search') . '%');
        }

        $transaksis = $query->with([
            'daftar_produk' => function ($query) {
                $query->with('varian_produk', 'produk');
            }
        ])->paginate(10);


        return view('admin.transaksi.index', [
            'transaksis' => $transaksis,

        ]);
    }

}
