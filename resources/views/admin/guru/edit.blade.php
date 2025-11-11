@extends('layouts.app')

@section('content')

@if($errors->any())
    <div class="alert alert-danger rounded-3 shadow-sm">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container py-4">
    <h3 class="mb-4 text-primary fw-bold">
        <i class="bi bi-pencil-square me-2"></i> Edit Data Guru
    </h3>

    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="card-header bg-gradient bg-primary text-white py-3">
            <h5 class="mb-0 fw-semibold">Form Edit Guru</h5>
        </div>

        <div class="card-body bg-light px-4 py-4">
            <form method="POST" action="{{ url('/admin/guru/'.$guru->id) }}">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    {{-- Nama --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Nama Guru</label>
                        <input type="text" name="nama" class="form-control" 
                            value="{{ old('nama', $guru->nama) }}" placeholder="Masukkan nama guru" required>
                    </div>

                    {{-- Email --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" 
                            value="{{ old('email', $guru->email) }}" placeholder="Masukkan email" required>
                    </div>

                    {{-- NIP --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">NIP</label>
                        <input type="text" name="nip" class="form-control" 
                            value="{{ old('nip', $guru->nip) }}" placeholder="Nomor Induk Pegawai" required>
                    </div>

                    {{-- Mapel --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Mata Pelajaran</label>
                        <select name="mapel_id" class="form-select" required>
                            <option value="">-- Pilih Mapel --</option>
                            @foreach($mapel as $m)
                                <option value="{{ $m->id }}" 
                                    {{ $guru->jadwal->first()?->mapel_id == $m->id ? 'selected' : '' }}>
                                    {{ $m->nama_mapel }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Kelas --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Pilih Kelas</label>
                        <div class="bg-white border rounded-4 p-3">
                            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2">
                                @foreach($kelas as $k)
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" 
                                                type="checkbox" 
                                                name="kelas_id[]" 
                                                value="{{ $k->id }}"
                                                id="kelas{{ $k->id }}"
                                                @if($guru->jadwal->contains('kelas_id', $k->id)) checked @endif>
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

                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ url('/admin/guru') }}" class="btn btn-light border">
                        <i class="bi bi-arrow-left me-1"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-success fw-semibold">
                        <i class="bi bi-check-circle me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
