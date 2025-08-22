@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Tombol Buat Tugas --}}
    <a href="{{ route('guru.tugas.buat') }}" class="btn btn-primary mb-4 shadow-sm">
        <i class="bi bi-plus-circle me-1"></i> Buat Tugas Baru
    </a>

    {{-- Tabel Tugas --}}
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th>Judul</th>
                    <th>Foto</th>
                    <th>Mapel</th>
                    <th>Kelas</th>
                    <th>Deadline</th>
                    <th width="140">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tugas as $item)
                    <tr>
                        <td class="fw-semibold">{{ $item->judul }}</td>
                        <td>

                            @if($item->foto_tugas)
                            @php
        $ext = pathinfo($item->foto_tugas, PATHINFO_EXTENSION);
    @endphp

    @if(in_array(strtolower($ext), ['jpg','jpeg','png']))
        <img src="{{ asset('storage/'.$item->foto_tugas) }}" 
             alt="Foto Tugas" 
             class="img-thumbnail" 
             style="max-width: 80px; max-height: 80px;">
             @else
             <a href="{{ asset('storage/'.$item->foto_tugas) }}" 
             target="_blank" 
             class="btn btn-sm btn-outline-primary">
             <i class="bi bi-file-earmark-arrow-down"></i> Download
            </a>
            @endif
            @else
            <span class="text-muted">-</span>
            @endif
        </td>
            
                        <td>{{ $item->mapel->nama_mapel ?? '-' }}</td>
                        <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                        <td>
                            @if(\Carbon\Carbon::parse($item->deadline)->isPast())
                                <span class="badge bg-danger">Sudah Lewat</span>
                            @else
                                <span class="badge bg-success">{{ $item->deadline }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('guru.tugas.edit', $item->id) }}" class="btn btn-warning btn-sm me-1">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form method="POST" action="{{ route('guru.tugas.hapus', $item->id) }}" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus tugas ini?')">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if($tugas->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center text-muted">Tidak ada tugas yang tersedia</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
