@extends('layouts.admin.app')

@section('title', 'Kelola Footer')

@section('content')
<!--./Tabel Footer-->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Semua Footer</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="overflow-x:overlay">
                        @if ($footers->count() > 0)
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Logo Aktif</th>
                                        <th>No. CP</th>
                                        <th>Alamat Sekre</th>
                                        <th>Sosmed</th>
                                        <th>Email</th>
                                        <th>Hak Cipta</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($footers as $footer)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                               @foreach ($logos as $logo)
                                                    @if ($logo != null)
                                                        <img src="{{ asset($logo->logo_kbt)}}" style="width:70px; heigth: 70px" alt="">
                                                    @else
                                                        <a href="logo/create">Logo Kosong</a>
                                                    @endif
                                               @endforeach
                                            </td>
                                            <td>
                                                @if($footer->no_cp)
                                                    @foreach($footer->no_cp as $no_cp)
                                                        <div>{{ $no_cp }}</div>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>{{ $footer->alamat_sekre }}</td>
                                            <td>
                                                @if($footer->sosmed)
                                                    @foreach($footer->sosmed as $sosmed)
                                                        <div>
                                                            {!! $sosmed['icon'] !!} <a href="{{ $sosmed['link'] }}">{{ $sosmed['link'] }}</a>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>{{ $footer->email }}</td>
                                            <td>{{ $footer->hak_cipta }}</td>
                                            <td>
                                                <!-- <a href="{{ route('admin.footer.show', $footer->id) }}" class="btn btn-info"><i class="fa-solid fa-eye"></i></a> -->
                                                <a href="{{ route('admin.footer.edit', $footer->id) }}" class="btn btn-primary">
                                                    <i class="fa-solid fa-marker"></i>
                                                </a>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus-{{ $footer->id }}"><i class="fa-solid fa-trash-can"></i></button>
                                                <!-- Modal -->
                                                <div id="hapus-{{ $footer->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog bd-danger">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">
                                                                    <strong>Hapus Footer</strong>
                                                                </h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus data ini? <br>
                                                                Footer "{{ $footer->alamat_sekre }}"
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('admin.footer.destroy', $footer->id) }}" method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <input type="submit" class="btn btn-danger light" value="Hapus">
                                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
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
                            Saat ini, belum ada footer yang tersedia.
                        @endif
                    </div>
                    <!-- /.card-body -->

                </div>

            </div>
            <!-- /.card -->
        </div>
    </div>
</section>
@endsection
