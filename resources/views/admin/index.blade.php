@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex flex-wrap">
                @if(auth()->user()->id_role == 888)
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="fa-solid fa-users fa-2xl text-primary float-left"></i>
                                        </div>
                                        <div class="media-body text-right">
                                            <h3>{{ $user_count }}</h3>
                                            <span>User</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    <a href="{{ route($cms_route . 'user.index') }}"
                                        class="text-decoration-none text-dark {{ Request::routeIs($cms_route . 'user.index') ? 'active' : '' }}">Kelola
                                        User</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="fa-solid fa-person-running fa-2xl float-left"
                                                style="color: orange"></i>
                                        </div>
                                        <div class="media-body text-right">
                                            <h3>{{$activity_count}}</h3>
                                            <span>Aktivitas KM</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    <a href="{{ route($cms_route . 'km-activity.index') }}"
                                        class="text-decoration-none text-dark {{ Request::routeIs($cms_route . 'km-activity.index') ? 'active' : '' }}">Kelola
                                        Aktivitas KM</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="fa-solid fa-podcast fa-2xl text-success float-left"></i>
                                        </div>
                                        <div class="media-body text-right">
                                            <h3>{{$podcast_count}}</h3>
                                            <span>Podcast KM</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    <a href="{{ route($cms_route . 'podcasts.index') }}"
                                        class="text-decoration-none text-dark {{Request::routeIs($cms_route . 'podcasts.index') ? 'active' : '' }}">Kelola
                                        Podcast KM</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="fa-solid fa-newspaper fa-2xl text-info float-left"></i>
                                        </div>
                                        <div class="media-body text-right">
                                            <h3>{{ $atk_count }}</h3>
                                            <span>Artikel</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    <a href="{{ route($cms_route . 'artikel.index') }}"
                                        class="text-decoration-none text-dark {{ Request::routeIs($cms_route . 'artikel.index') ? 'active' : '' }}">Kelola
                                        Artikel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="fa-solid fa-sitemap fa-2xl text-secondary float-left"></i>
                                        </div>
                                        <div class="media-body text-right">
                                            <h3>{{$ormawa_count}}</h3>
                                            <span>Organisasi Mahasiswa</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    <a href="{{ route($cms_route . 'ormawa.index') }}"
                                        class="text-decoration-none text-dark {{ Request::routeIs($cms_route . 'ormawa.index') ? 'active' : '' }}">Kelola
                                        Organisasi Mahasiswa</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- Ekraf -->
                @if(auth()->user()->id_role == 888 or auth()->user()->id_role == 1111)
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="fa-solid fa-cart-shopping fa-2xl text-warning float-left"></i>
                                        </div>
                                        <div class="media-body text-right">
                                            <h3>{{ $transaksi_count }}</h3>
                                            <span>Transaksi</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    <a href="{{ route($cms_route . 'transaksi.index') }}"
                                        class="text-decoration-none text-dark">Lihat Transaksi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="fa-solid fa-shirt fa-2xl text-danger float-left"></i>
                                        </div>
                                        <div class="media-body text-right">
                                            <h3>{{ $produk_count }}</h3>
                                            <span>Produk</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    <a href="{{ route($cms_route . 'produk.index') }}"
                                        class="text-decoration-none text-dark {{ Request::routeIs($cms_route . 'produk.index') ? 'active' : '' }}">
                                        Kelola Produk</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection