<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    @auth
@if (Auth::user()->role === 'admin' || Auth::user()->role === 'guru')
<style>
    body {
        min-height: 100vh;
        background-color: #f8f9fa;
    }
    .sidebar {
        height: 100vh;
        width: 250px;
        position: fixed;
        background: linear-gradient(180deg, #343a40, #212529);
        color: #fff;
        display: flex;
        flex-direction: column;
        box-shadow: 2px 0 10px rgba(0,0,0,0.2);
    }
    .sidebar h4 {
        font-weight: bold;
        margin: 0;
        padding: 20px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    .sidebar a, .sidebar button {
        color: #adb5bd;
        padding: 12px 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        font-size: 15px;
        transition: all 0.2s ease;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
    }
    .sidebar a:hover, .sidebar button:hover {
        background-color: rgba(255,255,255,0.1);
        color: #fff;
        border-left: 4px solid #0d6efd;
        padding-left: 16px;
    }
    .sidebar .logout-btn {
        color: #f8d7da;
    }
    .sidebar .logout-btn:hover {
        background-color: rgba(220,53,69,0.15);
        border-left: 4px solid #dc3545;
        color: #fff;
    }
    .main-content {
        margin-left: 250px;
        padding: 20px;
    }
</style>
@endif
@endauth

<body>
@auth
@if (Auth::user()->role === 'admin')
<title>Admin Dashboard</title>
<div class="sidebar">
    <h4>Admin Panel</h4>
    <a href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="{{ route('admin.guru.index') }}"><i class="bi bi-person-badge"></i> Manajemen Guru</a>
    <a href="{{ route('admin.siswa.index') }}"><i class="bi bi-people"></i> Manajemen Siswa</a>
    <a href="{{ route('admin.mapel.index') }}"><i class="bi bi-journal-bookmark"></i> Mata Pelajaran</a>
    <a href="{{ route('admin.kelas.index') }}"><i class="bi bi-building"></i> Kelas</a>
    <form action="{{ route('logout') }}" method="POST" class="mt-auto">
        @csrf
        <button type="submit" class="logout-btn"><i class="bi bi-box-arrow-right"></i> Logout</button>
    </form>
</div>
@endif
@endauth

@auth
@if (Auth::user()->role === 'guru')
<title>Guru Dashboard</title>
<div class="sidebar">
    <h4>Guru Panel</h4>
    <a href="{{ route('guru.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="{{ route('guru.tugas') }}"><i class="bi bi-file-earmark-text"></i> Manajemen Tugas</a>
    <a href="{{ route('guru.penilaian') }}"><i class="bi bi-check2-square"></i> Penilaian Tugas</a>
    <a href="{{ route('guru.profil') }}"><i class="bi bi-person-circle"></i> Profil</a>
    <form action="{{ route('logout') }}" method="POST" class="mt-auto">
        @csrf
        <button type="submit" class="logout-btn"><i class="bi bi-box-arrow-right"></i> Logout</button>
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
                    <a class="nav-link px-3 {{ request()->routeIs('siswa.pengumpulan.create') ? 'text-primary fw-semibold' : '' }}" href="{{ route('siswa.pengumpulan.create') }}">Tugas</a>
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
