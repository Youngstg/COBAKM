<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use App\Models\Produk;
use Illuminate\Http\Request;

class ClientProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $productsQuery = Produk::with('varianProduk');

        if ($search) {
            $productsQuery->where('nama_produk', 'like', "%{$search}%")
                ->orWhere('deskripsi', 'like', "%{$search}%");
        }

        $products = $productsQuery->paginate(12);
        $carousels = Carousel::orderBy('order')->get();

        return view('client.produk.home', compact('products', 'carousels', 'search'));
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
        $product = Produk::with([
            'varianProduk' => function ($query) {
                $query->where('stok', '>', 0);
            }
        ])->findOrFail($id);

        return view('client.produk.detail', compact('product'));
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
}
