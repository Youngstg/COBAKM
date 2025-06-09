@extends('layouts.admin.app')

@section('title', 'Kelola Arsip')

@section('content')
    <!--./Tabel User-->
    <section class="con tent">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Semua Arsip</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="overflow-x:overlay">
                            @if ($arsips->count() >= 0)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Judul Arsip</th>
                                            <th>Link Arsip</th>
                                            <th>More</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($arsips as $arp => $value)
                                            <tr>
                                                <td class="text-center">{{ $arsips->firstItem() + $arp }}</td>
                                                <td>{{ $value->judul_arp }}</td>
                                                <td>{{ $value->link_arp }}</td>
                                                <td>
                                                    @if(auth()->user()->id_role == 888)
                                                    <a href="{{ route('admin.arsip.show', $value->id)}}" class="btn btn-info mr-1"><i class="fa-solid fa-eye"></i></a>
                                                    <a href="{{ route('admin.arsip.edit', $value->id)}}" class="btn btn-primary"><i class="fa-solid fa-marker"></i></a>
                                                    @elseif(auth()->user()->id_role == 1000)
                                                    <a href="{{ route('penris.arsip.show', $value->id)}}" class="btn btn-info mr-1"><i class="fa-solid fa-eye"></i></a>
                                                    <a href="{{ route('penris.arsip.edit', $value->id)}}" class="btn btn-primary"><i class="fa-solid fa-marker"></i></a>
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
                                                                        <strong>Hapus Arsip</strong>
                                                                    </h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah Anda yakin ingin menghapus data ini? <br>
                                                                    "{{ $value->judul_arp }}"
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form
                                                                        action="{{ route('admin.arsip.destroy', $value->id) }}"
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
                                Saat ini, belum ada arsip yang tersedia.
                            @endif
                        </div>
                        <!-- /.card-body -->
                        @if ($arsips->count() > 0)
                            <div class="card-footer clearfix">
                                {{ $arsips->links('pagination::simple-bootstrap-5') }}
                            </div>
                        @endif
                    </div>

                </div>
                <!-- /.card -->
            </div>
        </div>
        </div>
    </section>
@endsection
