@extends('layouts.guru')

@section('content')
<style>
    body {
        background: #f5f7fb;
    }

    .dashboard-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
    }

    .dashboard-header h3 {
        font-weight: 700;
        color: #1e293b;
    }

    .card-stat {
        border: none;
        border-radius: 1.2rem;
        padding: 30px 25px;
        color: #fff;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        background: rgba(255, 255, 255, 0.08);
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        backdrop-filter: blur(12px);
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
    }

    .card-stat:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.15);
    }

    .card-stat::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle at 20% 20%, rgba(255,255,255,0.15), transparent 60%);
        opacity: 0.5;
        transform: rotate(30deg);
    }

    .icon-box {
        font-size: 2.8rem;
        opacity: 0.95;
        margin-bottom: 20px;
        transition: transform 0.3s ease;
    }

    .card-stat:hover .icon-box {
        transform: scale(1.15) rotate(5deg);
    }

    .stat-label {
        font-size: 1rem;
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
    .gradient-green { background: linear-gradient(135deg,#16a34a,#22c55e,#4ade80); }
    .gradient-blue { background: linear-gradient(135deg,#2563eb,#3b82f6,#60a5fa); }
    .gradient-orange { background: linear-gradient(135deg,#ea580c,#f97316,#fb923c); }
    .gradient-purple { background: linear-gradient(135deg,#7c3aed,#8b5cf6,#a78bfa); }

    /* Card Grid Responsive */
    .card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 1.5rem;
    }
</style>

<div class="container py-4">
    <div class="dashboard-header">
        <h3><i class="bi bi-speedometer2 text-primary"></i> Dashboard Guru</h3>
        <div class="text-muted small">
            <i class="bi bi-calendar-event"></i> {{ now()->format('d F Y') }}
        </div>
    </div>

    <div class="card-grid">
        <!-- Jumlah Tugas -->
        <div class="card-stat gradient-green">
            <div class="icon-box">
                <i class="bi bi-file-earmark-check"></i>
            </div>
            <div>
                <div class="stat-label">Jumlah Tugas</div>
                <div class="stat-value">{{ $jumlahTugas }}</div>
            </div>
        </div>

        <!-- Jumlah Mapel -->
        <div class="card-stat gradient-blue">
            <div class="icon-box">
                <i class="bi bi-journal-bookmark"></i>
            </div>
            <div>
                <div class="stat-label">Jumlah Mapel</div>
                <div class="stat-value">{{ $jumlahMapel ?? 0 }}</div>
            </div>
        </div>

        <!-- Siswa Mengumpulkan -->
        <div class="card-stat gradient-orange">
            <div class="icon-box">
                <i class="bi bi-people"></i>
            </div>
            <div>
                <div class="stat-label">Siswa Mengumpulkan</div>
                <div class="stat-value">{{ $totalSiswa ?? 0 }}</div>
            </div>
        </div>

        <!-- Tugas Terakhir -->
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
@endsection
