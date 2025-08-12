@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold text-primary">📚 Daftar Kelas</h2>
    <p class="text-muted">Berikut adalah semua kelas yang kamu ikuti beserta informasi tugasnya.</p>

    <div class="row g-4">
        @forelse($kelas as $k)
            <div class="col-md-4">
                <div class="card shadow border-0 rounded-4 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3 text-primary fs-2">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-0">{{ $k->nama_kelas }}</h5>
                                <small class="text-muted">{{ $k->mapel->nama_mapel ?? '-' }}</small>
                            </div>
                        </div>
                        <p class="mb-2"><strong>Guru:</strong> {{ $k->guru->nama ?? '-' }}</p>
                        <p class="mb-2"><strong>Tugas Aktif:</strong> {{ $k->tugas->where('status', 'aktif')->count() }}</p>
                        <p class="mb-3"><strong>Total Tugas:</strong> {{ $k->tugas->count() }}</p>
                        
                        <a href="{{ route('kelas.detail', $k->id) }}" class="btn btn-primary w-100">
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
@endsection
