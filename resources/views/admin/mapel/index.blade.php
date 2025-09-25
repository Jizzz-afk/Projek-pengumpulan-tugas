@extends('layouts.app')

@section('content')

@if (session('success') || session('error'))
    <div class="alert alert-{{ session('success') ? 'success' : 'danger' }}">
        {{ session('success') ?? session('error') }}
    </div>
@endif

<div class="container py-4">
    <h3 class="mb-4 text-primary fw-bold">Data Mata Pelajaran</h3>

    {{-- Filter + Tombol Tambah --}}
    <div class="card mb-3 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-2">
            <form method="GET" action="{{ route('admin.mapel.index') }}" class="d-flex flex-wrap gap-2">
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                    <input type="text" name="q" class="form-control" placeholder="Cari nama mapel..."
                        value="{{ request('q') }}">
                </div>
                <button type="submit" class="btn btn-primary d-flex align-items-center gap-1">
                    <i class="bi bi-funnel"></i> Cari
                </button>
                <a href="{{ route('admin.mapel.index') }}" class="btn btn-secondary d-flex align-items-center gap-1">
                    <i class="bi bi-arrow-clockwise"></i> Reset
                </a>
            </form>

            <button class="btn btn-success fw-semibold d-flex align-items-center gap-1"
                data-bs-toggle="modal" data-bs-target="#modalTambahMapel">
                <i class="bi bi-plus-circle"></i> Tambah Mapel
            </button>
        </div>
    </div>

    {{-- Modal Tambah Mapel --}}
    <div class="modal fade" id="modalTambahMapel" tabindex="-1" aria-labelledby="modalTambahMapelLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content shadow-lg rounded-3">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-semibold" id="modalTambahMapelLabel">
                        <i class="bi bi-plus-circle"></i> Tambah Mata Pelajaran
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.mapel.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_mapel" class="form-label fw-semibold">Nama Mapel</label>
                            <input type="text" name="nama_mapel" id="nama_mapel" class="form-control" placeholder="Contoh: Matematika" required>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-success fw-semibold">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Tabel Mapel --}}
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white fw-semibold">
            Daftar Mata Pelajaran
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Mapel</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mapel as $index => $m)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $m->nama_mapel }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.mapel.edit', $m->id) }}" class="btn btn-warning btn-sm d-inline-flex align-items-center gap-1">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('admin.mapel.destroy', $m->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus mapel ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm d-inline-flex align-items-center gap-1">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">Belum ada data mapel</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
