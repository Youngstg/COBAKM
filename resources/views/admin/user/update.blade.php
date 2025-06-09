@extends('layouts.admin.app')

@section('title', 'Ubah Data User')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Ubah Data User "{{ $users->nama }}"</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('admin.user.update', $users->id) }}"
                            enctype='multipart/form-data'>
                            @csrf
                            @method('PUT')
                            <div class="card-body" style="overflow-x:overlay;">
                                <div class="form-group">
                                    <label for="id_role">Role</label>
                                    <select name="id_role" required
                                        class="custom-select form-control-border @error('id_role') is-invalid @enderror"
                                        id="id_role">
                                        <option value="">=== PILIH ROLE ===</option>
                                        <option value="888" {{ $users->id_role == 888 ? "selected" : "" }}>Super Administrator</option>
                                        <option value="999" {{ $users->id_role == 999 ? "selected" : "" }}>Operasional</option>
                                        <option value="1000" {{ $users->id_role == 1000 ? "selected" : "" }}>Penristek</option>
                                    </select>
                                    @error('id_role')
                                        <div id="id_role-error" class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input name="nama" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" placeholder="Masukkan Nama..." required value="{{ old('nama') ?? $users->nama }}">
                                    @error('nama')
                                        <div id="nama-error" class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input name="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        placeholder="Masukan Email (contoh@gmail.com)" required value="{{ old('email') ?? $users->email }}">
                                    @error('email')
                                        <div id="email-error" class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password (opsional)</label>
                                    <input name="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" id="password"
                                        placeholder="Masukan Password..." autocomplete="new-password">
                                    @error('password')
                                        <div id="password-error" class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div id="passwordHelpBlock" class="form-text">
                                        Isi hanya jika password ingin diubah. Jika dikosongkan, password tidak akan berubah.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Ulangi Password (opsional)</label>
                                    <input name="password_confirmation" type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"
                                        placeholder="Ulangi Password..." autocomplete="new-password">
                                    @error('password_confirmation')
                                        <div id="password_confirmation-error" class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div id="password_confirmationHelpBlock" class="form-text">
                                        Wajib diisi dengan isian yang sama, jika input password tidak kosong.
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                @endsection
