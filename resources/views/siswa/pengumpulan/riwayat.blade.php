@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center rounded-top-4" style="background: linear-gradient(90deg, #4e73df, #224abe);">
            <h4 class="mb-0"><i class="bi bi-journal-check me-2"></i> Riwayat Pengumpulan & Nilai</h4>
        </div>
        <div class="card-body">
            
            @if(session('success'))
                <div class="alert alert-success shadow-sm rounded-3">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                </div>
            @endif

            @if($riwayat->isEmpty())
                <div class="text-center text-muted py-5">
                    <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                    <p class="mt-3 fs-5">Belum ada riwayat pengumpulan tugas.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle shadow-sm rounded-3 overflow-hidden">
                        <thead class="table-primary">
                            <tr>
                                <th class="text-center">📄 Judul Tugas</th>
                                <th class="text-center">📅 Tanggal Upload</th>
                                <th class="text-center">📎 File</th>
                                <th class="text-center">📊 Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayat as $item)
                                <tr class="transition">
                                    <td class="fw-semibold">{{ $item->tugas->judul }}</td>
                                    <td class="text-muted">{{ $item->created_at->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <a href="{{ asset('storage/' . $item->file) }}" target="_blank" 
                                           class="btn btn-outline-primary btn-sm rounded-pill px-3 shadow-sm">
                                            <i class="bi bi-eye-fill me-1"></i> Lihat
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        @if($item->nilai !== null)
                                            <span class="badge bg-success fs-6 px-3 py-2 shadow-sm">
                                                <i class="bi bi-check-circle-fill me-1"></i> {{ $item->nilai }}
                                            </span>
                                        @else
                                            <span class="badge bg-warning text-dark fs-6 px-3 py-2 shadow-sm">
                                                <i class="bi bi-hourglass-split me-1"></i> Belum Dinilai
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>
</div>

<style>
    .transition {
        transition: all 0.2s ease-in-out;
    }
    .transition:hover {
        background-color: #f8f9fc;
        transform: scale(1.01);
    }
</style>
@endsection
