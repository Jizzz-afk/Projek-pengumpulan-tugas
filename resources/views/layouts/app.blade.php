<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @auth
        @if (Auth::user()->role === 'admin' || Auth::user()->role === 'guru')
        <style>
        body {
            min-height: 100vh;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            background-color: #343a40;
        }
        .sidebar a {
            color: #fff;
            padding: 15px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .sidebar form :hover {
            background-color: #495057;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
        @endif
    @endauth
</head>
<body>
    @auth
    @if (Auth::user()->role === 'admin')
    <title>Admin Dashboard</title>
<div class="sidebar">
    <h4 class="text-white text-center py-4">Admin Panel</h4>
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('admin.guru.index') }}">Manajemen Guru</a>
    <a href="{{ route('admin.siswa.index') }}">Manajemen Siswa</a>
    <a href="{{ route('admin.mapel.index') }}">Mata Pelajaran</a>
    <a href="{{ route('admin.kelas.index') }}">Kelas</a>
    <form action="{{ route('logout') }}" method="POST" class="m-0">
    @csrf
    <button type="submit" class="w-100 text-start btn btn-link text-white px-3 py-2" style="text-decoration: none;">
        Logout
    </button>
</form>

</div>
@endif
@endauth

@auth
    @if (Auth::user()->role === 'guru')
    <title>Guru Dashboard</title>
<div class="sidebar">
    <h4 class="text-white text-center py-4">Guru Panel</h4>
    <a href="{{ route('guru.dashboard') }}">Dashboard</a>
    <a href="{{ route('guru.tugas') }}">Manajemen Tugas</a>
    <a href="{{ route('guru.penilaian')}}">Penilaian Tugas</a>
    <a href="{{ route('guru.profil')}}">Profil</a>
    <form action="{{ route('logout') }}" method="POST" class="m-0">
    @csrf
    <button type="submit" class="w-100 text-start btn btn-link text-white px-3 py-2" style="text-decoration: none;">
        Logout
    </button>
</form>
</div>
@endif
@endauth

@auth
@if (Auth::user()->role === 'siswa')
<title>Siswa Dashboard</title>

<!-- Modern Navbar Siswa -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold text-primary" href="{{ route('siswa.dashboard') }}">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135768.png" alt="logo" width="32" height="32" class="me-2">
            PortalTugas.id
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSiswaModern" aria-controls="navbarSiswaModern" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSiswaModern">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                <li class="nav-item">
                    <a class="nav-link px-3 {{ request()->routeIs('siswa.dashboard') ? 'text-primary fw-semibold' : '' }}" href="{{ route('siswa.dashboard') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 {{ request()->routeIs('siswa.kelas') ? 'text-primary fw-semibold' : '' }}" href="{{ route('siswa.kelas') }}">Kelas</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link px-3 {{ request()->routeIs('siswa.pengumpulan.create') ? 'text-primary fw-semibold' : '' }}" href="{{ route('siswa.pengumpulan.create') }}">Tugas</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link px-3 {{ request()->routeIs('siswa.nilai') ? 'text-primary fw-semibold' : '' }}" href="{{ route('siswa.nilai') }}">Nilai</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link px-3 {{ request()->routeIs('siswa.riwayat') ? 'text-primary fw-semibold' : '' }}" href="{{ route('siswa.riwayat') }}">Riwayat</a>
                </li>

                <!-- Dropdown Logout -->
                <li class="nav-item dropdown ms-3">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="avatar" width="32" height="32" class="rounded-circle me-1">
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('siswa.profil') }}">Profil Saya</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="px-3">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger w-100">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

@endif
@endauth

<div class="main-content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>