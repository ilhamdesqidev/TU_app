<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Klapper;
use App\Models\Tambah_siswa; // Pastikan model ini di-import
use DB;

class KlapperController extends Controller
{
    public function index()
    {
        $klapper = Klapper::all();
        return view('klapper', compact('klapper'));
    }

    public function create()
    {
        return view('admin.klapper.tambah_buku');
    }

    public function storeKlapper(Request $request)
    {
        DB::table('klapper')->insert([
            'nama_buku' => $request->nama_buku,
            'tahun_ajaran' => $request->tahun_ajaran,
        ]);

        return redirect('klapper')->with('status', 'Data buku berhasil ditambah!');
    }

    public function show($id)
    {
        $klapper = Klapper::findOrFail($id);
        $siswa = Tambah_siswa::where('klapper_id', $id)->get(); // Ambil siswa berdasarkan klapper_id
        return view('klapper.show', compact('klapper', 'siswa'));
    }

    public function addSiswa(Request $request, $klapper_id)
    {
        Tambah_siswa::create([
            'nis' => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'gender' => $request->gender,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'angkatan' => $request->angkatan,
            'nama_orang_tua' => $request->nama_orang_tua,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_naik_kelas_xi' => $request->tanggal_naik_kelas_xi,
            'tanggal_naik_kelas_xii' => $request->tanggal_naik_kelas_xii,
            'tanggal_lulus' => $request->tanggal_lulus,
            'foto' => $request->file('foto')->store('images'), // Simpan foto jika ada
            'klapper_id' => $klapper_id, // Relasi dengan klapper
        ]);

        return redirect()->route('klapper.show', $klapper_id)->with('status', 'Data siswa berhasil ditambah!');
    }

    public function delete($id)
    {
        DB::table('klapper')->where('id', $id)->delete();
        return redirect('klapper')->with('status', 'Data berhasil dihapus!');
    }
}
