<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Tugas;
use App\Models\Pengumpulan;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
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

    public function daftarPengumpulan()
    {
        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();

        $pengumpulan = Pengumpulan::with('tugas')
            ->where('siswa_id', $siswa->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('siswa.pengumpulan.index', compact('pengumpulan'));
    }

        public function formPengumpulan()
        {
            $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();

            $tugas = Tugas::where('kelas_id', $siswa->kelas_id)->get();

            $tugasTerkumpul = Pengumpulan::where('siswa_id', $siswa->id)->pluck('tugas_id')->toArray();

            return view('siswa.pengumpulan.create', compact('tugas', 'tugasTerkumpul'));
        }

        public function simpanPengumpulan(Request $request)
    {
        $request->validate([
            'tugas_id' => 'required|exists:tugas,id',
            'file' => 'required|file|max:2048',
        ]);

        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();

        $tugas = Tugas::findOrFail($request->tugas_id);

        $sudahMengumpulkan = Pengumpulan::where('tugas_id', $tugas->id)->where('siswa_id', $siswa->id)->exists();

        if ($sudahMengumpulkan) {
            return back()->with('error', 'Anda sudah mengumpulkan tugas ini.');
        }

        if (now()->gt($tugas->deadline)) {
            return back()->with('error', 'Deadline tugas telah lewat. Anda tidak dapat mengumpulkan tugas ini.');
        }

        $path = $request->file('file')->store('pengumpulan', 'public');

        Pengumpulan::create([
            'tugas_id' => $request->tugas_id,
            'siswa_id' => $siswa->id,
            'file' => $path,
        ]);

        return redirect()->route('siswa.pengumpulan.index')->with('success', 'Tugas berhasil dikumpulkan!');
    }

    public function riwayatNilai()
    {
        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();

        $riwayat = Pengumpulan::with('tugas')
            ->where('siswa_id', $siswa->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('siswa.pengumpulan.riwayat', compact('riwayat'));
    }

    public function kelas () {
        return view ('siswa.kelas');
    }
    public function nilai () {
        return view ('siswa.nilai');
    }
    public function riwayat () {
        return view ('siswa.riwayat');
    }
    public function profil()
    {
        $user = Auth::user();
        return view('siswa.profil', [
            'user' => $user,
            'siswa' => $user->siswa,
        ]);
    }
}
