@extends('layouts.app')

@section('content')
<style>
    /* Hover efek untuk card */
    .card-hover {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        border-radius: 1rem;
    }
    .card-hover:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.15);
    }

    /* Gradient untuk heading */
    .title-gradient {
        background: linear-gradient(135deg, #007bff, #6610f2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Warna background card */
    .bg-gradient-primary { background: linear-gradient(135deg, #007bff, #0056b3); }
    .bg-gradient-success { background: linear-gradient(135deg, #28a745, #1e7e34); }
    .bg-gradient-warning { background: linear-gradient(135deg, #ffc107, #ff9800); }
    .bg-gradient-info { background: linear-gradient(135deg, #17a2b8, #117a8b); }

    /* Icon besar */
    .stat-icon { font-size: 2.5rem; }

    /* Progress bar custom */
    .progress { height: 20px; border-radius: 10px; overflow: hidden; }
    .progress-bar { font-size: 0.85rem; }
</style>

<div class="container py-4">
    <h3 class="mb-4 fw-bold title-gradient">📊 Dashboard Guru</h3>

    {{-- Statistik Utama --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3 col-sm-6">
            <div class="card text-white bg-gradient-success shadow-sm h-100 card-hover">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-file-earmark-check stat-icon me-3"></i>
                    <div>
                        <h6 class="text-uppercase mb-1">Jumlah Tugas</h6>
                        <h2 class="fw-bold mb-0">{{ $jumlahTugas }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card text-white bg-gradient-primary shadow-sm h-100 card-hover">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-journal-bookmark stat-icon me-3"></i>
                    <div>
                        <h6 class="text-uppercase mb-1">Jumlah Mapel</h6>
                        <h2 class="fw-bold mb-0">{{ $jumlahMapel ?? 0 }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card text-white bg-gradient-warning shadow-sm h-100 card-hover">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-people stat-icon me-3"></i>
                    <div>
                        <h6 class="text-uppercase mb-1">Siswa Mengumpulkan</h6>
                        <h2 class="fw-bold mb-0">{{ $totalSiswa ?? 0 }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card text-white bg-gradient-info shadow-sm h-100 card-hover">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-clock-history stat-icon me-3"></i>
                    <div>
                        <h6 class="text-uppercase mb-1">Tugas Terakhir Dibuat</h6>
                        <h6 class="mb-0">{{ $tugasTerakhir?->judul ?? '-' }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
