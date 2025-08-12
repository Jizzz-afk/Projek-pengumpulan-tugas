@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Pengumpulan Tugas Saya</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('siswa.pengumpulan.create') }}" class="btn btn-primary mb-3">Kumpulkan Tugas</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tugas</th>
                <th>File</th>
                <th>Dikirim Pada</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengumpulan as $item)
            <tr>
                <td>{{ $item->tugas->judul }}</td>
                <td><a href="{{ asset('storage/' . $item->file) }}" target="_blank">Lihat</a></td>
                <td>{{ $item->created_at->format('d M Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
