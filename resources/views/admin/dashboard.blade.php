@extends('layouts.app')

@section('content')

@if ($userRole === 'admin')
@endif

<div class="container">
    <h2>Dashboard Admin</h2>
    <div class="row mt-4">

        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Guru</h5>
                    <p class="card-text">{{ $jumlahGuru }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Total Siswa</h5>
                    <p class="card-text">{{ $jumlahSiswa }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Total Kelas</h5>
                    <p class="card-text">{{ $jumlahKelas }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Total Mapel</h5>
                    <p class="card-text">{{ $jumlahMapel }}</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
