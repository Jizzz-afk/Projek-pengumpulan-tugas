@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Error Validation --}}
    @if ($errors->any())
        <div class="alert alert-danger shadow-sm">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success shadow-sm">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        </div>
    @endif

    {{-- Form Card --}}
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-primary text-white fw-bold">
            <i class="bi bi-plus-circle me-2"></i> Buat Tugas Baru
        </div>
        <div class="card-body p-4">
            <form action="{{ route('guru.tugas.simpan') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="judul" class="form-label">Judul Tugas</label>
        <input type="text" name="judul" id="judul" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label for="foto_tugas" class="form-label">File Tugas</label>
        <input type="file" name="foto_tugas" id="foto_tugas" class="form-control"
            accept=".jpg,.png,.pdf,.docx,.zip,.rar">
    </div>

    <div class="mb-3">
        <label for="deadline" class="form-label">Deadline</label>
        <input type="date" name="deadline" id="deadline" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="jadwal_id" class="form-label">Pilih Jadwal (Mapel & Kelas)</label>
        <select name="jadwal_id" id="jadwal_id" class="form-select" required>
            <option value="">-- Pilih Jadwal --</option>
            @foreach($jadwal as $j)
                <option value="{{ $j->id }}">{{ $j->mapel->nama_mapel }} - {{ $j->kelas->nama_kelas }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

        </div>
    </div>
</div>
@endsection
