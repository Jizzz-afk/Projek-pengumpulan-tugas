@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- 🔹 Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-primary mb-1">👨‍🏫 Data Guru</h3>
            <p class="text-muted mb-0">Kelola daftar guru dan kelas yang diampu.</p>
        </div>
        <button class="btn btn-primary fw-semibold" data-bs-toggle="collapse" data-bs-target="#formTambahGuru">
            + Tambah Guru
        </button>
    </div>

    {{-- 🔹 Form Tambah Guru --}}
    <div class="collapse mb-4" id="formTambahGuru">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="fw-bold text-primary mb-3">Form Tambah Guru</h5>
                <form method="POST" action="{{ url('/admin/guru') }}" class="row g-3">
                    @csrf
                    <div class="col-md-4">
                        <label for="nama" class="form-label fw-semibold">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-control shadow-sm" required>
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" id="email" name="email" class="form-control shadow-sm" required>
                    </div>
                    <div class="col-md-4">
                        <label for="nip" class="form-label fw-semibold">NIP</label>
                        <input type="text" id="nip" name="nip" class="form-control shadow-sm" required>
                    </div>
                    <div class="col-md-4">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" id="password" name="password" class="form-control shadow-sm" required>
                    </div>

                    {{-- 🔹 Pilihan Kelas (Checkbox Grid) --}}
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Kelas (maksimal 3)</label>
                        <div class="row row-cols-2 row-cols-md-3 g-2">
                            @foreach($kelas as $k)
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input kelas-check" type="checkbox" name="kelas_id[]" value="{{ $k->id }}" id="kelas{{ $k->id }}">
                                        <label class="form-check-label" for="kelas{{ $k->id }}">
                                            {{ $k->nama_kelas }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <small class="text-muted d-block mt-1">Pilih maksimal 3 kelas.</small>
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-success fw-semibold px-4">Simpan</button>
                        <button type="button" class="btn btn-secondary fw-semibold" data-bs-toggle="collapse" data-bs-target="#formTambahGuru">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- 🔹 Tabel Guru --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="fw-bold text-primary mb-3">Daftar Guru</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>NIP</th>
                            <th>Kelas</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($guru as $g)
                        <tr>
                            <td class="fw-semibold">{{ $g->nama }}</td>
                            <td>{{ $g->email }}</td>
                            <td>{{ $g->nip }}</td>
                            <td>
                                @if($g->kelas->count())
                                    @foreach($g->kelas as $k)
                                        <span class="badge bg-primary">{{ $k->nama_kelas }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ url('/admin/guru/'.$g->id.'/edit') }}" class="btn btn-sm btn-warning me-1">
                                    ✏️ Edit
                                </a>
                                <form method="POST" action="{{ url('/admin/guru/'.$g->id) }}" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus guru ini?')">🗑️ Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Belum ada guru terdaftar</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- 🔹 Script Batas Maksimal Checkbox --}}
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const checkboxes = document.querySelectorAll(".kelas-check");
        checkboxes.forEach(cb => {
            cb.addEventListener("change", function() {
                const checked = document.querySelectorAll(".kelas-check:checked");
                if (checked.length > 3) {
                    this.checked = false;
                    alert("Maksimal hanya boleh memilih 3 kelas.");
                }
            });
        });
    });
</script>
@endpush
