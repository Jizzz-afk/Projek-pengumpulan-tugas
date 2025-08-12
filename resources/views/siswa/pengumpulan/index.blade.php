@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">📚 Daftar Pengumpulan Tugas Saya</h3>
        <a href="{{ route('siswa.pengumpulan.create') }}" class="btn btn-success">
            ➕ Kumpulkan Tugas
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Tugas</th>
                            <th>File</th>
                            <th>Dikirim Pada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengumpulan as $item)
                            <tr>
                                <td class="fw-semibold">{{ $item->tugas->judul }}</td>
                                <td>
                                    <a href="{{ asset('storage/' . $item->file) }}" 
                                       class="btn btn-sm btn-outline-primary" 
                                       target="_blank">
                                       📄 Lihat File
                                    </a>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $item->created_at->format('d M Y H:i') }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">
                                    Belum ada tugas yang dikumpulkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
