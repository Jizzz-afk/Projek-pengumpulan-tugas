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
    <div class="card mb-3 shadow-sm border-0">
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
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-4 overflow-hidden">
            {{-- Header --}}
            <div class="modal-header bg-gradient bg-primary text-white py-3">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-person-plus me-2"></i> Tambah Guru Baru
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ url('/admin/guru') }}">
                @csrf
                <div class="modal-body bg-light px-4 py-4">
                    <div class="row g-3">
                        {{-- Nama --}}
                        <div class="col-md-4">
                            <label for="nama" class="form-label fw-semibold">Nama Guru</label>
                            <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama guru" required>
                        </div>

                        {{-- Email --}}
                        <div class="col-md-4">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email" required>
                        </div>

                        {{-- NIP --}}
                        <div class="col-md-4">
                            <label for="nip" class="form-label fw-semibold">NIP</label>
                            <input type="text" id="nip" name="nip" class="form-control" placeholder="Nomor Induk Pegawai" required>
                        </div>

                        {{-- Password --}}
                        <div class="col-md-4">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
                        </div>

                        {{-- Mapel --}}
                        <div class="col-md-4">
                            <label for="mapel_id" class="form-label fw-semibold">Mata Pelajaran</label>
                            <select name="mapel_id" id="mapel_id" class="form-select" required>
                                <option value="">-- Pilih Mapel --</option>
                                @foreach($mapel as $m)
                                    <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Kelas --}}
                        <div class="col-md-12 mt-3">
                            <label class="form-label fw-semibold">Pilih Kelas (maks. 10)</label>
                            <div class="bg-white border rounded-4 p-3">
                                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2">
                                    @foreach($kelas as $k)
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" 
                                                       name="kelas_id[]" value="{{ $k->id }}" 
                                                       id="kelas{{ $k->id }}">
                                                <label class="form-check-label small fw-medium" for="kelas{{ $k->id }}">
                                                    {{ $k->nama_kelas }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="modal-footer bg-white border-top-0 py-3">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-success fw-semibold">
                        <i class="bi bi-check-circle me-1"></i> Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

    {{-- Tabel Guru --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white fw-semibold rounded-top-3">Daftar Guru</div>
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle mb-0">
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
                        <td class="fw-semibold">{{ $g->nama }}</td>
                        <td>{{ $g->email }}</td>
                        <td>{{ $g->nip }}</td>
                        <td>
                            @forelse($g->jadwal as $j)
                                <span class="badge bg-primary mb-1">{{ $j->kelas?->nama_kelas }}</span>
                            @empty
                                <span class="text-muted">-</span>
                            @endforelse
                        </td>
                        <td>
                            <span class="badge bg-success">
                                {{ $g->jadwal->first()?->mapel?->nama_mapel ?? '-' }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ url('/admin/guru/'.$g->id.'/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                            <form method="POST" action="{{ url('/admin/guru/'.$g->id) }}" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Belum ada guru</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
