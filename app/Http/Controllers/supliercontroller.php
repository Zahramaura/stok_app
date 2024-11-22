<?php

namespace App\Http\Controllers;

use App\Models\suplier;
use Illuminate\Http\Request;

class supliercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $data = suplier::where(
            'nama_suplier',
            'like',
            "%{$search}%"
        )->orwhere(
            'telp',
            'like',
            "%{$search}%"
            )->paginate();

        
        return view('suplier.suplier', compact(
            'data'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('suplier.add-suplier', compact(
            'getsuplier',
        ));
            
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_suplier' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'telp' => 'required',
            'tgl_terdaftar' => 'required',
            'status' => 'required',
        ], [
            'nama_suplier.required' => 'Data wajib diisi!',
            'email.required' => 'Data wajib diisi!',
            'email.email' => 'Format email tidak sesuai!',
            'alamat.required' => 'Data wajib diisi!',
            'telp.required' => 'Data wajib diisi!',
            'tgl_terdaftar.required' => 'Data wajib diisi!',
            'status.required' => 'Data wajib diisi!',
        ]);

        $savesuplier = new suplier();
        $savesuplier->nama_suplier = $request->nama_suplier;
        $savesuplier->alamat = $request->alamat;
        $savesuplier->telp = $request->telp;
        $savesuplier->email = $request->email;
        $savesuplier->tgl_terdaftar = $request->tgl_terdaftar;
        $savesuplier->status = $request->status;
        $savesuplier->save();

        return redirect('/suplier')->with(
            'message',
            'Data' . $request->nama_suuplier . 'berhasil ditambahkan!'
        );
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
        $getsuplier = suplier::find($id);
        return view('suplier.edit-suplier', compact(
            'getsuplier',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_suplier' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'telp' => 'required',
            'tgl_terdaftar' => 'required',
            'status' => 'required',
        ], [
            'nama_suplier.required' => 'Data wajib diisi!',
            'email.required' => 'Data wajib diisi!',
            'email.email' => 'Format email tidak sesuai!',
            'alamat.required' => 'Data wajib diisi!',
            'telp.required' => 'Data wajib diisi!',
            'tgl_terdaftar.required' => 'Data wajib diisi!',
            'status.required' => 'Data wajib diisi!',
        ]);

        $savesuplier = suplier::find($id);
        $savesuplier->nama_suplier = $request->nama_suplier;
        $savesuplier->alamat = $request->alamat;
        $savesuplier->telp = $request->telp;
        $savesuplier->email = $request->email;
        $savesuplier->tgl_terdaftar = $request->tgl_terdaftar;
        $savesuplier->status = $request->status;
        $savesuplier->save();

        return redirect('/suplier')->with(
            'message',
            'Data' . $request->nama_suuplier . 'berhasil diperbarui!!'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
