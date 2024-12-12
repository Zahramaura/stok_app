<?php

namespace App\Http\Controllers;

use App\Models\barangMasuk;
use App\Models\stok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class barangMasukcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $getnama_barang_id = stok::with('getSuplier')->get();
        return view('Barang.barang-Masuk.add-barang-Masuk', compact(
            'getnama_barang_id'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_faktur' => 'required',
            'nama_barang_id' => 'required',
            //'harga' => 'required',
            'jumlah' => 'required',
        ]);
        
        $updatestok = stok::find($request->nama_barang_id);
             if ($request->filled('harga')) {
                 $harga_beli = $request->harga;
            }else {
                 $harga_beli = $updatestok->harga;
        }

        $savebarangMasuk = new barangMasuk();
        $savebarangMasuk->tanggal_faktur = $request->tanggal_faktur;
        $savebarangMasuk->nama_barang_id = $request->nama_barang_id;
        $savebarangMasuk->suplier_id = $updatestok->suplier_id;
        $savebarangMasuk->harga_beli = $request->harga_beli;
        $savebarangMasuk->jumlah_barang_masuk = $request->jumlah;
        $savebarangMasuk->admin_id = Auth::user()->id;
        // dd($savebarangMasuk);
        $savebarangMasuk->save();

        $hitung = $updatestok->stok + $request->jumlah;
        $updatestok->stok = $hitung;
        // dd($hitung)
        $updatestok->save();

        return redirect('/barang_masuk')->with(
            'message',
            'Data Barang' . $updatestok->nama_barang . ' berhasil ditambahkan'
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
