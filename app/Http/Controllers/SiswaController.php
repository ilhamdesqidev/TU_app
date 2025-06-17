<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Klapper;
use App\Models\Ijazah;

class SiswaController extends Controller
{
    public function indexSiswa()
    {
        $siswa = Siswa::count();
        return view('klapper.siswa', compact('siswa'));
    }

    public function createSiswa($klappersId)
    {
        $klapper = Klapper::findOrFail($klappersId);

        $minClass = 'X';

        $hasKelasXI = $klapper->siswas()->where('kelas', 'XI')->where('status', 2)->exists();
        $hasKelasXII = $klapper->siswas()->where('kelas', 'XII')->where('status', 2 )->exists();

        if ($hasKelasXII) {
            $minClass = 'XII';
        } elseif ($hasKelasXI) {
            $minClass = 'XI';
        }

        return view('klapper.detail_klapper.tambah_siswa', compact('klappersId', 'minClass'));
    }

    public function storeSiswa(Request $request, $klappersId)
{
    $request->validate([
        'nis' => 'required|unique:siswas,nis',
        'nisn' => 'required|unique:siswas,nisn',
        'nama_siswa' => 'required',
        'tempat_lahir' => 'required',
        'tanggal_lahir' => 'required|date',
        'gender' => 'required',
        'kelas' => 'required',
        'jurusan' => 'required',
        'nama_ibu' => 'required',
        'nama_ayah' => 'required',
        'tanggal_masuk' => 'required|date',
        'tanggal_naik_kelas_xi' => 'nullable|date',
        'tanggal_naik_kelas_xii' => 'nullable|date',
        'tanggal_lulus' => 'nullable|date',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'alasan_masuk' => 'required_if:kelas,XI,XII|nullable|string|max:500',
    ], [
        'nis.unique' => 'NIS sudah digunakan oleh siswa lain',
        'nisn.unique' => 'NISN sudah digunakan oleh siswa lain',
    ]);

    try {
        $siswa = new Siswa();
        $siswa->nis = $request->nis;
        $siswa->nisn = $request->nisn;
        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->tempat_lahir = $request->tempat_lahir;
        $siswa->tanggal_lahir = $request->tanggal_lahir;
        $siswa->gender = $request->gender;
        $siswa->kelas = $request->kelas;
        $siswa->jurusan = $request->jurusan;
        $siswa->nama_ibu = $request->nama_ibu;
        $siswa->nama_ayah = $request->nama_ayah;
        $siswa->tanggal_masuk = $request->tanggal_masuk;
        $siswa->tanggal_naik_kelas_xi = $request->tanggal_naik_kelas_xi;
        $siswa->tanggal_naik_kelas_xii = $request->tanggal_naik_kelas_xii;
        $siswa->tanggal_lulus = $request->tanggal_lulus;
        $siswa->klapper_id = $klappersId;
        $siswa->status = 2;
        $siswa->alasan_masuk = $request->kelas === 'X' ? null : $request->alasan_masuk;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('image'), $filename);
            $siswa->foto = $filename;
        }

        $siswa->save();

