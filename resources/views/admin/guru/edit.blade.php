@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-primary fw-bold">Edit Guru</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST" enctype="multipart/form-data" class="row g-3">
        @csrf
        @method('PUT')

        <div class="col-md-6">
            <label for="nama" class="form-label">Nama Guru</label>
            <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', $guru->nama) }}" required>
        </div>

        <div class="col-md-6">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" id="nip" name="nip" class="form-control" value="{{ old('nip', $guru->nip) }}" required>
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $guru->email) }}" required>
        </div>
        
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary fw-semibold">Simpan Perubahan</button>
            <a href="{{ url('/admin/guru') }}" class="btn btn-secondary ms-2">Batal</a>
        </div>
    </form>
</div>
@endsection
