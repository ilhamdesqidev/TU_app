<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Klapper;
use DB;

class KlapperController extends Controller
{
    public function index()
    {
        $klapper=DB::table('klapper')->get();
        return view('klapper',['klapper'=>$klapper]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.klapper.tambahdataklapper');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::table('klapper')->insert([
            'nis'=> $request->nis,
            'nama'=> $request->nama,
            'gender'=> $request->gender,
            'kelas'=> $request->kelas,
            'jurusan'=> $request->jurusan,
            'angkatan'=> $request->angkatan,
            'tempat_tanggal_lahir'=> $request->tempat_tanggal_lahir,
            'tanggal_lahir'=> $request->tanggal_lahir,
            'nama_orang_tua'=> $request->nama_orang_tua,
            'tanggal_masuk'=> $request->tanggal_masuk, 
            'tanggal_naik_kelas_xi'=> $request->tanggal_naik_kelas_xi,
            'tanggal_naik_kelas_xii'=> $request->tanggal_naik_kelas_xii,
            'tanggal_lulus'=> $request->tanggal_lulus,
            'foto'=> $request->foto,
            ]);
            
            return redirect('klapper')->with('status','Data berhasil di tambah!');
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

    //  public function show($id)
    // {
    //     $klapper = Klapper::findOrFail($id);

    //     return view('admin.klapper.detail', compact('klapper'));
    // }


    public function delete($id)
    {
        DB::table('klapper')->where('id',$id)->delete();
        return redirect('klapper')->with('status','Data berhasil di Hapus!');
    }
}
