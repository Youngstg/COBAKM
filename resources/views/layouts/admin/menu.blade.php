<style>
    #beasiswa,
    #saidata,
    #arsip,
    #op,
    #penris,
    #alumni {
        display: none !important;
    }
</style>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/" class="nav-link" target="_blank">Kunjungi Beranda <i
                    class="nav-icon fas fa-solid fa-up-right-from-square"></i></a>
        </li>
        <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link">Logout</a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
@auth
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
            @if($logos->count() != 0)
                @foreach ($logos as $logo)
                    <img src="{{ asset($logo->logo_kbt) }}" alt="logo-km-itera" class="brand-image">
                @endforeach
            @else
                <img src="{{ asset('assets/images/km_logo_400x500.png') }}" alt="logo-km-itera" class="brand-image">
            @endif
            <span class="">CMS KM ITERA</span>

        </a>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 mb-3">
                <div class="info flex-row">
                    <img src="{{ asset('assets/images/user.svg') }}" alt="icon-user" class="brand-image">
                    <a href="" class="mx-3">{{ auth()->user()->nama }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                                                                                                                                                                                                                                                                            with font-awesome or any other icon font library -->
                    @if (auth()->user()->id_role == 888)
                        <li class="nav-item">
                            <a href="{{ route('admin.cms.index') }}"
                                class="nav-link {{ Request::routeIs('admin.cms.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-solid fa-chart-pie"></i>
                                <p>
                                    Dashboard CMS
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a role="button" class="nav-link {{ Request::routeIs('admin.user.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-solid fa-users"></i>
                                <p>
                                    User
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.user.create') }}"
                                        class="nav-link {{ Request::routeIs('admin.user.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah User</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.user.index') }}"
                                        class="nav-link {{ Request::routeIs('admin.user.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola Data User</p>
                                    </a>
                            </ul>
                        </li>
                        <li id="beasiswa" class="nav-item">
                            <a role="button" class="nav-link {{ Request::routeIs('admin.beasiswa.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-solid fa-star"></i>
                                <p>
                                    Beasiswa
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.beasiswa.create') }}"
                                        class="nav-link {{ Request::routeIs('admin.beasiswa.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Beasiswa</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.beasiswa.index') }}"
                                        class="nav-link {{ Request::routeIs('admin.beasiswa.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola Beasiswa</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li id="alumni" class="nav-item">
                            <a role="button" class="nav-link {{ Request::routeIs('admin.alumni.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-solid fa-user-graduate"></i>
                                <p>
                                    Alumni
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.alumni.create') }}"
                                        class="nav-link {{ Request::routeIs('admin.alumni.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Alumni</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.alumni.index') }}"
                                        class="nav-link {{ Request::routeIs('admin.alumni.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola Alumni</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li id="op" class="nav-item">
                            <a role="button" class="nav-link {{ Request::routeIs('admin.operasional.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-solid fa-user-gear"></i>
                                <p>
                                    Operasional
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.operasional.create') }}"
                                        class="nav-link {{ Request::routeIs('admin.operasional.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Aset</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.operasional.index') }}"
                                        class="nav-link {{ Request::routeIs('admin.operasional.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola Aset</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a role="button" class="nav-link {{ Request::routeIs('admin.dummy.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Alur Sistem
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.dummy.create') }}"
                                        class="nav-link {{ Request::routeIs('admin.dummy.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Alur Sistem</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.dummy.index') }}"
                                        class="nav-link {{ Request::routeIs('admin.dummy.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola Alur Sistem</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-header">Konten</li>
                        <li class="nav-item">
                            <a role="button" class="nav-link {{ Request::routeIs('admin.artikel.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-solid fa-newspaper"></i>
                                <p>
                                    Artikel
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.artikel.create') }}"
                                        class="nav-link {{ Request::routeIs('admin.artikel.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Buat Artikel Baru</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.artikel.index') }}"
                                        class="nav-link {{ Request::routeIs('admin.artikel.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola Artikel</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a role="button" class="nav-link {{ Request::routeIs('admin.tag-artikel.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-solid fa-tags"></i>
                                <p>
                                    Tag
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.tag-artikel.create') }}"
                                        class="nav-link {{ Request::routeIs('admin.tag-artikel.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Buat Tag Baru</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.tag-artikel.index') }}"
                                        class="nav-link {{ Request::routeIs('admin.tag-artikel.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola Tag</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li id="penris" class="nav-item">
                            <a role="button" class="nav-link {{ Request::routeIs('admin.penristek.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-solid fa-file"></i>
                                <p>
                                    Penristek
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.penristek.create') }}"
                                        class="nav-link {{ Request::routeIs('admin.penristek.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Buat Penristek Baru</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.penristek.index') }}"
                                        class="nav-link {{ Request::routeIs('admin.penristek.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola Penristek</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a role="button" class="nav-link {{ Request::routeIs('admin.footer.*') ? 'active' : '' }}">
                                <i class="fa-solid fa-person-running"></i>
                                <p>
                                    KM Activity
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.km-activity.index') }}"
                                        class="nav-link {{ Request::routeIs('admin.km-activity.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola KM Activity</p>
                                    </a>
                                </li>
                                <li class="nav-item hidden">
                                    <a href="{{ route('admin.km-activity.create') }}"
                                        class="nav-link {{ Request::routeIs('admin.km-activity.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah KM Activity</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a role="button" class="nav-link {{ Request::routeIs('admin.podcasts.*') ? 'active' : '' }}">
                                <i class="fa-solid fa-microphone"></i>
                                <p>
                                    Podcast
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.podcasts.index') }}"
                                        class="nav-link {{ Request::routeIs('admin.podcasts.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola Podcast</p>
                                    </a>
                                </li>
                                <li class="nav-item hidden">
                                    <a href="{{ route('admin.podcasts.create') }}"
                                        class="nav-link {{ Request::routeIs('admin.podcasts.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Podcast</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-header">Kabinet</li>
                        <li class="nav-item">
                            <a role="button" class="nav-link {{ Request::routeIs('admin.kabinet.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-solid fa-circle-dot"></i>
                                <p>
                                    Kabinet
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.kabinet.create') }}"
                                        class="nav-link {{ Request::routeIs('admin.kabinet.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Kabinet</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.kabinet.index') }}"
                                        class="nav-link {{ Request::routeIs('admin.kabinet.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola Kabinet</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-header">Ekraf</li>
                        <li class="nav-item">
                            <a role="button" class="nav-link {{ Request::routeIs('admin.produk.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-solid fa-cubes"></i>
                                <p>
                                    Produk
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.produk.index') }}"
                                        class="nav-link {{ Request::routeIs('admin.produk.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola Produk</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.produk.create') }}"
                                        class="nav-link {{ Request::routeIs('admin.produk.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Produk</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a role="button" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-credit-card-alt "></i>
                                <p>
                                    Transaksi
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.transaksi.index') }}"
                                        class="nav-link {{ Request::routeIs('admin.transaksi.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola Transaksi</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a role="button" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-image "></i>
                                <p>
                                    Banner
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.carousel.create') }}"
                                        class="nav-link {{ Request::routeIs('admin.carousel.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Banner</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.carousel.index') }}"
                                        class="nav-link {{ Request::routeIs('admin.carousel.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola Banner</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-header">Ormawa</li>
                        <li class="nav-item">
                            <a role="button" class="nav-link {{ Request::routeIs('admin.ormawa.*') ? 'active' : '' }}">
                                <i class="fa-solid fa-scale-balanced"></i>
                                <p>
                                    Ormawa
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.ormawa.create') }}"
                                        class="nav-link {{ Request::routeIs('admin.ormawa.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Ormawa</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.ormawa.index') }}"
                                        class="nav-link {{ Request::routeIs('admin.ormawa.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola Ormawa</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-header">Layout</li>
                        <li class="nav-item">
                            <a role="button" class="nav-link {{ Request::routeIs('admin.footer.*') ? 'active' : '' }}">
                                <i class="fa-solid fa-copyright"></i>
                                <p>
                                    Footer
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.footer.index') }}"
                                        class="nav-link {{ Request::routeIs('admin.footer.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola Footer</p>
                                    </a>
                                </li>
                                <li class="nav-item hidden">
                                    <a href="{{ route('admin.footer.create') }}"
                                        class="nav-link {{ Request::routeIs('admin.footer.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Footer</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li id="saidata" class="nav-header">SaiData</li>
                        <li id="saidata" class="nav-item">
                            <a role="button" class="nav-link {{ Request::routeIs('admin.saidata.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-server"></i>
                                <p>
                                    SaiData
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.saidata.create') }}"
                                        class="nav-link {{ Request::routeIs('admin.saidata.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah SaiData</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.saidata.index') }}"
                                        class="nav-link {{ Request::routeIs('admin.saidata.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola SaiData</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li id="arsip" class="nav-item">
                            <a role="button" class="nav-link {{ Request::routeIs('admin.arsip.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-folder"></i>
                                <p>
                                    Arsip
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.arsip.index') }}"
                                        class="nav-link {{ Request::routeIs('admin.arsip.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola Arsip</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @elseif(auth()->user()->id_role == 1111)
                        <li class="nav-header">Ekraf</li>
                        <li class="nav-item">
                            <a role="button" class="nav-link {{ Request::routeIs('ekraf.produk.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-solid fa-cubes"></i>
                                <p>
                                    Produk
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('ekraf.produk.index') }}"
                                        class="nav-link {{ Request::routeIs('ekraf.produk.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola Produk</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('ekraf.produk.create') }}"
                                        class="nav-link {{ Request::routeIs('ekraf.produk.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Produk</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a role="button" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-credit-card-alt "></i>
                                <p>
                                    Transaksi
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('ekraf.transaksi.index') }}"
                                        class="nav-link {{ Request::routeIs('ekraf.transaksi.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola Transaksi</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a role="button" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-image "></i>
                                <p>
                                    Banner
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('ekraf.carousel.create') }}"
                                        class="nav-link {{ Request::routeIs('ekraf.carousel.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Banner</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('ekraf.carousel.index') }}"
                                        class="nav-link {{ Request::routeIs('ekraf.carousel.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola Banner</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @elseif(auth()->user()->id_role == 1000)
                        <li class="nav-item">
                            <a href="{{ route('penris.cms.index') }}"
                                class="nav-link {{ Request::routeIs('penris.cms.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-solid fa-chart-pie"></i>
                                <p>
                                    Dashboard CMS
                                </p>
                            </a>
                        </li>
                        <li id="beasiswa" class="nav-item">
                            <a role="button" class="nav-link {{ Request::routeIs('penris.beasiswa.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-solid fa-star"></i>
                                <p>
                                    Beasiswa
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('penris.beasiswa.create') }}"
                                        class="nav-link {{ Request::routeIs('penris.beasiswa.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Beasiswa</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('penris.beasiswa.index') }}"
                                        class="nav-link {{ Request::routeIs('penris.beasiswa.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola Beasiswa</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li id="alumni" class="nav-item">
                            <a role="button" class="nav-link {{ Request::routeIs('penris.alumni.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-solid fa-user-graduate"></i>
                                <p>
                                    Alumni
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('penris.alumni.create') }}"
                                        class="nav-link {{ Request::routeIs('penris.alumni.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Alumni</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('penris.alumni.index') }}"
                                        class="nav-link {{ Request::routeIs('penris.alumni.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola Alumni</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li id="penris" class="nav-item">
                            <a role="button" class="nav-link {{ Request::routeIs('penris.penristek.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-solid fa-file"></i>
                                <p>
                                    Penristek
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('penris.penristek.create') }}"
                                        class="nav-link {{ Request::routeIs('penris.penristek.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Buat Penristek Baru</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('penris.penristek.index') }}"
                                        class="nav-link {{ Request::routeIs('penris.penristek.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola Penristek</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- <li class="nav-item">
                            <a role="button" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-sitemap"></i>
                                <p>
                                    Logo
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('penris.logo.index') }}"
                                        class="nav-link {{ Request::routeIs('penris.logo.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola Logo</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                        <li id="saidata" class="nav-header">SaiData</li>
                        <li id="saidata" class="nav-item">
                            <a role="button" class="nav-link {{ Request::routeIs('penris.saidata.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-server"></i>
                                <p>
                                    SaiData
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('penris.saidata.create') }}"
                                        class="nav-link {{ Request::routeIs('penris.saidata.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah SaiData</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('penris.saidata.index') }}"
                                        class="nav-link {{ Request::routeIs('penris.saidata.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola SaiData</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li id="arsip" class="nav-item">
                            <a role="button" class="nav-link {{ Request::routeIs('penris.arsip.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-folder"></i>
                                <p>
                                    Arsip
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('penris.arsip.index') }}"
                                        class="nav-link {{ Request::routeIs('penris.arsip.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola Arsip</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
@endauth
