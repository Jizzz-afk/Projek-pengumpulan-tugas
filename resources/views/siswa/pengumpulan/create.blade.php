@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- Judul Halaman -->
    <div class="mb-4 text-center">
        <h3 class="fw-bold mb-1 text-gradient">📚 Daftar Tugas Kelas Saya</h3>
        <p class="text-muted">Berikut adalah semua tugas yang harus kamu kerjakan sesuai kelasmu.</p>
    </div>

    <!-- Alert sukses -->
    <div class="alert alert-success shadow-sm d-none rounded-pill px-4">
        Pesan sukses di sini
    </div>

    <!-- Daftar tugas -->
    <div class="card task-card shadow border-0 rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-header text-white">
                        <tr>
                            <th>Judul Tugas</th>
                            <th>Deskripsi</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="fade-in">
                        {{-- Jika belum ada tugas --}}
                        <tr>
                            <td colspan="5" class="text-center py-5 bg-light">
                                <div class="d-flex flex-column align-items-center">
                                    <!-- Ikon animasi -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="text-secondary mb-3 animate-book" viewBox="0 0 16 16">
                                        <path d="M1 2.828c.885-.37 2.154-.654 3.5-.654 1.346 0 2.615.284 3.5.654V13.5c-.885-.37-2.154-.654-3.5-.654-1.346 0-2.615.284-3.5.654V2.828z"/>
                                        <path d="M0 1.5A.5.5 0 0 1 .5 1h5a.5.5 0 0 1 .5.5v13a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 0 14.5v-13zM6 2H1v11h5V2z"/>
                                        <path d="M15 1.5A.5.5 0 0 1 15.5 1h-5a.5.5 0 0 0-.5.5v13a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 .5-.5v-13zM10 2h5v11h-5V2z"/>
                                    </svg>
                                    <h5 class="text-muted fw-bold">Belum ada tugas untuk kelas kamu</h5>
                                    <p class="text-muted small mb-0">Nikmati waktu luangmu... tapi tetap siap kalau ada tugas baru! 😉</p>
                                </div>
                            </td>
                        </tr>

                        {{-- Contoh tugas --}}
                        {{--
                        <tr>
                            <td class="fw-semibold">Matematika - Persamaan Linear</td>
                            <td>Mengerjakan soal dari halaman 45-50</td>
                            <td>
                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill shadow-sm">
                                    20 Agu 2025 23:59
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-danger px-3 py-2 rounded-pill shadow-sm">Belum Dikumpulkan</span>
                            </td>
                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-success shadow-sm rounded-pill px-3 btn-hover-scale">
                                    📤 Kumpulkan
                                </a>
                            </td>
                        </tr>
                        --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    /* Gradient title */
    .text-gradient {
        background: linear-gradient(90deg, #007bff, #00c4ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Card styling */
    .task-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .task-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }

    /* Table header gradient */
    .table-header {
        background: linear-gradient(90deg, #0d6efd, #0dcaf0);
    }

    /* Hover efek row */
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.06);
        transition: background-color 0.2s ease-in-out;
    }

    /* Animasi ikon buku */
    .animate-book {
        animation: floating 3s ease-in-out infinite;
    }
    @keyframes floating {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-6px); }
    }

    /* Fade-in untuk tabel */
    .fade-in {
        animation: fadeInUp 0.5s ease-in-out;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Button hover effect */
    .btn-hover-scale {
        transition: transform 0.2s ease;
    }
    .btn-hover-scale:hover {
        transform: scale(1.05);
    }

    /* Badge style */
    .badge {
        font-size: 0.85rem;
    }
</style>
@endsection
