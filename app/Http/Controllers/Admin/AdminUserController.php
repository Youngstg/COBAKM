<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.user.index', [
            'users' => DB::table('users')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::get();

        return view('admin.user.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi data user
        $request->validate([
            'id_role' => 'required',
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required|same:password',
        ], [
            'id_role.required' => 'Role harus dipilih.',
            'nama.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email harus diisi dengan format yang benar.',
            'password.confirmed' => 'Isian password dan ulangi password harus sama.',
            'password_confirmation.required' => 'Password harus dimasukkan kembali di sini.',
            'password_confirmation.same' => 'Isian password dan ulangi password harus sama.',
        ]);

        User::create([
            'id_role' => $request->id_role,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('admin/user')->with('sukses', 'Berhasil Tambah Data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = User::where('id', $id)->first();

        return view('admin.user.read', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::where('id', $id)->first();

        if (! $users) {
            abort(404);
        }

        return view('admin.user.update', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_role' => 'required',
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|confirmed|required_with:password_confirmation',
            'password_confirmation' => 'required_with:password|same:password',
        ], [
            'id_role.required' => 'Role harus dipilih.',
            'nama.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email harus diisi dengan format yang benar.',
            'password.confirmed' => 'Isian password dan ulangi password harus sama.',
            'password_confirmation.required_with' => 'Password harus dimasukkan kembali di sini.',
            'password.required_with' => 'Isian password dan ulangi password harus sama.',
            'password_confirmation.same' => 'Isian password dan ulangi password harus sama.',
        ]);

        $user = User::where('id', $id)->first();

        if (! $user) {
            abort(404);
        }

        // if ($request->input('password') ==  $user->password) {
        //     $password = $user->password;
        // }else {
        //     $password =  Hash::make($request->password) ;
        // }

        $update = [
            'id_role' => $request->id_role,
            'nama' => $request->nama,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $update['password'] = Hash::make($request->password);
        }

        $user->update($update);

        return redirect('admin/user')->with('sukses', 'Berhasil Edit Data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::where('id', $id)->first();
        $data->delete();

        return redirect('admin/user')->with('sukses', 'Berhasil Hapus Data!');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('index', 'create', 'store', 'show', 'edit', 'update', 'destroy');
    }
}
