@extends('layouts.guru')

@section('content')
<style>
    .card-hover { transition: 0.3s; border-radius: 1rem; }
    .card-hover:hover { transform: translateY(-6px); box-shadow: 0 8px 20px rgba(0,0,0,0.15); }
    .gradient-blue { background: linear-gradient(135deg,#007bff,#0056b3); }
    .gradient-green { background: linear-gradient(135deg,#28a745,#1e7e34); }
    .gradient-orange { background: linear-gradient(135deg,#ffc107,#ff9800); }
    .gradient-purple { background: linear-gradient(135deg,#6f42c1,#4b0082); }
</style>

<div class="container py-4">
    <h3 class="fw-bold mb-4 text-primary"><i class="bi bi-speedometer2"></i> Dashboard Guru</h3>

    <div class="row g-3">
        <div class="col-md-3">
            <div class="card text-white gradient-green card-hover h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-file-earmark-check display-6 me-3"></i>
                    <div>
                        <h6 class="mb-1">Jumlah Tugas</h6>
                        <h3 class="fw-bold">{{ $jumlahTugas }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white gradient-blue card-hover h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-journal-bookmark display-6 me-3"></i>
                    <div>
                        <h6 class="mb-1">Jumlah Mapel</h6>
                        <h3 class="fw-bold">{{ $jumlahMapel ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white gradient-orange card-hover h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-people display-6 me-3"></i>
                    <div>
                        <h6 class="mb-1">Siswa Mengumpulkan</h6>
                        <h3 class="fw-bold">{{ $totalSiswa ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white gradient-purple card-hover h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-clock-history display-6 me-3"></i>
                    <div>
                        <h6 class="mb-1">Tugas Terakhir</h6>
                        <small>{{ $tugasTerakhir?->judul ?? '-' }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
