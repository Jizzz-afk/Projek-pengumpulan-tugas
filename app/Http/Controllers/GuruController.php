<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Tugas;
use App\Models\Pengumpulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $guru = Guru::where('user_id', Auth::id())->firstOrFail();

        $jumlahJadwal = Jadwal::where('guru_id', $guru->id)->count();
        $jumlahTugas = Tugas::whereHas('jadwal', fn($q) => $q->where('guru_id',$guru->id))->count();

        return view('guru.dashboard', compact('guru','jumlahJadwal','jumlahTugas'));
    }

    // Profil
    public function profil()
    {
        $guru = Guru::where('user_id', Auth::id())->firstOrFail();
        return view('guru.profil', compact('guru'));
    }

    // ==================== CRUD TUGAS ====================
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
            'file' => 'nullable|file|max:2048'
        ]);

        $path = $r->hasFile('file') ? $r->file('file')->store('tugas','public') : null;

        Tugas::create([
            'jadwal_id'=>$r->jadwal_id,
            'judul'=>$r->judul,
            'deskripsi'=>$r->deskripsi,
            'deadline'=>$r->deadline,
            'file'=>$path
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
            'file' => 'nullable|file|max:2048'
        ]);

        $path = $tugas->file;
        if ($r->hasFile('file')) {
            $path = $r->file('file')->store('tugas','public');
        }

        $tugas->update([
            'jadwal_id'=>$r->jadwal_id,
            'judul'=>$r->judul,
            'deskripsi'=>$r->deskripsi,
            'deadline'=>$r->deadline,
            'file'=>$path
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
        $pengumpulan = Pengumpulan::whereHas('tugas.jadwal', fn($q)=>$q->where('guru_id',$guru->id))
            ->with('tugas.jadwal.mapel','siswa')
            ->get();
        return view('guru.penilaian.index', compact('pengumpulan'));
    }

    public function beriNilai(Request $r, $id)
    {
        $r->validate(['nilai'=>'required|integer|min:0|max:100']);
        $pengumpulan = Pengumpulan::findOrFail($id);
        $guru = Guru::where('user_id', Auth::id())->firstOrFail();
        if ($pengumpulan->tugas->jadwal->guru_id !== $guru->id) abort(403);

        $pengumpulan->update(['nilai'=>$r->nilai]);
        return redirect()->route('guru.penilaian')->with('success','Nilai diberikan');
    }
}
