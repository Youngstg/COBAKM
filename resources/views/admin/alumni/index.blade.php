@extends('layouts.admin.app')

@section('title', 'Kelola Alumni')

@section('content')
    <!--./Tabel User-->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Semua Alumni</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="overflow-x:overlay">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Nama Alumni</th>
                                        <th>Jabatan Alumni</th>
                                        <th>Kerja Praktik Alumni</th>
                                        <th>Pekerjaan Alumni</th>
                                        <th>More</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alis as $ali => $value)
                                        <tr>
                                            <td class="text-center">{{ $alis->firstItem() + $ali }}</td>
                                            <td>{{ $value->nama_ali }}</td>
                                            <td>{{ $value->jabatan_ali }}</td>
                                            <td>{{ $value->kp_ali }}</td>
                                            <td>{{ $value->pkj_ali }}</td>
                                            <td>
                                                @if(auth()->user()->id_role == 888)
                                                <a href="{{ route('admin.alumni.show', $value->id) }}"
                                                    class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                                                <a href="{{ route('admin.alumni.edit', $value->id) }}"
                                                    class="btn btn-primary">
                                                    <i class="fa-solid fa-marker"></i>
                                                </a>
                                                @elseif(auth()->user()->id_role == 1000)
                                                <a href="{{ route('penris.alumni.show', $value->id) }}"
                                                    class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                                                <a href="{{ route('penris.alumni.edit', $value->id) }}"
                                                    class="btn btn-primary">
                                                    <i class="fa-solid fa-marker"></i>
                                                </a>
                                                @endif
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#hapus-{{ $value->id }}"><i
                                                        class="fa-solid fa-trash-can"></i></button>
                                                <!-- Modal -->
                                                <div id="hapus-{{ $value->id }}" class="modal fade" tabindex="-1"
                                                    role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog bd-danger">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">
                                                                    <strong>Hapus User</strong>
                                                                </h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus data ini? <br>
                                                                "{{ $value->nama_ali }}"
                                                            </div>
                                                            <div class="modal-footer">
                                                            @if(auth()->user()->id_role == 888)
                                                                <form method="POST" action="{{ route('admin.alumni.destroy', $value->id) }}"  enctype='multipart/form-data'>
                                                            @elseif(auth()->user()->id_role == 1000)
                                                                <form method="POST" action="{{ route('penris.alumni.destroy', $value->id) }}"  enctype='multipart/form-data'>
                                                            @endif
                                                            @method('DELETE')
                                                            @csrf
                                                                <input type="submit" class="btn btn-danger light"
                                                                    name="" id="" value="Hapus">
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
                            {{ $alis->links('pagination::simple-bootstrap-5') }}
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
