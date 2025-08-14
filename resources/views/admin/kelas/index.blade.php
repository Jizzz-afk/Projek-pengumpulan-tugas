@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-primary fw-bold">Data Kelas</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="POST" action="{{ url('/admin/kelas') }}" class="row g-3 align-items-center">
                @csrf
                <div class="col-md-5">
                    <input type="text" name="nama_kelas" placeholder="Nama Kelas" class="form-control form-control-lg" required>
                </div>
                <div class="col-md-5">
                    <select name="guru_id" class="form-select form-select-lg" required>
                        <option value="" disabled selected>Pilih Wali Kelas</option>
                        @foreach($guru as $g)
                            <option value="{{ $g->id }}">{{ $g->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-primary btn-lg fw-semibold" type="submit">Tambah Kelas</button>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive shadow-sm rounded-3">
        <table class="table table-striped align-middle mb-0 bg-white">
            <thead class="table-primary">
                <tr>
                    <th>Nama Kelas</th>
                    <th>Deskripsi</th>
                    <th>Wali Kelas</th>
                    <th class="text-center" style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kelas as $k)
                <tr>
                    <td>{{ $k->nama_kelas }}</td>
                    <td>{{ $k->deskripsi }}</td>
                    <td>{{ $k->guru->nama ?? '-' }}</td>
                    <td class="text-center">
                        <a href="{{ url('/admin/kelas/'.$k->id.'/edit') }}" class="btn btn-sm btn-warning me-1" title="Edit Kelas">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form method="POST" action="{{ url('/admin/kelas/'.$k->id) }}" style="display:inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" title="Hapus Kelas">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">Belum ada data kelas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
