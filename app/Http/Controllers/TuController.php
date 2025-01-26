<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spensasi;

class TuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $surat = Spensasi::where('status', 'menunggu')->paginate(10);
        return view('superadmin.spensasi.tu.index', compact('surat'));
    }

    /**
     * Approve the surat spensasi.
     */
    public function approve(Request $request, $id)
    {
        // Cari surat berdasarkan ID
        $surat = Spensasi::findOrFail($id);

        // Ubah status surat menjadi disetujui
        $surat->status = 'disetujui';
        $surat->save();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('superadmin.spensasi.tu.index')->with('success', 'Surat disetujui!');
    }

    /**
     * Reject the surat spensasi.
     */
    public function reject(Request $request, $id)
    {
        // Cari surat berdasarkan ID
        $surat = Spensasi::findOrFail($id);

        // Ubah status surat menjadi ditolak
        $surat->status = 'ditolak';
        $surat->save();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('superadmin.spensasi.tu.index')->with('success', 'Surat ditolak!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
