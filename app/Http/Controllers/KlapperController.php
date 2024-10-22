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
            'nama_buku'=> $request->nama_buku,
            'tahun_ajaran'=> $request->tahun_ajaran,
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
