@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-primary fw-bold">Edit Kelas</h3>

    <form action="{{ route('admin.kelas.update', $kelas->id) }}" method="POST" class="mb-3">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_kelas" class="form-label fw-semibold">Nama Kelas</label>
            <input
                type="text"
                id="nama_kelas"
                name="nama_kelas"
                value="{{ old('nama_kelas', $kelas->nama_kelas) }}"
                placeholder="Nama Kelas"
                class="form-control"
                required
            >
        </div>

        <div class="mb-3">
            <label for="guru_id" class="form-label fw-semibold">Wali Kelas</label>
            <select
                id="guru_id"
                name="guru_id"
                class="form-select"
                required
            >
                <option value="" disabled>Pilih Wali Kelas</option>
                @foreach($guru as $g)
                    <option value="{{ $g->id }}" {{ (old('guru_id', $kelas->guru_id) == $g->id) ? 'selected' : '' }}>
                        {{ $g->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary fw-semibold">Simpan</button>
    </form>
</div>
@endsection
