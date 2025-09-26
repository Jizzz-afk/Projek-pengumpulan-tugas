<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Guru Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: #f1f5f9;
            margin: 0;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: #1e293b; /* dark navy */
            color: #f1f5f9;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 10px rgba(0,0,0,0.15);
            transition: all 0.3s ease;

            /* Fix height */
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;

            /* Scroll terpisah kalau konten sidebar banyak */
            overflow-y: auto;
        }
        .sidebar-header {
            padding: 20px;
            font-size: 1.25rem;
            font-weight: bold;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar .nav-link {
            color: #cbd5e1;
            border-radius: 8px;
            margin: 6px 12px;
            padding: 10px 14px;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .sidebar .nav-link i {
            margin-right: 8px;
        }
        .sidebar .nav-link.active {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: #fff !important;
            font-weight: 600;
            box-shadow: 0 2px 6px rgba(37,99,235,0.4);
        }
        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.08);
            color: #fff;
        }
        .sidebar .logout {
            margin-top: auto;
            padding: 15px;
        }

        /* Content */
        .content {
            margin-left: 250px; /* supaya konten nggak ketiban sidebar */
            padding: 20px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                left: -250px;
                z-index: 1050;
            }
            .sidebar.show {
                left: 0;
            }
            .content {
                margin-left: 0;
                padding-top: 56px;
            }
            .toggle-btn {
                display: inline-block;
            }
        }
        .toggle-btn {
            display: none;
            cursor: pointer;
            font-size: 1.4rem;
            margin-right: 15px;
        }
    </style>
</head>
<body>
    @auth
    @if (Auth::user()->role === 'guru')
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <i class="bi bi-mortarboard"></i> Guru Panel
        </div>
        <nav class="nav flex-column mt-3 flex-grow-1">
            <a class="nav-link {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}" href="{{ route('guru.dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('guru.tugas*') ? 'active' : '' }}" href="{{ route('guru.tugas') }}">
                <i class="bi bi-file-earmark-text"></i> Tugas
            </a>
            <a class="nav-link {{ request()->routeIs('guru.penilaian') ? 'active' : '' }}" href="{{ route('guru.penilaian') }}">
                <i class="bi bi-check2-square"></i> Penilaian
            </a>
            <a class="nav-link {{ request()->routeIs('guru.profil') ? 'active' : '' }}" href="{{ route('guru.profil') }}">
                <i class="bi bi-person-circle"></i> Profil
            </a>
        </nav>
        <div class="logout">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger w-100">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>
    @endif
    @endauth

    <div class="content flex-grow-1">
        {{-- Navbar toggle hanya muncul di HP --}}
        <nav class="navbar navbar-light bg-white shadow-sm d-lg-none fixed-top">
            <div class="container-fluid">
                <span class="toggle-btn" onclick="toggleSidebar()"><i class="bi bi-list"></i></span>
                <span class="navbar-brand mb-0 h5">Guru Panel</span>
            </div>
        </nav>

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
