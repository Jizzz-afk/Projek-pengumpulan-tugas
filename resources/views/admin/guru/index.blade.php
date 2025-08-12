@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-primary fw-bold">Data Guru</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/admin/guru') }}" enctype="multipart/form-data" class="row g-3 mb-4">
        @csrf
        <div class="col-md-3">
            <label for="nama" class="form-label fw-semibold">Nama</label>
            <input type="text" id="nama" name="nama" placeholder="Nama lengkap" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input type="email" id="email" name="email" placeholder="Email aktif" class="form-control" required>
        </div>
        <div class="col-md-2">
            <label for="nip" class="form-label fw-semibold">NIP</label>
            <input type="text" id="nip" name="nip" placeholder="NIP" class="form-control" required>
        </div>
        <div class="col-md-2">
            <label for="password" class="form-label fw-semibold">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" class="form-control" required>
        </div>
        <div class="col-md-2 d-grid align-self-end">
            <button type="submit" class="btn btn-primary fw-semibold">Tambah Guru</button>
        </div>
    </form>

    <div class="table-responsive shadow-sm rounded-3">
        <table class="table table-striped align-middle mb-0 bg-white">
            <thead class="table-primary text-center">
                <tr>
                    <th class="text-start" style="width: 30%;">Nama</th>
                    <th style="width: 35%;">Email</th>
                    <th style="width: 20%;">NIP</th>
                    <th style="width: 15%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($guru as $g)
                <tr>
                    <td class="text-start">{{ $g->nama }}</td>
                    <td>{{ $g->email }}</td>
                    <td>{{ $g->nip }}</td>
                    <td class="text-center">
                        <a href="{{ url('/admin/guru/'.$g->id.'/edit') }}" class="btn btn-sm btn-warning me-1 px-3" title="Edit Guru">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form method="POST" action="{{ url('/admin/guru/'.$g->id) }}" style="display:inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger px-3" title="Hapus Guru">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Belum ada data guru.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
