```blade
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

                {{-- Judul --}}
                <div class="mb-3">
                    <label for="judul" class="form-label fw-semibold">
                        <i class="bi bi-fonts me-1 text-primary"></i> Judul Tugas
                    </label>
                    <input type="text" name="judul" id="judul" 
                           class="form-control shadow-sm" value="{{ old('judul') }}" required>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label for="deskripsi" class="form-label fw-semibold">
                        <i class="bi bi-card-text me-1 text-primary"></i> Deskripsi
                    </label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" 
                              class="form-control shadow-sm">{{ old('deskripsi') }}</textarea>
                </div>

                {{-- File --}}
                <div class="mb-3">
                    <label for="foto_tugas" class="form-label fw-semibold">
                        <i class="bi bi-upload me-1 text-primary"></i> File Tugas
                    </label>
                    <input type="file" name="foto_tugas" id="foto_tugas" 
                           class="form-control shadow-sm"
                           accept=".jpg,.png,.pdf,.docx,.zip,.rar">
                    <div class="form-text">Format: jpg, png, pdf, docx, zip, rar (max 2MB)</div>
                </div>

                {{-- Deadline --}}
                <div class="mb-3">
                    <label for="deadline" class="form-label fw-semibold">
                        <i class="bi bi-calendar-date me-1 text-primary"></i> Deadline
                    </label>
                    <input type="date" name="deadline" id="deadline" 
                           class="form-control shadow-sm" value="{{ old('deadline') }}" required>
                </div>

                {{-- Jadwal --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-journal-bookmark me-1 text-primary"></i> Pilih Jadwal (Mapel & Kelas)
                    </label>

                    <div class="d-flex gap-2 mb-3">
                        <button type="button" id="checkAll" class="btn btn-sm btn-success">
                            <i class="bi bi-check2-square me-1"></i> Pilih Semua
                        </button>
                        <button type="button" id="uncheckAll" class="btn btn-sm btn-danger">
                            <i class="bi bi-x-square me-1"></i> Batalkan Semua
                        </button>
                    </div>

                    <div class="row">
                        @foreach($jadwal as $j)
                            <div class="col-md-6 col-lg-4">
                                <div class="form-check border rounded-3 p-2 mb-2 shadow-sm">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="jadwal_id[]" 
                                           value="{{ $j->id }}" 
                                           id="jadwal{{ $j->id }}"
                                           {{ (collect(old('jadwal_id'))->contains($j->id)) ? 'checked':'' }}>
                                    <label class="form-check-label fw-semibold" for="jadwal{{ $j->id }}">
                                        {{ $j->mapel->nama_mapel }} - {{ $j->kelas->nama_kelas }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-sm">
                    <i class="bi bi-save me-1"></i> Simpan Tugas
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Script langsung agar berfungsi --}}
<script>
document.addEventListener("DOMContentLoaded", function() {
    const checkAllBtn = document.getElementById('checkAll');
    const uncheckAllBtn = document.getElementById('uncheckAll');
    const checkboxes = document.querySelectorAll('input[name="jadwal_id[]"]');

    checkAllBtn.addEventListener('click', function(e) {
        e.preventDefault();
        checkboxes.forEach(cb => cb.checked = true);
    });

    uncheckAllBtn.addEventListener('click', function(e) {
        e.preventDefault();
        checkboxes.forEach(cb => cb.checked = false);
    });
});
</script>
@endsection
```
