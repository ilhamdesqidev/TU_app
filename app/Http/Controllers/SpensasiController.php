<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spensasi;
use App\Models\Siswa;

class SpensasiController extends Controller
{
    /**
     * Tampilkan daftar surat spensasi dengan filter status.
     */
    public function index(Request $request)
    {
        $status = $request->input('status', 'semua');

        $query = Spensasi::query();
        if ($status !== 'semua') {
            $query->where('status', $status);
        }

        $surat = $query->paginate(10);
        return view('superadmin.spensasi.index', compact('surat', 'status'));
    }

    /**
     * Form tambah surat spensasi baru.
     */
    public function create()
    {
        $siswa = Siswa::select('id', 'nama_siswa', 'kelas')->get();

        $kategoriSpensasi = [
            'keluar' => 'Keluar',
            'sakit' => 'Sakit',
            'pulang' => 'Pulang',
        ];

        return view('superadmin.spensasi.create', compact('kategoriSpensasi', 'siswa'));
    }

    /**
     * Simpan surat spensasi yang baru dibuat.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'siswa_terpilih' => 'required', // Data siswa dikirim dalam format JSON
            'kategori_spensasi' => 'required|in:keluar,sakit,pulang',
            'jam_pelajaran' => 'nullable|string|max:100',
            'detail_spensasi' => 'required|string',
            'tanggal_spensasi' => 'required|date'
        ]);
    
        // Decode JSON siswa yang dipilih
        $siswaTerpilih = json_decode($request->siswa_terpilih, true);
    
        foreach ($siswaTerpilih as $siswa) {
            // Pastikan siswa ada di database dan belum lulus
            $siswaDB = Siswa::where('nama_siswa', $siswa['nama'])->first();
    
            if (!$siswaDB) {
                return redirect()->back()->withErrors(['siswa_terpilih' => 'Salah satu nama siswa tidak valid!'])->withInput();
            }
    
            if ($siswaDB->status === 'lulus') {
                return redirect()->back()->withErrors(['siswa_terpilih' => 'Siswa ' . $siswa['nama'] . ' sudah lulus dan tidak bisa dimasukkan ke Spensasi!'])->withInput();
            }
    
            Spensasi::create([
                'nama_siswa' => $siswa['nama'],
                'kelas' => $siswa['kelas'],
                'jurusan' => $siswa['jurusan'],
                'kategori_spensasi' => $request->kategori_spensasi,
                'jam_pelajaran' => $request->jam_pelajaran,
                'detail_spensasi' => $request->detail_spensasi,
                'tanggal_spensasi' => $request->tanggal_spensasi,
                'status' => 'menunggu'
            ]);
        }
    
        return redirect()->route('superadmin.spensasi.index')->with('sukses', 'Surat spensasi berhasil dibuat.');
    }
    
    /**
     * Form edit surat spensasi.
     */
    public function edit(Spensasi $spensasi)
    {
        if ($spensasi->status !== 'menunggu') {
            return redirect()->back()->with('error', 'Hanya surat dengan status "menunggu" yang bisa diedit.');
        }

        $kategoriSpensasi = [
            'keluar' => 'Keluar',
            'sakit' => 'Sakit',
            'pulang' => 'Pulang',
        ];

        return view('superadmin.spensasi.edit', compact('spensasi', 'kategoriSpensasi'));
    }

    /**
     * Perbarui surat spensasi.
     */
    public function update(Request $request, Spensasi $spensasi)
    {
        if ($spensasi->status !== 'menunggu') {
            return redirect()->back()->with('error', 'Hanya surat dengan status "menunggu" yang bisa diupdate.');
        }

        $validatedData = $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
            'kategori_spensasi' => 'required|in:keluar,sakit,pulang',
            'jam_pelajaran' => 'nullable|string|max:100',
            'detail_spensasi' => 'required|string',
            'tanggal_spensasi' => 'required|date'
        ]);

        // Pastikan nama siswa ada di database
        $siswa = Siswa::where('nama_siswa', $request->nama_siswa)->first();
        if (!$siswa) {
            return redirect()->back()->withErrors(['nama_siswa' => 'Nama siswa tidak valid! Pilih dari daftar.'])->withInput();
        }

        $spensasi->update($validatedData);

        return redirect()->route('superadmin.spensasi.index')->with('sukses', 'Surat spensasi berhasil diperbarui.');
    }

    /**
     * Hapus surat spensasi.
     */
    public function destroy(Spensasi $spensasi)
    {
        if ($spensasi->status !== 'menunggu') {
            return redirect()->back()->with('error', 'Hanya surat dengan status "menunggu" yang bisa dihapus.');
        }

        $spensasi->delete();

        return redirect()->route('superadmin.spensasi.index')->with('sukses', 'Surat spensasi berhasil dihapus.');
    }

    /**
     * Live search untuk mencari siswa berdasarkan nama.
     */
    public function searchSiswa(Request $request)
{
    $query = $request->input('query');

    $siswa = Siswa::where('nama_siswa', 'LIKE', "%$query%")
        ->where('status', '!=', 'lulus') // Hanya tampilkan siswa yang belum lulus
        ->select('nama_siswa', 'kelas', 'jurusan')
        ->get();

    return response()->json($siswa);
}
}
