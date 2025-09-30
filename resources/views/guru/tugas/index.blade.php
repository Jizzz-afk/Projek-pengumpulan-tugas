@extends('layouts.guru')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0">
            <i class="bi bi-list-task text-primary"></i> Daftar Tugas
        </h3>
        <a href="{{ route('guru.tugas.buat') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Buat Tugas Baru
        </a>
    </div>

    {{-- Filter Pencarian --}}
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('guru.tugas') }}" class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" value="{{ request('judul') }}" class="form-control" placeholder="Cari judul...">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Mata Pelajaran</label>
                    <select name="mapel" class="form-select">
                        <option value="">Mapel</option>
                        @foreach($mapelList as $mapel)
                            <option value="{{ $mapel->id }}" {{ request('mapel') == $mapel->id ? 'selected' : '' }}>
                                {{ $mapel->nama_mapel }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Kelas</label>
                    <select name="kelas" class="form-select">
                        <option value="">Kelas</option>
                        @foreach($kelasList as $kelas)
                            <option value="{{ $kelas->id }}" {{ request('kelas') == $kelas->id ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Status</option>
                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Belum Deadline</option>
                        <option value="lewat" {{ request('status') == 'lewat' ? 'selected' : '' }}>Sudah Lewat</option>
                    </select>
                </div>
                <div class="col-md-12 text-end mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Filter
                    </button>
                    <a href="{{ route('guru.tugas') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Daftar Tugas --}}
    <div class="card shadow border-0 rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Judul</th>
                            <th>File</th>
                            <th>Mapel</th>
                            <th>Kelas</th>
                            <th>Deadline</th>
                            <th width="130" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tugas as $item)
                        <tr>
                            <td class="fw-semibold text-dark">
                                <i class="bi bi-file-earmark-text text-primary me-1"></i>
                                {{ $item->judul }}
                            </td>
                            <td>
                                @if($item->foto_tugas)
                                    <a href="{{ asset('storage/'.$item->foto_tugas) }}" target="_blank" 
                                       class="badge bg-gradient bg-primary text-decoration-none">
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
                                    <span class="badge bg-danger">
                                        <i class="bi bi-x-circle me-1"></i> Lewat
                                    </span>
                                @else
                                    <span class="badge bg-success">
                                        <i class="bi bi-clock me-1"></i>
                                        {{ \Carbon\Carbon::parse($item->deadline)->format('d M Y H:i') }}
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('guru.tugas.edit',$item->id) }}" 
                                   class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('guru.tugas.hapus',$item->id) }}" method="POST" 
                                      class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Yakin hapus tugas ini?')" 
                                            data-bs-toggle="tooltip" title="Hapus">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox"></i> Belum ada tugas
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Tooltip Bootstrap --}}
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
@endpush
@endsection
