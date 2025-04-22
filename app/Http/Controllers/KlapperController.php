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
        return view('superadmin.klapper.index', compact('klapper'));
    }

    public function createKlapper()
{
    // Ambil klapper terakhir berdasarkan ID tertinggi
    $lastKlapper = Klapper::latest()->first();

    // Tentukan nama buku baru
    $newNamaBuku = $lastKlapper ? 'Angkatan ' . ((int) filter_var($lastKlapper->nama_buku, FILTER_SANITIZE_NUMBER_INT) + 1) : 'Angkatan 1';

    // Tentukan tahun ajaran baru (misalnya, tambah 1 tahun jika formatnya "2023/2024")
    if ($lastKlapper && preg_match('/(\d{4})\/(\d{4})/', $lastKlapper->tahun_ajaran, $matches)) {
        $newTahunAjaran = ($matches[1] + 1) . '/' . ($matches[2] + 1);
    } else {
        $newTahunAjaran = date('Y') . '/' . (date('Y') + 1);
    }

    return view('superadmin.klapper.tambah_buku', compact('newNamaBuku', 'newTahunAjaran'));
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

    public function showKlapper($id, Request $request)
    {
        $search = $request->input('search');
        $amaliah = $request->input('amaliah');

        $klapper = Klapper::with(['siswas' => function ($query) use ($search, $amaliah) {
            if ($search) {
                $query->where('nama_siswa', 'like', "%$search%")
                    ->orWhere('nis', 'like', "%$search%")
                    ->orWhere('jurusan', 'like', "%$search%");
            }
            
            if ($amaliah) {
                if ($amaliah == 1) {
                    $query->whereIn('jurusan', ['pplg', 'tjkt', 'an']);
                } elseif ($amaliah == 2) {
                    $query->whereIn('jurusan', ['dpb', 'lps', 'akl', 'mp', 'br']);
                }
            }

            $query->orderBy('nama_siswa', 'asc');
        }])->findOrFail($id);

        return view('superadmin.klapper.detail_klapper.siswa', compact('klapper', 'search', 'amaliah'));
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
        return view('superadmin.klapper.siswa', compact('siswa'));
    }

    public function createSiswa($klappersId)
    {
        return view('superadmin.klapper.detail_klapper.tambah_siswa', compact('klappersId'));
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
            'nama_ibu' => 'required',
            'nama_ayah' => 'required',
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
        $siswa->nama_ibu = $request->nama_ibu;
        $siswa->nama_ayah = $request->nama_ayah;
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
        return view('superadmin.klapper.detail_klapper.detail_siswa', compact('siswa'));
    }

    public function editSiswa($id)
    {
        $siswa = Siswa::findOrFail($id); // Ambil siswa berdasarkan ID
        return view('superadmin.klapper.detail_klapper.editdata_siswa', compact('siswa')); // Tampilkan form edit dengan data siswa
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

    public function lulusSemua(Request $request, $id)
    {
        $klapper = Klapper::findOrFail($id);
        $counter = 0;
        
        foreach ($klapper->siswas as $siswa) {
            if ($siswa->kelas == 'XII' && $siswa->status == 0) {
                $siswa->status = 1; // Set status to graduated
                $siswa->tanggal_lulus = $request->tanggal_lulus;
                $siswa->save();
                $counter++;
            }
        }
        
        return redirect()->route('klapper.show', $id)
            ->with('success', "$counter siswa berhasil dinyatakan Lulus.");
    }

    public function keluar($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->status = 2; // Set status ke 2 untuk "Keluar"
        $siswa->tanggal_keluar = now();
        $siswa->save();
    
        return redirect()->back()->with('success', 'Status siswa berhasil diubah menjadi Keluar.');
    }
    
    public function naikKelasXI(Request $request, $id)
    {
        $klapper = Klapper::findOrFail($id);
        $counter = 0;
        
        foreach ($klapper->siswas as $siswa) {
            if ($siswa->kelas == 'X' && $siswa->status == 0) {
                $siswa->kelas = 'XI';
                $siswa->tanggal_naik_kelas_xi = $request->tanggal_naik_kelas_xi;
                $siswa->save();
                $counter++;
            }
        }
        
        return redirect()->route('klapper.show', $id)
            ->with('success', "$counter siswa berhasil dinaikkan ke Kelas XI.");
    }
    

    public function naikKelasXII(Request $request, $id)
    {
        $klapper = Klapper::findOrFail($id);
        $counter = 0;
        
        foreach ($klapper->siswas as $siswa) {
            if ($siswa->kelas == 'XI' && $siswa->status == 0) {
                $siswa->kelas = 'XII';
                $siswa->tanggal_naik_kelas_xii = $request->tanggal_naik_kelas_xii;
                $siswa->save();
                $counter++;
            }
        }
        
        return redirect()->route('klapper.show', $id)
            ->with('success', "$counter siswa berhasil dinaikkan ke Kelas XII.");
    }


    public function index()
    {
        $jumlahSiswa = Siswa::where('status', 0)->count(); // Menghitung jumlah siswa
        $jumlahAngkatan = Klapper::count(); // Menghitung jumlah Klapper
        return view('superadmin/welcome', compact('jumlahSiswa', 'jumlahAngkatan')); // Mengirimkan jumlah siswa ke view
    }


    public function getSiswa($nama_siswa) {
    $siswa = Siswa::where('nama_siswa', $nama_siswa)->first();
    
    if (!$siswa) {
        return response()->json(['error' => 'Siswa tidak ditemukan'], 404);
    }

    return response()->json($siswa);
}


}