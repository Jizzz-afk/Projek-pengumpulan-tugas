@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-primary mb-4">
        📜 Riwayat Tugas
    </h2>

    @if($riwayat->isEmpty())
        <div class="alert alert-info text-center shadow-sm">
            <i class="bi bi-info-circle"></i> Belum ada riwayat pengumpulan tugas.
        </div>
    @else
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
                                    <td class="text-center text-muted">
                                        {{ $r->created_at->format('d M Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>

{{-- Efek hover --}}
<style>
    .table-hover tbody tr:hover {
        background-color: #f6f9ff !important;
        transition: background-color 0.2s ease-in-out;
    }
</style>
@endsection
