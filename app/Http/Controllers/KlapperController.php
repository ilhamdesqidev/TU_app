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
        return view('admin.klapper.tambah_buku'); // Ganti dengan view tambah buku
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
        return view('klapper.siswa', compact('siswa'));
    }

    public function createSiswa()
    {
        return view('tambah_siswa'); // View untuk menambah siswa
    }

    public function storeSiswa(Request $request, $klapperId)
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

        $siswa = new Siswa();
        $siswa->nis = $request->nis;
        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->tempat_lahir = $request->tempat_lahir;
        $siswa->tanggal_lahir = $request->tanggal_lahir;
        $siswa->gender = $request->gender;
        $siswa->kelas = $request->kelas;
        $siswa->jurusan = $request->jurusan;
        $siswa->angkatan = $request->angkatan;
        $siswa->nama_orang_tua = $request->nama_orang_tua;
        $siswa->tanggal_masuk = $request->tanggal_masuk;
        $siswa->tanggal_naik_kelas_xi = $request->tanggal_naik_kelas_xi;
        $siswa->tanggal_naik_kelas_xii = $request->tanggal_naik_kelas_xii;
        $siswa->tanggal_lulus = $request->tanggal_lulus;
        $siswa->klapper_id = $klapperId;
        $siswa->save();
        

        // Siswa::create
        // ([
        //     'nis' => $request->nis,
        //     'nama_siswa' => $request->nama_siswa,
        //     'tempat_lahir' => $request->tempat_lahir,
        //     'tanggal_lahir' => $request->tanggal_lahir,
        //     'gender' => $request->gender,
        //     'kelas' => $request->kelas,
        //     'jurusan' => $request->jurusan,
        //     'angkatan' => $request->angkatan,
        //     'nama_orang_tua' => $request->nama_orang_tua,
        //     'tanggal_masuk' => $request->tanggal_masuk,
        //     'tanggal_naik_kelas_xi' => $request->tanggal_naik_kelas_xi,
        //     'tanggal_naik_kelas_xii' => $request->tanggal_naik_kelas_xii,
        //     'tanggal_lulus' => $request->tanggal_lulus,
        //     'klapper_id' => $klapperId,
        // ]);
        // return redirect()->route('klapper.siswa')->with('success', 'Data siswa berhasil
        return redirect()->route('klapper.siswa', $klapperId)->with('status', 'Data siswa berhasil ditambah!');
    }
}
