@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Header --}}
    <div class="text-center mb-5">
        <h2 class="fw-bold text-gradient animate-fade">📤 Kumpulkan Tugas</h2>
        <p class="text-muted fs-5">Cek detail tugas lalu unggah jawabanmu sebelum deadline ⏰</p>
    </div>

    {{-- Notifikasi --}}
    @if(session('error'))
        <div class="alert alert-danger shadow-sm rounded-3 px-4 py-3 mb-4">
            ❌ {{ session('error') }}
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded-3 px-4 py-3 mb-4">
            ✅ {{ session('success') }}
        </div>
    @endif

    @php
        \Carbon\Carbon::setLocale('id');
        $now = \Carbon\Carbon::now();
        $deadline = \Carbon\Carbon::parse($tugas->deadline);
    @endphp

    <div class="row justify-content-center">
        <div class="col-lg-9">

            {{-- Card Detail Tugas --}}
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4 animate-fade">
                <div class="card-header bg-light py-3 border-0">
                    <h5 class="mb-0 fw-bold text-primary">📌 Detail Tugas</h5>
                </div>
                <div class="card-body p-4">
                    <table class="table table-borderless align-middle mb-0">
                        <tbody>
                            <tr>
                                <th class="text-muted fw-normal" style="width: 25%">Judul</th>
                                <td class="fw-semibold fs-6">{{ $tugas->judul }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted fw-normal">Deskripsi</th>
                                <td class="fs-6">{!! nl2br(e($tugas->deskripsi)) !!}</td>
                            </tr>
                            <tr>
                                <th class="text-muted fw-normal">Deadline</th>
                                <td>
                                    <b>{{ $deadline->format('d M Y H:i') }}</b><br>
                                    @if($now->greaterThan($deadline))
                                        <span class="badge bg-danger rounded-pill mt-2 px-3 py-2">❌ Melewati deadline</span>
                                    @else
                                        <span class="badge bg-warning text-dark rounded-pill mt-2 px-3 py-2">
                                            ⏳ {{ $deadline->diffForHumans($now, ['parts' => 2, 'join' => true]) }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @if($tugas->foto_tugas)
                            <tr>
                                <th class="text-muted fw-normal">Gambar Tugas</th>
                                <td>
                                    <div class="border rounded-4 p-3 bg-light shadow-sm text-center">
                                        <img src="{{ asset('storage/' . $tugas->foto_tugas) }}" 
                                             alt="Soal Tugas" class="img-fluid rounded-4 shadow-sm" style="max-height: 400px; object-fit: contain;">
                                    </div>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Card Form Pengumpulan --}}
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden animate-fade">
                <div class="card-header bg-light py-3 border-0 text-center">
                    <h5 class="mb-0 fw-bold text-primary">📤 Form Pengumpulan</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('siswa.pengumpulan.simpan') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="tugas_id" value="{{ $tugas->id }}">

                        {{-- Catatan --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">📝 Catatan</label>
                            <textarea name="catatan" class="form-control rounded-3 shadow-sm" rows="3" placeholder="Tambahkan catatan jika perlu..."></textarea>
                        </div>

                        {{-- Upload Multiple Files --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">📎 File Tugas</label>
                            <input type="file" name="files[]" class="form-control rounded-3 shadow-sm" 
                                   accept=".pdf,.docx,.zip,.rar,.jpg,.png" multiple required>
                            <small class="text-muted d-block mt-1">Bisa upload lebih dari 1 file (PDF, DOCX, ZIP, RAR, JPG, PNG, Max: 2MB per file)</small>
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('siswa.dashboard') }}" 
                               class="btn btn-outline-secondary rounded-pill px-4 shadow-sm btn-animate">
                                ⬅ Kembali
                            </a>
                            <button type="submit" 
                                    class="btn btn-success rounded-pill px-4 shadow-sm btn-animate">
                                📤 Kumpulkan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Custom Style --}}
<style>
    .text-gradient {
        background: linear-gradient(90deg, #007bff, #00c4ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .animate-fade {
        animation: fadeInUp 0.7s ease;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .btn-animate {
        transition: all 0.2s ease-in-out;
    }
    .btn-animate:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }
</style>
@endsection
