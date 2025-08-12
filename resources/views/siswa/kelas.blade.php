@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold text-primary">📚 Daftar Kelas</h2>
    <p class="text-muted">Berikut adalah semua kelas yang kamu ikuti beserta informasi tugasnya.</p>

    <div class="row g-4">
        @forelse($kelas as $k)
            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-4 h-100 kelas-card">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3 text-white bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                                <i class="bi bi-people-fill fs-4"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-0">{{ $k->nama_kelas }}</h5>
                                <small class="text-muted">{{ $k->nama_mapel ?? '' }}</small>
                            </div>
                        </div>
                        <p class="mb-2"><strong>Guru:</strong> {{ $k->guru->nama ?? '-' }}</p>
                        <p class="mb-2"><strong>Tugas Aktif:</strong> {{ $k->tugas->where('status', 'aktif')->count() }}</p>
                        <p class="mb-3"><strong>Total Tugas:</strong> {{ $k->tugas->count() }}</p>
                        
                    
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                <em>Belum ada kelas yang kamu ikuti.</em>
            </div>
        @endforelse
    </div>
</div>

<style>
    .kelas-card {
        transition: all 0.3s ease;
    }
    .kelas-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }
</style>
@endsection
