@extends('layouts.admin.app')
@section('title', 'Kelola Ormawa')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Kelola Ormawa</h3>
                        </div>
                        <div class="card-body">
                            <h4>HMPS</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10%">No</th>
                                        <th style="width: 40%">Detail</th>
                                        <th style="width: 20%">Aksi</th>
                                        <th style="width: 20%">Pindah Urutan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hmps as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>
                                                <strong>{{ $item->name }}</strong><br>
                                                <a href="{{ $item->website }}">{{ $item->website }}</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.ormawa.edit', ['slug' => $item->slug, 'type' => 'HMPS']) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fa-solid fa-marker"></i>
                                                </a>
                                                <form
                                                    action="{{ route('admin.ormawa.destroy', ['slug' => $item->slug, 'type' => 'HMPS']) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="text-center">
                                                <form
                                                    action="{{ route('admin.ormawa.changeOrder', ['slug' => $item->slug, 'type' => 'HMPS', 'direction' => 'up']) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm">
                                                        <i class="fas fa-arrow-up"></i>
                                                    </button>
                                                </form>
                                                <form
                                                    action="{{ route('admin.ormawa.changeOrder', ['slug' => $item->slug, 'type' => 'HMPS', 'direction' => 'down']) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm">
                                                        <i class="fas fa-arrow-down"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper">
                                <div id="pagination-hmps">
                                    {{ $hmps->withQueryString()->appends(['ukms_page' => $ukms->currentPage()])->links('pagination::simple-bootstrap-5') }}
                                </div>
                            </div>
                            <h4 class="mt-4">UKM</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10%">No</th>
                                        <th style="width: 40%">Detail</th>
                                        <th style="width: 20%">Aksi</th>
                                        <th style="width: 20%">Pindah Urutan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ukms as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>
                                                <strong>{{ $item->name }}</strong><br>
                                                <a href="{{ $item->website }}">{{ $item->website }}</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.ormawa.edit', ['slug' => $item->slug, 'type' => 'UKM']) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fa-solid fa-marker"></i>
                                                </a>
                                                <form
                                                    action="{{ route('admin.ormawa.destroy', ['slug' => $item->slug, 'type' => 'UKM']) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="text-center">
                                                <form
                                                    action="{{ route('admin.ormawa.changeOrder', ['slug' => $item->slug, 'type' => 'UKM', 'direction' => 'up']) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm">
                                                        <i class="fas fa-arrow-up"></i>
                                                    </button>
                                                </form>
                                                <form
                                                    action="{{ route('admin.ormawa.changeOrder', ['slug' => $item->slug, 'type' => 'UKM', 'direction' => 'down']) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm">
                                                        <i class="fas fa-arrow-down"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper">
                                <div id="pagination-ukm">
                                    {{ $ukms->withQueryString()->appends(['hmps_page' => $hmps->currentPage()])->links('pagination::simple-bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
