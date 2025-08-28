<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Tugas;
use App\Models\Kelas;
use App\Models\Pengumpulan;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Dashboard siswa
     */
    public function dashboard()
    {
        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();
        $tugas = Tugas::where('kelas_id', $siswa->kelas_id)->get();
        $tugasAktif = $tugas->where('deadline', '>=', now())->count();
        $tugasTerkumpul = Pengumpulan::where('siswa_id', $siswa->id)->count();
        $rataNilai = Pengumpulan::where('siswa_id', $siswa->id)
            ->whereNotNull('nilai')
            ->avg('nilai') ?? 0;

        $tugasBaru = $tugas->sortByDesc('created_at')->take(5);

        return view('siswa.dashboard', compact(
            'tugasAktif', 'tugasTerkumpul', 'rataNilai', 'tugasBaru'
        ));
    }

    /**
     * Daftar pengumpulan siswa
     */
    public function daftarPengumpulan()
    {
        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();

        $tugas = Tugas::where('kelas_id', $siswa->kelas_id)
            ->orderBy('deadline', 'asc')
            ->get();

        return view('siswa.pengumpulan.index', compact('tugas'));
    }

    public function formPengumpulan($tugas_id)
    {
        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();

        if ($tugas_id) {
            $tugas = Tugas::where('id', $tugas_id)->where('kelas_id', $siswa->kelas_id)->firstOrFail();

            return view('siswa.pengumpulan.create', compact('tugas'));
        }

        $tugas = Tugas::where('kelas_id', $siswa->kelas_id)
            ->orderBy('deadline', 'asc')
            ->get();

        $tugasTerkumpul = Pengumpulan::where('siswa_id', $siswa->id)
            ->pluck('tugas_id')
            ->toArray();

        return view('siswa.pengumpulan.create', compact('tugas', 'tugasTerkumpul'));
    }

    public function simpanPengumpulan(Request $request)
    {
        $request->validate([
            'tugas_id' => 'required|exists:tugas,id',
            'file' => 'required|file|mimes:pdf,docx,zip,rar,jpg,png|max:2048',
            'catatan' => 'nullable|string|max:255',
        ]);

        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();
        $tugas = Tugas::findOrFail($request->tugas_id);

        if (Pengumpulan::where('tugas_id', $tugas->id)->where('siswa_id', $siswa->id)->exists()) {
            return back()->with('error', 'Anda sudah mengumpulkan tugas ini.');
        }

        // Cek deadline
        if (now()->gt($tugas->deadline)) {
            return back()->with('error', 'Deadline tugas telah lewat. Anda tidak dapat mengumpulkan tugas ini.');
        }

        $path = $request->file('file')->store('pengumpulan', 'public');

        Pengumpulan::create([
            'tugas_id' => $request->tugas_id,
            'siswa_id' => $siswa->id,
            'file' => $path,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('siswa.pengumpulan.index')->with('success', 'Tugas berhasil dikumpulkan!');
    }


    /**
     * Detail kelas
     */
    public function detail($id)
    {
        $kelas = Kelas::with(['guru', 'tugas'])->findOrFail($id);
        return view('siswa.detail', compact('kelas'));
    }

    /**
     * Data kelas siswa
     */
    public function kelas()
    {
        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();
        $kelas = Kelas::with(['guru', 'mapel', 'tugas'])->where('id', $siswa->kelas_id)->get();

        return view('siswa.kelas', compact('kelas'));
    }

    /**
     * Riwayat pengumpulan tugas
     */
    public function riwayat()
    {
        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();

        $riwayat = Pengumpulan::with('tugas')
            ->where('siswa_id', $siswa->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('siswa.riwayat', compact('riwayat'));
    }

    /**
     * Profil siswa
     */
    public function profil()
    {
        $user = Auth::user();

        return view('siswa.profil', [
            'user' => $user,
            'siswa' => $user->siswa,
        ]);
    }
}
