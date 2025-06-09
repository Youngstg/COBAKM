@extends('layouts.admin.app')

@section('title', 'Kelola User')

@section('content')
    <!--./Tabel User-->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Semua User</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="overflow-x:overlay">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Nama User</th>
                                        <th>Role</th>
                                        <th>More</th>
                                        {{-- <th style="width: 40px">Label</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user => $value)
                                    @if (Auth::user()->id != $value->id && $value->id == 1)
                                        @continue
                                    @endif
                                        <tr>
                                            <td class="text-center">{{ $users->firstItem() + $user }}</td>
                                            <td>{{ $value->nama }}</td>
                                            <td>{{ $value->id_role == 888 ? 'Super Administrator' : ($value->id_role == 1111 ? 'Ekonomi Kreatif' : ($value->id_role == 1000 ? 'Penristek' : '-')) }}</td>
                                            <td>
                                                <a href="{{ route('admin.user.show', $value->id) }}" class="btn btn-info"><i
                                                        class="fa-solid fa-eye"></i></a>
                                                <a href="{{ route('admin.user.edit', $value->id) }}"
                                                    class="btn btn-primary">
                                                    <i class="fa-solid fa-marker"></i>
                                                </a>
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
                                                                Apakah Anda yakin ingin menghapus user ini? <br>
                                                                "{{ $value->nama }}"
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('admin.user.destroy', $value->id) }}"
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
                        </div>
                        <!-- /.card-body -->
                        @if ($users->count() > 0)
                            <div class="card-footer clearfix">
                                {{ $users->links('pagination::simple-bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
