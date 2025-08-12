@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold text-primary">📚 Daftar Kelas</h2>
    <p class="text-muted mb-4">Berikut adalah semua kelas yang kamu ikuti beserta informasi tugasnya.</p>

    <div class="row g-4">
        @forelse($kelas as $k)
            <div class="col-md-4">
                <div class="card kelas-card shadow border-0 rounded-5 h-100 overflow-hidden">
                    <div class="kelas-header p-4 text-white" style="background: linear-gradient(135deg, #5061f6, #3a49d4); border-bottom-left-radius: 60px;">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-white bg-opacity-15 me-3 d-flex justify-content-center align-items-center">
                                <i class="bi bi-people-fill fs-3"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">{{ $k->nama_kelas }}</h5>
                                <small class="opacity-75">{{ $k->nama_mapel ?? '-' }}</small>
                            </div>
                        </div>
                    </div>

                    <div class="card-body d-flex flex-column bg-gradient-light p-4">
                        <p class="mb-2"><i class="bi bi-person-badge text-primary me-2"></i><strong>Guru:</strong> {{ $k->guru->nama ?? '-' }}</p>
                        <p class="mb-2"><i class="bi bi-journal-check text-success me-2"></i><strong>Tugas Aktif:</strong> {{ $k->tugas->where('status', 'aktif')->count() }}</p>
                        <p class="mb-4"><i class="bi bi-journal-text text-secondary me-2"></i><strong>Total Tugas:</strong> {{ $k->tugas->count() }}</p>

                        <div class="mt-auto">
                            <a href="#" class="btn btn-primary w-100 rounded-pill fw-semibold text-uppercase shadow-sm btn-hover-scale">
                                Lihat Detail <i class="bi bi-arrow-right-circle ms-2 fs-5"></i>
                            </a>
                        </div>
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
    transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.35s ease;
    cursor: pointer;
    background: #fff;
    border-radius: 1.5rem;
}
.kelas-card:hover {
    transform: translateY(-10px) scale(1.03);
    box-shadow: 0 16px 40px rgba(58, 73, 212, 0.3);
}
.kelas-header {
    border-bottom-left-radius: 60px;
    user-select: none;
}
.icon-circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}
.bg-gradient-light {
    background: linear-gradient(135deg, #f9fafe, #e8eefe);
}
.btn-hover-scale {
    transition: transform 0.25s ease;
}
.btn-hover-scale:hover {
    transform: scale(1.05);
}
</style>
@endsection
