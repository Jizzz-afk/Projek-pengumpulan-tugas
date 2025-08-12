@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Notifikasi Error --}}
    @if(session('error'))
        <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
    @endif

    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">📤 Form Pengumpulan Tugas</h4>
        </div>
        <div class="card-body">

            <form action="{{ route('siswa.pengumpulan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Pilih Tugas --}}
                <div class="mb-3">
                    <label for="tugas_id" class="form-label fw-bold">Pilih Tugas</label>
                    <select name="tugas_id" id="tugas_id" class="form-select" required>
                        <option value="">-- Pilih Tugas --</option>
                        @foreach($tugas as $t)
                            <option value="{{ $t->id }}" 
                                @if(in_array($t->id, $tugasTerkumpul)) disabled @endif>
                                {{ $t->judul }} 
                                @if(in_array($t->id, $tugasTerkumpul)) (✅ Sudah dikumpulkan) @endif
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Upload File --}}
                <div class="mb-3">
                    <label for="file" class="form-label fw-bold">Upload File</label>
                    <input type="file" name="file" id="file" class="form-control" accept=".pdf,.doc,.docx,.zip,.rar" required>
                    <small class="text-muted">Format yang diizinkan: PDF, DOC, DOCX, ZIP, RAR. Maks 10MB</small>
                </div>

                {{-- Catatan --}}
                <div class="mb-3">
                    <label for="catatan" class="form-label fw-bold">Catatan</label>
                    <textarea name="catatan" id="catatan" class="form-control" rows="3" placeholder="Tulis catatan jika perlu..." required></textarea>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-end">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-success">📤 Kumpulkan</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
