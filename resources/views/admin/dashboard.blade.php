@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-primary">📊 Dashboard Admin</h2>

    <div class="row g-4">
        {{-- Total Guru --}}
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm rounded-4 bg-primary text-white h-100 hover-shadow-scale">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="icon-circle bg-white bg-opacity-25 d-flex justify-content-center align-items-center">
                        <i class="bi bi-person-badge fs-3"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 fw-semibold">Total Guru</h5>
                        <h2 class="fw-bold mb-0">{{ $jumlahGuru }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Siswa --}}
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm rounded-4 bg-success text-white h-100 hover-shadow-scale">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="icon-circle bg-white bg-opacity-25 d-flex justify-content-center align-items-center">
                        <i class="bi bi-people fs-3"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 fw-semibold">Total Siswa</h5>
                        <h2 class="fw-bold mb-0">{{ $jumlahSiswa }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Kelas --}}
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm rounded-4 bg-warning text-white h-100 hover-shadow-scale">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="icon-circle bg-white bg-opacity-25 d-flex justify-content-center align-items-center">
                        <i class="bi bi-building fs-3"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 fw-semibold">Total Kelas</h5>
                        <h2 class="fw-bold mb-0">{{ $jumlahKelas }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Mapel --}}
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm rounded-4 bg-danger text-white h-100 hover-shadow-scale">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="icon-circle bg-white bg-opacity-25 d-flex justify-content-center align-items-center">
                        <i class="bi bi-journal-bookmark fs-3"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 fw-semibold">Total Mapel</h5>
                        <h2 class="fw-bold mb-0">{{ $jumlahMapel }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.icon-circle {
    width: 56px;
    height: 56px;
    border-radius: 50%;
}

.hover-shadow-scale {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: default;
}

.hover-shadow-scale:hover {
    transform: scale(1.05);
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
}
</style>
@endsection
