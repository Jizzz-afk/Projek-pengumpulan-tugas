@extends('layouts.app')

@section('content')
<style>
    /* Efek hover pada semua card */
    .card-hover {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border-radius: 1rem;
    }
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }

    /* Background gradient untuk statistik */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #007bff, #0056b3);
    }
    .bg-gradient-success {
        background: linear-gradient(135deg, #28a745, #1e7e34);
    }
</style>

<div class="container">
    <h3 class="mb-4 fw-bold">📊 Dashboard Guru</h3>

    {{-- Info Wali Kelas --}}
    @if ($kelasYangDibina->count() > 0)
        <div class="alert alert-primary shadow-sm rounded-pill px-4">
            <strong>🧑‍🏫 Anda adalah wali kelas:</strong> 
            @foreach ($kelasYangDibina as $kelas)
                <span class="badge bg-primary">{{ $kelas->nama_kelas }}</span>
            @endforeach
        </div>
    @endif

        <div class="col-md-4">
            <div class="card text-white bg-gradient-success shadow-sm h-100 card-hover">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-file-earmark-check fs-1 me-3"></i>
                    <div>
                        <h6 class="text-uppercase mb-1">Jumlah Tugas</h6>
                        <h2 class="fw-bold mb-0">{{ $jumlahTugas }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Jumlah Siswa per Kelas --}}
    @if (count($jumlahSiswaPerKelas))
        <h5 class="mt-5 fw-semibold">👥 Jumlah Siswa pada Kelas Anda</h5>
        <div class="row g-3">
            @foreach ($jumlahSiswaPerKelas as $kelas => $jumlah)
                <div class="col-md-3 col-sm-6">
                    <div class="card border-0 shadow-sm h-100 card-hover">
                        <div class="card-body text-center">
                            <h6 class="fw-bold">{{ $kelas }}</h6>
                            <span class="badge bg-light text-dark px-3 py-2 shadow-sm">
                                {{ $jumlah }} siswa
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
