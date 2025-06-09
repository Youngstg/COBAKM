@extends('layouts.admin.app')

@section('title', 'Kelola Tag Artikel')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Semua Tag Artikel</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="overflow-x:overlay">
            @if ($tags->count() > 0)
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                    {{-- <th style="width: 40px">Label</th> --}}
                  </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $key => $tag)
                        <tr>
                            <td>{{ $tags->firstItem() + $key }}</td>
                            <td>{{ $tag->nama_tag }}</td>
                            <td>
                                <!-- Button trigger modal -->
                                <a href="{{ route('admin.tag-artikel.edit',$tag->id) }}" class="btn btn-primary">
                                    <i class="fa-solid fa-marker"></i>
                                </a>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus-{{ $tag->id }}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                                <!-- Modal -->
                                <div id="hapus-{{ $tag->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog bd-danger">
                                        <div class="modal-content bg-danger">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel"><strong>Hapus Tag Artikel</strong></h5>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus tag artikel ini? <br> <strong>"{{ $tag->nama_tag }}"</strong>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{route('admin.tag-artikel.destroy', $tag->id)}}" method="POST">
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
            @else
            Saat ini belum ada artikel yang tersedia.
            @endif
            </div>
            <!-- /.card-body -->
            @if ($tags->count() > 0)
            <div class="card-footer clearfix">
                {{ $tags->links('pagination::simple-bootstrap-5') }}
            </div>
            @endif
          </div>
          <!-- /.card -->
        </div>
        </div>
        </div>
</section>
@endsection
