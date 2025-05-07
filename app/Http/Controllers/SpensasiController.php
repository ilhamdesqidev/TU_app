<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spensasi;
use App\Models\Siswa;
use Carbon\Carbon;

class SpensasiController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status', 'semua');

        $query = Spensasi::query();

        // Update otomatis status menja di kadaluarsa
        $query->where(function ($q) {
            $q->where('status', 'menunggu')
              ->where('waktu_selesai', '<', now());
        })->update(['status' => 'kadaluarsa']);

        if ($status !== 'semua') {
            $query->where('status', $status);
        }

        $surat = $query->orderByDesc('created_at')->paginate(10);
        return view('superadmin.spensasi.index', compact('surat', 'status'));
    }

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

public function store(Request $request)
{
    $validatedData = $request->validate([
        'siswa_terpilih' => 'required',
        'kategori_spensasi' => 'required|in:keluar,sakit,pulang',
        'detail_spensasi' => 'required|string',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        'jam_mulai_spensasi' => 'required|date_format:H:i',
        'jam_selesai_spensasi' => 'required|date_format:H:i',
    ]);

    $siswaTerpilih = json_decode($request->siswa_terpilih, true);

    // Mengonversi waktu mulai dan selesai
    $waktuMulai = Carbon::parse($request->tanggal_mulai . ' ' . $request->jam_mulai_spensasi);
    $waktuSelesai = Carbon::parse($request->tanggal_selesai . ' ' . $request->jam_selesai_spensasi);

    foreach ($siswaTerpilih as $siswa) {
        $siswaDB = Siswa::where('nama_siswa', $siswa['nama'])->first();

        if (!$siswaDB) {
            return redirect()->back()->withErrors(['siswa_terpilih' => 'Salah satu nama siswa tidak valid!'])->withInput();
        }

        if ($siswaDB->status === 'lulus') {
            return redirect()->back()->withErrors(['siswa_terpilih' => 'Siswa ' . $siswa['nama'] . ' sudah lulus dan tidak bisa dimasukkan ke Spensasi!'])->withInput();
        }

        if (!$waktuMulai || !$waktuSelesai) {
            return redirect()->back()->withErrors(['waktu_spensasi' => 'Waktu mulai/selesai tidak valid'])->withInput();
        }
        

        Spensasi::create([
            'nama_siswa' => $siswa['nama'],
            'kelas' => $siswa['kelas'],
            'jurusan' => $siswa['jurusan'],
            'kategori_spensasi' => $request->kategori_spensasi,
            'detail_spensasi' => $request->detail_spensasi,
            'waktu_mulai' => $waktuMulai,
            'waktu_selesai' => $waktuSelesai,
            'status' => 'menunggu',
            'tanggal_spensasi' => Carbon::now()->toDateString(), // Tanggal spensasi adalah hari ini
        ]);
    }

    return redirect()->route('superadmin.spensasi.index')->with('sukses', 'Surat spensasi berhasil dibuat.');
}



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

    public function update(Request $request, Spensasi $spensasi)
    {
        if ($spensasi->status !== 'menunggu') {
            return redirect()->back()->with('error', 'Hanya surat dengan status "menunggu" yang bisa diupdate.');
        }

        $validatedData = $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
            'kategori_spensasi' => 'required|in:keluar,sakit,pulang',
            'detail_spensasi' => 'required|string',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after_or_equal:waktu_mulai',
        ]);

        $siswa = Siswa::where('nama_siswa', $request->nama_siswa)->first();
        if (!$siswa) {
            return redirect()->back()->withErrors(['nama_siswa' => 'Nama siswa tidak valid! Pilih dari daftar.'])->withInput();
        }

        $spensasi->update($validatedData);

        return redirect()->route('superadmin.spensasi.index')->with('sukses', 'Surat spensasi berhasil diperbarui.');
    }

    public function destroy(Spensasi $spensasi)
    {
        if ($spensasi->status !== 'menunggu') {
            return redirect()->back()->with('error', 'Hanya surat dengan status "menunggu" yang bisa dihapus.');
        }

        $spensasi->delete();

        return redirect()->route('superadmin.spensasi.index')->with('sukses', 'Surat spensasi berhasil dihapus.');
    }

    public function searchSiswa(Request $request)
    {
        $query = $request->input('query');

        $siswa = Siswa::where('nama_siswa', 'LIKE', "%$query%")
            ->where('status', '!=', 'lulus')
            ->select('nama_siswa', 'kelas', 'jurusan')
            ->get();

        return response()->json($siswa);
    }
}
