@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-2 fw-bold text-primary">Hai, {{ Auth::user()->name }} 👋</h2>
    <p class="text-muted mb-4">Berikut ringkasan aktivitas tugasmu hari ini.</p>

    {{-- 🔔 Peringatan Tugas Hampir Deadline --}}
    @php
        \Carbon\Carbon::setLocale('id'); // <-- supaya bahasa Indo
        $soonTasks = $tugasBaru->filter(function($t) {
            $deadline = \Carbon\Carbon::parse($t->deadline);
            return now()->lessThan($deadline) && now()->diffInHours($deadline) <= 24;
        });
    @endphp

    @if($soonTasks->isNotEmpty())
        <div class="card border-0 shadow-sm mb-4 rounded-4">
            <div class="card-body p-3">
                {{-- Header Alert --}}
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-exclamation-triangle-fill text-warning me-2 fs-4 animate-pulse"></i>
                    <h6 class="fw-bold m-0 text-danger">⚠️ Deadline Hampir Tiba!</h6>
                </div>

                <p class="small text-muted mb-3">
                    Ada <b>{{ $soonTasks->count() }}</b> tugas yang akan berakhir dalam <b>24 jam</b>.  
                    Segera kerjakan sebelum terlambat 🚀
                </p>

                {{-- List Tugas --}}
                <div class="list-group border-0">
                    @foreach($soonTasks as $t)
                        @php
                            $deadline = \Carbon\Carbon::parse($t->deadline);
                            $totalMinutes = now()->diffInMinutes($deadline);

                            // Progress: makin dekat deadline makin penuh
                            $progress = max(5, 100 - ($totalMinutes / (24 * 60) * 100));

                            // Warna progress dinamis
                            $progressColor = $totalMinutes <= 60
                                ? 'bg-danger'
                                : ($totalMinutes <= 180
                                    ? 'bg-orange'
                                    : 'bg-warning');
                        @endphp

                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-semibold">{{ $t->judul }}</span>
                                <span class="badge bg-light text-dark">
                                    {{ $deadline->format('d M Y H:i') }}
                                </span>
                            </div>

                            {{-- Progress bar --}}
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar {{ $progressColor }}" role="progressbar"
                                    style="width: {{ $progress }}%"
                                    aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>

                            {{-- Countdown --}}
                            <small class="d-block mt-1">
                                ⏳ <span class="badge {{ $totalMinutes <= 60 ? 'bg-danger' : 'bg-warning text-dark' }}">
                                    {{ $deadline->diffForHumans(now(), ['parts' => 2, 'join' => true]) }}
                                </span>
                            </small>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{-- ==== STYLE EXTRA ==== --}}
    <style>
        .animate-pulse { animation: pulse 1.5s infinite; }
        @keyframes pulse { 
            0%,100% { opacity:1; transform:scale(1);} 
            50% {opacity:.6; transform:scale(1.1);} 
        }
        .bg-orange { background-color: #fb923c !important; }
    </style>
    
    <div class="row g-3">
        <!-- ====== KIRI ====== -->
        <div class="col-lg-8">
            <!-- Ringkasan -->
            <div class="row g-3 mb-3">
                <div class="col-12 col-sm-4">
                    <div class="card h-100 shadow-sm border-0 hover-lift">
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
                    <div class="card h-100 shadow-sm border-0 hover-lift">
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

                <!-- Donut Nilai -->
                <div class="col-12 col-sm-4">
                    <div class="card h-100 shadow-sm border-0 hover-lift">
                        <div class="card-body d-flex align-items-center gap-3">
                            <div class="ms-auto me-auto">
                                <div class="donut-wrap glow">
                                    <canvas id="nilaiChart" width="96" height="96"></canvas>
                                    <div class="donut-label" id="nilaiLabel">{{ round($rataNilai, 0) }}%</div>
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
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 py-3 border-bottom">
                    <h5 class="mb-0 fw-semibold text-primary">📌 Tugas Terbaru</h5>
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($tugasBaru as $t)
                        @php
                            $sudahKumpul = $t->pengumpulan()->where('siswa_id', Auth::user()->siswa->id)->exists();
                            $nilai = $t->pengumpulan()->where('siswa_id', Auth::user()->siswa->id)->value('nilai');
                            $isLate = now()->greaterThan(\Carbon\Carbon::parse($t->deadline)) && !$sudahKumpul;
                            $isAfterDeadlineAndSubmitted = now()->greaterThan(\Carbon\Carbon::parse($t->deadline)) && $sudahKumpul;
                        @endphp

                        <li class="list-group-item py-3 d-flex justify-content-between align-items-start hover-bg">
                            @if(!$isAfterDeadlineAndSubmitted)
                                {{-- ✅ MASIH BISA DIKLIK --}}
                                <a href="{{ route('siswa.pengumpulan.create', ['tugas_id' => $t->id]) }}"
                                    class="text-decoration-none text-dark d-flex w-100 justify-content-between align-items-start">
                            @else
                                {{-- 🚫 SUDAH LEWAT DEADLINE DAN SUDAH DIKUMPULKAN (non-klik) --}}
                                <div class="text-muted d-flex w-100 justify-content-between align-items-start" style="cursor:not-allowed; opacity:.7;">
                            @endif

                                <div class="me-3">
                                    <div class="fw-semibold">
                                        <i class="bi bi-journal-bookmark me-1 text-primary"></i>
                                        {{ $t->mapel->nama_mapel ?? '-' }} — {{ $t->judul }}
                                    </div>
                                    <small class="text-muted">
                                        <i class="bi bi-clock me-1"></i>
                                        Deadline: {{ \Carbon\Carbon::parse($t->deadline)->format('d M Y H:i') }}
                                    </small>
                                </div>

                                <div>
                                    @if($isLate)
                                        <span class="badge rounded-pill bg-danger">Terlambat</span>
                                    @elseif($sudahKumpul && is_null($nilai))
                                        <span class="badge rounded-pill bg-warning text-dark">Menunggu Nilai</span>
                                    @elseif($sudahKumpul)
                                        <span class="badge rounded-pill bg-success">Sudah Dikirim</span>
                                    @else
                                        <span class="badge rounded-pill bg-primary">Belum Dikerjakan</span>
                                    @endif
                                </div>

                            @if(!$isAfterDeadlineAndSubmitted)
                                </a>
                            @else
                                </div>
                            @endif
                        </li>
                    @empty
                        <li class="list-group-item text-center text-muted">Belum ada tugas terbaru</li>
                    @endforelse

                </ul>
            </div>
        </div>

        <!-- ====== KANAN (Kalender) ====== -->
        @php
            use Carbon\Carbon;
            $today = Carbon::today();
            $startOfMonth = $today->copy()->startOfMonth();
            $endOfMonth   = $today->copy()->endOfMonth();
            $tasksByDate = $tugasBaru->groupBy(fn($t) => Carbon::parse($t->deadline)->toDateString());
            $daysOfWeek = ['Min','Sen','Sel','Rab','Kam','Jum','Sab'];
            $firstDayOfWeek = $startOfMonth->dayOfWeek;
            $daysInMonth = $endOfMonth->day;
            $totalCells = $firstDayOfWeek + $daysInMonth;
            $trailing = (7 - ($totalCells % 7)) % 7;
        @endphp

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 py-3 text-center border-bottom">
                    <h6 class="m-0 fw-bold text-primary text-uppercase small">{{ $today->translatedFormat('F Y') }}</h6>
                </div>
                <div class="card-body pt-2">
                    <!-- Header Hari -->
                    <div class="calendar-grid calendar-header mb-1">
                        @foreach($daysOfWeek as $d)
                            <div class="text-center fw-semibold tiny text-secondary">{{ $d }}</div>
                        @endforeach
                    </div>

                    <!-- Grid Kalender -->
                    <div class="calendar-grid">
                        @for ($i = 0; $i < $firstDayOfWeek; $i++)
                            <div class="calendar-cell calendar-empty"></div>
                        @endfor

                        @for ($day = 1; $day <= $daysInMonth; $day++)
                            @php
                                $date = $startOfMonth->copy()->day($day);
                                $key  = $date->toDateString();
                                $isToday = $date->isToday();
                                $hasTask = isset($tasksByDate[$key]);
                                $taskCount = $hasTask ? $tasksByDate[$key]->count() : 0;

                                $allDone = false;
                                $isLateDay = false;
                                if ($hasTask) {
                                    $allDone = $tasksByDate[$key]->every(fn($t) =>
                                        $t->pengumpulan()->where('siswa_id', Auth::user()->siswa->id)->exists()
                                    );
                                    $isLateDay = $tasksByDate[$key]->contains(fn($t) =>
                                        now()->greaterThan(\Carbon\Carbon::parse($t->deadline)) &&
                                        !$t->pengumpulan()->where('siswa_id', Auth::user()->siswa->id)->exists()
                                    );
                                }
                            @endphp
                            <div class="calendar-cell 
                                {{ $isToday ? 'calendar-today' : '' }} 
                                {{ $isLateDay ? 'calendar-late' : '' }}
                                {{ $hasTask ? ($allDone ? 'calendar-taskdone' : (!$isLateDay ? 'calendar-hastask' : '')) : '' }}">
                                <div class="calendar-daynum">{{ $day }}</div>
                                @if($hasTask)
                                    <span class="calendar-dot"></span>
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

                        @for ($i = 0; $i < $trailing; $i++)
                            <div class="calendar-cell calendar-empty"></div>
                        @endfor
                    </div>

                    <!-- Legend -->
                    <div class="mt-3 d-flex flex-wrap justify-content-center gap-3">
                        <div class="d-flex align-items-center gap-2">
                            <span class="legend-circle today"></span>
                            <span class="tiny text-muted">Hari ini</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="legend-dot"></span>
                            <span class="tiny text-muted">Ada tugas</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="legend-dot done"></span>
                            <span class="tiny text-muted">Semua selesai</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="legend-dot late"></span>
                            <span class="tiny text-muted">Tugas terlambat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ==== STYLE ==== --}}
