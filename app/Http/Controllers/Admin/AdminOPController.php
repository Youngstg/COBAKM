<?php

namespace App\Http\Controllers\Admin;

use App\Models\OP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminOPController extends Controller
{
    // public function checker($link_id)
    // {
    //    $link = explode("/file/d/", $link_id);

    //    if (count($link) >= 2) {
    //       $link_id = $link[1];
    //       $check_view = strpos($link_id, '/view');
    //       $check_preview = strpos($link_id, '/preview');
    //       if ($check_view !== false)
    //          $link_id = substr($link_id, 0, $check_view);
    //       elseif ($check_preview !== false)
    //          $link_id = substr($link_id, 0, $check_preview);
    //       else
    //          $link_id = null;
    //    }
    //    return $link_id;
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.op.index', [
            'ops' => OP::paginate(10),
            'op_route' => auth()->user()->id_role == 888 ? 'admin.operasional.'
               : (auth()->user()->id_role == 999 ? 'op.operasional.' : ''),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.op.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3|max:255',
            'kategori' => 'required|integer|between:1,2',
            'catatan' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama.required' => 'Nama aset harus diisi.',
            'nama.max' => 'Nama aset maksimal 255 karakter.',
            'nama.min' => 'Nama aset minimal 3 karakter.',
            'kategori.required' => 'Kategori aset harus diisi.',
            'kategori.integer' => 'Form yang diisi mungkin error, silakan isi kembali dengan benar dan coba lagi.',
            'kategori.between' => 'Form yang diisi mungkin error, silakan isi kembali dengan benar dan coba lagi.',
        ]);

        // $link = explode("/file/d/", $request->gambar);

        // if (count($link) >= 2) {
        //     $link_id = $link[1];
        //     $check_view = strpos($link_id, '/view');
        //     $check_preview = strpos($link_id, '/preview');
        //     if ($check_view !== false)
        //         $link_id = substr($link_id, 0, $check_view);
        //     elseif ($check_preview !== false)
        //         $link_id = substr($link_id, 0, $check_preview);
        //     else
        //         $link_id = NULL;
        // }
        // else
        //     $link_id = $request->gambar;
        $path_image = $request->file('gambar')->store(
            'images/op',
            'public'
        );
        OP::create([
            'nama_op' => $request->nama,
            'kategori_op' => $request->kategori,
            'catatan_op' => $request->catatan,
            'gambar_op' => $path_image,
        ]);

        if (auth()->user()->id_role == 888) {
            return redirect('admin/operasional')->with('sukses', 'Berhasil Tambah Data!');
        } elseif (auth()->user()->id_role == 999) {
            return redirect('op/operasional')->with('sukses', 'Berhasil Tambah Data!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $op = OP::where('id', $id)->first();
        if (! $op) {
            abort(404);
        }

        return view('admin.op.read', compact('op'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $op = OP::where('id', $id)->first();
        if (! $op) {
            abort(404);
        }

        return view('admin.op.update', compact('op'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|min:3|max:255',
            'kategori' => 'required|integer|between:1,2',
            'catatan' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama.required' => 'Nama aset harus diisi.',
            'nama.max' => 'Nama aset maksimal 255 karakter.',
            'nama.min' => 'Nama aset minimal 3 karakter.',
            'kategori.required' => 'Kategori aset harus diisi.',
            'kategori.integer' => 'Form yang diisi mungkin error, silakan isi kembali dengan benar dan coba lagi.',
            'kategori.between' => 'Form yang diisi mungkin error, silakan isi kembali dengan benar dan coba lagi.',
        ]);

        $op = OP::where('id', $id)->first();
        if (! $op) {
            abort(404);
        }

        // if (strpos($request->gambar, 'https')!==false){
        //     $link = explode("/file/d/", $request->gambar);
        //     if (count($link) >= 2){
        //         $link_id = $link[1];
        //         $check_view = strpos($link_id, '/view');
        //         $check_preview = strpos($link_id, '/preview');
        //         if ($check_view !== false){
        //             $link_id = substr($link_id, 0, $check_view);
        //         }elseif ($check_preview !== false){
        //             $link_id = substr($link_id, 0, $check_preview);
        //         }else{
        //             $link_id = $request->gambar;
        //         }
        //     }
        // }else{
        //     $link_id = NULL;
        // }
        $path_name = $op->gambar_op;
        if ($request->hasFile('gambar')) {
            $path_name = $request->file('gambar')->store('images/op', 'public');
            if ($op->gambar_op) {
                Storage::disk('public')->delete($op->gambar_op);
            }
        }

        $op->update([
            'nama_op' => $request->nama,
            'kategori_op' => $request->kategori,
            'catatan_op' => $request->catatan,
            'gambar_op' => $path_name,
        ]);
        if ($request->filled('tgl_publish')) {
            $update['published_at'] = date('Y-m-d H:i:s', strtotime($request->tgl_publish));
        } else {
            $update['published_at'] = $op->created_at;
        }

        $op->update($update);

        if (auth()->user()->id_role == 888) {
            return redirect('admin/operasional')->with('sukses', 'Berhasil Ubah Data!');
        } elseif (auth()->user()->id_role == 999) {
            return redirect('op/operasional')->with('sukses', 'Berhasil Ubah Data!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $op = OP::where('id', $id)->first();
        if (! $op) {
            abort(404);
        }

        Storage::disk('public')->delete($op->gambar_op);
        $op->delete();

        if (auth()->user()->id_role == 888) {
            return redirect('admin/operasional')->with('sukses', 'Berhasil Hapus Data!');
        } elseif (auth()->user()->id_role == 999) {
            return redirect('op/operasional')->with('sukses', 'Berhasil Hapus Data!');
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('index', 'create', 'checker', 'store', 'show', 'edit', 'update', 'destroy');
    }
}
