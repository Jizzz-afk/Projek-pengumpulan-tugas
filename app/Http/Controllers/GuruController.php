<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Tugas;
use App\Models\Jadwal;
use App\Models\Pengumpulan;
use App\Models\Siswa; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class GuruController extends Controller
{
// Dashboard
public function dashboard()
{
    $guru = Guru::where('user_id', Auth::id())->firstOrFail();

    $jumlahJadwal = Jadwal::where('guru_id', $guru->id)->count();

    $jumlahTugas = Tugas::whereHas('jadwal', fn($q) => $q->where('guru_id', $guru->id))->count();

    $tugasTerakhir = Tugas::whereHas('jadwal', fn($q) => $q->where('guru_id', $guru->id))
        ->latest()
        ->first();

    $jumlahMapel = Jadwal::where('guru_id', $guru->id)->with('mapel')->get()->pluck('mapel.id')->unique()->count();

    $totalSiswa = Pengumpulan::whereHas('tugas.jadwal', fn($q) => $q->where('guru_id', $guru->id))->distinct('siswa_id')->count('siswa_id');

    $jumlahSiswaPerKelas = Pengumpulan::whereHas('tugas.jadwal', fn($q) => $q->where('guru_id', $guru->id))->with('siswa.kelas')->get()->groupBy(fn($p) => $p->siswa->kelas->nama ?? 'Tanpa Kelas')->map(fn($g) => $g->pluck('siswa_id')->unique()->count());

    $totalSiswaPerKelas = [];
    foreach ($jumlahSiswaPerKelas as $kelas => $jumlah) {
        $totalSiswaPerKelas[$kelas] = Siswa::whereHas('kelas', fn($q) => $q->where('nama', $kelas))->count();
    }

    return view('guru.dashboard', compact('guru','jumlahJadwal','jumlahTugas','tugasTerakhir','jumlahMapel','totalSiswa','jumlahSiswaPerKelas','totalSiswaPerKelas'
    ));
}

    // Profil
    public function profil()
    {
        $guru = Guru::where('user_id', Auth::id())->firstOrFail();
        return view('guru.profil', compact('guru'));
    }

    // ==================== TUGAS ====================
    public function tugas()
    {
        $guru = Guru::where('user_id', Auth::id())->firstOrFail();
        $tugas = Tugas::whereHas('jadwal', fn($q)=>$q->where('guru_id',$guru->id))
            ->with('jadwal.mapel','jadwal.kelas')
            ->get();
        return view('guru.tugas.index', compact('tugas'));
    }

    public function buatTugas()
    {
        $guru = Guru::where('user_id', Auth::id())->firstOrFail();
        $jadwal = Jadwal::where('guru_id',$guru->id)->with('mapel','kelas')->get();
        return view('guru.tugas.create', compact('jadwal'));
    }

        public function simpanTugas(Request $r)
    {
        $r->validate([
            'jadwal_id' => 'required|exists:jadwal,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'deadline' => 'required|date',
            'foto_tugas' => 'nullable|file|max:2048'
        ]);

        $path = $r->hasFile('foto_tugas')
            ? $r->file('foto_tugas')->store('tugas', 'public')
            : null;

        Tugas::create([
            'jadwal_id' => $r->jadwal_id,
            'judul'     => $r->judul,
            'deskripsi' => $r->deskripsi,
            'deadline'  => $r->deadline,
            'foto_tugas'=> $path
        ]);

        return redirect()->route('guru.tugas')->with('success','Tugas dibuat');
    }


    public function editTugas($id)
    {
        $tugas = Tugas::findOrFail($id);
        $guru = Guru::where('user_id', Auth::id())->firstOrFail();

        if ($tugas->jadwal->guru_id !== $guru->id) abort(403);

        $jadwal = Jadwal::where('guru_id',$guru->id)->with('mapel','kelas')->get();
        return view('guru.tugas.edit', compact('tugas','jadwal'));
    }

    public function updateTugas(Request $r, $id)
    {
        $tugas = Tugas::findOrFail($id);
        $guru = Guru::where('user_id', Auth::id())->firstOrFail();

        if ($tugas->jadwal->guru_id !== $guru->id) abort(403);

        $r->validate([
            'jadwal_id' => 'required|exists:jadwal,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'deadline' => 'required|date',
            'foto_tugas' => 'nullable|file|max:2048'
        ]);

        $path = $tugas->foto_tugas;
        if ($r->hasFile('foto_tugas')) {
            $path = $r->file('foto_tugas')->store('tugas','public');
        }

        $tugas->update([
            'jadwal_id' => $r->jadwal_id,
            'judul'     => $r->judul,
            'deskripsi' => $r->deskripsi,
            'deadline'  => $r->deadline,
            'foto_tugas'=> $path
        ]);


        return redirect()->route('guru.tugas')->with('success','Tugas diperbarui');
    }

    public function hapusTugas($id)
    {
        $tugas = Tugas::findOrFail($id);
        $guru = Guru::where('user_id', Auth::id())->firstOrFail();
        if ($tugas->jadwal->guru_id !== $guru->id) abort(403);
        $tugas->delete();
        return redirect()->route('guru.tugas')->with('success','Tugas dihapus');
    }

    // ==================== PENILAIAN ====================
    public function penilaian()
    {
        $guru = Guru::where('user_id', Auth::id())->firstOrFail();

        $kelas = Kelas::whereHas('jadwal', function($q) use ($guru) {
            $q->where('guru_id', $guru->id);
        })->withCount('siswa')->get();

        return view('guru.penilaian.index', compact('kelas'));
    }

    public function penilaianKelas($kelasId)
    {
        $guru = Guru::where('user_id', Auth::id())->firstOrFail();

        $kelas = Kelas::findOrFail($kelasId);

        $tugas = Tugas::whereHas('jadwal', function($q) use ($guru, $kelasId) {
            $q->where('guru_id', $guru->id)->where('kelas_id', $kelasId);
        })->with('jadwal.mapel')->get();

        return view('guru.penilaian.tugas', compact('kelas', 'tugas'));
    }

    public function penilaianTugas($tugasId)
    {
        $guru = Guru::where('user_id', Auth::id())->firstOrFail();
        $tugas = Tugas::with('jadwal.mapel','jadwal.kelas')->findOrFail($tugasId);

        if ($tugas->jadwal->guru_id !== $guru->id) abort(403);

        $pengumpulan = Pengumpulan::where('tugas_id', $tugasId)
            ->with('siswa.kelas')
            ->get();

        return view('guru.penilaian.nilai', compact('tugas','pengumpulan'));
    }

    public function beriNilai(Request $r, $id)
    {
        $r->validate(['nilai'=>'required|integer|min:0|max:100']);
        $pengumpulan = Pengumpulan::findOrFail($id);

        $guru = Guru::where('user_id', Auth::id())->firstOrFail();
        if ($pengumpulan->tugas->jadwal->guru_id !== $guru->id) abort(403);

        $pengumpulan->update(['nilai'=>$r->nilai]);

        return back()->with('success','Nilai berhasil diberikan');
    }
}