@extends('layouts.admin.app')

@section('title', 'Tambah User')

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
                        <h3 class="card-title">Tambah User Baru</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ route('admin.user.store') }}" enctype='multipart/form-data'>
                        @csrf
                        <div class="card-body" style="overflow-x:overlay;">
                            <div class="form-group">
                                <label for="id_role">Role</label>
                                <select name="id_role" required
                                    class="custom-select form-control-border @error('id_role') is-invalid @enderror"
                                    id="id_role">
                                    <option selected value="">=== PILIH ROLE ===</option>
                                    <option value="888">Super Administrator</option>
                                    <option value="1111">Ekonomi Kreatif</option>
                                </select>
                                @error('id_role')
                                    <div id="id_role-error" class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                    placeholder="Masukkan Nama..." required value="{{ old('nama') }}">
                                @error('nama')
                                    <div id="nama-error" class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input name="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    placeholder="Masukan Email (contoh@gmail.com)" required value="{{ old('email') }}">
                                @error('email')
                                    <div id="email-error" class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input name="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" id="password"
                                    placeholder="Masukan Password..." required autocomplete="new-password">
                                @error('password')
                                    <div id="password-error" class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Ulangi Password</label>
                                <input name="password_confirmation" type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="password_confirmation" placeholder="Ulangi Password..." required
                                    autocomplete="new-password">
                                @error('password_confirmation')
                                    <div id="password_confirmation-error" class="error invalid-feedback">{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.card -->
@endsection