@extends('layouts.admin.app')

@section('title', 'Kelola Beasiswa')

@section('content')
    <!--./Tabel User-->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Semua Beasiswa</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x:overlay">
                <table class="table table-bordered">
                  <thead class="text-center">
                    <tr>
                      <th style="width: 5%;">No</th>
                      <th style="width: 20%;">Judul Beasiswa</th>
                      <th style="width: 60%;">Konten</th>
                      <th style="width: 15%">More</th>
                      {{-- <th style="width: 40px">Label</th> --}}
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($bsws as $bsw => $value)
                      <tr>
                          <td class="text-center" >{{ $bsws->firstItem() + $bsw}}</td>
                          <td>{{ $value->judul_bsw }}</td>
                          <td class="text-justify" ><div>{!! $value->konten_bsw !!}</div></td>
                          <td>
                            @if(auth()->user()->id_role == 888)
                            <a href="{{ route('admin.beasiswa.show', $value->slug_bsw)}}" class="btn btn-info mr-1"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('admin.beasiswa.edit', $value->slug_bsw)}}" class="btn btn-primary"><i class="fa-solid fa-marker"></i></a>
                            @elseif(auth()->user()->id_role == 1000)
                            <a href="{{ route('penris.beasiswa.show', $value->slug_bsw)}}" class="btn btn-info mr-1"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('penris.beasiswa.edit', $value->slug_bsw)}}" class="btn btn-primary"><i class="fa-solid fa-marker"></i></a>
                            @endif
                            <button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#hapus-{{ $value->slug_bsw }}"><i class="fa-solid fa-trash-can"></i></button>
                            <!-- Modal -->
                            <div id="hapus-{{ $value->slug_bsw }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog bd-danger">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel"><strong>Hapus User</strong></h5>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus beasiswa ini? <br> "{{ $value->judul_bsw }}"
                                        </div>
                                        <div class="modal-footer">
                                            @if(auth()->user()->id_role == 888)
                                                <form method="POST" action="{{route('admin.beasiswa.destroy', $value->slug_bsw)}}"  enctype='multipart/form-data'>
                                            @elseif(auth()->user()->id_role == 1000)
                                                <form method="POST" action="{{route('penris.beasiswa.destroy', $value->slug_bsw)}}"  enctype='multipart/form-data'>
                                            @endif
                                            @method('DELETE')
                                            @csrf
                                            <input type="submit" class="btn btn-danger light" name="" id="" value="Hapus">
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
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                {{ $bsws->links('pagination::simple-bootstrap-5') }}
              </div>
            </div>
            <!-- /.card -->
          </div>
          </div>
          </div>
  </section>
@endsection

