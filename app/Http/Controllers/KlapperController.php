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
        $klapper = Klapper::with('siswas')->findOrFail($id); // Pastikan relasi 'siswas' di-load
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
        $siswa = Siswa::count();
        return view('klapper.siswa', compact('siswa'));
    }

    public function createSiswa($klappersId)
    {
        return view('klapper.tambah_siswa', compact('klappersId'));
    }

    public function storeSiswa(Request $request, $klappersId)
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
        $siswa->klapper_id = $klappersId;
        $siswa->status = 0;
        $siswa->save();
        return redirect()->route('klapper.siswa', $klappersId)->with('status', 'Data siswa berhasil ditambah!');
    }

    public function showSiswa($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('klapper.detail_siswa', compact('siswa'));
    }

    public function editSiswa($id)
    {
        $siswa = Siswa::findOrFail($id); // Ambil siswa berdasarkan ID
        return view('klapper.editdata_siswa', compact('siswa')); // Tampilkan form edit dengan data siswa
    }

    public function updateSiswa(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->update($request->all()); // Update dengan data dari form
        return redirect()->route('siswa.show', $siswa->id)->with('success', 'Data siswa berhasil diperbarui.');
    }
    
    public function lulus($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->status = 1; // Set status ke 1 untuk "Lulus"
        $siswa->tanggal_lulus = now();
        $siswa->save();
    
        return redirect()->back()->with('success', 'Status siswa berhasil diubah menjadi Lulus.');
    }

    public function keluar($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->status = 2; // Set status ke 2 untuk "Keluar"
        $siswa->save();
    
        return redirect()->back()->with('success', 'Status siswa berhasil diubah menjadi Keluar.');
    }
    

    public function index()
    {
        $jumlahSiswa = Siswa::where('status', 0)->count(); // Menghitung jumlah siswa
        return view('welcome', compact('jumlahSiswa')); // Mengirimkan jumlah siswa ke view
    }
}

