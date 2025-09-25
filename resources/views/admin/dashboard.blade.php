@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-primary">📊 Dashboard Admin</h2>

    <div class="row g-4">
        {{-- Total Guru --}}
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm rounded-4 text-white h-100 hover-shadow-scale bg-gradient-primary">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <div class="icon-circle bg-white bg-opacity-25 d-flex justify-content-center align-items-center">
                            <i class="bi bi-person-badge fs-3"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-semibold">Total Guru</h6>
                            <h2 class="fw-bold mb-0 counter" data-count="{{ $jumlahGuru }}">0</h2>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-light" role="progressbar" style="width: 80%"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Siswa --}}
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm rounded-4 text-white h-100 hover-shadow-scale bg-gradient-success">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <div class="icon-circle bg-white bg-opacity-25 d-flex justify-content-center align-items-center">
                            <i class="bi bi-people fs-3"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-semibold">Total Siswa</h6>
                            <h2 class="fw-bold mb-0 counter" data-count="{{ $jumlahSiswa }}">0</h2>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-light" role="progressbar" style="width: 65%"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Kelas --}}
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm rounded-4 text-white h-100 hover-shadow-scale bg-gradient-warning">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <div class="icon-circle bg-white bg-opacity-25 d-flex justify-content-center align-items-center">
                            <i class="bi bi-building fs-3"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-semibold">Total Kelas</h6>
                            <h2 class="fw-bold mb-0 counter" data-count="{{ $jumlahKelas }}">0</h2>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-light" role="progressbar" style="width: 50%"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Mapel --}}
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm rounded-4 text-white h-100 hover-shadow-scale bg-gradient-danger">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <div class="icon-circle bg-white bg-opacity-25 d-flex justify-content-center align-items-center">
                            <i class="bi bi-journal-bookmark fs-3"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-semibold">Total Mapel</h6>
                            <h2 class="fw-bold mb-0 counter" data-count="{{ $jumlahMapel }}">0</h2>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-light" role="progressbar" style="width: 40%"></div>
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
/* Gradient background */
.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff, #0056b3);
}
.bg-gradient-success {
    background: linear-gradient(135deg, #28a745, #1e7e34);
}
.bg-gradient-warning {
    background: linear-gradient(135deg, #ffc107, #d39e00);
}
.bg-gradient-danger {
    background: linear-gradient(135deg, #dc3545, #a71d2a);
}
</style>

{{-- Counter Animation --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.counter').forEach(counter => {
        let target = +counter.getAttribute('data-count');
        let count = 0;
        let step = Math.ceil(target / 50);
        let updateCounter = setInterval(() => {
            count += step;
            if (count >= target) {
                counter.textContent = target;
                clearInterval(updateCounter);
            } else {
                counter.textContent = count;
            }
        }, 40);
    });
});
</script>
@endsection
