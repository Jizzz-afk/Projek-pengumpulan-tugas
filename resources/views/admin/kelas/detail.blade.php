@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <h3 class="fw-bold text-primary">Detail Kelas: {{ $kelas->nama_kelas }}</h3>
        <p><strong>Wali Kelas:</strong> {{ $kelas->wali_kelas }}</p>
        <p><strong>Deskripsi:</strong> {{ $kelas->deskripsi ?? '-' }}</p>
        <p><strong>Jumlah Siswa:</strong> {{ $kelas->siswa->count() }}</p>
    </div>

    <div class="table-responsive shadow-sm rounded-3">
        <table class="table table-striped align-middle mb-0 bg-white">
            <thead class="table-primary">
                <tr>
                    <th>Nama Siswa</th>
                    <th>NIS</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kelas->siswa as $s)
                <tr>
                    <td>{{ $s->nama }}</td>
                    <td>{{ $s->nis }}</td>
                    <td>{{ $s->email }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">Belum ada siswa di kelas ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <a href="{{ route('admin.kelas.index') }} " class="btn btn-sm btn-info">Kembali</a>
    </div>
</div>
@endsection