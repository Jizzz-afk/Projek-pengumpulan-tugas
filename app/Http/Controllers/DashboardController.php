<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Jadwal;
use App\Models\Tugas;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    // ======================= DASHBOARD =======================
    public function dashboard()
    {
        return view('admin.dashboard', [
            'jumlahGuru' => Guru::count(),
            'jumlahSiswa' => Siswa::count(),
            'jumlahKelas' => Kelas::count(),
            'jumlahMapel' => Mapel::count(),
            'jumlahJadwal' => Jadwal::count(),
            'jumlahTugas' => Tugas::count(),
        ]);
    }

    // ======================= GURU =======================
 public function guruIndex()
    {
        $guru  = Guru::with(['user','mapel','jadwal.kelas'])->get();
        $kelas = Kelas::all();
        $mapel = Mapel::all();

        return view('admin.guru.index', compact('guru', 'kelas', 'mapel'));
    }

    public function guruStore(Request $r)
    {
        $r->validate([
            'nama' => 'required',
            'nip' => 'required|unique:guru,nip',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $r->nama,
            'email' => $r->email,
            'password' => Hash::make($r->password),
            'role' => 'guru'
        ]);

        $guru = Guru::create([
            'user_id' => $user->id,
            'nama' => $r->nama,
            'nip' => $r->nip,
            'email' => $r->email
        ]);

        if ($r->kelas_id) {
        foreach ($r->kelas_id as $kelasId) {
            Jadwal::create([
                'guru_id'  => $guru->id,
                'kelas_id' => $kelasId,
                'mapel_id' => $r->mapel_id,
            ]);
        }
    }

        return back()->with('success', 'Guru berhasil ditambahkan');
    }

    public function guruEdit($id)
    {
        return view('admin.guru.edit', [
            'guru' => Guru::findOrFail($id),
            'kelas' => Kelas::all(),
            'mapel' => Mapel::all()
        ]);
    }

    public function guruUpdate(Request $r, $id)
    {
        $guru = Guru::findOrFail($id);

        $r->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:50|unique:guru,nip,' . $id,
            'email' => 'required|email|unique:guru,email,' . $id,
            'mapel_id' => 'required'
        ]);

        $guru->update([
            'nama' => $r->nama,
            'nip' => $r->nip,
            'email' => $r->email,
            'mapel_id' => $r->mapel_id
        ]);

        if ($r->kelas_id) {
            Jadwal::where('guru_id', $guru->id)->delete(); 
            $kelasDipilih = array_slice($r->kelas_id, 0, 10);
            foreach ($kelasDipilih as $kelasId) {
                Jadwal::create([
                    'guru_id' => $guru->id,
                    'kelas_id' => $kelasId,
                    'mapel_id' => $r->mapel_id,
                ]);
            }
        }
        return redirect()->route('admin.guru.index')->with('success', 'Guru diperbarui');
    }


    public function guruDelete($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->user->delete();
        $guru->delete();
        return back()->with('success', 'Guru dihapus');
    }

    // ======================= SISWA =======================
    public function siswaIndex()
    {
        return view('admin.siswa.index', [
            'siswa' => Siswa::with('kelas', 'user')->get(),
            'kelas' => Kelas::all()
        ]);
    }

    public function siswaStore(Request $r)
    {
        $r->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:50|unique:siswa,nis',
            'email' => 'required|email|unique:users,email', 
            'kelas_id' => 'required|exists:kelas,id',
            'password' => 'required|min:6',
            'foto' => 'nullable|image|max:2048'
        ]);

        $path = null;
        if ($r->hasFile('foto')) {
            $filename = $r->file('foto')->getClientOriginalName();
            $r->file('foto')->storeAs('public/foto', $filename);
            $path = 'foto/' . $filename;
        }

        $user = User::create([
            'name' => $r->nama,
            'email' => $r->email,
            'password' => Hash::make($r->password),
            'role' => 'siswa'
        ]);

        Siswa::create([
            'user_id' => $user->id,
            'nama' => $r->nama,
            'nis' => $r->nis,
            'kelas_id' => $r->kelas_id,
            'email' => $r->email,
            'foto' => $path ?? ''
        ]);

        return back()->with('success', 'Siswa ditambahkan');
    }

    public function siswaEdit($id)
    {
        return view('admin.siswa.edit', [
            'siswa' => Siswa::with('user', 'kelas')->findOrFail($id),
            'kelas' => Kelas::all()
        ]);
    }

    public function siswaUpdate(Request $r, $id)
    {
        $siswa = Siswa::findOrFail($id);

        if ($r->hasFile('foto')) {
            $filename = $r->file('foto')->getClientOriginalName();
            $r->file('foto')->storeAs('public/foto', $filename);
            $siswa->foto = 'foto/' . $filename;
        }

        $siswa->update([
            'nama' => $r->nama,
            'nis' => $r->nis,
            'email' => $r->email,
            'kelas_id' => $r->kelas_id,
            'foto' => $siswa->foto 
        ]);

        $siswa->user->update([
            'name' => $r->nama,
            'email' => $r->email
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa diperbarui');
    }

    public function siswaDelete($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->user->delete();
        $siswa->delete();
        return back()->with('success', 'Siswa dihapus');
    }

    // ======================= KELAS =======================
    public function kelasIndex()
    {
        return view('admin.kelas.index', [
            'kelas' => Kelas::withCount('siswa')->get()
        ]);
    }

    public function kelasStore(Request $r)
    {
        $r->validate([
            'nama_kelas' => 'required|unique:kelas,nama_kelas',
            'wali_kelas' => 'nullable|string',
            'deskripsi'  => 'nullable|string',
        ]);

        Kelas::create($r->all());
        return back()->with('success', 'Kelas ditambahkan');
    }

    public function kelasEdit($id)
    {
        return view('admin.kelas.edit', [
            'kelas' => Kelas::findOrFail($id)
        ]);
    }

    public function kelasUpdate(Request $r, $id)
    {
        $r->validate([
            'nama_kelas' => 'required|unique:kelas,nama_kelas,'.$id,
            'wali_kelas' => 'nullable|string',
            'deskripsi'  => 'nullable|string',
        ]);

        Kelas::findOrFail($id)->update($r->all());
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas diperbarui');
    }

    public function kelasDelete($id)
    {
        Kelas::destroy($id);
        return back()->with('success', 'Kelas dihapus');
    }

    // ======================= MAPEL =======================
    public function mapelIndex()
    {
        return view('admin.mapel.index', [
            'mapel' => Mapel::all()
        ]);
    }

    public function mapelStore(Request $r)
    {
        $r->validate([
            'nama_mapel' => 'required|unique:mapel,nama_mapel',
        ]);
        Mapel::create($r->all());
        return back()->with('success', 'Mapel ditambahkan');
    }

    public function mapelUpdate(Request $r, $id)
    {
        $r->validate([
            'nama_mapel' => 'required|unique:mapel,nama_mapel,' . $id,
        ]);
        Mapel::findOrFail($id)->update($r->all());
        return redirect()->route('admin.mapel.index')->with('success', 'Mapel diperbarui');
    }

    public function mapelDelete($id)
    {
        Mapel::destroy($id);
        return back()->with('success', 'Mapel dihapus');
    }

    // ======================= JADWAL =======================
    public function jadwalIndex()
    {
        return view('admin.jadwal.index', [
            'jadwal' => Jadwal::with(['guru','mapel','kelas'])->get(),
            'guru' => Guru::all(),
            'mapel' => Mapel::all(),
            'kelas' => Kelas::all(),
        ]);
    }

    public function jadwalStore(Request $r)
    {
        $r->validate([
            'guru_id' => 'required|exists:guru,id',
            'mapel_id' => 'required|exists:mapel,id',
            'kelas_id' => 'required|exists:kelas,id',
        ]);
        Jadwal::create($r->all());
        return back()->with('success', 'Jadwal ditambahkan');
    }

    public function jadwalUpdate(Request $r, $id)
    {
        $r->validate([
            'guru_id' => 'required|exists:guru,id',
            'mapel_id' => 'required|exists:mapel,id',
            'kelas_id' => 'required|exists:kelas,id',
        ]);
        Jadwal::findOrFail($id)->update($r->all());
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal diperbarui');
    }

    public function jadwalDelete($id)
    {
        Jadwal::destroy($id);
        return back()->with('success', 'Jadwal dihapus');
    }
}
