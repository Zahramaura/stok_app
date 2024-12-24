<?php

namespace App\Http\Controllers;

use App\Models\barangKeluar;
use App\Models\pelanggan;
use App\Models\stok;
use App\Models\suplier;
use Illuminate\Http\Request;

class dashboardcontroller extends Controller
{
    public function index(){
        $getsuplier = suplier::count();
        $getpelanggan = pelanggan::count();
        $getSTOK = stok::count();
        $getPendapatan = barangKeluar::sum('sub_total');
        return view( 'dashboard.dashboard',compact(
            'getSuplier',
            'getPelanggan',
            'getStok',
            'getPendapatan',
        ));
    }
}
