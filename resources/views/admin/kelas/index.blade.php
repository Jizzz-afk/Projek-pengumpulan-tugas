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
    <h3>Data Kelas</h3>

    <form method="POST" action="{{ url('/admin/kelas') }}" class="mb-3">
        @csrf
        <input type="text" name="nama_kelas" placeholder="Nama Kelas" class="form-control" required>
        <select name="guru_id" class="form-control">
            <option value="">Pilih Wali Kelas</option>
            @foreach($guru as $g)
            <option value="{{ $g->id }}">{{ $g-> nama }}</option>
            @endforeach
        </select>
        <button class="btn btn-primary mt-2">Tambah</button>
    </form>

    <table class="table">
        <tr><th>Nama Kelas</th><th>Wali Kelas</th><th>Aksi</th></tr>
        @foreach($kelas as $k)
<tr>
    <td>{{ $k->nama_kelas }}</td>
    <td>{{ $k->guru->nama ?? '-' }}</td>
    <td>
        <a href="{{ url('/admin/kelas/'.$k->id.'/edit') }}" class="btn btn-sm btn-warning">Edit</a>
        <form method="POST" action="{{ url('/admin/kelas/'.$k->id) }}" style="display:inline-block">
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
