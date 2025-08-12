@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">📊 Penilaian Tugas</h4>
        </div>
        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success mb-3">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Siswa</th>
                            <th>Judul Tugas</th>
                            <th>File</th>
                            <th>Nilai</th>
                            <th class="text-center">Input Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengumpulan as $item)
                            <tr>
                                <td>{{ $item->siswa->nama }}</td>
                                <td>{{ $item->tugas->judul }}</td>
                                <td>
                                    <a href="{{ asset('storage/' . $item->file) }}" target="_blank" class="btn btn-outline-info btn-sm">
                                        📂 Lihat File
                                    </a>
                                </td>
                                <td>
                                    @if($item->nilai !== null)
                                        <span class="badge bg-success">{{ $item->nilai }}</span>
                                    @else
                                        <span class="badge bg-danger">Belum Dinilai</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('guru.penilaian.nilai', $item->id) }}" method="POST" class="d-flex gap-2">
                                        @csrf
                                        <input type="number" name="nilai" class="form-control form-control-sm"
                                            min="0" max="100" placeholder="0-100" required>
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            Simpan
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Tidak ada tugas yang dikumpulkan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
