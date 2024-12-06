<?php

namespace App\Http\Controllers;

use App\Models\stok;
use App\Models\suplier;
use Illuminate\Http\Request;

class stokcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $r)
    {
        $search = $r->input('search');
        $getData = stok::with('getsuplier')
        ->where('kode_barang', 'like', "%{$search}%")
        ->orWhere('nama_barang', 'like', "%{$search}%")
        ->paginate(6);
        return view('Stok.stok', compact(
            'getData'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $getsuplier = suplier::all();
        return view('stok.add-stok', compact(
            'getsuplier'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'suplier' => 'required',
            'cabang' => 'required',
        ],[
            'kode_barang.required' => 'Data wajib diisi!',
            'nama_barang.required' => 'Data wajib diisi!',
            'harga.required' => 'Data wajib diisi!',
            'stok.required'=> 'Data wajib diisi!',
            'suplier.required' => 'Data wajin diisi!',
            'cabang.required' => 'Data wajib diisi!',
        ]);
        $savestok = new stok();
        $savestok->kode_barang = $request->kode_barang;
        $savestok->nama_barang = $request->nama_barang;
        $savestok->harga = $request->harga;
        $savestok->stok = $request->stok;
        $savestok->suplier = $request->suplier;
        $savestok->cabang = $request->cabang;
        $savestok->save();

        return redirect('/stok')->with(
            'message',
            'Data barang' . $request->nama_barang . 'berhasil ditambahkan'
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
        $getDataStokId = stok::with('getsuplier')->find($id);
        $suplier = suplier::all();
        return view('stok.edit-stok', compact(
            'getDataStokId',
            'suplier'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'suplier' => 'required',
            'cabang' => 'required',
        ],[
            'kode_barang.required' => 'Data wajib diisi!',
            'nama_barang.required' => 'Data wajib diisi!',
            'harga.required' => 'Data wajib diisi!',
            'stok.required'=> 'Data wajib diisi!',
            'suplier.required' => 'Data wajin diisi!',
            'cabang.required' => 'Data wajib diisi!',
        ]);
        $savestok = stok::find($id);
        $savestok->kode_barang = $request->kode_barang;
        $savestok->nama_barang = $request->nama_barang;
        $savestok->harga = $request->harga;
        $savestok->stok = $request->stok;
        $savestok->suplier = $request->suplier;
        $savestok->cabang = $request->cabang;
        $savestok->save();

        return redirect('/stok')->with(
            'message',
            'Data barang' . $request->nama_barang . 'berhasil ditambahkan'
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
