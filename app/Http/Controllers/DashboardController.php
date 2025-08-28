<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Mapel;
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
            'jumlahMapel' => Mapel::count()
        ]);
    }

    // ======================= GURU =======================
    public function guruIndex()
    {
        return view('admin.guru.index', [
            'guru' => Guru::with('user')->get()
        ]);
    }

    public function guruStore(Request $r)
    {
        $r->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:50|unique:guru,nip',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $r->nama,
            'email' => $r->email,
            'password' => Hash::make($r->password),
            'role' => 'guru'
        ]);

        Guru::create([
            'user_id' => $user->id,
            'nama' => $r->nama,
            'nip' => $r->nip,
            'email' => $r->email
        ]);

        return back()->with('success', 'Guru ditambahkan');
    }

    public function guruDelete($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->user->delete();
        $guru->delete();
        return back()->with('success', 'Guru dihapus');
    }

    public function guruEdit($id)
    {
        return view('admin.guru.edit', [
            'guru' => Guru::with('user')->findOrFail($id)
    ]);
    }

public function guruUpdate(Request $r, $id)
    {
        $guru = Guru::findOrFail($id);
        $r->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:50|unique:guru,nip,' . $id,
            'email' => 'required|email|unique:users,email,' . $guru->user_id,
        ]);

        $guru->update([
            'nama' => $r->nama,
            'nip' => $r->nip,
            'email' => $r->email,
            'foto' => $r->foto,
        ]);
        $guru->user->update([
            'name' => $r->nama,
            'email' => $r->email,
            'foto' => $r->foto,
        ]);
        return redirect()->route('admin.guru.index')->with('success', 'Guru diperbarui');

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
        ], [
            'nis.unique' => 'NIS ini sudah terdaftar.',
            'email.unique' => 'Email ini sudah digunakan.',
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

        public function siswaDelete($id)
        {
            $siswa = Siswa::findOrFail($id);
            $siswa->user->delete();
            $siswa->delete();
            return back()->with('success', 'Siswa dihapus');
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



    // ======================= KELAS =======================
    public function kelasIndex()
    {
        return view('admin.kelas.index', [
            'kelas' => Kelas::all()
        ]);
    }

    public function kelasStore(Request $r)
    {
        $r->validate([
            'nama_kelas' => 'required|unique:kelas,nama_kelas',
            'wali_kelas' => 'required|string',
            'deskripsi'  => 'nullable|string',
        ]);

        Kelas::create([
            'nama_kelas' => $r->nama_kelas,
            'wali_kelas' => $r->wali_kelas,
            'deskripsi'  => $r->deskripsi,
        ]);

        return back()->with('success', 'Kelas ditambahkan');
    }

    public function kelasEdit($id)
    {
        return view('admin.kelas.edit', [
            'kelas' => Kelas::findOrFail($id),
            'daftarWaliK' => Kelas::select('wali_kelas')->distinct()->get()
        ]);
    }

    public function kelasUpdate(Request $r, $id)
    {
        $r->validate([
            'nama_kelas' => 'required|unique:kelas,nama_kelas,'.$id,
            'wali_kelas' => 'required|string',
            'deskripsi'  => 'nullable|string',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update([
            'nama_kelas' => $r->nama_kelas,
            'wali_kelas' => $r->wali_kelas,
            'deskripsi'  => $r->deskripsi,
        ]);

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
        $guruDipakai = Mapel::pluck('guru_id')->toArray();

        return view('admin.mapel.index', [
            'mapel' => Mapel::with('guru')->get(),
            'guru' => Guru::whereNotIn('id', $guruDipakai)->get()
        ]);
    }

    public function mapelStore(Request $r)
    {
        $r->validate([
            'nama_mapel' => 'required|unique:mapel,nama_mapel',
            'guru_id' => 'required|exists:guru,id',
        ]);
        Mapel::create([
            'nama_mapel' => $r->nama_mapel,
            'guru_id' => $r->guru_id
        ]);
        return back()->with('success', 'Mapel ditambahkan');
    }

    public function mapelUpdate(Request $r, $id)
    {
        $r->validate([
            'nama_mapel' => 'required|unique:mapel,nama_mapel,' . $id,
            'guru_id' => 'required|exists:guru,id',
        ]);

        $mapel = Mapel::findOrFail($id);
        $mapel->update([
            'nama_mapel' => $r->nama_mapel,
            'guru_id' => $r->guru_id
        ]);
        return redirect()->route('admin.mapel.index')->with('success', 'Mapel diperbarui');
    }

    public function mapelDelete($id)
    {
        Mapel::destroy($id);
        return back()->with('success', 'Mapel dihapus');
    }

    public function mapelEdit($id)
    {
        $mapel = Mapel::findOrFail($id);

        $guruDipakai = Mapel::where('id', '!=', $id)->pluck('guru_id')->toArray();

        return view('admin.mapel.edit', [
            'mapel' => $mapel,
            'guru' => Guru::whereNotIn('id', $guruDipakai)->orWhere('id', $mapel->guru_id)->get()
        ]);
    }
}