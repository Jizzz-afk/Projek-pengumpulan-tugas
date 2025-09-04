@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-primary fw-bold">Data Guru</h3>

    {{-- Form Tambah Guru --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white fw-semibold">
            Tambah Guru
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/admin/guru') }}" class="row g-3">
                @csrf
                <div class="col-md-3">
                    <label for="nama" class="form-label fw-semibold">Nama</label>
                    <input type="text" id="nama" name="nama" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label for="nip" class="form-label fw-semibold">NIP</label>
                    <input type="text" id="nip" name="nip" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                {{-- Pilih Kelas --}}
                <div class="col-md-2">
                    <label for="kelas_id" class="form-label fw-semibold">Kelas (maks. 3)</label>
                    <select name="kelas_id[]" id="kelas_id" class="form-select" multiple size="5">
                        @foreach($kelas as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted">Tahan CTRL untuk memilih lebih dari satu.</small>
                </div>

                {{-- Pilih Mapel --}}
                <div class="col-md-2">
                    <label for="mapel_id" class="form-label fw-semibold">Mata Pelajaran</label>
                    <select name="mapel_id" id="mapel_id" class="form-select" required>
                        <option value="">-- Pilih Mapel --</option>
                        @foreach($mapel as $m)
                            <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 d-grid">
                    <button type="submit" class="btn btn-success fw-semibold">Tambah Guru</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Guru --}}
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white fw-semibold">
            Daftar Guru
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-primary text-center">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>NIP</th>
                        <th>Kelas</th>
                        <th>Mapel</th>
                        <th width="180px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($guru as $g)
                    <tr>
                        <td>{{ $g->nama }}</td>
                        <td>{{ $g->email }}</td>
                        <td>{{ $g->nip }}</td>
                        <td>
                            @if($g->jadwal->count())
                                @foreach($g->jadwal as $j)
                                    @if($j->kelas)
                                        <span class="badge bg-primary">{{ $j->kelas->nama_kelas }}</span>
                                    @endif
                                @endforeach
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($g->mapel)
                                <span class="badge bg-success">{{ $g->mapel->nama_mapel }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ url('/admin/guru/'.$g->id.'/edit') }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>
                            <form method="POST" action="{{ url('/admin/guru/'.$g->id) }}" style="display:inline-block">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada guru</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection