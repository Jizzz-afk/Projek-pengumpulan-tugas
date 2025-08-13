@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-2 fw-bold text-primary">Hai, {{ Auth::user()->name }} 👋</h2>
    <p class="text-muted mb-4">Berikut adalah ringkasan aktivitas tugasmu hari ini.</p>

    <div class="row g-3">
        <!-- ====== KIRI: 3 Kartu Ringkasan + Tugas ====== -->
        <div class="col-lg-8">
            <!-- 3 kartu ringkasan (lebih kecil & simetris) -->
            <div class="row g-3 mb-3">
                <div class="col-12 col-sm-4">
                    <div class="card summary-card h-100 shadow-sm border-0">
                        <div class="card-body d-flex align-items-center gap-3">
                            <div class="icon-pill bg-soft-primary">
                                <i class="bi bi-journal-text"></i>
                            </div>
                            <div class="flex-grow-1 text-end text-sm-start">
                                <div class="text-muted small fw-semibold">Tugas Aktif</div>
                                <div class="h3 m-0 text-primary fw-bold">{{ $tugasAktif }}</div>
                                <div class="small text-muted">Belum dikumpulkan</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="card summary-card h-100 shadow-sm border-0">
                        <div class="card-body d-flex align-items-center gap-3">
                            <div class="icon-pill bg-soft-success">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div class="flex-grow-1 text-end text-sm-start">
                                <div class="text-muted small fw-semibold">Tugas Selesai</div>
                                <div class="h3 m-0 text-success fw-bold">{{ $tugasTerkumpul }}</div>
                                <div class="small text-muted">Sudah dikumpulkan</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rata-Rata Nilai (donut kecil) -->
                <div class="col-12 col-sm-4">
                    <div class="card summary-card h-100 shadow-sm border-0">
                        <div class="card-body d-flex align-items-center gap-3">
                            <div class="ms-auto me-auto">
                                <div class="donut-wrap">
                                    <canvas id="nilaiChart" width="96" height="96"></canvas>
                                    <div class="donut-label">{{ round($rataNilai, 0) }}%</div>
                                </div>
                            </div>
                            <div class="text-end d-none d-sm-block">
                                <div class="text-muted small fw-semibold">Rata-Rata</div>
                                <div class="small text-muted">Dari semua tugas</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tugas Terbaru -->
            <div class="card border-0 shadow-sm rounded-4 mb-3">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold text-primary">📌 Tugas Terbaru</h5>
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($tugasBaru as $t)
                        @php
                            $sudahKumpul = $t->pengumpulan()->where('siswa_id', Auth::user()->siswa->id)->exists();
                            $nilai = $t->pengumpulan()->where('siswa_id', Auth::user()->siswa->id)->value('nilai');
                        @endphp
                        <li class="list-group-item py-3 d-flex justify-content-between align-items-start">
                            <div class="me-3">
                                <div class="fw-semibold">{{ $t->mapel->nama_mapel ?? '-' }} — {{ $t->judul }}</div>
                                <small class="text-muted">Deadline: {{ \Carbon\Carbon::parse($t->deadline)->format('d M Y') }}</small>
                            </div>
                            <div>
                                @if($sudahKumpul && is_null($nilai))
                                    <span class="badge rounded-pill bg-warning text-dark">Menunggu Nilai</span>
                                @elseif($sudahKumpul)
                                    <span class="badge rounded-pill bg-success">Sudah Dikirim</span>
                                @else
                                    <span class="badge rounded-pill bg-primary">Belum Dikerjakan</span>
                                @endif
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item text-center text-muted">Belum ada tugas terbaru</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- ====== KANAN: Kalender Bulanan (rapat, gaya Pijar) ====== -->
        @php
            use Carbon\Carbon;
            $today = Carbon::today();
            $startOfMonth = $today->copy()->startOfMonth();
            $endOfMonth   = $today->copy()->endOfMonth();
            $tasksByDate = $tugasBaru->groupBy(function($t){
                return Carbon::parse($t->deadline)->toDateString();
            });
            $daysOfWeek = ['Min','Sen','Sel','Rab','Kam','Jum','Sab'];
            $firstDayOfWeek = $startOfMonth->dayOfWeek;
            $daysInMonth = $endOfMonth->day;
            $totalCells = $firstDayOfWeek + $daysInMonth;
            $trailing = (7 - ($totalCells % 7)) % 7;
        @endphp

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex align-items-center justify-content-center">
                        <h6 class="m-0 fw-bold text-primary text-uppercase small">{{ $today->translatedFormat('F Y') }}</h6>
                    </div>
                </div>
                <div class="card-body pt-2">
                    <!-- Header hari -->
                    <div class="calendar-grid calendar-header mb-1">
                        @foreach($daysOfWeek as $d)
                            <div class="text-center fw-semibold tiny text-secondary">{{ $d }}</div>
                        @endforeach
                    </div>

                    <!-- Grid tanggal -->
                    <div class="calendar-grid">
                        {{-- padding awal --}}
                        @for ($i = 0; $i < $firstDayOfWeek; $i++)
                            <div class="calendar-cell calendar-empty"></div>
                        @endfor

                        {{-- tanggal 1..akhir --}}
                        @for ($day = 1; $day <= $daysInMonth; $day++)
                            @php
                                $date = $startOfMonth->copy()->day($day);
                                $key  = $date->toDateString();
                                $isToday = $date->isToday();
                                $hasTask = isset($tasksByDate[$key]);
                                $taskCount = $hasTask ? $tasksByDate[$key]->count() : 0;
                            @endphp
                            <div class="calendar-cell {{ $isToday ? 'calendar-today' : '' }} {{ $hasTask ? 'calendar-hastask' : '' }}">
                                <div class="calendar-daynum">{{ $day }}</div>
                                @if($hasTask)
                                    <span class="calendar-dot" title="{{ $taskCount }} tugas pada {{ $date->translatedFormat('l, d M Y') }}"></span>
                                    <div class="calendar-popover">
                                        <div class="fw-semibold mb-1">{{ $date->translatedFormat('l, d M Y') }}</div>
                                        <ul class="mb-0 ps-3 small">
                                            @foreach($tasksByDate[$key] as $t)
                                                <li>{{ $t->mapel->nama_mapel ?? '-' }} — {{ $t->judul }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        @endfor

                        {{-- padding akhir --}}
                        @for ($i = 0; $i < $trailing; $i++)
                            <div class="calendar-cell calendar-empty"></div>
                        @endfor
                    </div>

                    <div class="mt-3 d-flex justify-content-center gap-3">
                        <div class="d-flex align-items-center gap-2">
                            <span class="legend-circle today"></span>
                            <span class="tiny text-muted">Hari ini</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="legend-dot"></span>
                            <span class="tiny text-muted">Ada tugas</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ====== /KANAN ====== -->
    </div>
</div>

<!-- ==== STYLES (hanya tampilan, variabel tidak diubah) ==== -->
<style>
    /* Global */
    .tiny { font-size: .78rem; }
    .summary-card { border-radius: 16px; }

    /* Icon pills seperti contoh */
    .icon-pill{
        width: 44px; height: 44px; border-radius: 12px;
        display: grid; place-items: center;
        font-size: 1.2rem;
    }
    .bg-soft-primary{ background: #e7f1ff; color:#0d6efd; }
    .bg-soft-success{ background: #eaf7f0; color:#28a745; }
    .bg-soft-warning{ background: #fff6df; color:#f0ad4e; }

    /* Donut kecil */
    .donut-wrap{
        position: relative; width: 96px; height: 96px;
    }
    .donut-label{
        position: absolute; inset: 0; display: grid; place-items: center;
        font-weight: 700; font-size: .95rem; color:#333;
    }

    /* Kalender compact ala Pijar */
    .calendar-grid{
        display: grid; grid-template-columns: repeat(7, 1fr); gap: 6px;
    }
    .calendar-header div{ padding: 6px 0; }
    .calendar-cell{
        position: relative; height: 56px;
        border-radius: 12px; background: #fff;
        border: 1px solid #eef1f5;
        padding: 8px;
        transition: .15s ease;
        overflow: visible;
    }
    .calendar-empty{
        background: #f8fafc;
        border: 1px dashed #eef1f5;
    }
    .calendar-cell:hover{
        box-shadow: 0 8px 18px rgba(13,110,253,.08);
        transform: translateY(-1px);
    }
    .calendar-daynum{
        font-weight: 700; font-size: .9rem; color: #0d6efd;
    }
    .calendar-today{
        box-shadow: inset 0 0 0 2px #0d6efd33;
        background: #f2f7ff;
    }
    .calendar-hastask{
        border-color:#ffe08a; background:#fffdf5;
    }
    .calendar-dot{
        position:absolute; right:8px; bottom:8px;
        width:8px; height:8px; border-radius:50%; background:#ffc107;
    }
    .calendar-popover{
        position:absolute; display:none; z-index:5;
        left:50%; bottom: calc(100% + 8px); transform: translateX(-50%);
        width: 260px; padding: .6rem .75rem; border-radius: 12px;
        background:#fff; border:1px solid #eef1f5;
        box-shadow: 0 12px 26px rgba(0,0,0,.12);
    }
    .calendar-cell:hover .calendar-popover{ display:block; }

    /* Legends */
    .legend-circle{
        width:14px; height:14px; border-radius:50%;
        box-shadow: inset 0 0 0 2px #0d6efd; background:#eaf2ff;
        display:inline-block;
    }
    .legend-dot{
        width:10px; height:10px; border-radius:50%; background:#ffc107; display:inline-block;
        border:1px solid #ffd45b;
    }

    /* Kartu */
    .card{ border-radius: 16px; }
    .list-group-item{ border-left:0; border-right:0; }
</style>

<!-- Chart.js untuk donut nilai -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('nilaiChart').getContext('2d');
        const nilai = {{ round($rataNilai, 2) }};
        new Chart(ctx, {
            type: 'doughnut',
            data: { datasets: [{ data: [nilai, 100 - nilai], backgroundColor: ['#3b82f6','#e6eefc'], borderWidth: 0 }] },
            options: {
                cutout: '72%',
                responsive: true,
                plugins: { legend: { display:false }, tooltip: {enabled:false} }
            }
        });
    });
</script>
@endsection
