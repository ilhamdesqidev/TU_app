<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Klapper;

class KlapperController extends Controller
{
    public function indexKlapper()
    {
        $klapper = Klapper::all();
        return view('klapper.index', compact('klapper'));
    }

    public function createKlapper()
    {
        $lastKlapper = Klapper::latest()->first();

        $newNamaBuku = $lastKlapper ? 'Angkatan ' . ((int) filter_var($lastKlapper->nama_buku, FILTER_SANITIZE_NUMBER_INT) + 1) : 'Angkatan 1';

        if ($lastKlapper && preg_match('/(\d{4})\/(\d{4})/', $lastKlapper->tahun_ajaran, $matches)) {
            $newTahunAjaran = ($matches[1] + 1) . '/' . ($matches[2] + 1);
        } else {
            $newTahunAjaran = date('Y') . '/' . (date('Y') + 1);
        }

        return view('klapper.tambah_buku', compact('newNamaBuku', 'newTahunAjaran'));
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

        return view('klapper.detail_klapper.siswa', compact('klapper', 'search', 'amaliah'));
    }

    public function deleteKlapper($id)
    {
        Klapper::destroy($id);
        return redirect()->route('klapper.index')->with('status', 'Data berhasil dihapus!');
    }
}
