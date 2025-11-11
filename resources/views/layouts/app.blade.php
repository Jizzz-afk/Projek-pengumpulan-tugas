<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f4f6f9;
      font-family: "Poppins", sans-serif;
      margin: 0;
      overflow-x: hidden;
    }

    /* === SIDEBAR ADMIN === */
    .sidebar {
      height: 100vh;
      width: 260px;
      position: fixed;
      top: 0;
      left: 0;
      background: linear-gradient(180deg, #141824, #1e2230);
      color: #fff;
      display: flex;
      flex-direction: column;
      box-shadow: 3px 0 15px rgba(0,0,0,0.25);
      z-index: 100;
      transition: all 0.3s ease;
    }

    .sidebar-header {
      padding: 22px 20px;
      display: flex;
      align-items: center;
      gap: 12px;
      background: rgba(255,255,255,0.05);
      border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .sidebar-header img {
      width: 40px;
      height: 40px;
      border-radius: 8px;
    }

    .sidebar-header h4 {
      font-size: 17px;
      font-weight: 600;
      margin: 0;
    }

    .sidebar a, .sidebar button {
      color: #adb5bd;
      padding: 12px 22px;
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
      font-size: 15px;
      border: none;
      background: none;
      width: 100%;
      text-align: left;
      transition: all 0.25s ease;
    }

    .sidebar a:hover, .sidebar button:hover {
      background: rgba(13,110,253,0.15);
      color: #fff;
      padding-left: 26px;
    }

    .sidebar a.active {
      background-color: rgba(13,110,253,0.3);
      border-left: 4px solid #0d6efd;
      color: #fff;
      font-weight: 600;
      padding-left: 20px;
    }

    .sidebar i {
      font-size: 1.2rem;
      width: 22px;
      text-align: center;
    }

    .sidebar-section-title {
      font-size: 13px;
      text-transform: uppercase;
      color: #6c757d;
      letter-spacing: 1px;
      padding: 14px 22px 5px;
    }

    .logout-section {
      margin-top: auto;
      border-top: 1px solid rgba(255,255,255,0.1);
      padding-top: 10px;
    }

    .logout-btn {
      color: #f8d7da;
    }

    .logout-btn:hover {
      background-color: rgba(220,53,69,0.15);
      color: #fff;
      border-left: 4px solid #dc3545;
      padding-left: 26px;
    }

    /* === MAIN CONTENT === */
    .main-content {
      margin-left: 260px;
      padding: 25px;
      min-height: 100vh;
    }

    /* === TOGGLE MOBILE === */
    .toggle-sidebar {
      display: none;
    }

    @media (max-width: 991.98px) {
      .sidebar {
        width: 240px;
        transform: translateX(-100%);
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
      }

      .sidebar.show {
        transform: translateX(0);
      }

      .toggle-sidebar {
        display: block;
        position: fixed;
        top: 15px;
        left: 15px;
        z-index: 101;
        background: #0d6efd;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 8px 12px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
      }

      .main-content {
        margin-left: 0;
        padding-top: 70px;
      }
    }

    /* === SISWA NAV === */
    .active-link {
      font-weight: 600;
      color: var(--bs-primary) !important;
    }
  </style>
</head>
<body>

@auth
@if (Auth::user()->role === 'admin')
<!-- Toggle Button (for mobile) -->
<button class="toggle-sidebar d-lg-none"><i class="bi bi-list fs-4"></i></button>

<!-- Sidebar Admin -->
<div class="sidebar" id="adminSidebar">
  <div class="sidebar-header">
    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Logo">
    <h4>PortalTugas Admin</h4>
  </div>

  <div class="sidebar-menu">
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <div class="sidebar-section-title">Manajemen Data</div>
    <a href="{{ route('admin.guru.index') }}" class="{{ request()->routeIs('admin.guru.*') ? 'active' : '' }}">
      <i class="bi bi-person-badge"></i> Data Guru
    </a>
    <a href="{{ route('admin.siswa.index') }}" class="{{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
      <i class="bi bi-people"></i> Data Siswa
    </a>
    <a href="{{ route('admin.kelas.index') }}" class="{{ request()->routeIs('admin.kelas.*') ? 'active' : '' }}">
      <i class="bi bi-building"></i> Kelas
    </a>
    <a href="{{ route('admin.mapel.index') }}" class="{{ request()->routeIs('admin.mapel.*') ? 'active' : '' }}">
      <i class="bi bi-journal-bookmark"></i> Mata Pelajaran
    </a>
  </div>

  <div class="logout-section">
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit" class="logout-btn">
        <i class="bi bi-box-arrow-right"></i> Logout
      </button>
    </form>
  </div>
</div>

<!-- MAIN CONTENT WRAPPER -->
<div class="main-content">
  @yield('content')
</div>

<script>
  const toggleBtn = document.querySelector('.toggle-sidebar');
  const sidebar = document.getElementById('adminSidebar');
  toggleBtn?.addEventListener('click', () => sidebar.classList.toggle('show'));
</script>
@endif
@endauth


@auth
@if (Auth::user()->role === 'siswa')
<!-- Navbar Siswa -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container-fluid px-3">
    <a class="navbar-brand fw-bold text-primary d-flex align-items-center" href="{{ route('siswa.dashboard') }}">
      <img src="https://cdn-icons-png.flaticon.com/512/3135/3135768.png" alt="logo" width="32" height="32" class="me-2">
      <span>PortalTugas.id</span>
    </a>

    <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSiswa">
      <i class="bi bi-list fs-1 text-primary"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarSiswa">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
        <li class="nav-item">
          <a class="nav-link px-3 {{ request()->routeIs('siswa.dashboard') ? 'active-link' : '' }}" href="{{ route('siswa.dashboard') }}">
            <i class="bi bi-house-door-fill me-1"></i> Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 {{ request()->routeIs('siswa.pengumpulan.index') ? 'active-link' : '' }}" href="{{ route('siswa.pengumpulan.index') }}">
            <i class="bi bi-journal-text me-1"></i> Tugas
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 {{ request()->routeIs('siswa.riwayat') ? 'active-link' : '' }}" href="{{ route('siswa.riwayat') }}">
            <i class="bi bi-clock-history me-1"></i> Riwayat
          </a>
        </li>
        <li class="nav-item dropdown mt-3 mt-lg-0">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown">
            <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="avatar" width="32" height="32" class="rounded-circle me-2">
            <span>{{ Auth::user()->name }}</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
            <li><a class="dropdown-item" href="{{ route('siswa.profil') }}"><i class="bi bi-person-circle me-2"></i> Profil Saya</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="{{ route('logout') }}" method="POST" class="px-3">@csrf
                <button type="submit" class="btn btn-danger w-100"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- SISWA CONTENT -->
<div class="container py-4">
  @yield('content')
</div>
@endif
@endauth

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