        return redirect()->route('klapper.show', $klappersId)->with('status', 'Berhasil Menambahkan Data Siswa!');
    } catch (\Illuminate\Database\QueryException $e) {
        $errorCode = $e->errorInfo[1];
        if ($errorCode == 1062) { // Duplicate entry error code
            return back()->withInput()->withErrors([
                'nis' => $e->getMessage(),
                'nisn' => $e->getMessage(),
            ]);
        }
        return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data']);
    }
}

    public function showSiswa($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('klapper.detail_klapper.detail_siswa', compact('siswa'));
    }

    public function editSiswa($id)
    {

        $siswa = Siswa::findOrFail($id);

        $minClass = 'X';
    if ($siswa->kelas === 'XI') {
        $minClass = 'XI';
    } elseif ($siswa->kelas === 'XII') {
        $minClass = 'XII';
    }

        return view('klapper.detail_klapper.editdata_siswa', compact('siswa', 'minClass'));
    }

    public function updateSiswa(Request $request, $id)
{
    $siswa = Siswa::findOrFail($id);

    $request->validate([
        'nis' => 'required|unique:siswas,nis,'.$id,
        'nisn' => 'required|unique:siswas,nisn,'.$id,
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ], [
        'nis.unique' => 'NIS sudah digunakan oleh siswa lain',
        'nisn.unique' => 'NISN sudah digunakan oleh siswa lain',
    ]);

    try {
        $siswa->update($request->except('foto'));

        if ($request->hasFile('foto')) {
            if ($siswa->foto && file_exists(public_path('image/' . $siswa->foto))) {
                unlink(public_path('image/' . $siswa->foto));
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('image'), $filename);
            $siswa->foto = $filename;
        }

        $siswa->save();

        return redirect()->route('siswa.show', $siswa->id)->with('success', 'Data siswa berhasil diperbarui.');
    } catch (\Illuminate\Database\QueryException $e) {
        $errorCode = $e->errorInfo[1];
        if ($errorCode == 1062) {
            return back()->withInput()->withErrors([
                'nis' => 'NIS sudah digunakan oleh siswa lain',
                'nisn' => 'NISN sudah digunakan oleh siswa lain',
            ]);
        }
        return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data']);
    }
}

    public function luluskanSiswa(Request $request, $klapperId)
{
    $request->validate([
        'tanggal_lulus' => 'required|date'
    ]);

    $klapper = Klapper::findOrFail($klapperId);
    $siswas = $klapper->siswas()->where('status', 2)->get();

    if ($siswas->isEmpty()) {
        return back()->with('error', 'Tidak ada siswa aktif untuk diluluskan!');
    }

    foreach ($siswas as $siswa) {
        // Update status siswa
        $siswa->update([
            'status' => 1,
            'tanggal_lulus' => $request->tanggal_lulus
        ]);

        // Arsipkan ke ijazah (tanpa kondisi klapper_id)
        Ijazah::firstOrCreate(
            ['siswa_id' => $siswa->id],
            [
                'klapper_id' => $klapper->id,
                'nama_siswa' => $siswa->nama_siswa,
                'nis' => $siswa->nis,
                'jurusan' => $siswa->jurusan,
                'tanggal_lulus' => $request->tanggal_lulus,
                'nomor_ijazah' => $this->generateNomorIjazah($siswa, $klapper)
            ]
        );
    }

    return back()->with('success', "Berhasil meluluskan {$siswas->count()} siswa dan mengarsipkan ijazah!");
}

private function generateNomorIjazah($siswa, $klapper)
{
    $tahun = $klapper->tahun_ajaran; // Gunakan tahun ajaran klapper
    $sequence = Ijazah::whereYear('tanggal_lulus', now()->year)->count() + 1;
    return "IJZ-{$klapper->id}-{$sequence}-{$tahun}";
}

public function keluar(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'tanggal_keluar' => 'required|date',
        'alasan_keluar' => 'required|string|max:500',
    ], [
        'tanggal_keluar.required' => 'Tanggal keluar harus diisi',
        'tanggal_keluar.date' => 'Format tanggal tidak valid',
        'alasan_keluar.required' => 'Alasan keluar harus diisi',
        'alasan_keluar.max' => 'Alasan keluar maksimal 500 karakter',
    ]);

    try {
        $siswa = Siswa::findOrFail($id);
            
        // Update data siswa
        $siswa->update([
            'status' => 0, // 0 = keluar/tidak aktif, 2 = aktif/pelajar, 1 = lulus
            'tanggal_keluar' => $request->tanggal_keluar,
            'alasan_keluar' => $request->alasan_keluar,
        ]);

        // Gunakan nama_siswa sesuai dengan field di database
        return redirect()->back()->with('success', 'Siswa ' . $siswa->nama_siswa . ' berhasil dikeluarkan dari sistem.');
        
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

    public function naikKelasXI(Request $request, $id)
    {
        $klapper = Klapper::findOrFail($id);
        $counter = 0;

        foreach ($klapper->siswas as $siswa) {
            if ($siswa->kelas == 'X' && $siswa->status == 2) {
                $siswa->kelas = 'XI';
                $siswa->tanggal_naik_kelas_xi = $request->tanggal_naik_kelas_xi;
                $siswa->save();
                $counter++;
            }
        }

        return redirect()->route('klapper.show', $id)->with('success', "$counter siswa berhasil dinaikkan ke Kelas XI.");
    }

    public function naikKelasXII(Request $request, $id)
    {
        $klapper = Klapper::findOrFail($id);
        $counter = 0;

        foreach ($klapper->siswas as $siswa) {
            if ($siswa->kelas == 'XI' && $siswa->status == 2) {
                $siswa->kelas = 'XII';
                $siswa->tanggal_naik_kelas_xii = $request->tanggal_naik_kelas_xii;
                $siswa->save();
                $counter++;
            }
        }

        return redirect()->route('klapper.show', $id)->with('success', "$counter siswa berhasil dinaikkan ke Kelas XII.");
    }

    public function getSiswa($nama_siswa)
    {
        $siswa = Siswa::where('nama_siswa', $nama_siswa)->first();

        if (!$siswa) {
            return response()->json(['error' => 'Siswa tidak ditemukan'], 404);
        }

        return response()->json($siswa);
    }
}
