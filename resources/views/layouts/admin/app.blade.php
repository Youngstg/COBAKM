<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMS - KM ITERA 2023 | @yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
    <style>
        .dark-mode input:-webkit-autofill,
        .dark-mode input:-webkit-autofill:focus,
        .dark-mode input:-webkit-autofill:hover,
        .dark-mode select:-webkit-autofill,
        .dark-mode select:-webkit-autofill:focus,
        .dark-mode select:-webkit-autofill:hover,
        .dark-mode textarea:-webkit-autofill,
        .dark-mode textarea:-webkit-autofill:focus,
        .dark-mode textarea:-webkit-autofill:hover {
            -webkit-background-clip: text;
        }

        .table td,
        .table th {
            vertical-align: middle;
            text-align: center;
        }
    </style>
    @yield('css')
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        @include('layouts.admin.menu')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">@yield('title')</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </section> <!-- /.content-header -->

            @yield('content')


            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
            <footer class="main-footer text-center">
                <strong>Copyright &copy; Kementerian Teknologi Informasi<a href="/"> Kabinet KM ITERA
                        2023-2024, 2024 - 2025</a>.</strong>
                All rights reserved.
            </footer>
        </div>
        <!-- ./wrapper -->

        {{-- Scripts --}}
        <script>
            function openCMS(evt, menuName) {
                var i, tabitem, tabcontents, tablinks;
                tabitem = document.getElementsByClassName("tabitem");
                tabcontents = document.getElementsByClassName("tabcontents");
                for (i = 0; i < tabcontents.length; i++) {
                    tabcontents[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(menuName).style.display = "block";
                evt.currentTarget.className += " active";
            }
        </script>

        <!-- jQuery -->
        <script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- overlayScrollbars -->
        <script src="{{ asset('lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('lte/dist/js/adminlte.js') }}"></script>

        <!-- PAGE PLUGINS -->
        <!-- jQuery Mapael -->
        <script src="{{ asset('lte/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
        <script src="{{ asset('lte/plugins/raphael/raphael.min.js') }}"></script>
        <script src="{{ asset('lte/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
        <script src="{{ asset('lte/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
        <!-- ChartJS -->
        <script src="{{ asset('lte/plugins/chart.js/Chart.min.js') }}"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('lte/dist/js/demo.js') }}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ asset('lte/dist/js/pages/dashboard2.js') }}"></script>
        @yield('js')
        @yield('script')
</body>

</html>