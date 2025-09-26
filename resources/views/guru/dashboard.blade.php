@extends('layouts.guru')

@section('content')
<style>
    .card-stat {
        border: none;
        border-radius: 1.2rem;
        color: #fff;
        padding: 30px 25px;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0 6px 18px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
    }
    .card-stat:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 28px rgba(0,0,0,0.25);
    }

    .card-stat .icon-box {
        font-size: 2.8rem;
        opacity: 0.9;
        margin-bottom: 20px;
    }

    .stat-label {
        font-size: 1.1rem;
        font-weight: 500;
        opacity: 0.9;
    }
    .stat-value {
        font-size: 2.4rem;
        font-weight: 800;
        margin-top: 5px;
    }
    .stat-sub {
        font-size: 1rem;
        font-weight: 500;
        opacity: 0.9;
    }

    /* Gradients */
    .gradient-green { background: linear-gradient(135deg,#22c55e,#15803d); }
    .gradient-blue { background: linear-gradient(135deg,#3b82f6,#1e40af); }
    .gradient-orange { background: linear-gradient(135deg,#f59e0b,#b45309); }
    .gradient-purple { background: linear-gradient(135deg,#8b5cf6,#5b21b6); }
</style>

<div class="container py-4">
    <h3 class="fw-bold mb-4 text-dark">
        <i class="bi bi-speedometer2 text-primary"></i> Dashboard Guru
    </h3>

    <div class="row g-4">
        <!-- Jumlah Tugas -->
        <div class="col-md-6 col-lg-3">
            <div class="card-stat gradient-green">
                <div class="icon-box">
                    <i class="bi bi-file-earmark-check"></i>
                </div>
                <div>
                    <div class="stat-label">Jumlah Tugas</div>
                    <div class="stat-value">{{ $jumlahTugas }}</div>
                </div>
            </div>
        </div>

        <!-- Jumlah Mapel -->
        <div class="col-md-6 col-lg-3">
            <div class="card-stat gradient-blue">
                <div class="icon-box">
                    <i class="bi bi-journal-bookmark"></i>
                </div>
                <div>
                    <div class="stat-label">Jumlah Mapel</div>
                    <div class="stat-value">{{ $jumlahMapel ?? 0 }}</div>
                </div>
            </div>
        </div>

        <!-- Siswa Mengumpulkan -->
        <div class="col-md-6 col-lg-3">
            <div class="card-stat gradient-orange">
                <div class="icon-box">
                    <i class="bi bi-people"></i>
                </div>
                <div>
                    <div class="stat-label">Siswa Mengumpulkan</div>
                    <div class="stat-value">{{ $totalSiswa ?? 0 }}</div>
                </div>
            </div>
        </div>

        <!-- Tugas Terakhir -->
        <div class="col-md-6 col-lg-3">
            <div class="card-stat gradient-purple">
                <div class="icon-box">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div>
                    <div class="stat-label">Tugas Terakhir</div>
                    <div class="stat-sub">{{ $tugasTerakhir?->judul ?? '-' }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
