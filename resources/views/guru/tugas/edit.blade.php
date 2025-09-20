@extends('layouts.guru')

@section('content')
<div class="container">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">✏️ Edit Tugas</h4>
        </div>
        <div class="card-body">

            {{-- Notifikasi Error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form Edit --}}
            <form action="{{ route('guru.tugas.update', $tugas->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-3">
                    <label for="judul" class="form-label fw-semibold">Judul Tugas</label>
                    <input type="text" name="judul" id="judul" 
                        class="form-control" 
                        value="{{ old('judul', $tugas->judul) }}" required>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" 
                        class="form-control" rows="4">{{ old('deskripsi', $tugas->deskripsi) }}</textarea>
                </div>
                
                {{-- File Tugas --}}
                <div class="mb-3">
                    <label for="foto_tugas" class="form-label fw-semibold">File Tugas</label>
                    {{-- Preview File Lama --}}
                    @if($tugas->foto_tugas)
                        <p class="mb-2">
                            File saat ini: 
                            <a href="{{ asset('storage/'.$tugas->foto_tugas) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-file-earmark-arrow-down"></i> Lihat File
                            </a>
                        </p>
                    @endif
                    <input type="file" name="foto_tugas" id="foto_tugas" class="form-control"
                        accept=".jpg,.png,.pdf,.docx,.zip,.rar">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti file.</small>
                </div>

                {{-- Deadline --}}
                <div class="mb-3">
                    <label for="deadline" class="form-label fw-semibold">Deadline</label>
                    <input type="date" name="deadline" id="deadline" 
                        class="form-control" 
                        value="{{ old('deadline', $tugas->deadline) }}" required>
                </div>

                {{-- Mata Pelajaran --}}
                <div class="mb-3">
                    <label for="jadwal_id" class="form-label">Pilih Jadwal (Mapel & Kelas)</label>
                    <select name="jadwal_id" id="jadwal_id" class="form-select" required>
                        <option value="">-- Pilih Jadwal --</option>
                        @foreach($jadwal as $j)
                            <option value="{{ $j->id }}" {{ $tugas->jadwal_id == $j->id ? 'selected' : '' }}>
                                {{ $j->mapel->nama_mapel }} - {{ $j->kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('guru.tugas') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        💾 Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
