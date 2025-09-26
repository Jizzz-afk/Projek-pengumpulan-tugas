@extends('layouts.guru')

@section('content')
<div class="container py-4">

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
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header text-white fw-bold" 
             style="background: linear-gradient(135deg,#3b82f6,#1e40af);">
            <i class="bi bi-plus-circle me-2"></i> Buat Tugas Baru
        </div>
        <div class="card-body p-4">
            <form action="{{ route('guru.tugas.simpan') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="judul" class="form-label fw-semibold">
                        <i class="bi bi-fonts me-1 text-primary"></i> Judul Tugas
                    </label>
                    <input type="text" name="judul" id="judul" class="form-control shadow-sm" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label fw-semibold">
                        <i class="bi bi-card-text me-1 text-primary"></i> Deskripsi
                    </label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" 
                              class="form-control shadow-sm"></textarea>
                </div>

                <div class="mb-3">
                    <label for="foto_tugas" class="form-label fw-semibold">
                        <i class="bi bi-upload me-1 text-primary"></i> File Tugas
                    </label>
                    <input type="file" name="foto_tugas" id="foto_tugas" 
                           class="form-control shadow-sm"
                           accept=".jpg,.png,.pdf,.docx,.zip,.rar">
                    <div class="form-text">Format: jpg, png, pdf, docx, zip, rar</div>
                </div>

                <div class="mb-3">
                    <label for="deadline" class="form-label fw-semibold">
                        <i class="bi bi-calendar-date me-1 text-primary"></i> Deadline
                    </label>
                    <input type="date" name="deadline" id="deadline" 
                           class="form-control shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="jadwal_id" class="form-label fw-semibold">
                        <i class="bi bi-journal-bookmark me-1 text-primary"></i> Pilih Jadwal (Mapel & Kelas)
                    </label>
                    <select name="jadwal_id" id="jadwal_id" 
                            class="form-select shadow-sm" required>
                        <option value="">-- Pilih Jadwal --</option>
                        @foreach($jadwal as $j)
                            <option value="{{ $j->id }}">
                                {{ $j->mapel->nama_mapel }} - {{ $j->kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-sm">
                    <i class="bi bi-save me-1"></i> Simpan Tugas
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
