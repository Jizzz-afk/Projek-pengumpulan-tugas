@extends('layouts.app')

@section('content')

<div class="container">

    <a href="{{ route('guru.tugas.buat') }}" class="btn btn-primary mb-3">Buat Tugas Baru</a>
    
<table class="table table-bordered">
    <tr>
        <th>Judul</th>
        <th>Mapel</th>
        <th>Kelas</th>
        <th>Deadline</th>
        <th>Aksi</th>
    </tr>
    @foreach($tugas as $item)
    <tr>
        <td>{{ $item->judul }}</td>
        <td>{{ $item->mapel->nama_mapel ?? '-' }}</td>
        <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
        <td>{{ $item->deadline }}</td>
        <td>
            <a href="{{ route('guru.tugas.edit', $item->id) }}">Edit</a> |
            <form method="POST" action="{{ route('guru.tugas.hapus', $item->id) }}" style="display:inline;">
                @csrf @method('DELETE')
                <button onclick="return confirm('Yakin hapus tugas?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
</div>
@endsection
