@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary mb-0">
            📊 Nilai Tugas
        </h2>
        <span class="text-muted small">
            Terakhir diperbarui: {{ now()->format('d M Y') }}
        </span>
    </div>

    <!-- Jika Tidak Ada Data -->
    @if($nilai->isEmpty())
        <div class="text-center text-muted py-5">
            <i class="bi bi-clipboard-x" style="font-size: 3rem;"></i>
            <p class="mt-3 mb-0 fs-5">Belum ada nilai yang diberikan.</p>
        </div>
    @else
        <!-- Tabel Nilai -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-center" style="width: 5%;">No</th>
                                <th>Judul Tugas</th>
                                <th class="text-center" style="width: 15%;">Nilai</th>
                                <th class="text-center" style="width: 20%;">Tanggal Dinilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($nilai as $n)
                                <tr>
                                    <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                    <td>{{ $n->tugas->judul ?? '-' }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-success fs-6 px-3 py-2 shadow-sm">
                                            {{ $n->nilai }}
                                        </span>
                                    </td>
                                    <td class="text-center text-muted">
                                        {{ $n->updated_at->format('d M Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
