@extends('layouts.admin.app')

@section('title', 'Kelola Alur Sistem')

@section('content')
<!--./Tabel User-->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Semua Alur Sistem</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body d-flex" style="overflow-x:overlay">
                        <table class="table table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Alur Sitem</th>
                                    <th>Link Alur Sistem</th>
                                    <th>Foto Alur Sistem</th>
                                    <th>More</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dummy as $dummies)
                                    <tr>
                                        <td class="text-center">{{ $dummies->id }}</td>
                                        <td>{{ $dummies->nama_dummy }}</td>
                                        <td class="overflow-auto">{{ Str::limit($dummies->link_dummy, 30) }}</td>
                                        <td><img src="{{ asset("storage/" . $dummies->foto_dummy) }}"
                                                style="width:100px; heigth:100px" alt=""></td>
                                        <td>
                                            <a href="{{ route('admin.dummy.show', $dummies->id)}}"
                                                class="btn btn-info mr-1"><i class="fa-solid fa-eye"></i></a>
                                            <a href="{{ route('admin.dummy.edit', $dummies->id)}}"
                                                class="btn btn-primary"><i class="fa-solid fa-marker"></i></a>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-danger ml-1" data-toggle="modal"
                                                data-target="#hapus-{{ $dummies->id }}"><i
                                                    class="fa-solid fa-trash-can"></i></button>
                                            <!-- Modal -->
                                            <div id="hapus-{{ $dummies->id }}" class="modal fade" tabindex="-1"
                                                role="dialog" aria-hidden="true">
                                                <div class="modal-dialog bd-danger">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel"><strong>Hapus
                                                                    User</strong></h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus beasiswa ini? <br>
                                                            "{{ $dummies->nama_dummies }}"
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{route('admin.dummy.destroy', $dummies->id)}}"
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
                    {{-- <div class="card-footer clearfix">
                        {{ $dummy->links() }}
                    </div> --}}
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
@endsection