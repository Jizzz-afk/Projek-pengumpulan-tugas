@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-primary mb-4">📜 Riwayat Tugas</h2>

    <div class="card shadow border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="text-center" style="width: 50px;">#</th>
                            <th>Judul Tugas</th>
                            <th class="text-center">File</th>
                            <th class="text-center">Nilai</th>
                            <th>Catatan</th>
                            <th class="text-center">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($riwayat->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center py-5 bg-light">
                                    <div class="d-flex flex-column align-items-center">
                                        <!-- Ikon arsip -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor"
                                             class="text-secondary mb-3 animate-archive" viewBox="0 0 16 16">
                                            <path d="M4.81.783A1.5 1.5 0 0 1 6.207 0h3.586a1.5 1.5 0 0 1 1.397.783L14.118 4H1.882l2.928-3.217z"/>
                                            <path d="M.5 4.5h15a.5.5 0 0 1 .5.5V5a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1v-.5a.5.5 0 0 1 .5-.5z"/>
                                            <path d="M1 7h14v7a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V7zm4.5 2a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                                        </svg>
                                        <h5 class="text-muted fw-bold">Belum ada riwayat tugas</h5>
                                        <p class="text-muted small">Ayo mulai kumpulkan tugasmu biar ada yang tercatat di sini 😉</p>
                                    </div>
                                </td>
                            </tr>
                        @else
                            @foreach($riwayat as $r)
                                <tr>
                                    <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                    <td class="fw-semibold">{{ $r->tugas->judul ?? '-' }}</td>
                                    <td class="text-center">
                                        <a href="{{ asset('storage/' . $r->file) }}" target="_blank" class="btn btn-sm btn-outline-primary shadow-sm">
                                            <i class="bi bi-eye"></i> Lihat
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        @if($r->nilai !== null)
                                            <span class="badge bg-success fs-6 px-3 py-2 shadow-sm">{{ $r->nilai }}</span>
                                        @else
                                            <span class="badge bg-secondary px-3 py-2">Belum Dinilai</span>
                                        @endif
                                    </td>
                                    <td>{{ $r->catatan ?? '-' }}</td>
                                    <td class="text-center text-muted">{{ $r->created_at->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Efek hover & animasi ikon --}}
<style>
    .table-hover tbody tr:hover {
        background-color: #f6f9ff !important;
        transition: background-color 0.2s ease-in-out;
    }
    .animate-archive {
        animation: floatY 3s ease-in-out infinite;
    }
    @keyframes floatY {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-5px); }
    }
</style>
@endsection
