@extends('layouts.admin.app')

@section('title', 'Kelola Aset Operasional')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Semua Aset Operasional</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="overflow-x:overlay">
                            @if ($ops->count() > 0)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Nama Aset</th>
                                            <th>Kategori Aset</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ops as $key => $op)
                                            <tr>
                                                <td>{{ $ops->firstItem() + $key }}</td>
                                                <td>{{ $op->nama_op }}</td>
                                                <td>{{ $op->kategori_op == 1 ? 'Barang' : 'Ruangan' }}</td>
                                                <td>
                                                    <a target="_blank" href="{{ route($op_route.'show', $op->id) }}"
                                                        class="btn btn-info">Lihat Detail</a>
                                                    <a href="{{ route($op_route.'edit', $op->id) }}"
                                                        class="btn btn-primary">
                                                        <i class="fa-solid fa-marker"></i>
                                                    </a>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#hapus-{{ $op->id }}">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                    <!-- Modal -->
                                                    <div id="hapus-{{ $op->id }}" class="modal fade" tabindex="-1"
                                                        role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog bd-danger">
                                                            <div class="modal-content bg-danger">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">
                                                                        <strong>Hapus Aset Operasional</strong></h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah Anda yakin ingin menghapus aset operasional ini?
                                                                    <br> <strong>"{{ $op->nama_op }}"</strong>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form
                                                                        action="{{ route($op_route.'destroy', $op->id) }}"
                                                                        method="POST">
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
                            @else
                                Saat ini belum ada aset operasional yang tersedia.
                            @endif
                        </div>
                        <!-- /.card-body -->
                        @if ($ops->count() > 0)
                            <div class="card-footer clearfix">
                                {{ $ops->links('pagination::simple-bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
