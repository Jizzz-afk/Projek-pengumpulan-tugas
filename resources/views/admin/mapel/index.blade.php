@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-primary fw-bold">Data Mapel</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/admin/mapel') }}" class="mb-4 row g-3 align-items-center">
        @csrf
        <div class="col-md-6">
            <label for="nama_mapel" class="form-label fw-semibold">Nama Mapel</label>
            <input type="text" id="nama_mapel" name="nama_mapel" placeholder="Nama Mapel" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label for="guru_id" class="form-label fw-semibold">Guru Pengajar</label>
            <select id="guru_id" name="guru_id" class="form-select" required>
                <option value="" selected disabled>Pilih Guru Pengajar</option>
                @foreach($guru as $g)
                    <option value="{{ $g->id }}">{{ $g->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 d-grid mt-4">
            <button type="submit" class="btn btn-primary fw-semibold">Tambah Mapel</button>
        </div>
    </form>

    <div class="table-responsive shadow-sm rounded-3">
        <table class="table table-striped align-middle mb-0 bg-white">
            <thead class="table-primary text-center">
                <tr>
                    <th class="text-start" style="width: 50%;">Mapel</th>
                    <th style="width: 35%;">Guru Pengajar</th>
                    <th style="width: 15%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mapel as $m)
                <tr>
                    <td class="text-start">{{ $m->nama_mapel }}</td>
                    <td>{{ $m->guru->nama ?? '-' }}</td>
                    <td class="text-center">
                        <a href="{{ url('/admin/mapel/'.$m->id.'/edit') }}" class="btn btn-sm btn-warning me-1 px-3" title="Edit Mapel">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form method="POST" action="{{ url('/admin/mapel/'.$m->id) }}" style="display:inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger px-3" title="Hapus Mapel">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">Belum ada data mapel.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
