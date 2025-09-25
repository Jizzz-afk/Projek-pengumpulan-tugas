@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-primary fw-bold">Edit Mata Pelajaran</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.mapel.update', $mapel->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-2">
                    <div class="col-md-6">
                        <input type="text" name="nama_mapel" class="form-control"
                            value="{{ old('nama_mapel', $mapel->nama_mapel) }}" required>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success fw-semibold">Update</button>
                        <a href="{{ route('admin.mapel.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
