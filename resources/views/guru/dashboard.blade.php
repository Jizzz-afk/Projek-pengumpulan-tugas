@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Dashboard Guru</h3>

    @if ($kelasYangDibina->count() > 0)
        <div class="alert alert-info">
            Anda adalah wali kelas dari:
                @foreach ($kelasYangDibina as $kelas)
                    {{ $kelas->nama_kelas }}
                @endforeach
        </div>
    @endif

    <div class="row mt-3">
        <div class="col-md-4">
            <div class="card bg-primary text-white mb-3">
                <div class="card-body">
                    Jumlah Mapel: {{ $jumlahMapel }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white mb-3">
                <div class="card-body">
                    Jumlah Tugas: {{ $jumlahTugas }}
                </div>
            </div>
        </div>
    </div>

    @if (count($jumlahSiswaPerKelas))
        <h5 class="mt-4">Jumlah Siswa pada Kelas Anda</h5>
        <ul>
            @foreach ($jumlahSiswaPerKelas as $kelas => $jumlah)
                <li>{{ $kelas }}: {{ $jumlah }} siswa</li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
