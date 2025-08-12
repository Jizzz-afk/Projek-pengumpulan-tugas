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
    <h3>Data Siswa</h3>

    <form method="POST" action="{{ url('/admin/siswa') }}" enctype="multipart/form-data" class="row g-3 mb-4">
        @csrf
        <input type="text" name="nama" placeholder="Nama" class="form-control" required>
        <input type="email" name="email" placeholder="Email" class="form-control" required>
        <input type="text" name="nis" placeholder="NIS" class="form-control" required>
        <input type="password" name="password" placeholder="Password" class="form-control" required>
        <input type="file" name="foto" placeholder="Foto" class="form-control" required>
        <select name="kelas_id" class="form-control" required>
            <option value="">Pilih Kelas</option>
            @foreach($kelas as $k)
            <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
            @endforeach
        </select>
        <button class="btn btn-primary">Tambah</button>
    </form>

    <table class="table">
        <tr><th>Nama</th><th>Email</th><th>NIS</th><th>Foto</th><th>Kelas</th><th>Aksi</th></tr>
        @foreach($siswa as $s)
        <tr>
            <td>{{ $s->nama }}</td>
            <td>{{ $s->email }}</td>
            <td>{{ $s->nis }}</td>
            <td>
                @if($s->foto)
                    <img src="{{ asset('storage/' . $s->foto) }}" alt="Foto" width="80">
                @else
                    Tidak ada foto
                @endif
            </td>
            <td>{{ $s->kelas->nama_kelas ?? '-' }}</td>

        <td>
            <a href="{{ url('/admin/siswa/'.$s->id.'/edit') }}" class="btn btn-sm btn-warning">Edit</a>

            <form method="POST" action="{{ url('/admin/siswa/'.$s->id) }}" style="display:inline-block">
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
