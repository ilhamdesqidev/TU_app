<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\Disposisi;
use Illuminate\Http\Request;

class DisposisiController extends Controller
{
    /**
     * Menyimpan data disposisi baru
     */
    public function store(Request $request, $suratMasukId)
    {
        $validated = $request->validate([
            'tujuan_disposisi' => 'required|string|max:255',
            'catatan_disposisi' => 'required|string',
            'tenggat_waktu' => 'required|date',
            'prioritas_disposisi' => 'required|in:tinggi,sedang,rendah',
            'status_disposisi' => 'nullable|in:pending,diterima,selesai'
        ]);

        $suratMasuk = SuratMasuk::findOrFail($suratMasukId);

        // Cek apakah sudah ada disposisi
        if ($suratMasuk->disposisi) {
            return redirect()->back()
                ->with('error', 'Surat ini sudah memiliki disposisi');
        }

        // Buat disposisi baru
        $disposisi = $suratMasuk->disposisi()->create($validated);

        // Update status surat jika belum diproses
        if ($suratMasuk->status == 'belum_diproses') {
            $suratMasuk->update(['status' => 'sedang_diproses']);
        }

        return redirect()->route('arsip.surat-masuk.index')
            ->with('success', 'Disposisi berhasil dibuat');
    }

    /**
     * Menampilkan form edit disposisi
     */
    public function edit($suratMasukId)
    {
        $suratMasuk = SuratMasuk::with('disposisi')->findOrFail($suratMasukId);
        
        if (!$suratMasuk->disposisi) {
            return redirect()->back()
                ->with('error', 'Surat ini belum memiliki disposisi');
        }

        return view('arsip.surat_masuk.modals.edit_disposisi', compact('suratMasuk'));
    }

    /**
     * Mengupdate data disposisi
     */
    public function update(Request $request, $suratMasukId)
    {
        $validated = $request->validate([
            'tujuan_disposisi' => 'required|string|max:255',
            'catatan_disposisi' => 'required|string',
            'tenggat_waktu' => 'required|date',
            'prioritas_disposisi' => 'required|in:tinggi,sedang,rendah',
            'status_disposisi' => 'required|in:pending,diterima,selesai'
        ]);

        $suratMasuk = SuratMasuk::with('disposisi')->findOrFail($suratMasukId);

        if (!$suratMasuk->disposisi) {
            return redirect()->back()
                ->with('error', 'Disposisi tidak ditemukan');
        }

        $suratMasuk->disposisi->update($validated);

        // Update status surat berdasarkan status disposisi
        if ($validated['status_disposisi'] == 'selesai') {
            $suratMasuk->update(['status' => 'selesai']);
        } elseif ($suratMasuk->status == 'belum_diproses') {
            $suratMasuk->update(['status' => 'sedang_diproses']);
        }

        return redirect()->route('arsip.surat-masuk.index')
            ->with('success', 'Disposisi berhasil diperbarui');
    }

    /**
     * Menghapus disposisi
     */
    public function destroy($suratMasukId)
    {
        $suratMasuk = SuratMasuk::with('disposisi')->findOrFail($suratMasukId);

        if (!$suratMasuk->disposisi) {
            return redirect()->back()
                ->with('error', 'Disposisi tidak ditemukan');
        }

        $suratMasuk->disposisi->delete();
        $suratMasuk->update(['status' => 'belum_diproses']);

        return redirect()->route('arsip.surat-masuk.index')
            ->with('success', 'Disposisi berhasil dihapus');
    }
}