@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-primary fw-bold">Edit Guru</h3>

    <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST" class="row g-3">
        @csrf @method('PUT')

        <div class="col-md-6">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', $guru->nama) }}">
        </div>
        <div class="col-md-6">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" id="nip" name="nip" class="form-control" value="{{ old('nip', $guru->nip) }}">
        </div>
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $guru->email) }}">
        </div>
        <div class="col-md-6">
        <label for="kelas_id" class="form-label fw-semibold">Kelas (maksimal 3)</label>
        <select name="kelas_id[]" id="kelas_id" class="form-select" multiple size="5">
            @foreach($kelas as $k)
                <option value="{{ $k->id }}"
                    {{ in_array($k->id, $guru->kelas->pluck('id')->toArray()) ? 'selected' : '' }}>
                    {{ $k->nama_kelas }}
                </option>

            @endforeach
        </select>
        <small class="text-muted">Tahan CTRL (atau CMD di Mac) untuk memilih lebih dari satu.</small>

        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ url('/admin/guru') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
