@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-gradient">📤 Kumpulkan Tugas</h2>
        <p class="text-muted">Baca detail tugas di bawah sebelum mengumpulkan ⏰</p>
    </div>

    {{-- Notifikasi --}}
    @if(session('error'))
        <div class="alert alert-danger shadow-sm rounded-pill px-4">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded-pill px-4">{{ session('success') }}</div>
    @endif

    @php
        $now = \Carbon\Carbon::now();
        $deadline = \Carbon\Carbon::parse($tugas->deadline);
        $remaining = $now->diff($deadline);
    @endphp

    <div class="row justify-content-center">
        <div class="col-lg-9">

            {{-- Detail Tugas --}}
            <div class="table-responsive mb-4">
                <table class="table table-bordered table-hover align-middle shadow-sm rounded-3 overflow-hidden">
                    <tbody>
                        <tr>
                            <th class="bg-light" style="width: 25%">📌 Judul Tugas</th>
                            <td>{{ $tugas->judul }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">📝 Deskripsi</th>
                            <td>{!! nl2br(e($tugas->deskripsi)) !!}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">⏳ Deadline</th>
                            <td>
                                <b>{{ $deadline->format('d M Y H:i') }}</b><br>
                                <small class="text-muted">
                                    Sisa waktu: 
                                    {{ $remaining->d > 0 ? $remaining->d.' hari ' : '' }}
                                    {{ $remaining->h }} jam {{ $remaining->i }} menit
                                </small>
                            </td>
                        </tr>
                        @if($tugas->file)
                        <tr>
                            <th class="bg-light">📂 File Tugas</th>
                            <td>
                                <a href="{{ asset('storage/tugas/' . $tugas->file) }}" target="_blank" class="btn btn-sm btn-primary rounded-pill px-3">
                                    📥 Download Soal
                                </a>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            {{-- Form Pengumpulan --}}
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-gradient text-white py-3 text-center">
                    <h5 class="mb-0 fw-bold">Form Pengumpulan</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('siswa.pengumpulan.simpan') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="tugas_id" value="{{ $tugas->id }}">

                        {{-- Catatan --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">📝 Catatan</label>
                            <textarea name="catatan" class="form-control rounded-3" rows="3" placeholder="Tambahkan catatan jika perlu..."></textarea>
                        </div>

                        {{-- Upload Multiple Files --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">📎 File Tugas</label>
                            <input type="file" name="files[]" class="form-control rounded-3" 
                                accept=".pdf,.docx,.zip,.rar,.jpg,.png" multiple required>
                            <small class="text-muted">Bisa upload lebih dari 1 file (PDF, DOCX, ZIP, RAR, JPG, PNG, Max: 2MB per file)</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('siswa.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                ⬅ Kembali
                            </a>
                            <button type="submit" class="btn btn-success rounded-pill px-4 shadow-sm">
                                📤 Kumpulkan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .text-gradient {
        background: linear-gradient(90deg, #007bff, #00c4ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .bg-gradient {
        background: linear-gradient(90deg, #007bff, #00c4ff);
    }
</style>
@endsection
