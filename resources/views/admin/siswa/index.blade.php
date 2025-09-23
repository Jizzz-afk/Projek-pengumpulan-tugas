@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-primary fw-bold">Data Siswa</h3>

    {{-- Notifikasi error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form Tambah Siswa --}}
    <div class="card shadow-sm mb-5">
        <div class="card-body">
            <form method="POST" action="{{ url('/admin/siswa') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" class="form-control form-control-lg" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="Masukkan email" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nis" class="form-label fw-semibold">NIS</label>
                        <input type="text" name="nis" id="nis" class="form-control form-control-lg" placeholder="Nomor Induk Siswa" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Buat password" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label fw-semibold">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control form-control-lg" accept="image/*" required>
                </div>

                <div class="mb-4">
                    <label for="kelas_id" class="form-label fw-semibold">Kelas</label>
                    <select name="kelas_id" id="kelas_id" class="form-select form-select-lg" required>
                        <option value="" disabled selected>Pilih kelas</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-lg w-100 fw-semibold">Tambah Siswa</button>
            </form>
        </div>
    </div>

    {{-- Filter Search --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ url('/admin/siswa') }}" class="row g-2">
                <div class="col-md-8">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="form-control form-control-lg" placeholder="Cari nama, NIS, atau kelas...">
                </div>
                <div class="col-md-4 d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Data Siswa --}}
    <div class="table-responsive shadow-sm rounded-3">
        <table class="table table-striped align-middle mb-0 bg-white">
            <thead class="table-primary">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>NIS</th>
                    <th>Foto</th>
                    <th>Kelas</th>
                    <th class="text-center" style="width: 160px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswa as $s)
                <tr>
                    <td>{{ $s->nama }}</td>
                    <td>{{ $s->email }}</td>
                    <td>{{ $s->nis }}</td>
                    <td>
                        @if($s->foto)
                            <img src="{{ asset('storage/' . $s->foto) }}" alt="Foto {{ $s->nama }}" width="80" class="rounded">
                        @else
                            <span class="text-muted fst-italic">Tidak ada foto</span>
                        @endif
                    </td>
                    <td>{{ $s->kelas->nama_kelas ?? '-' }}</td>
                    <td class="text-center">
                        <a href="{{ url('/admin/siswa/'.$s->id.'/edit') }}" class="btn btn-sm btn-warning me-1" title="Edit Siswa">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form method="POST" action="{{ url('/admin/siswa/'.$s->id) }}" style="display:inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" title="Hapus Siswa">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada data siswa.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $siswa->links() }}
    </div>
</div>
@endsection
