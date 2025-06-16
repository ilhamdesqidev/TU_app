<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\Disposisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratMasukController extends Controller
{
    public function index()
    {
        $suratMasuks = SuratMasuk::with(['lampiran', 'disposisi'])->paginate(10);
        return view('arsip.surat_masuk.index', compact('suratMasuks'));
    }

    public function create()
    {
        return view('arsip.surat_masuk.modals.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|unique:surat_masuks|max:100',
            'tanggal_surat' => 'required|date',
            'pengirim' => 'required|max:100',
            'tanggal_diterima' => 'required|date',
            'perihal' => 'required|max:255',
            'kategori' => 'required|in:penting,segera,biasa',
            'status' => 'required|in:belum_diproses,sedang_diproses,selesai',
            'isi_surat' => 'nullable',
            'lampiran.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240'
        ]);
        
        $suratMasuk = SuratMasuk::create($validated);
        
        // Handle file upload
        if($request->hasFile('lampiran')) {
            foreach($request->file('lampiran') as $file) {
                $path = $file->store('lampiran_surat_masuk', 'public');
                $suratMasuk->lampiran()->create(['path' => $path]);
            }
        }
        
        return redirect()->route('surat_masuk.index')
            ->with('success', 'Surat masuk berhasil ditambahkan');
    }

    public function show(SuratMasuk $suratMasuk)
    {
        return view('surat_masuk.modals.show', compact('suratMasuk'));
    }

    public function edit(SuratMasuk $suratMasuk)
    {
        return view('arsip.surat_masuk.modals.edit', compact('suratMasuk'));
    }

    public function update(Request $request, SuratMasuk $suratMasuk)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|max:100|unique:surat_masuks,nomor_surat,'.$suratMasuk->id,
            'tanggal_surat' => 'required|date',
            'pengirim' => 'required|max:100',
            'tanggal_diterima' => 'required|date',
            'perihal' => 'required|max:255',
            'kategori' => 'required|in:penting,segera,biasa',
            'status' => 'required|in:belum_diproses,sedang_diproses,selesai',
            'isi_surat' => 'nullable',
            'lampiran.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240'
        ]);
        
        $suratMasuk->update($validated);
        
        // Handle file upload baru
        if($request->hasFile('lampiran')) {
            // Hapus lampiran lama
            foreach($suratMasuk->lampiran as $lampiran) {
                Storage::disk('public')->delete($lampiran->path);
                $lampiran->delete();
            }
            
            // Upload lampiran baru
            foreach($request->file('lampiran') as $file) {
                $path = $file->store('lampiran_surat_masuk', 'public');
                $suratMasuk->lampiran()->create(['path' => $path]);
            }
        }
        
        return redirect()->route('surat_masuk.index')
            ->with('success', 'Surat masuk berhasil diperbarui');
    }

    public function destroy(SuratMasuk $suratMasuk)
    {
        // Hapus lampiran terkait
        foreach($suratMasuk->lampiran as $lampiran) {
            Storage::disk('public')->delete($lampiran->path);
            $lampiran->delete();
        }
        
        // Hapus disposisi terkait
        if($suratMasuk->disposisi) {
            $suratMasuk->disposisi->delete();
        }
        
        $suratMasuk->delete();
        
        return redirect()->route('surat_masuk.index')
            ->with('success', 'Surat masuk berhasil dihapus');
    }

    public function disposisi(SuratMasuk $suratMasuk)
    {
        return view('arsip.surat_masuk.modals.disposisi', compact('suratMasuk'));
    }

    public function storeDisposisi(Request $request, SuratMasuk $suratMasuk)
    {
        $validated = $request->validate([
            'tujuan_disposisi' => 'required|in:kepala_bagian,sekretaris,staff_admin,wadir,direktur',
            'catatan_disposisi' => 'required|string|max:500',
            'tenggat_waktu' => 'required|date|after_or_equal:today',
            'prioritas_disposisi' => 'required|in:tinggi,sedang,rendah'
        ]);
        
        // Update status surat menjadi sedang diproses
        $suratMasuk->update(['status' => 'sedang_diproses']);
        
        // Buat disposisi
        $suratMasuk->disposisi()->create($validated);
        
        return redirect()->route('surat_masuk.index')
            ->with('success', 'Disposisi berhasil dibuat');
    }

    public function print($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        return view('surat_masuk.print', compact('surat'));
    }
    

    public function export()
    {
        // Implementasi export Excel
        // Anda bisa menggunakan package seperti Maatwebsite/Laravel-Excel
        return response()->streamDownload(function() {
            $suratMasuks = SuratMasuk::all();
            echo view('surat_masuk.export', compact('suratMasuks'));
        }, 'Data-Surat-Masuk-'.date('Y-m-d').'.xlsx');
    }
}