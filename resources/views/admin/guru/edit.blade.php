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
    <h3 class="mb-4 text-primary fw-bold">Edit Guru</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ url('/admin/guru/'.$guru->id) }}">
                @csrf @method('PUT')

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $guru->nama) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $guru->email) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">NIP</label>
                        <input type="text" name="nip" class="form-control" value="{{ old('nip', $guru->nip) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Kelas</label>
                        <select name="kelas_id" class="form-select" required>
                            @foreach($kelas as $k)
                                <option value="{{ $k->id }}" {{ $guru->jadwal->first()?->kelas_id == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Mata Pelajaran</label>
                        <select name="mapel_id" class="form-select" required>
                            @foreach($mapel as $m)
                                <option value="{{ $m->id }}" {{ $guru->jadwal->first()?->mapel_id == $m->id ? 'selected' : '' }}>
                                    {{ $m->nama_mapel }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ url('/admin/guru') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success fw-semibold">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
