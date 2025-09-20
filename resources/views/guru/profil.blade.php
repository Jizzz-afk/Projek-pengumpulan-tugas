@extends('layouts.guru')

@section('content')
<style>
    .profile-card { border-radius: 1rem; }
    .profile-avatar { width: 120px; height: 120px; object-fit: cover; }
</style>

<div class="container py-4">
    <h3 class="fw-bold mb-4 text-primary"><i class="bi bi-person-circle"></i> Profil Guru</h3>

    <div class="card shadow-lg border-0 profile-card">
        <div class="card-body d-flex align-items-center p-4">
            <img src="{{ $guru->foto ? asset('storage/'.$guru->foto) : asset('foto/default.png') }}"
                 alt="Foto Guru" class="rounded-circle border border-3 shadow-sm me-4 profile-avatar">

            <div>
                <h4 class="fw-bold mb-1">{{ $guru->nama }}</h4>
                <p class="mb-2 text-muted"><i class="bi bi-envelope-fill text-primary me-2"></i>{{ $guru->email }}</p>
                <p class="mb-0 text-muted"><i class="bi bi-person-badge-fill text-success me-2"></i>{{ $guru->nip }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
