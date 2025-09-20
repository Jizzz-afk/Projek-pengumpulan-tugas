@extends('layouts.guru')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 fw-bold text-success">📖 Tugas untuk {{ $kelas->nama_kelas }}</h3>
    <div class="row g-3">
        @forelse($tugas as $t)
            <div class="col-md-4">
                <div class="card shadow-sm border-0 card-hover h-100">
                    <div class="card-body">
                        <h5 class="fw-bold">{{ $t->judul }}</h5>
                        <p class="mb-1 text-muted">{{ $t->jadwal->mapel->nama_mapel ?? '-' }}</p>
                        <p class="small">Deadline: {{ $t->deadline }}</p>
                        <a href="{{ route('guru.penilaian.tugas', $t->id) }}" 
                           class="btn btn-outline-success">
                           Lihat Pengumpulan
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada tugas di kelas ini.</p>
        @endforelse
    </div>
</div>
@endsection
