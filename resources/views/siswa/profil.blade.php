@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <!-- Bagian Header / Foto -->
        <div class="bg-primary text-white text-center py-5 position-relative">
            <div class="position-absolute top-100 start-50 translate-middle">
                <img src="{{ $siswa->foto ? asset('storage/' . $siswa->foto) : asset('images/default.png') }}" 
                    alt="Foto Profil" 
                    class="rounded-circle border border-4 border-white shadow-lg profile-img">
            </div>
            <h3 class="fw-bold mt-3">{{ $siswa->nama }}</h3>
            <p class="mb-0">Siswa {{ $siswa->kelas->nama_kelas ?? '-' }}</p>
        </div>

        <!-- Bagian Info -->
        <div class="card-body mt-5">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-3 border rounded-3 bg-light h-100">
                        <h6 class="fw-bold text-muted mb-2">📧 Email</h6>
                        <p class="mb-0">{{ $siswa->email }}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 border rounded-3 bg-light h-100">
                        <h6 class="fw-bold text-muted mb-2">🆔 NIS</h6>
                        <p class="mb-0">{{ $siswa->nis }}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 border rounded-3 bg-light h-100">
                        <h6 class="fw-bold text-muted mb-2">🏫 Kelas</h6>
                        <p class="mb-0">{{ $siswa->kelas->nama_kelas ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- CSS Custom --}}
<style>
    .profile-img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .profile-img:hover {
        transform: scale(1.08);
    }
</style>
@endsection
