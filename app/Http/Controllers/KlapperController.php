<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Klapper;
use App\Models\Siswa;
use DB;

class KlapperController extends Controller
{
    // Untuk Klapper
    public function indexKlapper()
    {
        $klapper = Klapper::all();
        return view('klapper', compact('klapper'));
    }

    public function createKlapper()
    {
        return view('admin.klapper.create'); // Ganti dengan view tambah buku
    }

    public function storeKlapper(Request $request)
    {
        $request->validate([
            'nama_buku' => 'required',
            'tahun_ajaran' => 'required',
        ]);

        Klapper::create($request->all());
        return redirect()->route('klapper.index')->with('status', 'Data berhasil ditambah!');
    }

    public function showKlapper($id)
    {
        $klapper = Klapper::findOrFail($id);
        return view('klapper.siswa', compact('klapper'));
    }

    public function deleteKlapper($id)
    {
        Klapper::destroy($id);
        return redirect()->route('klapper.index')->with('status', 'Data berhasil dihapus!');
    }

    // Untuk Siswa
    public function indexSiswa()
    {
        $siswa = Siswa::all();
        return view('siswa.index', compact('siswa'));
    }

    public function createSiswa()
    {
        return view('tambah_siswa'); // View untuk menambah siswa
    }

    public function storeSiswa(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'nama_siswa' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'gender' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'angkatan' => 'required',
            'nama_orang_tua' => 'required',
            'tanggal_masuk' => 'required|date',
            'tanggal_naik_kelas_xi' => 'nullable|date',
            'tanggal_naik_kelas_xii' => 'nullable|date',
            'tanggal_lulus' => 'nullable|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        Siswa::create($request->all());
        return redirect()->route('siswa.index')->with('status', 'Data siswa berhasil ditambah!');
    }
}
