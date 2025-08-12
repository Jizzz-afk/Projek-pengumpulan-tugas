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
    <h3>Data Guru</h3>

    <form method="POST" action="{{ url('/admin/guru') }}" enctype="multipart/form-data" class="row g-3 mb-4">
        @csrf
        <input type="text" name="nama" placeholder="Nama" class="form-control" required>
        <input type="email" name="email" placeholder="Email" class="form-control" required>
        <input type="text" name="nip" placeholder="NIP" class="form-control" required>
        <input type="password" name="password" placeholder="Password" class="form-control" required>
        <button class="btn btn-primary">Tambah</button>
    </form>

    <table class="table">
        <tr><th>Nama</th><th>Email</th><th>NIP</th><th>Aksi</th></tr>
        @foreach($guru as $g)
        <tr>
            <td>{{ $g->nama }}</td>
            <td>{{ $g->email }}</td>
            <td>{{ $g->nip }}</td>
        <td>
            <a href="{{ url('/admin/guru/'.$g->id.'/edit') }}" class="btn btn-sm btn-warning">Edit</a>

            <form method="POST" action="{{ url('/admin/guru/'.$g->id) }}" style="display:inline-block">
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
