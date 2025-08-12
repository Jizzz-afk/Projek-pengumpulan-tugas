@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-primary mb-4">📜 Riwayat Tugas</h2>

    @if($riwayat->isEmpty())
        <div class="alert alert-info">Belum ada riwayat pengumpulan tugas.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Judul Tugas</th>
                        <th>File</th>
                        <th>Nilai</th>
                        <th>Catatan</th>
                        <th>Tanggal Pengumpulan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riwayat as $r)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $r->tugas->judul ?? '-' }}</td>
                            <td>
                                <a href="{{ asset('storage/' . $r->file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    Lihat File
                                </a>
                            </td>
                            <td>
                                @if($r->nilai !== null)
                                    <span class="badge bg-success">{{ $r->nilai }}</span>
                                @else
                                    <span class="badge bg-secondary">Belum Dinilai</span>
                                @endif
                            </td>
                            <td>{{ $r->catatan ?? '-' }}</td>
                            <td>{{ $r->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
