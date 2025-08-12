@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold text-primary">📚 Daftar Kelas</h2>
    <p class="text-muted mb-4">Berikut adalah semua kelas yang kamu ikuti beserta informasi tugasnya.</p>

    <div class="row g-4">
        @forelse($kelas as $k)
            <div class="col-md-4">
                <div class="card kelas-card shadow border-0 rounded-5 h-100 overflow-hidden">
                    <div class="kelas-header p-4 text-white d-flex align-items-center" style="background: linear-gradient(135deg, #5061f6, #3a49d4); border-bottom-left-radius: 60px; transition: background-color 0.3s ease;">
                        <div class="icon-circle bg-white bg-opacity-15 me-3 d-flex justify-content-center align-items-center shadow-sm">
                            <i class="bi bi-people-fill fs-3"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">{{ $k->nama_kelas }}</h5>
                            <small class="opacity-75">{{ $k->nama_mapel ?? 'Bahasa Indonesia' }}</small>
                        </div>
                    </div>

                    <div class="card-body d-flex flex-column bg-gradient-light p-4">
                        <p class="mb-3 fs-6"><i class="bi bi-person-badge text-primary me-2"></i><strong>Guru:</strong> {{ $k->guru->nama ?? 'Doni Prayoga' }}</p>
                        <p class="mb-3 fs-6"><i class="bi bi-journal-check text-success me-2"></i><strong>Tugas Aktif:</strong> {{ $k->tugas->where('status', 'aktif')->count() }}</p>
                        <p class="mb-4 fs-6"><i class="bi bi-journal-text text-secondary me-2"></i><strong>Total Tugas:</strong> {{ $k->tugas->count() }}</p>

                        <div class="mt-auto">
                            <a href="#" class="btn btn-gradient w-100 rounded-pill fw-semibold text-uppercase shadow-sm btn-hover-scale">
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
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.4s ease;
    cursor: pointer;
    background: #fff;
    border-radius: 1.5rem;
}
.kelas-card:hover {
    transform: translateY(-12px) scale(1.04);
    box-shadow: 0 20px 50px rgba(58, 73, 212, 0.35);
}
.kelas-header {
    border-bottom-left-radius: 60px;
    user-select: none;
}
.kelas-card:hover .kelas-header {
    background: linear-gradient(135deg, #647bff, #5061f6);
}

.icon-circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.bg-gradient-light {
    background: linear-gradient(135deg, #f9fafe, #e8eefe);
}

.btn-gradient {
    background: linear-gradient(135deg, #5061f6, #3a49d4);
    color: white;
    border: none;
    box-shadow: 0 5px 15px rgba(80, 97, 246, 0.4);
    transition: background 0.3s ease, box-shadow 0.3s ease;
}

.btn-gradient:hover, .btn-gradient:focus {
    background: linear-gradient(135deg, #3a49d4, #5061f6);
    box-shadow: 0 8px 25px rgba(58, 73, 212, 0.7);
    color: white;
}

.btn-hover-scale {
    transition: transform 0.3s ease;
}
.btn-hover-scale:hover {
    transform: scale(1.07);
}
</style>
@endsection
