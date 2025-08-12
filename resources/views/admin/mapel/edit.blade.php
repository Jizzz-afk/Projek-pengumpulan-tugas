@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-primary fw-bold">Edit Mapel</h3>

    <form action="{{ route('admin.mapel.update', $mapel->id) }}" method="POST" class="mb-3">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_mapel" class="form-label fw-semibold">Nama Mapel</label>
            <input
                type="text"
                id="nama_mapel"
                name="nama_mapel"
                value="{{ old('nama_mapel', $mapel->nama_mapel) }}"
                class="form-control"
                required
            >
        </div>

        <div class="mb-3">
            <label for="guru_id" class="form-label fw-semibold">Guru Pengajar</label>
            <select
                id="guru_id"
                name="guru_id"
                class="form-select"
                required
            >
                <option value="" disabled>Pilih Guru Pengajar</option>
                @foreach($guru as $g)
                    <option value="{{ $g->id }}" {{ (old('guru_id', $mapel->guru_id) == $g->id) ? 'selected' : '' }}>
                        {{ $g->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary fw-semibold">Simpan</button>
    </form>
</div>
@endsection
