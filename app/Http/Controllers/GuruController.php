<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Tugas;
use App\Models\Pengumpulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
    private function isWaliKelas($guruId)
    {
        return Kelas::where('wali_kelas_id', $guruId)->exists();
    }

    // Dashboard
    public function dashboard()
    {
        $guru = Guru::where('user_id', Auth::id())->first();

        if (!$guru) {
            abort(403, 'Data guru tidak ditemukan.');
        }

        $jumlahMapel = Mapel::where('guru_id', $guru->id)->count();
        $jumlahTugas = Tugas::where('guru_id', $guru->id)->count();

        $kelasYangDibina = $guru->kelasYangDibina; 

        $jumlahSiswaPerKelas = [];
        foreach ($kelasYangDibina as $kelas) {
            $jumlahSiswaPerKelas[$kelas->nama_kelas] = Siswa::where('kelas_id', $kelas->id)->count();
        }

        return view('guru.dashboard', compact(
            'guru', 'jumlahMapel', 'jumlahTugas', 'jumlahSiswaPerKelas', 'kelasYangDibina'
        ));
    }

    // Profil
    public function profil()
    {
        $guru = Guru::where('user_id', Auth::id())->first();
        return view('guru.profil', compact('guru'));
    }

    // ==================== CRUD TUGAS ====================

    public function tugas()
    {
        $guru = Guru::where('user_id', Auth::id())->first();
        $tugas = Tugas::where('guru_id', $guru->id)
            ->with('mapel', 'kelas')
            ->get();

        return view('guru.tugas.index', compact('tugas'));
    }

    public function buatTugas()
    {
        $guru = Guru::where('user_id', Auth::id())->first();
        $mapel = Mapel::where('guru_id', $guru->id)->get();

        $kelas = $guru->kelas()->get();

        return view('guru.tugas.create', compact('mapel', 'kelas'));
    }


    public function simpanTugas(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'deadline' => 'required|date',
            'foto_tugas' => 'required|file|mimes:pdf,docx,zip,rar,jpg,png|max:2048',
            'mapel_id' => 'required|exists:mapel,id',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $guru = Guru::where('user_id', Auth::id())->first();

        if (!$guru) {
            return back()->with('error', 'Data guru tidak ditemukan.');
        }

        // Simpan file
        $path = $request->file('foto_tugas')->store('tugas', 'public');

        Tugas::create([
            'guru_id' => $guru->id,
            'mapel_id' => $request->mapel_id,
            'kelas_id' => $request->kelas_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto_tugas' => $path,
            'deadline' => $request->deadline,
        ]);

        return redirect()->route('guru.tugas')->with('success', 'Tugas berhasil dibuat.');
    }

    public function editTugas($id)
    {
        $tugas = Tugas::findOrFail($id);
        $guru = Guru::where('user_id', Auth::id())->first();

        if ($tugas->guru_id !== $guru->id) {
            abort(403, 'Akses ditolak.');
        }

        $mapel = Mapel::where('guru_id', $guru->id)->get();
        $kelas = Kelas::all();

        return view('guru.tugas.edit', compact('tugas', 'mapel', 'kelas'));
    }

    public function updateTugas(Request $request, $id)
    {
        $tugas = Tugas::findOrFail($id);
        $guru = Guru::where('user_id', Auth::id())->first();

        if ($tugas->guru_id !== $guru->id) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'deadline' => 'required|date',
            'mapel_id' => 'required|exists:mapel,id',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $tugas->update([
            'mapel_id' => $request->mapel_id,
            'kelas_id' => $request->kelas_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'deadline' => $request->deadline,
        ]);

        return redirect()->route('guru.tugas')->with('success', 'Tugas berhasil diperbarui.');
    }

    public function hapusTugas($id)
    {
        $tugas = Tugas::findOrFail($id);
        $guru = Guru::where('user_id', Auth::id())->first();

        if ($tugas->guru_id !== $guru->id) {
            abort(403, 'Akses ditolak.');
        }

        $tugas->delete();

        return redirect()->route('guru.tugas')->with('success', 'Tugas berhasil dihapus.');
    }

    // ==================== PENILAIAN ====================

    public function penilaian()
    {
        $guru = Guru::where('user_id', Auth::id())->first();

        $pengumpulan = Pengumpulan::whereHas('tugas', function ($q) use ($guru) {
            $q->where('guru_id', $guru->id);
        })->with('tugas', 'siswa')->get();

        return view('guru.penilaian.index', compact('pengumpulan'));
    }

    public function beriNilai(Request $request, $id)
    {
        $request->validate([
            'nilai' => 'required|integer|min:0|max:100',
        ]);

        $pengumpulan = Pengumpulan::findOrFail($id);
        $guru = Guru::where('user_id', Auth::id())->first();

        if ($pengumpulan->tugas->guru_id !== $guru->id) {
            abort(403, 'Akses ditolak.');
        }

        $pengumpulan->nilai = $request->nilai;
        $pengumpulan->save();

        return redirect()->route('guru.penilaian')->with('success', 'Nilai berhasil diberikan.');
    }
}
