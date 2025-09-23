<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Tugas;
use App\Models\Pengumpulan;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $siswa = \App\Models\Siswa::with('kelas')
            ->when($search, function ($query, $search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('nis', 'like', "%{$search}%")
                    ->orWhereHas('kelas', function ($q) use ($search) {
                        $q->where('nama_kelas', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->get();

        $kelas = \App\Models\Kelas::all();

        return view('admin.siswa.index', compact('siswa', 'kelas'));
    }

    public function dashboard()
    {
        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();

        // Ambil tugas berdasarkan kelas siswa via jadwal
        $tugas = Tugas::whereHas('jadwal', function ($q) use ($siswa) {
            $q->where('kelas_id', $siswa->kelas_id);
        })->get();

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

        $tugas = Tugas::whereHas('jadwal', function ($q) use ($siswa) {
            $q->where('kelas_id', $siswa->kelas_id);
        })->orderBy('deadline', 'asc')->get();

        return view('siswa.pengumpulan.index', compact('tugas'));
    }

    public function formPengumpulan($tugas_id)
    {
        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();

        $tugas = Tugas::where('id', $tugas_id)
            ->whereHas('jadwal', function ($q) use ($siswa) {
                $q->where('kelas_id', $siswa->kelas_id);
            })->firstOrFail();

        return view('siswa.pengumpulan.create', compact('tugas'));
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

        // Cek apakah kelas siswa cocok
        if ($tugas->jadwal->kelas_id !== $siswa->kelas_id) {
            return back()->with('error', 'Anda tidak berhak mengumpulkan tugas ini.');
        }

        // Cek apakah sudah pernah kumpul
        if (Pengumpulan::where('tugas_id', $tugas->id)->where('siswa_id', $siswa->id)->exists()) {
            return back()->with('error', 'Anda sudah mengumpulkan tugas ini.');
        }

        // Cek deadline
        if (now()->gt($tugas->deadline)) {
            return back()->with('error', 'Deadline tugas telah lewat.');
        }

        $path = $request->file('file')->store('pengumpulan', 'public');

        Pengumpulan::create([
            'tugas_id' => $tugas->id,
            'siswa_id' => $siswa->id,
            'file' => $path,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('siswa.pengumpulan.index')->with('success', 'Tugas berhasil dikumpulkan!');
    }

    public function riwayat()
    {
        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();

        $riwayat = Pengumpulan::with('tugas.jadwal.mapel')
            ->where('siswa_id', $siswa->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('siswa.riwayat', compact('riwayat'));
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
