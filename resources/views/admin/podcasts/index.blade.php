@extends('layouts.admin.app')
@section('title', 'Kelola Podcast')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="cardi card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Kelola Podcast</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Featured</th>
                                    <th>Top Page</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($podcasts as $index => $podcast)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $podcast->judul }}</td>
                                        <td>{{ $podcast->kategori }}</td>
                                        <td>{{ $podcast->features_podcast ? 'Ya' : 'Tidak' }}</td>
                                        <td>{{ $podcast->top_podcast ? 'Ya' : 'Tidak' }}</td>
                                        <td>
                                            <a href="{{ route('admin.podcasts.edit', $podcast->id) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="fa-solid fa-marker"></i>
                                            </a>
                                            <form action="{{ route('admin.podcasts.destroy', $podcast->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection