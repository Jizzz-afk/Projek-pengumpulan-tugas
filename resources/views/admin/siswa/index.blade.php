@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Judul Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary mb-0">📚 Data Siswa</h3>
        <button class="btn btn-success fw-semibold" data-bs-toggle="modal" data-bs-target="#modalTambahSiswa">
            <i class="bi bi-person-plus"></i> Tambah Siswa
        </button>
    </div>

    {{-- Notifikasi error --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Filter Search --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.siswa.index') }}" class="row g-2">
                <div class="col-md-9">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="form-control"
                        placeholder="🔍 Cari nama, NIS, atau kelas...">
                </div>
                <div class="col-md-3 d-grid">
                    <button type="submit" class="btn btn-outline-primary fw-semibold">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Data Siswa --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
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
                            <td class="fw-semibold">{{ $s->nama }}</td>
                            <td>{{ $s->email }}</td>
                            <td>{{ $s->nis }}</td>
                            <td>
                                @if($s->foto)
                                    <img src="{{ asset('storage/' . $s->foto) }}" alt="Foto {{ $s->nama }}" width="60" class="rounded shadow-sm">
                                @else
                                    <span class="text-muted fst-italic">Tidak ada foto</span>
                                @endif
                            </td>
                            <td>{{ $s->kelas->nama_kelas ?? '-' }}</td>
                            <td class="text-center">
                                <a href="{{ url('/admin/siswa/'.$s->id.'/edit') }}" class="btn btn-sm btn-warning me-1" title="Edit Siswa">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form method="POST" action="{{ url('/admin/siswa/'.$s->id) }}" style="display:inline-block" onsubmit="return confirm('Yakin ingin menghapus siswa ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Hapus Siswa">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada data siswa.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        @if ($siswa->hasPages())
            <div class="card-footer d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    Menampilkan <strong>{{ $siswa->firstItem() }}</strong> - 
                    <strong>{{ $siswa->lastItem() }}</strong> 
                    dari <strong>{{ $siswa->total() }}</strong> siswa
                </div>
                <div>
                    {{ $siswa->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>

</div>

{{-- Modal Tambah Siswa --}}
<div class="modal fade" id="modalTambahSiswa" tabindex="-1" aria-labelledby="modalTambahSiswaLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title fw-semibold" id="modalTambahSiswaLabel"><i class="bi bi-person-add"></i> Tambah Siswa</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form method="POST" action="{{ url('/admin/siswa') }}" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nama" class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email" required>
                </div>

                <div class="col-md-6">
                    <label for="nis" class="form-label fw-semibold">NIS</label>
                    <input type="text" name="nis" id="nis" class="form-control" placeholder="Nomor Induk Siswa" required>
                </div>

                <div class="col-md-6">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Buat password" required>
                </div>

                <div class="col-md-6">
                    <label for="foto" class="form-label fw-semibold">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control" accept="image/*" required>
                </div>

                <div class="col-md-6">
                    <label for="kelas_id" class="form-label fw-semibold">Kelas</label>
                    <select name="kelas_id" id="kelas_id" class="form-select" required>
                        <option value="" disabled selected>Pilih kelas</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan Data</button>
      </div>
        </form>
    </div>
  </div>
</div>
@endsection
