@extends('layouts.guru')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 fw-bold text-primary d-flex align-items-center">
        <i class="bi bi-door-open-fill me-2"></i> Pilih Kelas
    </h3>

    <div class="row g-4">
        @foreach($kelas as $k)
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100 card-hover-custom">
                    <div class="card-body d-flex flex-column justify-content-center text-center p-4">
                        <div class="mb-3">
                            <i class="bi bi-people-fill fs-1 text-primary"></i>
                        </div>
                        <h5 class="fw-bold mb-2">{{ $k->nama_kelas }}</h5>
                        <p class="text-muted mb-4">
                            👥 {{ $k->siswa_count }} Siswa
                        </p>
                        <a href="{{ route('guru.penilaian.kelas', $k->id) }}" 
                           class="btn btn-primary w-100 fw-semibold">
                            <i class="bi bi-book-half me-1"></i> Lihat Tugas
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- Custom Style --}}
@push('styles')
<style>
    .card-hover-custom {
        transition: all 0.3s ease-in-out;
        border-radius: 15px;
    }
    .card-hover-custom:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
</style>
@endpush
@endsection
