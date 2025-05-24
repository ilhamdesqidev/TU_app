<?php

namespace App\Http\Controllers;

use App\Models\Ijazah;
use App\Models\Klapper;
use App\Models\Siswa;
use Illuminate\Http\Request;

class IjazahController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter');

        $query = Ijazah::query()->with('siswa', 'klapper');

        if ($filter && $filter !== 'all') {
            if (str_starts_with($filter, 'klapper-')) {
                $klapperId = explode('-', $filter)[1] ?? null;
                $query->where('klapper_id', $klapperId);
            }
        }

        $ijazahs = $query->latest()->paginate(10);

        // Ambil daftar klapper dan jumlah ijazah terkait untuk menu filter
        $availableKlappers = Klapper::withCount('ijazahs')->get();
        return view('superadmin.arsip.ijazah.index', compact('ijazahs', 'availableKlappers'));
    }

    public function create()
    {
        $klappers = Klapper::whereHas('siswas', function($query) {
            $query->where('status', 1); // Hanya klapper dengan siswa yang sudah lulus
        })->get();
        
        return view('ijazah.create', compact('klappers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'klapper_id' => 'required|exists:klappers,id',
            'siswa_id' => 'required|exists:siswas,id',
            'nomor_ijazah' => 'required|unique:ijazahs'
        ]);

        $siswa = Siswa::findOrFail($request->siswa_id);

        Ijazah::create([
            'klapper_id' => $request->klapper_id,
            'siswa_id' => $request->siswa_id,
            'nama_siswa' => $siswa->nama_siswa,
            'nis' => $siswa->nis,
            'jurusan' => $siswa->jurusan,
            'tanggal_lulus' => $siswa->tanggal_lulus ?? now(),
            'nomor_ijazah' => $request->nomor_ijazah
        ]);

        return redirect()->route('ijazah.index')->with('success', 'Data ijazah berhasil ditambahkan');
    }

    // Method lainnya (show, edit, update, destroy) bisa disesuaikan kebutuhan

    public function download($id)
    {
        $ijazah = Ijazah::findOrFail($id);
        $pdf = PDF::loadView('ijazah.pdf', compact('ijazah'));
        return $pdf->download('ijazah-'.$ijazah->nomor_ijazah.'.pdf');
    }
}