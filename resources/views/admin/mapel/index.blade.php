@extends('layouts.app')

@section('content')

@if (session('success') || session('error'))
    <div class="alert alert-{{ session('success') ? 'success' : 'danger' }}">
        {{ session('success') ?? session('error') }}
    </div>
@endif

<div class="container py-4">
    <h3 class="mb-4 text-primary fw-bold">Data Mata Pelajaran</h3>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white fw-semibold">
            Tambah Mata Pelajaran
        </div>
        <div class="card-body">
            <form action="{{ route('admin.mapel.store') }}" method="POST">
                @csrf
                <div class="row g-2">
                    <div class="col-md-6">
                        <input type="text" name="nama_mapel" class="form-control" placeholder="Nama Mapel" required>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success fw-semibold">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- Form Filter Pencarian --}}
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.mapel.index') }}" class="row g-2 align-items-center">
                <div class="col-md-4">
                    <input type="text" name="q" class="form-control" placeholder="Cari nama mapel..."
                        value="{{ request('q') }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    <a href="{{ route('admin.mapel.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Mapel</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mapel as $index => $m)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $m->nama_mapel }}</td>
                            <td>
                                <a href="{{ route('admin.mapel.edit', $m->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('admin.mapel.destroy', $m->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus mapel ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
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
