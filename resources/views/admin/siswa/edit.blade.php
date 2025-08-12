@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-primary fw-bold">Edit Siswa</h3>

    <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data" class="mb-3">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label fw-semibold">Nama Siswa</label>
            <input
                type="text"
                id="nama"
                name="nama"
                class="form-control"
                value="{{ old('nama', $siswa->nama) }}"
                required
            >
        </div>

        <div class="mb-3">
            <label for="nis" class="form-label fw-semibold">NIS</label>
            <input
                type="text"
                id="nis"
                name="nis"
                class="form-control"
                value="{{ old('nis', $siswa->nis) }}"
                required
            >
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                class="form-control"
                value="{{ old('email', $siswa->email) }}"
                required
            >
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label fw-semibold">Foto</label>
            <input
                type="file"
                id="foto"
                name="foto"
                class="form-control"
            >
            @if($siswa->foto)
                <small class="text-muted">Foto saat ini:</small><br>
                <img src="{{ asset('storage/' . $siswa->foto) }}" alt="Foto Siswa" width="120" class="mt-2 rounded">
            @endif
        </div>

        <button type="submit" class="btn btn-primary fw-semibold">Simpan</button>
    </form>
</div>
@endsection
