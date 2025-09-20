@extends('layouts.guru')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold mb-4 text-primary"><i class="bi bi-file-earmark-text"></i> Daftar Tugas</h3>

    <a href="{{ route('guru.tugas.buat') }}" class="btn btn-primary mb-4 shadow-sm">
        <i class="bi bi-plus-circle me-1"></i> Buat Tugas Baru
    </a>

    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Judul</th>
                            <th>File</th>
                            <th>Mapel</th>
                            <th>Kelas</th>
                            <th>Deadline</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tugas as $item)
                        <tr>
                            <td class="fw-semibold">{{ $item->judul }}</td>
                            <td>
                                @if($item->foto_tugas)
                                    <a href="{{ asset('storage/'.$item->foto_tugas) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-file-earmark-arrow-down"></i> Lihat
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $item->jadwal->mapel->nama_mapel ?? '-' }}</td>
                            <td>{{ $item->jadwal->kelas->nama_kelas ?? '-' }}</td>
                            <td>
                                @if(\Carbon\Carbon::parse($item->deadline)->isPast())
                                    <span class="badge bg-danger">Lewat</span>
                                @else
                                    <span class="badge bg-success">{{ $item->deadline }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('guru.tugas.edit',$item->id) }}" class="btn btn-warning btn-sm me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('guru.tugas.hapus',$item->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus tugas ini?')">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada tugas</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
