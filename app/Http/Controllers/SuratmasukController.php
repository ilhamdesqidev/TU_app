<?php
namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SuratMasukExport;

class SuratMasukController extends Controller
{
    public function index()
    {
        $suratMasuks = SuratMasuk::latest()->paginate(10);
        return view('superadmin.arsip.surat_masuk.index', compact('suratMasuks'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nomor_surat' => 'required',
            'tanggal_surat' => 'required|date',
            'tanggal_diterima' => 'required|date',
            'pengirim' => 'required',
            'perihal' => 'required',
            'isi_surat' => 'nullable',
            'kategori' => 'required|in:penting,segera,biasa',
            'status' => 'required|in:belum_diproses,sedang_diproses,selesai',
            'lampiran.*' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png'
        ]);

        // Inisialisasi array data dengan field dari request
        $data = $request->only([
            'nomor_surat',
            'tanggal_surat',
            'tanggal_diterima',
            'pengirim',
            'perihal',
            'isi_surat',
            'kategori',
            'status',
        ]);

        // Menangani lampiran
        $lampiran = [];
        if ($request->hasFile('lampiran')) {
            foreach ($request->file('lampiran') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('lampiran_surat_masuk', $filename, 'public');
                
                $lampiran[] = [
                    'nama' => $file->getClientOriginalName(),
                    'path' => $path,
                    'tipe' => $file->getClientOriginalExtension(),
                    'ukuran' => round($file->getSize() / 1024, 2) . ' KB'
                ];
            }
            $data['lampiran'] = $lampiran;
        }

        // Simpan data
        $surat = SuratMasuk::create($data);

        return redirect()->route('surat_masuk.index')
            ->with('success', 'Surat masuk berhasil ditambahkan.');
    }

    public function show($id)
    {
        $surat = SuratMasuk::findOrFail($id);

        return response()->json([
            'id' => $surat->id,
            'nomor_surat' => $surat->nomor_surat,
            'tanggal_surat' => $surat->tanggal_surat->format('Y-m-d'),
            'tanggal_diterima' => $surat->tanggal_diterima->format('Y-m-d'),
            'pengirim' => $surat->pengirim,
            'perihal' => $surat->perihal,
            'isi_surat' => $surat->isi_surat,
            'kategori' => $surat->kategori,
            'status' => $surat->status,
            'lampiran' => $surat->lampiran,
        ]);
    }
    
    public function edit($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        return response()->json($surat);
    }
    
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nomor_surat' => 'required',
            'tanggal_surat' => 'required|date',
            'tanggal_diterima' => 'required|date',
            'pengirim' => 'required',
            'perihal' => 'required',
            'isi_surat' => 'nullable',
            'kategori' => 'required|in:penting,segera,biasa',
            'status' => 'required|in:belum_diproses,sedang_diproses,selesai',
            'lampiran.*' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png'
        ]);

        $surat = SuratMasuk::findOrFail($id);
        
        // Inisialisasi array data dengan field dari request
        $data = $request->only([
            'nomor_surat',
            'tanggal_surat',
            'tanggal_diterima',
            'pengirim',
            'perihal',
            'isi_surat',
            'kategori',
            'status',
        ]);

        // Menangani lampiran
        if ($request->hasFile('lampiran')) {
            $existingAttachments = $surat->lampiran ?? [];
            $keepAttachments = $request->input('keep_file', []);
            $lampiran = [];
            
            // Pertahankan lampiran yang dipilih
            if (!empty($existingAttachments)) {
                foreach ($existingAttachments as $index => $attachment) {
                    if (in_array($index, $keepAttachments)) {
                        $lampiran[] = $attachment;
                    } else {
                        // Hapus file yang tidak dipertahankan
                        if (isset($attachment['path'])) {
                            Storage::disk('public')->delete($attachment['path']);
                        }
                    }
                }
            }
            
            // Tambahkan lampiran baru
            foreach ($request->file('lampiran') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('lampiran_surat_masuk', $filename, 'public');
                
                $lampiran[] = [
                    'nama' => $file->getClientOriginalName(),
                    'path' => $path,
                    'tipe' => $file->getClientOriginalExtension(),
                    'ukuran' => round($file->getSize() / 1024, 2) . ' KB'
                ];
            }
            
            $data['lampiran'] = $lampiran;
        }

        // Update data
        $surat->update($data);

        return redirect()->route('surat_masuk.index')
            ->with('success', 'Surat masuk berhasil diperbarui.');
    }
    
    public function destroy($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        
        // Hapus semua file lampiran
        if (!empty($surat->lampiran)) {
            foreach ($surat->lampiran as $attachment) {
                if (isset($attachment['path'])) {
                    Storage::disk('public')->delete($attachment['path']);
                }
            }
        }
        
        $surat->delete();
        
        return redirect()->route('surat_masuk.index')
            ->with('success', 'Surat masuk berhasil dihapus.');
    }
    
    public function downloadAttachment($id, $index)
    {
        $surat = SuratMasuk::findOrFail($id);
        
        if (empty($surat->lampiran) || !isset($surat->lampiran[$index])) {
            return redirect()->back()->with('error', 'Lampiran tidak ditemukan.');
        }
        
        $attachment = $surat->lampiran[$index];
        
        if (!isset($attachment['path']) || !Storage::disk('public')->exists($attachment['path'])) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }
        
        return Storage::disk('public')->download($attachment['path'], $attachment['nama']);
    }
    
    public function export()
    {
        return Excel::download(new SuratMasukExport, 'daftar_surat_masuk.xlsx');
    }
}