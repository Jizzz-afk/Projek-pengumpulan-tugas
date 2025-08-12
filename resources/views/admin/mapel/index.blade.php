@extends('layouts.app')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <h3>Data Mapel</h3>
    

    <form method="POST" action="{{ url('/admin/mapel') }}" class="mb-3">
        @csrf
        <input type="text" name="nama_mapel" placeholder="Nama Mapel" class="form-control mb-2" required>
        <select name="guru_id" class="form-control" required>
            <option value="">Pilih Guru Pengajar</option>
            @foreach($guru as $g)
                <option value="{{ $g->id }}">{{ $g->nama }}</option>
            @endforeach
        </select>
        <button class="btn btn-primary mt-2">Tambah</button>
    </form>

    <table class="table">
        <tr><th>Mapel</th><th>Guru Pengajar</th><th>Aksi</th></tr>
        @foreach($mapel as $m)
        <tr>
            <td>{{ $m->nama_mapel }}</td>
            <td>{{ $m->guru->nama ?? '-' }}</td>

        <td>
            <a href="{{ url('/admin/mapel/'.$m->id.'/edit') }}" class="btn btn-sm btn-warning">Edit</a>

            <form method="POST" action="{{ url('/admin/mapel/'.$m->id) }}" style="display:inline-block">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
            </form>
        </td>
            
        </tr>
        @endforeach
    </table>
</div>
@endsection
