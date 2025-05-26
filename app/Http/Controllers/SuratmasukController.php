<?php
namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SuratMasukExport;

class SuratMasukController extends Controller
{
    public function index(Request $request)
    {
        $query = SuratMasuk::query();
    
    // Filter berdasarkan pencarian
    if ($request->has('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nomor_surat', 'like', "%{$search}%")
              ->orWhere('pengirim', 'like', "%{$search}%")
              ->orWhere('perihal', 'like', "%{$search}%");
        });
    }
    
    // Filter berdasarkan kategori
    if ($request->has('kategori') && $request->kategori != '') {
        $query->where('kategori', $request->kategori);
    }
    
    // Filter berdasarkan status
    if ($request->has('status') && $request->status != '') {
        $query->where('status', $request->status);
    }
    
    // Filter berdasarkan tanggal
    if ($request->has('start_date') && $request->start_date != '') {
        $query->whereDate('tanggal_diterima', '>=', $request->start_date);
    }
    
    if ($request->has('end_date') && $request->end_date != '') {
        $query->whereDate('tanggal_diterima', '<=', $request->end_date);
    }
    
    // Export ke Excel jika parameter export ada
    if ($request->has('export')) {
        return Excel::download(new SuratMasukExport($query), 'surat-masuk-'.date('YmdHis').'.xlsx');
    }
    
    $suratMasuks = $query->orderBy('tanggal_diterima', 'desc')->paginate(10);
    
     // Paginate results
     $suratMasuks = $query->paginate(25);
    
     // Handle AJAX request
     if ($request->ajax()) {
         $html = '';
         
         if ($suratMasuks->count() > 0) {
             foreach ($suratMasuks as $index => $surat) {
                 $html .= view('surat_masuk.partials.table_row', [
                     'surat' => $surat,
                     'index' => ($suratMasuks->currentPage() - 1) * $suratMasuks->perPage() + $index + 1
                 ])->render();
             }
         } else {
             $html = view('surat_masuk.partials.empty_state')->render();
         }
         
         // Generate pagination HTML
         $paginationHtml = $suratMasuks->links()->toHtml();
         
         return response()->json([
             'html' => $html,
             'pagination' => $paginationHtml,
             'total' => $suratMasuks->total(),
             'currentPage' => $suratMasuks->currentPage(),
             'lastPage' => $suratMasuks->lastPage()
         ]);
     }
     
        return view('superadmin.arsip.surat_masuk.index', compact('suratMasuks'));
    }
    

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nomor_surat' => 'required',
            'tanggal_surat' => 'required|date',
            'pengirim' => 'required',
            'tanggal_diterima' => 'required|date',
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
            'pengirim',
            'tanggal_diterima',
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
            'pengirim' => $surat->pengirim,
            'tanggal_diterima' => $surat->tanggal_diterima->format('Y-m-d'),
            'perihal' => $surat->perihal,
            'isi_surat' => $surat->isi_surat,
            'kategori' => $surat->kategori,
            'status' => $surat->status,
            'lampiran' => $surat->lampiran,
            'disposisi' => $surat->disposisi,
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
            'pengirim' => 'required',
            'tanggal_diterima' => 'required|date',
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
            'pengirim',
            'tanggal_diterima',
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
    
    // Metode untuk menangani disposisi surat
    public function saveDisposisi(Request $request)
    {
        // Validasi input
        $request->validate([
            'surat_id' => 'required|exists:surat_masuks,id',
            'tujuan_disposisi' => 'required',
            'catatan_disposisi' => 'required',
            'tenggat_waktu' => 'required|date',
            'prioritas_disposisi' => 'required|in:tinggi,sedang,rendah',
        ]);
        
        $surat = SuratMasuk::findOrFail($request->surat_id);
        
        // Dapatkan data disposisi yang sudah ada atau inisialisasi array kosong
        $disposisi = $surat->disposisi ?? [];
        
        // Tambahkan disposisi baru
        $disposisi[] = [
            'tujuan' => $request->tujuan_disposisi,
            'catatan' => $request->catatan_disposisi,
            'tenggat_waktu' => $request->tenggat_waktu,
            'prioritas' => $request->prioritas_disposisi,
            'tanggal_disposisi' => now()->format('Y-m-d'),
            'pemberi_disposisi' => auth()->id(),
            'status' => 'belum_ditindaklanjuti'
        ];
        
        // Update data disposisi surat
        $surat->update([
            'disposisi' => $disposisi,
            'status' => 'sedang_diproses'
        ]);
        
        return redirect()->route('surat_masuk.index')
            ->with('success', 'Disposisi surat berhasil disimpan.');
    }
    
    public function updateDisposisiStatus(Request $request, $id, $index)
    {
        // Validasi input
        $request->validate([
            'status_disposisi' => 'required|in:belum_ditindaklanjuti,sedang_ditindaklanjuti,selesai_ditindaklanjuti',
            'catatan_tindaklanjut' => 'nullable|string',
        ]);
        
        $surat = SuratMasuk::findOrFail($id);
        
        if (empty($surat->disposisi) || !isset($surat->disposisi[$index])) {
            return redirect()->back()->with('error', 'Disposisi tidak ditemukan.');
        }
        
        // Update status disposisi
        $disposisi = $surat->disposisi;
        $disposisi[$index]['status'] = $request->status_disposisi;
        
        if ($request->has('catatan_tindaklanjut')) {
            $disposisi[$index]['catatan_tindaklanjut'] = $request->catatan_tindaklanjut;
        }
        
        $disposisi[$index]['tanggal_tindaklanjut'] = now()->format('Y-m-d');
        $disposisi[$index]['petugas_tindaklanjut'] = auth()->id();
        
        // Update data disposisi surat
        $surat->update(['disposisi' => $disposisi]);
        
        // Jika semua disposisi selesai ditindaklanjuti, update status surat menjadi selesai
        $allCompleted = true;
        foreach ($disposisi as $disp) {
            if ($disp['status'] !== 'selesai_ditindaklanjuti') {
                $allCompleted = false;
                break;
            }
        }
        
        if ($allCompleted) {
            $surat->update(['status' => 'selesai']);
        }
        
        return redirect()->route('surat_masuk.index')
            ->with('success', 'Status disposisi berhasil diperbarui.');
    }

}