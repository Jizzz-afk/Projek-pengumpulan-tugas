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
        <label for="judul" class="form-label fw-semibold">
            <i class="bi bi-pencil-square me-1"></i> Judul Tugas
        </label>
        <input type="text" name="judul" id="judul" class="form-control form-control-lg"
            placeholder="Masukkan judul tugas" required>
    </div>

    <div class="mb-3">
        <label for="deskripsi" class="form-label fw-semibold">
            <i class="bi bi-card-text me-1"></i> Deskripsi
        </label>
        <textarea name="deskripsi" id="deskripsi" class="form-control form-control-lg" rows="4"
            placeholder="Tuliskan deskripsi tugas..."></textarea>
    </div>

    <div class="mb-3">
        <label for="foto_tugas" class="form-label fw-semibold">
            <i class="bi bi-image me-1"></i> Foto / File Tugas
        </label>
        <input type="file" name="foto_tugas" id="foto_tugas" class="form-control form-control-lg"
            accept=".jpg,.png,.pdf,.docx,.zip,.rar" required>
        <small class="text-muted">Format: JPG, PNG, PDF, DOCX, ZIP, RAR (Max: 2MB)</small>
    </div>

    <div class="mb-3">
        <label for="deadline" class="form-label fw-semibold">
            <i class="bi bi-calendar-event me-1"></i> Tanggal Dikumpulkan
        </label>
        <input type="date" name="deadline" id="deadline" class="form-control form-control-lg" required>
    </div>

    <div class="mb-3">
        <label for="kelas_id" class="form-label fw-semibold">
            <i class="bi bi-people-fill me-1"></i> Kelas
        </label>
        <select name="kelas_id" class="form-select form-select-lg" required>
            <option value="">-- Pilih Kelas --</option>
            @foreach($kelas as $k)
                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="mapel_id" class="form-label fw-semibold">
            <i class="bi bi-journal-bookmark-fill me-1"></i> Mata Pelajaran
        </label>
        <select name="mapel_id" id="mapel_id" class="form-select form-select-lg" required>
            <option value="">-- Pilih Mata Pelajaran --</option>
            @foreach ($mapel as $m)
                <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
            @endforeach
        </select>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('guru.tugas') }}" class="btn btn-secondary btn-lg">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <button type="submit" class="btn btn-primary btn-lg">
            <i class="bi bi-save"></i> Simpan Tugas
        </button>
    </div>
</form>

        </div>
    </div>

</div>
@endsection
