<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Guru Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f3f4f6;
      font-family: "Poppins", sans-serif;
      margin: 0;
    }

    /* === SIDEBAR === */
    .sidebar {
      width: 260px;
      height: 100vh;
      background: linear-gradient(180deg, #0f172a, #1e1b4b);
      color: #f8fafc;
      position: fixed;
      top: 0;
      left: 0;
      display: flex;
      flex-direction: column;
      box-shadow: 3px 0 25px rgba(0, 0, 0, 0.35);
      transition: all 0.3s ease;
      z-index: 1000;
      overflow-y: auto;
      scrollbar-width: thin;
      scrollbar-color: #334155 transparent;
    }

    .sidebar::-webkit-scrollbar {
      width: 6px;
    }
    .sidebar::-webkit-scrollbar-thumb {
      background-color: #334155;
      border-radius: 10px;
    }

    /* === HEADER === */
    .sidebar-header {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 22px;
      background: rgba(255,255,255,0.05);
      border-bottom: 1px solid rgba(255,255,255,0.1);
      backdrop-filter: blur(10px);
    }

    .sidebar-header img {
      width: 44px;
      height: 44px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(37,99,235,0.4);
    }

    .sidebar-header h4 {
      font-size: 17px;
      font-weight: 600;
      margin: 0;
      background: linear-gradient(135deg, #60a5fa, #a78bfa);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    /* === MENU === */
    .menu-title {
      font-size: 12px;
      text-transform: uppercase;
      color: #64748b;
      letter-spacing: 1px;
      margin: 20px 20px 6px;
      font-weight: 600;
    }

    .nav-link {
      color: #cbd5e1;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 22px;
      margin: 6px 12px;
      border-radius: 10px;
      transition: all 0.25s ease;
    }

    .nav-link i {
      font-size: 1.2rem;
      width: 25px;
      text-align: center;
      color: #94a3b8;
      transition: color 0.25s ease;
    }

    .nav-link:hover {
      background: rgba(255,255,255,0.08);
      transform: translateX(4px);
      color: #fff;
    }

    .nav-link:hover i {
      color: #60a5fa;
    }

    .nav-link.active {
      background: linear-gradient(135deg, #2563eb, #7c3aed);
      color: #fff;
      font-weight: 600;
      box-shadow: 0 3px 12px rgba(124,58,237,0.35);
      transform: translateX(4px);
    }

    .nav-link.active i {
      color: #fff;
    }

    /* === LOGOUT === */
    .logout {
      margin-top: auto;
      padding: 22px;
      border-top: 1px solid rgba(255,255,255,0.08);
      backdrop-filter: blur(10px);
    }

    .logout-btn {
      width: 100%;
      background: linear-gradient(135deg, #ef4444, #dc2626);
      border: none;
      color: #fff;
      border-radius: 10px;
      padding: 10px 0;
      font-weight: 600;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: all 0.25s ease;
      box-shadow: 0 4px 12px rgba(239,68,68,0.3);
    }

    .logout-btn:hover {
      background: linear-gradient(135deg, #dc2626, #b91c1c);
      transform: translateY(-2px);
      box-shadow: 0 6px 14px rgba(239,68,68,0.45);
    }

    /* === CONTENT === */
    .content {
      margin-left: 260px;
      padding: 30px;
      transition: margin-left 0.3s ease;
    }

    /* === TOGGLE (MOBILE) === */
    .toggle-btn {
      display: none;
      position: fixed;
      top: 15px;
      left: 15px;
      background: #2563eb;
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 8px 12px;
      z-index: 1100;
      box-shadow: 0 2px 6px rgba(0,0,0,0.25);
    }

    @media (max-width: 991.98px) {
      .sidebar {
        transform: translateX(-100%);
      }

      .sidebar.show {
        transform: translateX(0);
      }

      .toggle-btn {
        display: block;
      }

      .content {
        margin-left: 0;
        padding-top: 70px;
      }
    }
  </style>
</head>
<body>
@auth
@if (Auth::user()->role === 'guru')

<!-- Toggle Sidebar Button (Mobile) -->
<button class="toggle-btn" onclick="toggleSidebar()"><i class="bi bi-list fs-4"></i></button>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <div class="sidebar-header">
    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135768.png" alt="logo">
    <h4>Guru Panel</h4>
  </div>

  <div class="menu">
    <div class="menu-title">Menu Utama</div>
    <a class="nav-link {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}" href="{{ route('guru.dashboard') }}">
      <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a class="nav-link {{ request()->routeIs('guru.tugas*') ? 'active' : '' }}" href="{{ route('guru.tugas') }}">
      <i class="bi bi-file-earmark-text"></i> Tugas
    </a>
    <a class="nav-link {{ request()->routeIs('guru.penilaian') ? 'active' : '' }}" href="{{ route('guru.penilaian') }}">
      <i class="bi bi-check2-square"></i> Penilaian
    </a>

    <div class="menu-title">Akun</div>
    <a class="nav-link {{ request()->routeIs('guru.profil') ? 'active' : '' }}" href="{{ route('guru.profil') }}">
      <i class="bi bi-person-circle"></i> Profil
    </a>
  </div>

  <div class="logout">
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit" class="logout-btn">
        <i class="bi bi-box-arrow-right"></i> Logout
      </button>
    </form>
  </div>
</div>
@endif
@endauth

<!-- Content -->
<div class="content">
  <div class="container-fluid my-4">
    @yield('content')
  </div>
</div>

<script>
  function toggleSidebar() {
    document.getElementById("sidebar").classList.toggle("show");
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
