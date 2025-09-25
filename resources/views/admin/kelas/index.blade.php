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

    {{-- Filter + Tombol Tambah --}}
    <div class="card mb-3 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-2">
            <form method="GET" action="{{ url('/admin/kelas') }}" class="d-flex flex-wrap gap-2">
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                    <input type="text" name="q" class="form-control" placeholder="Cari kelas, wali kelas, atau deskripsi..."
                           value="{{ request('q') }}">
                </div>
                <button class="btn btn-primary d-flex align-items-center gap-1" type="submit">
                    <i class="bi bi-funnel"></i> Cari
                </button>
                <a href="{{ url('/admin/kelas') }}" class="btn btn-secondary d-flex align-items-center gap-1">
                    <i class="bi bi-arrow-clockwise"></i> Reset
                </a>
            </form>

            <button class="btn btn-success fw-semibold d-flex align-items-center gap-1"
                data-bs-toggle="modal" data-bs-target="#modalTambahKelas">
                <i class="bi bi-plus-circle"></i> Tambah Kelas
            </button>
        </div>
    </div>

    {{-- Modal Tambah Kelas --}}
    <div class="modal fade" id="modalTambahKelas" tabindex="-1" aria-labelledby="modalTambahKelasLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow-lg rounded-3">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-semibold" id="modalTambahKelasLabel">
                        <i class="bi bi-plus-circle"></i> Tambah Kelas
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ url('/admin/kelas') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nama_kelas" class="form-label fw-semibold">Nama Kelas</label>
                                <input type="text" name="nama_kelas" id="nama_kelas" class="form-control" placeholder="Contoh: X IPA 1" required>
                            </div>
                            <div class="col-md-6">
                                <label for="wali_kelas" class="form-label fw-semibold">Wali Kelas</label>
                                <input type="text" name="wali_kelas" id="wali_kelas" class="form-control" placeholder="Nama wali kelas" required>
                            </div>
                            <div class="col-12">
                                <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Contoh: Kelas unggulan untuk IPA" rows="2" required></textarea>
                            </div>
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

    {{-- Grid Kelas --}}
    <div class="row">
        @forelse($kelas as $k)
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm h-100 border-0 rounded-3">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-primary">{{ $k->nama_kelas }}</h5>
                    <p class="card-text text-muted">{{ $k->deskripsi ?? '-' }}</p>
                    <p><strong>Jumlah Siswa:</strong> {{ $k->siswa_count }}</p>
                    <p><strong>Wali Kelas:</strong> {{ $k->wali_kelas }}</p>
                </div>
                <div class="card-footer bg-white border-0 d-flex justify-content-between">
                    <a href="{{ route('admin.kelas.detail', $k->id) }}" class="btn btn-sm btn-info d-flex align-items-center gap-1">
                        <i class="bi bi-info-circle"></i> Detail
                    </a>
                    <div>
                        <a href="{{ url('/admin/kelas/'.$k->id.'/edit') }}" class="btn btn-sm btn-warning me-1">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form method="POST" action="{{ url('/admin/kelas/'.$k->id) }}" style="display:inline-block"
                              onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted">
            Belum ada data kelas.
        </div>
        @endforelse
    </div>
</div>
@endsection
