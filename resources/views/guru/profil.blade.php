@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-body d-flex align-items-center p-4">
            
            {{-- Foto Guru --}}
            <div class="me-4 flex-shrink-0">
                <img src="{{ $guru->foto ? asset('storage/' . $guru->foto) : asset('foto/default.png') }}"
                     alt="Foto Guru"
                     class="rounded-circle border border-3 shadow-sm"
                     width="100" height="100"
                     style="object-fit: cover;">
            </div>

            {{-- Info Guru --}}
            <div>
                <h4 class="mb-1 fw-bold">{{ $guru->nama }}</h4>
                <p class="mb-2 text-muted">
                    <i class="bi bi-envelope-fill me-2 text-primary"></i>
                    <strong>Email:</strong> {{ $guru->email }}
                </p>
                <p class="mb-0 text-muted">
                    <i class="bi bi-person-badge-fill me-2 text-success"></i>
                    <strong>NIP:</strong> {{ $guru->nip }}
                </p>
            </div>

        </div>
    </div>

</div>
@endsection
