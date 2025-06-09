@extends('layouts.admin.app')

@section('title', 'Kelola Kabinet')

@section('content')
<!--./Tabel User-->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Semua Kabinet</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="overflow-x:overlay">
                        <table class="table table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th style="">Nama Kabinet</th>
                                    <th style="">Logo Kabinet</th>
                                    <th style="">Foto Orgranigram</th>
                                    <th style="">Nama Presma</th>
                                    <th style="">Prodi Presma</th>
                                    <th style="">Tahun Jabatan</th>
                                    <th style="">Status Kabinet</th>
                                    <th style="">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kbts as $kbt => $value)
                                    <tr>
                                        <td class="text-center">{{ $kbts->firstItem() + $kbt }}</td>
                                        <td>{{ $value->nama_kbt }}</td>
                                        <td>
                                            @if(isset($value->logo_kbt) && !empty($value->logo_kbt))
                                                <img src="{{ asset($value->logo_kbt) }}" alt="Logo Kabinet {{$value->nama_kbt}}"
                                                    style="width:100px; heigth:100px;">
                                            @else
                                                Foto tidak tersedia
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($value->foto_kbt) && !empty($value->foto_kbt))
                                                <a href="{{ $value->foto_kbt }}">Lihat Foto Organigram</a>
                                            @else
                                                Foto tidak tersedia
                                            @endif
                                        </td>
                                        <td>{{ $value->nama_presma }}</td>
                                        <td>{{ $value->prodi_presma }}</td>
                                        <td>{{ $value->tahun_kbt }} - {{ $value->tahun_kbt + 1}}</td>
                                        <td>{{ $value->status_kbt == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                                        <td>
                                            {{-- <a href="{{ route('admin.logo.create', ['id' => $value->id]) }}"
                                                class="btn btn-success">Tambah Definisi Logo</a> --}}
                                            <a href="{{ route('admin.kabinet.show', $value->slug_kbt) }}"
                                                class="btn btn-info mr-1"><i class="fa-solid fa-eye"></i></a>
                                            <a href="{{ route('admin.kabinet.edit', $value->slug_kbt) }}"
                                                class="btn btn-primary"><i class="fa-solid fa-marker"></i></a>

                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-danger ml-1" data-toggle="modal"
                                                data-target="#hapus-{{ $value->slug_kbt }}"><i
                                                    class="fa-solid fa-trash-can"></i></button>


                                            <!-- Modal Delete -->
                                            <div id="hapus-{{ $value->slug_kbt }}" class="modal fade" tabindex="-1"
                                                role="dialog" aria-hidden="true">
                                                <div class="modal-dialog bd-danger">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">
                                                                <strong>Hapus User</strong>
                                                            </h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus beasiswa ini? <br>
                                                            "{{ $value->nama_kbt }}"
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form
                                                                action="{{ route('admin.kabinet.destroy', $value->slug_kbt) }}"
                                                                method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <input type="submit" class="btn btn-danger light" name=""
                                                                    id="" value="Hapus">
                                                                <button type="button" class="btn btn-primary"
                                                                    data-dismiss="modal">Tidak</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.modal -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{ $kbts->links() }}
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
@endsection