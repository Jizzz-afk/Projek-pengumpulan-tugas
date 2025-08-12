@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Penilaian Tugas</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Siswa</th>
                <th>Judul Tugas</th>
                <th>File</th>
                <th>Nilai</th>
                <th>Input Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengumpulan as $item)
                <tr>
                    <td>{{ $item->siswa->nama }}</td>
                    <td>{{ $item->tugas->judul }}</td>
                    <td>
                        <a href="{{ asset('storage/' . $item->file) }}" target="_blank">Lihat File</a>
                    </td>
                    <td>
                        @if($item->nilai !== null)
                            {{ $item->nilai }}
                        @else
                            <span class="text-danger">Belum Dinilai</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('guru.penilaian.nilai', $item->id) }}" method="POST" class="d-flex">
                            @csrf
                            <input type="number" name="nilai" class="form-control me-2" min="0" max="100" required>
                            <button type="submit" class="btn btn-primary btn-sm">Beri Nilai</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
