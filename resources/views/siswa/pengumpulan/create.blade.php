@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-4 text-center">
        <h3 class="fw-bold mb-1 text-gradient">📤 Kumpulkan Tugas</h3>
        <p class="text-muted">Upload tugasmu sebelum deadline berakhir.</p>
    </div>

    @if(session('error'))
        <div class="alert alert-danger shadow-sm rounded-pill px-4">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded-pill px-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow border-0 rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('siswa.pengumpulan.simpan') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Judul Tugas -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul Tugas</label>
                    <input type="text" class="form-control" value="{{ $tugas->judul }}" disabled>
                    <input type="hidden" name="tugas_id" value="{{ $tugas->id }}">
                </div>

                <!-- Catatan -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Catatan</label>
                    <textarea name="catatan" class="form-control" rows="3" placeholder="Tulis catatan atau keterangan tambahan..."></textarea>
                </div>

                <!-- Upload File -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Upload File Tugas</label>
                    <input type="file" name="file" class="form-control" accept=".pdf,.docx,.zip,.rar,.jpg,.png" required>
                    <small class="text-muted">Format: PDF, DOCX, ZIP, RAR, JPG, PNG (Max: 2MB)</small>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('siswa.dashboard') }}" class="btn btn-secondary rounded-pill px-4">⬅ Kembali</a>
                    <button type="submit" class="btn btn-success rounded-pill px-4">📤 Kumpulkan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .text-gradient {
        background: linear-gradient(90deg, #007bff, #00c4ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
@endsection
