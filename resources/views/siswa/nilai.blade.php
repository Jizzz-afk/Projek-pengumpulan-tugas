@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-primary mb-4">📊 Nilai Tugas</h2>

    @if($nilai->isEmpty())
        <div class="alert alert-info">Belum ada nilai yang diberikan.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Judul Tugas</th>
                        <th>Nilai</th>
                        <th>Tanggal Dinilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nilai as $n)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $n->tugas->judul ?? '-' }}</td>
                            <td><span class="badge bg-success">{{ $n->nilai }}</span></td>
                            <td>{{ $n->updated_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
