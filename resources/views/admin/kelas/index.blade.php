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
                    <input type="text" name="deskripsi" placeholder="Deskripsi" class="form-control form-control-lg" required>
                </div>
                <div class="col-md-5">
                <select name="wali_kelas" class="form-select form-select-lg" required>
                    <option value="" disabled selected>Pilih Wali Kelas</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->wali_kelas }}">{{ $k->wali_kelas }}</option>
                    @endforeach
                </select>
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-primary btn-lg fw-semibold" type="submit">Tambah Kelas</button>
                </div>
            </form>
        </div>
    </div>

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
                    <a href="{{ route('admin.kelas.detail', $k->id) }}" class="btn btn-sm btn-info">
                        <i class="bi bi-info-circle"></i> Detail
                    </a>
                    <div>
                        <a href="{{ url('/admin/kelas/'.$k->id.'/edit') }}" class="btn btn-sm btn-warning me-1">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form method="POST" action="{{ url('/admin/kelas/'.$k->id) }}" style="display:inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
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
