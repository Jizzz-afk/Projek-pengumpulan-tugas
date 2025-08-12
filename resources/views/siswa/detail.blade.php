@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <h2 class="fw-bold text-primary">{{ $kelas->nama_kelas }}</h2>
        <p class="text-muted mb-1"><i class="bi bi-person-badge"></i> Guru: {{ $kelas->guru->nama ?? '-' }}</p>
        <p class="text-muted"><i class="bi bi-book"></i> Mapel: {{ $kelas->nama_mapel ?? '-' }}</p>
    </div>

    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">📋 Daftar Tugas</h5>
            @if($kelas->tugas->count() > 0)
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kelas->tugas as $tugas)
                        <tr>
                            <td>{{ $tugas->judul }}</td>
                            <td>{{ Str::limit($tugas->deskripsi, 50) }}</td>
                            <td>{{ $tugas->deadline ? \Carbon\Carbon::parse($tugas->deadline)->format('d M Y H:i') : '-' }}</td>
                            <td>
                                @if($tugas->status == 'aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Selesai</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('siswa.pengumpulan.create', ['tugas_id' => $tugas->id]) }}" class="btn btn-primary btn-sm rounded-pill">
                                    Kumpulkan
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted"><em>Belum ada tugas untuk kelas ini.</em></p>
            @endif
        </div>
    </div>

    <a href="{{ route('siswa.kelas') }}" class="btn btn-outline-secondary rounded-pill">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Kelas
    </a>
</div>
@endsection
