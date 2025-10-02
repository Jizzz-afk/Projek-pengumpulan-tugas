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
    public function guruIndex(Request $r)
    {
        $query = Guru::with(['user','mapel','jadwal.kelas']);

        if ($r->q) {
            $query->where(function($q) use ($r) {
                $q->where('nama', 'like', '%'.$r->q.'%')
                ->orWhere('email', 'like', '%'.$r->q.'%')
                ->orWhere('nip', 'like', '%'.$r->q.'%');
            });
        }

        if ($r->mapel_id) {
            $query->whereHas('mapel', function($q) use ($r) {
                $q->where('mapel_id', $r->mapel_id);
            });
        }

        $guru  = $query->get();
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
            'password' => 'required|min:6',
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapel,id',
        ]);

        $cek = Jadwal::where('kelas_id', $r->kelas_id)
                    ->where('mapel_id', $r->mapel_id)
                    ->first();

        if ($cek) {
            return back()
                ->withErrors(['kelas_id' => '❌ Kelas dan mapel ini sudah diajar guru lain.'])
                ->withInput();
        }

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
            'email' => $r->email,
        ]);

        Jadwal::create([
            'guru_id'  => $guru->id,
            'kelas_id' => $r->kelas_id,
            'mapel_id' => $r->mapel_id,
        ]);

        return back()->with('success', '✅ Guru berhasil ditambahkan');
    }

    public function guruEdit($id)
    {
        $guru  = Guru::with(['user','jadwal.mapel','jadwal.kelas'])->findOrFail($id);
        $mapel = Mapel::all();
        $kelas = Kelas::all();

        return view('admin.guru.edit', compact('guru', 'mapel', 'kelas'));
    }


    public function guruUpdate(Request $r, $id)
    {
        $guru = Guru::findOrFail($id);

        $r->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:50|unique:guru,nip,' . $id,
            'email' => 'required|email|unique:guru,email,' . $id,
            'mapel_id' => 'required|exists:mapel,id',
            'kelas_id' => 'required|exists:kelas,id'
        ]);

        // 🔒 Cek apakah kombinasi kelas + mapel sudah dipakai guru lain
        $cek = Jadwal::where('kelas_id', $r->kelas_id)
                    ->where('mapel_id', $r->mapel_id)
                    ->where('guru_id', '!=', $guru->id) // jangan cek diri sendiri
                    ->first();

        if ($cek) {
            return back()
                ->withErrors(['kelas_id' => '❌ Kelas dan mapel ini sudah diajar guru lain.'])
                ->withInput();
        }

        $guru->update([
            'nama' => $r->nama,
            'nip' => $r->nip,
            'email' => $r->email,
        ]);

        // Hapus jadwal lama lalu buat baru
        Jadwal::where('guru_id', $guru->id)->delete();
        Jadwal::create([
            'guru_id' => $guru->id,
            'kelas_id' => $r->kelas_id,
            'mapel_id' => $r->mapel_id,
        ]);

        return redirect()->route('admin.guru.index')->with('success', '✅ Guru berhasil diperbarui');
    }

    public function guruDelete($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->user->delete();
        $guru->delete();
        return back()->with('success', 'Guru dihapus');
    }

    // ======================= SISWA =======================
public function siswaIndex(Request $r)
{
    $search = trim($r->input('search'));

    $siswa = Siswa::with('kelas', 'user')
        ->when($search, function ($query, $search) {
            $keywords = preg_split('/\s+/', $search); 

            $query->where(function ($q) use ($keywords, $search) {
                foreach ($keywords as $word) {
                    $q->where(function ($sub) use ($word) {
                        $sub->where('nama', 'like', "%{$word}%")
                            ->orWhere('nis', 'like', "%{$word}%");
                    });
                }

                // cari kelas dengan full string
                $q->orWhereHas('kelas', function ($q2) use ($search) {
                    $q2->where('nama_kelas', 'like', "%{$search}%");
                });
            });
        })
        ->orderBy('kelas_id', 'asc')
        ->orderBy('nama', 'asc')
        ->paginate(34)
        ->withQueryString();

    $kelas = Kelas::all();

    return view('admin.siswa.index', compact('siswa', 'kelas'));
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
    public function kelasIndex(Request $request)
    {
        $query = Kelas::withCount('siswa');

        if ($request->has('q') && $request->q != '') {
            $query->where('nama_kelas', 'like', '%' . $request->q . '%')
            ->orWhere('wali_kelas', 'like', '%' . $request->q . '%')
            ->orWhere('deskripsi', 'like', '%' . $request->q . '%');
        }

        $kelas = $query->get();

        return view('admin.kelas.index', compact('kelas'));
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

    public function KelasDetail($id)
{
    $kelas = Kelas::withCount('siswa')
        ->with('siswa') 
        ->findOrFail($id);

    return view('admin.kelas.detail', compact('kelas'));
}


    // ======================= MAPEL =======================
    public function mapelIndex(Request $r)
    {
        $query = Mapel::query();

        if ($r->q) {
            $query->where('nama_mapel', 'like', '%'.$r->q.'%');
        }

        $mapel = $query->orderBy('nama_mapel')->get();

        return view('admin.mapel.index', compact('mapel'));
    }

    public function mapelStore(Request $r)
    {
        $r->validate([
            'nama_mapel' => 'required|unique:mapel,nama_mapel',
        ]);
        Mapel::create($r->all());
        return back()->with('success', 'Mapel ditambahkan');
    }

    public function mapelEdit($id)
    {
        $mapel = Mapel::findOrFail($id);
        return view('admin.mapel.edit', compact('mapel'));
    }

    public function mapelUpdate(Request $r, $id)
    {
        $r->validate([
            'nama_mapel' => 'required|unique:mapel,nama_mapel,' . $id,
        ]);

        Mapel::findOrFail($id)->update([
            'nama_mapel' => $r->nama_mapel
        ]);

        return redirect()->route('admin.mapel.index')->with('success', 'Mapel diperbarui');
    }

    public function mapelDelete($id)
    {
        $mapel = Mapel::findOrFail($id);

        if ($mapel->jadwal()->exists()) {
            return back()->with('error', 'Mapel ini tidak bisa dihapus.');
        }

        $mapel->delete();
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
