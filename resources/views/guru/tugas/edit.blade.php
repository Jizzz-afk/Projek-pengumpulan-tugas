@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">✏️ Edit Tugas</h4>
        </div>
        <div class="card-body">

            {{-- Notifikasi Error --}}
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            {{-- Form Edit --}}
            <form method="POST" action="{{ route('guru.tugas.update', $tugas->id) }}">
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

                {{-- Deadline --}}
                <div class="mb-3">
                    <label for="deadline" class="form-label fw-semibold">Deadline</label>
                    <input type="date" name="deadline" id="deadline" 
                        class="form-control" 
                        value="{{ old('deadline', $tugas->deadline) }}" required>
                </div>

                {{-- Mata Pelajaran --}}
                <div class="mb-3">
                    <label for="mapel_id" class="form-label fw-semibold">Mata Pelajaran</label>
                    <select name="mapel_id" id="mapel_id" class="form-select" required>
                        <option value="">-- Pilih Mapel --</option>
                        @foreach($mapel as $m)
                            <option value="{{ $m->id }}" {{ $tugas->mapel_id == $m->id ? 'selected' : '' }}>
                                {{ $m->nama_mapel }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Kelas --}}
                <div class="mb-4">
                    <label for="kelas_id" class="form-label fw-semibold">Kelas</label>
                    <select name="kelas_id" id="kelas_id" class="form-select" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id }}" {{ $tugas->kelas_id == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kelas }}
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
