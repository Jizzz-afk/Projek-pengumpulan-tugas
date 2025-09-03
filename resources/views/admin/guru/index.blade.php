@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-primary fw-bold">Data Guru</h3>

    {{-- Form Tambah Guru --}}
    <form method="POST" action="{{ url('/admin/guru') }}" class="row g-3 mb-4">
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
        <div class="col-md-2">
            <label for="kelas_id" class="form-label fw-semibold">Kelas (maksimal 3)</label>
            <select name="kelas_id[]" id="kelas_id" class="form-select" multiple size="5">
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                @endforeach
            </select>
            <small class="text-muted">Tahan CTRL (atau CMD di Mac) untuk memilih lebih dari satu.</small>

        </div>
        <div class="col-12 d-grid">
            <button type="submit" class="btn btn-primary fw-semibold">Tambah Guru</button>
        </div>
    </form>

    {{-- Tabel Guru --}}
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>NIP</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($guru as $g)
                <tr>
                    <td>{{ $g->nama }}</td>
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
                    <td>
                        <a href="{{ url('/admin/guru/'.$g->id.'/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                        <form method="POST" action="{{ url('/admin/guru/'.$g->id) }}" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center">Belum ada guru</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
