@extends('layouts.guru')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold text-info mb-4">
        ✏️ Penilaian: {{ $tugas->judul }} <br>
        <small class="text-muted">
            {{ $tugas->jadwal->mapel->nama_mapel ?? '-' }} - {{ $tugas->jadwal->kelas->nama_kelas ?? '-' }}
        </small>
    </h3>

    {{-- Tabel siswa yang sudah mengumpulkan --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body table-responsive">
            <h5 class="fw-bold text-success mb-3">✅ Sudah Mengumpulkan</h5>
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>File</th>
                        <th>Nilai</th>
                        <th width="160">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengumpulan as $p)
                        <tr>
                            <td>{{ $p->siswa->nama }}</td>
                            <td>{{ $p->siswa->kelas->nama_kelas ?? '-' }}</td>
                            <td>
                                @if($p->file)
                                    <a href="{{ asset('storage/'.$p->file) }}" target="_blank" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-file-earmark-arrow-down"></i> Download
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($p->nilai !== null)
                                    <span class="badge bg-success">{{ $p->nilai }}</span>
                                @else
                                    <span class="badge bg-warning text-dark">Belum Dinilai</span>
                                @endif
                            </td>
                            <td>
                                <form method="POST" action="{{ route('guru.penilaian.nilai', $p->id) }}" class="d-flex">
                                    @csrf
                                    <input type="number" name="nilai" min="0" max="100"
                                           class="form-control form-control-sm me-2"
                                           value="{{ $p->nilai ?? '' }}" required>
                                    <button class="btn btn-sm btn-success">✔</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada yang mengumpulkan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tabel siswa yang belum mengumpulkan --}}
    <div class="card shadow-sm border-0">
        <div class="card-body table-responsive">
            <h5 class="fw-bold text-danger mb-3">🚫 Belum Mengumpulkan</h5>
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama Siswa</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($belumMengumpulkan as $s)
                        <tr>
                            <td>{{ $s->nama }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center text-muted">Semua siswa sudah mengumpulkan 🎉</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
