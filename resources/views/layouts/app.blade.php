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

<!-- Navbar Siswa Modern -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container-fluid px-3">
        <!-- Brand -->
        <a class="navbar-brand fw-bold text-primary d-flex align-items-center" href="{{ route('siswa.dashboard') }}">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135768.png" alt="logo" width="32" height="32" class="me-2">
            <span>PortalTugas.id</span>
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSiswa" aria-controls="navbarSiswa" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list fs-1 text-primary"></i>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarSiswa">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
                <li class="nav-item">
                    <a class="nav-link px-3 {{ request()->routeIs('siswa.dashboard') ? 'active-link' : '' }}" href="{{ route('siswa.dashboard') }}">
                        <i class="bi bi-house-door-fill me-1"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 {{ request()->routeIs('siswa.pengumpulan.create') ? 'active-link' : '' }}" href="{{ route('siswa.pengumpulan.create') }}">
                        <i class="bi bi-journal-text me-1"></i> Tugas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 {{ request()->routeIs('siswa.riwayat') ? 'active-link' : '' }}" href="{{ route('siswa.riwayat') }}">
                        <i class="bi bi-clock-history me-1"></i> Riwayat
                    </a>
                </li>

                <!-- Dropdown Profil -->
                <li class="nav-item dropdown mt-3 mt-lg-0">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="avatar" width="32" height="32" class="rounded-circle me-2">
                        <span>{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('siswa.profil') }}">
                                <i class="bi bi-person-circle me-2"></i> Profil Saya
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="px-3">
                                @csrf
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Style -->
<style>
    .active-link {
        font-weight: 600;
        color: var(--bs-primary) !important;
    }
    /* Hover efek */
    .nav-link:hover {
        color: var(--bs-primary) !important;
        background-color: #f8f9fa;
        border-radius: 8px;
        transition: 0.2s;
    }
    /* Mobile dropdown styling */
    @media (max-width: 991.98px) {
        #navbarSiswa {
            background: #fff;
            padding: 1rem;
            border-radius: 10px;
            margin-top: 10px;
        }
        #navbarSiswa .nav-link {
            padding: 0.8rem 1rem;
            border-radius: 8px;
        }
        #navbarSiswa .dropdown-menu {
            position: static !important;
            transform: none !important;
            box-shadow: none;
        }
    }
</style>

@endif
@endauth

<div class="main-content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