<style>
    .tiny { font-size: .8rem; }
    .hover-lift { transition: all .25s ease; }
    .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 10px 24px rgba(0,0,0,.08) !important; }
    .hover-bg:hover { background: #f9fbff; }

    .icon-pill { width: 48px; height: 48px; border-radius: 50%; display: grid; place-items: center; font-size: 1.3rem; }
    .bg-soft-primary { background: #eef4ff; color:#2563eb; }
    .bg-soft-success { background: #ecfdf5; color:#16a34a; }

    .donut-wrap { position: relative; width: 96px; height: 96px; }
    .donut-label { position: absolute; inset: 0; display: grid; place-items: center; font-weight: 700; font-size: .95rem; }
    .donut-label.red { color: #ef4444; }
    .donut-label.yellow { color: #facc15; }
    .donut-label.green { color: #22c55e; }
    .glow { filter: drop-shadow(0 0 8px rgba(59,130,246,0.3)); }

    /* Kalender */
    .calendar-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 6px; }
    .calendar-cell {
        position: relative; height: 65px; border-radius: 14px;
        background: #fff; border: 1px solid #edf0f6;
        padding: 6px; transition: .2s ease;
        display:flex; align-items:flex-start; justify-content:flex-start;
    }
    .calendar-cell:hover { box-shadow: 0 6px 16px rgba(59,130,246,.12); transform: translateY(-2px); }
    .calendar-daynum { font-size:.9rem; font-weight:600; color:#334155; }
    .calendar-today { border: 2px solid #3b82f6; background: #eff6ff; }
    .calendar-hastask { border-color:#fde68a; background:#fffbeb; }
    .calendar-taskdone { border-color: #bbf7d0; background:#f0fdf4; }
    .calendar-late { border-color: #fecaca; background:#fef2f2; }
    .calendar-dot { position:absolute; right:8px; bottom:8px; width:9px; height:9px; border-radius:50%; background:#fbbf24; }
    .calendar-taskdone .calendar-dot { background:#22c55e; }
    .calendar-late .calendar-dot { background:#ef4444; }

    .calendar-popover {
        position:absolute; display:none; z-index:5; left:50%; bottom: calc(100% + 10px);
        transform: translateX(-50%) scale(.95); width: 250px; padding: .7rem .8rem;
        border-radius: 12px; background:#fff; border:1px solid #eef1f5;
        box-shadow: 0 12px 26px rgba(0,0,0,.12);
        animation: fadeIn .2s ease forwards;
    }
    .calendar-cell:hover .calendar-popover { display:block; }
    @keyframes fadeIn { from { opacity: 0; transform: translate(-50%, 8px) scale(.95); } to { opacity: 1; transform: translate(-50%, 0) scale(1); } }

    .legend-circle { width:14px; height:14px; border-radius:50%; box-shadow: inset 0 0 0 2px #3b82f6; background:#eff6ff; display:inline-block; }
    .legend-dot { width:10px; height:10px; border-radius:50%; background:#fbbf24; border:1px solid #fcd34d; display:inline-block; }
    .legend-dot.done { background:#22c55e; border-color:#22c55e; }
    .legend-dot.late { background:#ef4444; border-color:#ef4444; }
</style>

{{-- ==== CHART NILAI ==== --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('nilaiChart').getContext('2d');
    const nilai = {{ round($rataNilai, 2) }};
    let warna;

    if (nilai < 50) {
        warna = '#ef4444';
        document.getElementById('nilaiLabel').classList.add('red');
    } else if (nilai < 75) {
        warna = '#facc15';
        document.getElementById('nilaiLabel').classList.add('yellow');
    } else {
        warna = '#22c55e';
        document.getElementById('nilaiLabel').classList.add('green');
    }

    new Chart(ctx, {
        type: 'doughnut',
        data: { datasets: [{ data: [nilai, 100 - nilai], backgroundColor: [warna, '#e6eefc'], borderWidth: 0 }] },
        options: { cutout: '72%', plugins: { legend: { display:false }, tooltip: {enabled:false} } }
    });
});
</script>
@endsection
