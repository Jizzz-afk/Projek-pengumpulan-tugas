@extends('layouts.app')

@section('content')

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="container">
    <h2>Form Pengumpulan Tugas</h2>

    <form action="{{ route('siswa.pengumpulan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="tugas_id" class="form-label">Pilih Tugas</label>
        <select name="tugas_id" class="form-control" required>
            <option value="">-- Pilih Tugas --</option>
            @foreach($tugas as $t)
                <option value="{{ $t->id }}" 
                    @if(in_array($t->id, $tugasTerkumpul)) disabled @endif>
                    {{ $t->judul }} 
                    @if(in_array($t->id, $tugasTerkumpul)) (Sudah dikumpulkan) @endif
                </option>
            @endforeach
        </select>
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">Upload File</label>
            <input type="file" name="file" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan</label>
            <textarea name="catatan" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Kumpulkan</button>
    </form>
</div>
@endsection
