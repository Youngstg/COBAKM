<?php

namespace App\Http\Controllers\Admin;

use App\Models\Photos;
use App\Models\Produk;
use App\Models\VarianProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminProdukController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index(Request $request)
   {

      $query = Produk::query();

      if ($request->has('search')) {
         $query->where('nama_produk', 'like', '%' . $request->input('search') . '%');
      }

      $produks = $query->orderBy('created_at', 'desc')->paginate(10);

      return view('admin.produk.index', [
         'produks' => $produks
      ]);
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
      return view('admin.produk.create');
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(Request $request)
   {
      $request->validate([
         'nama_produk' => 'required|string|max:255',
         'deskripsi' => 'required|string',
         'nama_varian' => 'string|max:255',
         'produk.*.ukuran' => 'required_with:produk.*.stok,produk.*.harga|string|max:255',
         'produk.*.stok' => 'required_with:produk.*.ukuran,produk.*.harga|integer|min:0',
         'produk.*.harga' => 'required_with:produk.*.ukuran,produk.*.stok|numeric|min:0',
         'foto_produk.*' => 'file|image|max:2048', // maksimum 2MB per image
      ]);

      $produk = Produk::create([
         'nama_produk' => $request->nama_produk,
         'deskripsi' => $request->deskripsi,
      ]);

      if ($request->hasFile('foto_produk')) {
         foreach ($request->file('foto_produk') as $file) {
            $path_image = $file->store('images/produks', 'public');
            Photos::create([
               'produk_id' => $produk->id,
               'url_photo' => $path_image,
            ]);
         }
      }

      foreach ($request->produk as $jenis) {

         VarianProduk::create([
            'stok' => $jenis['stok'],
            'harga' => $jenis['harga'],
            'produk_id' => $produk->id,
            'nama_varian' => $request['nama_varian'],
            'ukuran' => $jenis['ukuran'],
         ]);
      }

      if (Auth::user()->id_role == 1111) {
         return redirect(route('ekraf.produk.index'))->with(
            'sukses',
            'Berhasil menambahkan produk'
         );
      }
      return redirect(route('admin.produk.index'))->with(
         'sukses',
         'Berhasil menambahkan produk'
      );
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
      $produk = Produk::with('varianProduk')->with('photos')->findorfail($id);

      return view('admin.produk.update', compact('produk'));
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, $id)
   {
      $request->validate([
         'nama_produk' => 'required|string|max:255',
         'deskripsi' => 'required|string',
         'nama_varian' => 'string|max:255',
         'produk.*.ukuran' => 'required_with:produk.*.stok,produk.*.harga|string|max:255',
         'produk.*.stok' => 'required_with:produk.*.ukuran,produk.*.harga|integer|min:0',
         'produk.*.harga' => 'required_with:produk.*.ukuran,produk.*.stok|numeric|min:0',
         'foto_produk.*' => 'file|image|max:2048',
      ]);

      DB::transaction(function () use ($request, $id) {
         $produk = Produk::findOrFail($id);

         $produk->update([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
         ]);

         if ($request->hasFile('foto_produk')) {
            // Hapus foto produk yang lama dari local storage
            foreach ($produk->photos as $photo) {
               Storage::disk('public')->delete($photo->url_photo);
               $photo->delete();
            }

            // Upload dan tambahkan foto_produk baru
            foreach ($request->file('foto_produk') as $file) {
               $path_image = $file->store('images/produks', 'public');
               Photos::create([
                  'produk_id' => $produk->id,
                  'url_photo' => $path_image,
               ]);
            }
         }


         foreach ($request->produk as $key => $jenis) {
            if (isset($jenis['id'])) {
               // Jika ada 'id', update data yang sudah ada
               $varian = VarianProduk::find($jenis['id']);
               $varian->update([
                  'stok' => $jenis['stok'],
                  'harga' => $jenis['harga'],
                  'ukuran' => $jenis['ukuran'],
                  'nama_varian' => $request['nama_varian'],
               ]);
            } else {
               // Jika tidak ada 'id', buat data baru
               VarianProduk::create([
                  'stok' => $jenis['stok'],
                  'harga' => $jenis['harga'],
                  'ukuran' => $jenis['ukuran'],
                  'nama_varian' => $request['nama_varian'],
                  'produk_id' => $produk->id, // Sesuaikan dengan cara Anda menangani id produk
               ]);
            }
         }
      });

      if (Auth::user()->id_role == 1111) {
         return redirect(route('ekraf.produk.index'))->with(
            'sukses',
            'Berhasil mengubah produk'
         );
      }
      return redirect(route('admin.produk.index'))->with(
         'sukses',
         'Berhasil menambahkan produk'
      );
   }



   /**
    * Remove the specified resource from storage.
    */
   /**
    * Remove the specified resource from storage.
    */
   public function destroy(string $id)
   {
      DB::transaction(function () use ($id) {
         $produk = Produk::findOrFail($id);

         // Delete associated photos from storage and database
         foreach ($produk->photos as $photo) {
            Storage::disk('public')->delete($photo->url_photo);
            $photo->delete();
         }

         // Delete associated variants
         $produk->varianProduk()->delete();

         // Delete the produk
         $produk->delete();
      });

      if (Auth::user()->id_role == 1111) {
         return redirect()->route('ekraf.produk.index')->with(
            'sukses',
            'Produk berhasil dihapus'
         );
      }

      return redirect()->route('admin.produk.index')->with(
         'sukses',
         'Produk berhasil dihapus'
      );
   }
}
