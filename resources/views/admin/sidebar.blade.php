<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initialscale=1">
    <title> Dashboard </title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3C6CoIi6uLrA9TneE0a7RxnatzjcDCsCmG1MxXSRI6AsXEV/Dwvykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css">

    <!-- Custom Style -->
    <style>
        body {
            background-color: #1a1a1a;
            color: #ffffff;
        }
        .content-wrapper,
        .main-footer,
        .main-header {
            background-color: #1a1a1a;
            color: #ffffff;
        }
        .sidebar-dark-primary {
            background-color: #1a1a1a !important;
        }
        .nav-link {
            color: #ffffff !important;
        }
        .nav-link:hover {
            background-color: #333333;
        }
        p, i{
            font-size: 1.3rem;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div class="sidebar">
            <nav class="mt-2">

            <a href="{{ url('admin\dashboard') }}" class="brand-link text-center" style="background-color: #d4af37; color: #1a1a1a; font-weight: bold; font-size: 2rem; text-decoration:none;">
            BaratieResto
            </a>

                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <br>
                    <li class="nav-item">
                        <a href="{{ url('admin\menu') }}" class="nav-link">
                            <i class="fa-solid fa-book mr-2"></i>
                            <p> Menu </p>
                        </a>
                    </li>
                    <br>
                    <li class="nav-item">
                        <a href="{{ url('admin\meja') }}" class="nav-link">
                            <i class="fa-solid fa-table mr-2"></i>
                            <p> Meja </p>
                        </a>
                    </li>
                    <br>
                    <li class="nav-item">
                        <a href="{{ url('admin\reservasi') }}" class="nav-link">
                            <i class="fa-solid fa-ticket mr-2"></i>
                            <p> Reservasi </p>
                        </a>
                    </li>
                    <br>
                    <li class="nav-item">
                        <a href="{{ url('admin\user') }}" class="nav-link">
                            <i class="fa-solid fa-person mr-2"></i>
                            <p> User </p>
                        </a>
                    </li>
                    <br>
                    <li class="nav-item">
                        <a href="{{ url('admin\review') }}" class="nav-link">
                            <i class="fa-solid fa-star mr-2"></i>
                            <p> Review </p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <div class="content-wrapper">
        @yield('content')
    </div>
    <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">Baratie Resto</div>
        <strong>Copyright &copy; {{ date('Y') }} <a href="#" style="color:#d4af37;">AtmaJayaYK</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- REQUIRED SCRIPTS -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/adminlte.min.js') }}"></script>
</body>
</html>
