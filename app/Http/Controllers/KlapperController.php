<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Klapper;

class KlapperController extends Controller
{
    public function indexKlapper()
    {
        $klapper = Klapper::orderBy('created_at', 'desc')->get();
        return view('klapper.index', compact('klapper'));
    }

    public function createKlapper()
    {
        $lastKlapper = Klapper::latest()->first();

        // Jika tidak ada data sebelumnya (first create)
        if (!$lastKlapper) {
            $newNamaBuku = 'Angkatan 1';
            $newTahunAjaran = date('Y') . '/' . (date('Y') + 1);
            $isFirstCreate = true;
        } 
        // Jika ada data sebelumnya
        else {
            // Ekstrak angka dari nama buku terakhir
            $lastNumber = (int) filter_var($lastKlapper->nama_buku, FILTER_SANITIZE_NUMBER_INT);
            $newNamaBuku = 'Angkatan ' . ($lastNumber + 1);
            
            // Ekstrak tahun ajaran terakhir
            if (preg_match('/(\d{4})\/(\d{4})/', $lastKlapper->tahun_ajaran, $matches)) {
                $newTahunAjaran = ($matches[1] + 1) . '/' . ($matches[2] + 1);
            } else {
                $newTahunAjaran = date('Y') . '/' . (date('Y') + 1);
            }
            $isFirstCreate = false;
        }

        return view('klapper.tambah_buku', compact('newNamaBuku', 'newTahunAjaran', 'isFirstCreate'));
    }

    public function storeKlapper(Request $request)
    {
        $request->validate([
            'nama_buku' => 'required|unique:klappers,nama_buku',
            'tahun_ajaran' => 'required|regex:/^\d{4}\/\d{4}$/',
        ],  [
            'nama_buku.required' => 'Nama buku wajib diisi.',
            'nama_buku.unique' => 'Nama buku sudah ada, silakan gunakan nama lain.',
            'tahun_ajaran.required' => 'Tahun ajaran wajib diisi.',
            'tahun_ajaran.regex' => 'Format tahun ajaran harus YYYY/YYYY (contoh: 2023/2024).',
        ]);
        
        Klapper::create([
            'nama_buku' => $request->nama_buku,
            'tahun_ajaran' => $request->tahun_ajaran
        ]);

        return redirect()->route('klapper.index')
            ->with('status', 'Berhasil menambahkan buku angkatan baru');
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

        $enableNaikXI = $klapper->siswas()->where('kelas', 'X')->where('status', 2)->exists();
        $enableNaikXII = $klapper->siswas()->where('kelas', 'XI')->where('status', 2)->exists();
        $enableLuluskan = $klapper->siswas()->where('kelas', 'XII')->where('status', 2)->exists();

        return view('klapper.detail_klapper.siswa', compact('klapper', 'search', 'amaliah', 'enableNaikXI',
        'enableNaikXII', 
        'enableLuluskan'));
    }

    public function deleteKlapper($id)
    {
        $klapper = Klapper::findOrFail($id);
        $klapper->delete();
        
        return redirect()->route('klapper.index')->with('status', 'Data berhasil dihapus!');
    }
}