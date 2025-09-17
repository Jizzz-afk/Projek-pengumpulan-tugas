@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-primary fw-bold">Edit Guru</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ url('/admin/guru/'.$guru->id) }}" class="row g-3">
                @csrf
                @method('PUT')

                <div class="col-md-3">
                    <label for="nama" class="form-label fw-semibold">Nama</label>
                    <input type="text" id="nama" name="nama" class="form-control" 
                           value="{{ $guru->nama }}" required>
                </div>

                <div class="col-md-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" id="email" name="email" class="form-control" 
                           value="{{ $guru->email }}" required>
                </div>

                <div class="col-md-2">
                    <label for="nip" class="form-label fw-semibold">NIP</label>
                    <input type="text" id="nip" name="nip" class="form-control" 
                           value="{{ $guru->nip }}" required>
                </div>

                {{-- Pilih Kelas --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Pilih Kelas (maks. 3)</label>
                    <div class="row">
                        @foreach($kelas as $k)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input 
                                        type="checkbox" 
                                        class="form-check-input" 
                                        id="kelas_{{ $k->id }}" 
                                        name="kelas_id[]" 
                                        value="{{ $k->id }}"
                                        @if($guru->jadwal->pluck('kelas_id')->contains($k->id)) checked @endif
                                    >
                                    <label for="kelas_{{ $k->id }}" class="form-check-label">
                                        {{ $k->nama_kelas }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <small class="text-muted">Pilih maksimal 3 kelas.</small>
                </div>

                {{-- Mapel --}}
                <div class="col-md-3">
                    <label for="mapel_id" class="form-label fw-semibold">Mata Pelajaran</label>
                    <select name="mapel_id" id="mapel_id" class="form-select" required>
                        @foreach($mapel as $m)
                            <option value="{{ $m->id }}" 
                                @if($guru->mapel_id == $m->id) selected @endif>
                                {{ $m->nama_mapel }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 d-grid">
                    <button type="submit" class="btn btn-success fw-semibold">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
