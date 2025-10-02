@extends('layouts.app')

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container py-4">
    <h3 class="mb-4 text-primary fw-bold">Data Guru</h3>

    {{-- Filter + Tombol Tambah --}}
    <div class="card mb-3 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-2">
            <form method="GET" action="{{ url('/admin/guru') }}" class="d-flex flex-wrap gap-2">
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                    <input type="text" name="q" class="form-control" placeholder="Cari nama, email, atau NIP..."
                        value="{{ request('q') }}">
                </div>

                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-book"></i></span>
                    <select name="mapel_id" class="form-select">
                        <option value="">-- Semua Mapel --</option>
                        @foreach($mapel as $m)
                            <option value="{{ $m->id }}" {{ request('mapel_id') == $m->id ? 'selected' : '' }}>
                                {{ $m->nama_mapel }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary d-flex align-items-center gap-1">
                    <i class="bi bi-funnel"></i> Cari
                </button>
                <a href="{{ url('/admin/guru') }}" class="btn btn-secondary d-flex align-items-center gap-1">
                    <i class="bi bi-arrow-clockwise"></i> Reset
                </a>
            </form>

            <button class="btn btn-success fw-semibold d-flex align-items-center gap-1"
                data-bs-toggle="modal" data-bs-target="#modalTambahGuru">
                <i class="bi bi-plus-circle"></i> Tambah Guru
            </button>
        </div>
    </div>

    {{-- Modal Tambah Guru --}}
    <div class="modal fade" id="modalTambahGuru" tabindex="-1" aria-labelledby="modalTambahGuruLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow-lg rounded-3">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-semibold" id="modalTambahGuruLabel">Tambah Guru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ url('/admin/guru') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="nama" class="form-label fw-semibold">Nama</label>
                                <input type="text" id="nama" name="nama" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="nip" class="form-label fw-semibold">NIP</label>
                                <input type="text" id="nip" name="nip" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="kelas_id" class="form-label fw-semibold">Kelas</label>
                                <select name="kelas_id" id="kelas_id" class="form-select" required>
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach($kelas as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="mapel_id" class="form-label fw-semibold">Mata Pelajaran</label>
                                <select name="mapel_id" id="mapel_id" class="form-select" required>
                                    <option value="">-- Pilih Mapel --</option>
                                    @foreach($mapel as $m)
                                        <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success fw-semibold">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Tabel Guru --}}
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white fw-semibold">Daftar Guru</div>
        <div class="card-body table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-primary text-center">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>NIP</th>
                        <th>Kelas</th>
                        <th>Mapel</th>
                        <th width="180px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($guru as $g)
                    <tr>
                        <td>{{ $g->nama }}</td>
                        <td>{{ $g->email }}</td>
                        <td>{{ $g->nip }}</td>
                        <td>
                            <span class="badge bg-primary">
                                {{ $g->jadwal->first()?->kelas?->nama_kelas ?? '-' }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-success">
                                {{ $g->jadwal->first()?->mapel?->nama_mapel ?? '-' }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ url('/admin/guru/'.$g->id.'/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                            <form method="POST" action="{{ url('/admin/guru/'.$g->id) }}" style="display:inline-block">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada guru</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
