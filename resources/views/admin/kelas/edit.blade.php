@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-primary fw-bold">Edit Kelas</h3>

    <form action="{{ route('admin.kelas.update', $kelas->id) }}" method="POST" class="mb-3">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_kelas" class="form-label fw-semibold">Nama Kelas</label>
            <input
                type="text"
                id="nama_kelas"
                name="nama_kelas"
                value="{{ old('nama_kelas', $kelas->nama_kelas) }}"
                placeholder="Nama Kelas"
                class="form-control"
                required
            >
        </div>

        <div class="mb-3">
            <label for="wali_kelas" class="form-label fw-semibold">Wali Kelas</label>
            <input
                type="text"
                id="wali_kelas"
                name="wali_kelas"
                value="{{ old('wali_kelas', $kelas->wali_kelas) }}"
                placeholder="Nama Wali Kelas"
                class="form-control"
                required
            >
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
            <textarea
                id="deskripsi"
                name="deskripsi"
                class="form-control"
                rows="3"
                required
            >{{ old('deskripsi', $kelas->deskripsi) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary fw-semibold">Simpan</button>
    </form>
</div>
@endsection
