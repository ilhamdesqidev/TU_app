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
            'nama_buku' => 'required|unique:klappers,nama_buku',
            'tahun_ajaran' => 'required',
        ],  [
            'nama_buku.required' => 'Nama buku wajib diisi.',
            'nama_buku.unique' => 'Nama buku sudah ada, silakan gunakan nama lain.',
            'tahun_ajaran.required' => 'Tahun ajaran wajib diisi.',
        ]);
        Klapper::create($request->all());
        return redirect()->route('klapper.index')->with('status', 'Berhasil Menambahkan Buku Angkatan');
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
            'nisn' => 'required',
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
        $siswa->nisn = $request->nisn;
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
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('image'), $filename);
            $siswa->foto = $filename;
        }
        $siswa->save();
        return redirect()->route('klapper.siswa', $klappersId)->with('status', 'Berhasil Menambahkan Data Siswa!');
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

        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        // Update semua data kecuali foto
        $siswa->update($request->except('foto'));
    
        // Proses update foto jika ada file yang diunggah
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
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
    }
    
    public function lulus($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->status = 1; // Set status ke 1 untuk "Lulus"
        $siswa->tanggal_lulus = now();
        $siswa->save();
    
        return redirect()->back()->with('success', 'Status siswa berhasil diubah menjadi Lulus.');
    }

    public function lulusSemua($klapperId)
    {
        $klapper = Klapper::findOrFail($klapperId);
    
        // Update status siswa menjadi "Lulus" hanya jika statusnya "Pelajar"
        $klapper->siswas()
            ->where('status', 0)
            ->update([
            'status' => 1,
            'tanggal_lulus' => now(), // Mengisi dengan tanggal dan waktu saat ini
            ]);

        return redirect()->route('klapper.show', $klapperId)
                         ->with('success', 'Semua pelajar telah diluluskan.');
    }
    

    public function keluar($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->status = 2; // Set status ke 2 untuk "Keluar"
        $siswa->tanggal_keluar = now();
        $siswa->save();
    
        return redirect()->back()->with('success', 'Status siswa berhasil diubah menjadi Keluar.');
    }
    
    public function naikKelasXI($klapperId)
    {
        // Ambil klapper berdasarkan ID
        $klapper = Klapper::findOrFail($klapperId);
    
        // Ambil siswa yang statusnya Pelajar (status 0)
        $siswasNaikKelas = $klapper->siswas()->where('status', 0)->get();
    
        // Lakukan perubahan kelas hanya pada siswa yang statusnya Pelajar
        foreach ($siswasNaikKelas as $siswa) {
            // Cek jika siswa berada di kelas X, maka naik kelas
            if ($siswa->kelas == 'X') {
                $siswa->kelas = 'XI';  // Ubah kelas menjadi XI
                $siswa->save();
            }
        }
    
        // Redirect kembali ke halaman yang sesuai setelah proses selesai
        return redirect()->route('klapper.show', $klapperId);
    }
    

    public function naikKelasXII($klapperId)
    {
        // Ambil klapper berdasarkan ID
        $klapper = Klapper::findOrFail($klapperId);
    
        // Ambil siswa yang statusnya Pelajar (status 0)
        $siswasNaikKelas = $klapper->siswas()->where('status', 0)->get();
    
        // Lakukan perubahan kelas hanya pada siswa yang statusnya Pelajar
        foreach ($siswasNaikKelas as $siswa) {
            // Cek jika siswa berada di kelas XI, maka naik kelas
            if ($siswa->kelas == 'XI') {
                $siswa->kelas = 'XII';  // Ubah kelas menjadi XII
                $siswa->save();
            }
        }
    
        // Redirect kembali ke halaman yang sesuai setelah proses selesai
        return redirect()->route('klapper.show', $klapperId);
    }

    public function index()
    {
        $jumlahSiswa = Siswa::where('status', 0)->count(); // Menghitung jumlah siswa
        return view('welcome', compact('jumlahSiswa')); // Mengirimkan jumlah siswa ke view
    }
}

