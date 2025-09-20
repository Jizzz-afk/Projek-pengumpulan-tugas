@extends('layouts.guru')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 fw-bold text-primary">📚 Pilih Kelas</h3>
    <div class="row g-3">
        @foreach($kelas as $k)
            <div class="col-md-4">
                <div class="card shadow-sm border-0 card-hover h-100">
                    <div class="card-body text-center">
                        <h5 class="fw-bold">{{ $k->nama_kelas }}</h5>
                        <p class="text-muted">Jumlah Siswa: {{ $k->siswa_count }}</p>
                        <a href="{{ route('guru.penilaian.kelas', $k->id) }}" 
                           class="btn btn-outline-primary">
                           Lihat Tugas
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
