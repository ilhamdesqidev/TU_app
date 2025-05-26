<?php
namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SuratKeluarExport;

class SuratKeluarController extends Controller
{
    // --- AJAX RESPONSE HANDLER FOR LARAVEL ---
/**
 * This controller method handles AJAX pagination requests 
 * Add this to your SuratKeluarController.php
 */

public function index(Request $request)
{
    $query = SuratKeluar::query();
    
    // Apply filters
    if ($request->filled('search')) {
        $searchTerm = $request->search;
        $query->where(function($q) use ($searchTerm) {
            $q->where('nomor_surat', 'like', "%{$searchTerm}%")
              ->orWhere('penerima', 'like', "%{$searchTerm}%")
              ->orWhere('perihal', 'like', "%{$searchTerm}%");
        });
    }
    
    if ($request->filled('category')) {
        $query->where('kategori', $request->category);
    }
    
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }
    
    if ($request->filled('start_date')) {
        $query->whereDate('tanggal_surat', '>=', $request->start_date);
    }
    
    if ($request->filled('end_date')) {
        $query->whereDate('tanggal_surat', '<=', $request->end_date);
    }
    
    // Order by date
    $query->orderBy('tanggal_surat', 'desc');
    
    // Paginate results
    $suratKeluars = $query->paginate(25);
    
    // Handle AJAX request
    if ($request->ajax()) {
        $html = '';
        
        if ($suratKeluars->count() > 0) {
            foreach ($suratKeluars as $index => $surat) {
                $html .= view('surat_keluar.partials.table_row', [
                    'surat' => $surat,
                    'index' => ($suratKeluars->currentPage() - 1) * $suratKeluars->perPage() + $index + 1
                ])->render();
            }
        } else {
            $html = view('surat_keluar.partials.empty_state')->render();
        }
        
        // Generate pagination HTML
        $paginationHtml = $suratKeluars->links()->toHtml();
        
        return response()->json([
            'html' => $html,
            'pagination' => $paginationHtml,
            'total' => $suratKeluars->total(),
            'currentPage' => $suratKeluars->currentPage(),
            'lastPage' => $suratKeluars->lastPage()
        ]);
    }
    
    // Regular view response
    return view('superadmin.arsip.surat_keluar.index', compact('suratKeluars'));
}

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nomor_surat' => 'required',
            'tanggal_surat' => 'required|date',
            'penerima' => 'required',
            'tanggal_pengiriman' => 'nullable|date',
            'perihal' => 'required',
            'isi_surat' => 'nullable',
            'kategori' => 'required|in:penting,segera,biasa',
            'status' => 'required|in:draft,dikirim,diterima',
            'lampiran.*' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png'
        ]);

        // Inisialisasi array data dengan field dari request
        $data = $request->only([
            'nomor_surat',
            'tanggal_surat',
            'penerima',
            'tanggal_pengiriman',
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
                $path = $file->storeAs('lampiran_surat_keluar', $filename, 'public');
                
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
        $surat = SuratKeluar::create($data);

        return redirect()->route('surat_keluar.index')
            ->with('success', 'Surat keluar berhasil ditambahkan.');
    }

    public function show($id)
    {
        $surat = SuratKeluar::findOrFail($id);

        return response()->json([
            'id' => $surat->id,
            'nomor_surat' => $surat->nomor_surat,
            'tanggal_surat' => $surat->tanggal_surat->format('Y-m-d'),
            'penerima' => $surat->penerima,
            'tanggal_pengiriman' => $surat->tanggal_pengiriman ? $surat->tanggal_pengiriman->format('Y-m-d') : null,
            'perihal' => $surat->perihal,
            'isi_surat' => $surat->isi_surat,
            'kategori' => $surat->kategori,
            'status' => $surat->status,
            'lampiran' => $surat->lampiran,
        ]);
    }
    
    public function edit($id)
    {
        $surat = SuratKeluar::findOrFail($id);
        return response()->json($surat);
    }
    
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nomor_surat' => 'required',
            'tanggal_surat' => 'required|date',
            'penerima' => 'required',
            'tanggal_pengiriman' => 'nullable|date',
            'perihal' => 'required',
            'isi_surat' => 'nullable',
            'kategori' => 'required|in:penting,segera,biasa',
            'status' => 'required|in:draft,dikirim,diterima',
            'lampiran.*' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png'
        ]);

        $surat = SuratKeluar::findOrFail($id);
        
        // Inisialisasi array data dengan field dari request
        $data = $request->only([
            'nomor_surat',
            'tanggal_surat',
            'penerima',
            'tanggal_pengiriman',
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
                $path = $file->storeAs('lampiran_surat_keluar', $filename, 'public');
                
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

        return redirect()->route('surat_keluar.index')
            ->with('success', 'Surat keluar berhasil diperbarui.');
    }
    
    public function destroy($id)
    {
        $surat = SuratKeluar::findOrFail($id);
        
        // Hapus semua file lampiran
        if (!empty($surat->lampiran)) {
            foreach ($surat->lampiran as $attachment) {
                if (isset($attachment['path'])) {
                    Storage::disk('public')->delete($attachment['path']);
                }
            }
        }
        
        $surat->delete();
        
        return redirect()->route('surat_keluar.index')
            ->with('success', 'Surat keluar berhasil dihapus.');
    }
    
    public function downloadAttachment($id, $index)
    {
        $surat = SuratKeluar::findOrFail($id);
        
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
        return Excel::download(new SuratKeluarExport, 'daftar_surat_keluar.xlsx');
    }
}