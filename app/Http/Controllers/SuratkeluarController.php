<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratKeluarController extends Controller
{
    public function index(Request $request)
    {
        $query = SuratKeluar::query();

        // Filter dan pencarian (sama seperti sebelumnya)
        // ...

        $suratKeluars = $query->latest()->paginate(10);

        return view('arsip.surat_keluar.index', compact('suratKeluars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|unique:surat_keluars',
            'tanggal_surat' => 'required|date',
            'penerima' => 'required',
            'perihal' => 'required',
            'kategori' => 'required|in:penting,segera,biasa',
            'status' => 'required|in:draft,dikirim,diterima',
            'isi_surat' => 'required',
            'lampiran.*' => 'file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240'
        ]);

        $lampiranPaths = [];
        if ($request->hasFile('lampiran')) {
            foreach ($request->file('lampiran') as $file) {
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $fileName = pathinfo($originalName, PATHINFO_FILENAME);
                
                // Cek jika file sudah ada
                $counter = 1;
                $newName = $originalName;
                
                while (Storage::disk('public')->exists('lampiran/'.$newName)) {
                    $newName = $fileName . '_' . $counter . '.' . $extension;
                    $counter++;
                }
                
                $path = $file->storeAs('lampiran', $newName, 'public');
                $lampiranPaths[] = $path;
            }
        }

        SuratKeluar::create([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'penerima' => $request->penerima,
            'tanggal_pengiriman' => $request->tanggal_pengiriman,
            'perihal' => $request->perihal,
            'kategori' => $request->kategori,
            'status' => $request->status,
            'isi_surat' => $request->isi_surat,
            'lampiran' => !empty($lampiranPaths) ? implode('|', $lampiranPaths) : null
        ]);

        return redirect()->route('surat_keluar.index')
            ->with('success', 'Surat keluar berhasil ditambahkan');
    }

    public function update(Request $request, SuratKeluar $suratKeluar)
    {
        $request->validate([
            'nomor_surat' => 'required|unique:surat_keluars,nomor_surat,'.$suratKeluar->id,
            'tanggal_surat' => 'required|date',
            'penerima' => 'required',
            'perihal' => 'required',
            'kategori' => 'required|in:penting,segera,biasa',
            'status' => 'required|in:draft,dikirim,diterima',
            'isi_surat' => 'required',
            'lampiran.*' => 'file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240'
        ]);

        $existingFiles = $suratKeluar->lampiran ? explode('|', $suratKeluar->lampiran) : [];
        $selectedFiles = $request->existing_files ?? [];
        $newFiles = [];

        // Proses file baru
        if ($request->hasFile('lampiran')) {
            foreach ($request->file('lampiran') as $file) {
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $fileName = pathinfo($originalName, PATHINFO_FILENAME);
                
                $counter = 1;
                $newName = $originalName;
                
                while (Storage::disk('public')->exists('lampiran/'.$newName)) {
                    $newName = $fileName . '_' . $counter . '.' . $extension;
                    $counter++;
                }
                
                $path = $file->storeAs('lampiran', $newName, 'public');
                $newFiles[] = $path;
            }
        }

        // Gabungkan file yang dipilih dengan file baru
        $allFiles = array_merge($selectedFiles, $newFiles);
        $lampiranString = implode('|', $allFiles);

        // Hapus file yang tidak dipilih
        $filesToDelete = array_diff($existingFiles, $selectedFiles);
        foreach ($filesToDelete as $file) {
            Storage::disk('public')->delete($file);
        }

        $suratKeluar->update([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'penerima' => $request->penerima,
            'tanggal_pengiriman' => $request->tanggal_pengiriman,
            'perihal' => $request->perihal,
            'kategori' => $request->kategori,
            'status' => $request->status,
            'isi_surat' => $request->isi_surat,
            'lampiran' => !empty($allFiles) ? $lampiranString : null
        ]);

        return redirect()->route('surat_keluar.index')
            ->with('success', 'Surat keluar berhasil diperbarui');
    }

    public function destroy(SuratKeluar $suratKeluar)
    {
        // Hapus lampiran jika ada
        if ($suratKeluar->lampiran) {
            foreach (explode('|', $suratKeluar->lampiran) as $file) {
                Storage::disk('public')->delete($file);
            }
        }

        $suratKeluar->delete();

        return redirect()->route('surat_keluar.index')
            ->with('success', 'Surat keluar berhasil dihapus');
    }

    public function print(SuratKeluar $suratKeluar)
    {
        return view('arsip.surat_keluar.print', compact('suratKeluar'));
    }

    public function downloadLampiran($suratId, $filename)
    {
        $surat = SuratKeluar::findOrFail($suratId);
        $files = explode('|', $surat->lampiran);
        
        foreach ($files as $file) {
            if (basename($file) === $filename) {
                $originalName = pathinfo($file, PATHINFO_BASENAME);
                return Storage::disk('public')->download($file, $originalName);
            }
        }
        
        abort(404, 'File tidak ditemukan');
    }
}