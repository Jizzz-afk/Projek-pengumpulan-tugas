@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- Header -->
    <div class="text-center mb-4">
        <h2 class="fw-bold text-gradient">📚 Daftar Tugas</h2>
        <p class="text-muted">Kelola & kerjakan semua tugasmu di sini.</p>
    </div>

    <!-- Alert sukses -->
    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded-pill px-4 mb-3">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- Tabel -->
    <div class="table-responsive shadow-sm rounded-4 overflow-hidden">
        <table class="table modern-table align-middle mb-0 w-100">
            <thead>
                <tr>
                    <th style="width: 20%;">Judul</th>
                    <th style="width: 15%;">Mapel</th>
                    <th style="width: 15%;">Guru</th>
                    <th style="width: 20%;">Deadline</th>
                    <th style="width: 20%;">Status</th>
                    <th style="width: 15%;" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tugas as $t)
                    @php
                        $sudahKumpul = \App\Models\Pengumpulan::where('tugas_id', $t->id)
                            ->where('siswa_id', auth()->user()->siswa->id)
                            ->exists();
                        $isLate = now()->greaterThan($t->deadline);
                    @endphp
                    <tr>
                        <!-- Judul & Deskripsi -->
                        <td>
                            <div class="fw-semibold text-dark">{{ $t->judul }}</div>
                            <div class="desc-text">{{ $t->deskripsi ?? '-' }}</div>
                        </td>

                        <!-- Mapel -->
                        <td>
                            {{ $t->mapel->nama_mapel ?? '-' }}
                        </td>

                        <td>
                            {{ $t->jadwal->guru->user->name ?? '-' }}
                        </td>

                        <!-- Deadline -->
                        <td>
                            <span class="deadline-text">
                                ⏰ {{ \Carbon\Carbon::parse($t->deadline)->format('d M Y H:i') }}
                            </span>
                        </td>

                        <!-- Status -->
                        <td>
                            @if($sudahKumpul)
                                <span class="status-badge success">Sudah Dikumpulkan</span>
                            @elseif($isLate)
                                <span class="status-badge late">Terlambat</span>
                            @else
                                <span class="status-badge pending">Belum Dikumpulkan</span>
                            @endif
                        </td>

                        <!-- Aksi -->
                        <td class="text-center">
                            @if(!$sudahKumpul && !$isLate)
                                <a href="{{ route('siswa.pengumpulan.create', ['tugas_id' => $t->id]) }}"
                                   class="btn btn-sm btn-primary rounded-pill px-3 btn-hover-scale">
                                    📤 Kumpulkan
                                </a>
                            @else
                                <button class="btn btn-sm btn-secondary rounded-pill px-3" disabled>
                                    📤 Kumpulkan
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80"
                                     fill="currentColor" class="text-secondary mb-3 animate-book"
                                     viewBox="0 0 16 16">
                                    <path d="M1 2.828c.885-.37 2.154-.654 3.5-.654 
                                             1.346 0 2.615.284 3.5.654V13.5
                                             c-.885-.37-2.154-.654-3.5-.654
                                             -1.346 0-2.615.284-3.5.654V2.828z"/>
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1h5a.5.5 
                                             0 0 1 .5.5v13a.5.5 0 0 1-.5.5h-5
                                             A.5.5 0 0 1 0 14.5v-13zM6 2H1v11h5V2z"/>
                                    <path d="M15 1.5A.5.5 0 0 1 15.5 1h-5
                                             a.5.5 0 0 0-.5.5v13a.5.5 
                                             0 0 0 .5.5h5a.5.5 0 0 0 
                                             .5-.5v-13zM10 2h5v11h-5V2z"/>
                                </svg>
                                <h5 class="fw-bold text-muted">Belum ada tugas</h5>
                                <p class="text-muted small mb-0">Santai dulu... tapi tetap siap kalau ada tugas baru 😉</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{-- CSS --}}
<style>
    .text-gradient {
        background: linear-gradient(90deg, #007bff, #00c4ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Tabel modern */
    .modern-table thead {
        background: #f8f9fa;
    }
    .modern-table th {
        font-weight: 600;
        color: #495057;
        border-bottom: 2px solid #e9ecef;
        padding: 14px 20px;
    }
    .modern-table td {
        padding: 16px 20px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f3f5;
    }
    .modern-table tbody tr:nth-child(even) {
        background-color: #fafbfc;
    }
    .modern-table tbody tr:hover {
        background-color: #f1f9ff;
    }

    /* Kolom Aksi biar tombol ga melar */
    .modern-table td:last-child,
    .modern-table th:last-child {
        width: 1%;
        white-space: nowrap;
    }

    /* Deskripsi lebih kecil */
    .desc-text {
        font-size: 0.8rem;
        color: #6c757d;
        margin-top: 2px;
    }

    /* Deadline */
    .deadline-text {
        font-size: 0.85rem;
        color: #495057;
    }

    /* Status Badge */
    .status-badge {
        padding: 7px 14px;
        border-radius: 30px;
        font-size: 0.85rem;
        font-weight: 500;
    }
    .status-badge.success { background: #d1e7dd; color: #0f5132; }
    .status-badge.pending { background: #fff3cd; color: #664d03; }
    .status-badge.late { background: #f8d7da; color: #842029; }

    /* Button efek hover */
    .btn-hover-scale { transition: transform 0.2s ease; }
    .btn-hover-scale:hover { transform: scale(1.05); }

    /* Animasi buku kosong */
    .animate-book { animation: floating 3s ease-in-out infinite; }
    @keyframes floating {
        0%,100% { transform: translateY(0); }
        50% { transform: translateY(-6px); }
    }
</style>
@endsection
