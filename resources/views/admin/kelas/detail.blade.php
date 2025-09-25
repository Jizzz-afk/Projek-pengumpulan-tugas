@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary">Detail Kelas: {{ $kelas->nama_kelas }}</h3>
        <a href="{{ url('/admin/kelas') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <p><strong>Nama Kelas:</strong> {{ $kelas->nama_kelas }}</p>
            <p><strong>Deskripsi:</strong> {{ $kelas->deskripsi ?? '-' }}</p>
            <p><strong>Wali Kelas:</strong> {{ $kelas->wali_kelas ?? '-' }}</p>
            <p><strong>Jumlah Siswa:</strong> {{ $kelas->siswa_count }}</p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <h5 class="fw-bold text-primary mb-3">Daftar Siswa</h5>
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Email</th>
                        <th>NIS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kelas->siswa as $index => $s)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $s->nama }}</td>
                            <td>{{ $s->email ?? '-' }}</td>
                            <td>{{ $s->nis }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">Belum ada siswa di kelas ini</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
