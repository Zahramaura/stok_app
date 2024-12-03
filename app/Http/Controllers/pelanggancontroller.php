<?php

namespace App\Http\Controllers;

use App\Models\pelanggan;
use Illuminate\Http\Request;

class pelanggancontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getData = pelanggan::paginate();
        return view('pelanggan.pelanggan', compact(
            'getData',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pelanggan.add-pelanggan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valueData = $request->validate([
            'nama_pelanggan' => 'required',
            'telp' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
        ], [
            'nama_pelanggan.required' => 'Data wajib diisi!!!',
            'telp.required' => 'Data wajib diisi!!!',
            'jenis_kelamin.required' => 'Data wajib diisi!!!',
            'alamat.required' => 'Data wajib diisi!!!',
            'kota.required' => 'Data wajib diisi!!!',
            'provinsi.required' => 'Data wajib diisi!!!',
        ]);

        pelanggan::created($valueData);

        return redirect('/pelanggan')->with(
            'message',
            '' . $request->nama_pelanggan . ' berhasil terdaftar'
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
        $getData = pelanggan::find($id);
        return view('pelanggan.edit-pelanggan', compact(
            'detData',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'telp' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'provinsi' => 'required'
        ], [
            'nama_pelanggan.require' => 'Data wajib diisi!!!',
            'telp.required' => 'Data wajib diisi!!!',
            'jenis_kelamin.requied' => 'Data wajin diisi!!!',
            'alamat.required' => 'Data wajib diisi!!!',
            'kota.required' => 'Data wajib diisi!!!',
            'provinsi.required' => 'Data wajib disi!!!',
        ]);
        
        $updatepelanggan = pelanggan::fin($id);
        $updatepelanggan->nama_pelanggan = $request->nama_pelanggan;
        $updatepelanggan->telp = $request->telp;
        $updatepelanggan->jenis_kelamin = $request->jenis_kelamin;
        $updatepelanggan->alamat = $request->alamat;
        $updatepelanggan->kota = $request->kota;
        $updatepelanggan->provinsi = $request->provinsi;
        $updatepelanggan->save();

        return redirect('/pelanggan')->with(
            'mwssage',
            'Data pelangan' . $request->nama_pelanggan. 'berhasil diperbrui'
        );
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = pelanggan::find($id);
        $data->delete();

        return redirect()->back()->with(
            'message',
            'Data pelanggan'. $data->nama_pelanggan . 'berhasil dihapus'
        );
    }
}
