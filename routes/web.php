<?php

use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\dashboardcontroller;
use App\Http\Controllers\pegawaicontroller;
use App\Http\Controllers\supliercontroller;
use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [Authcontroller::class, 'index']);
Route::post('/', [Authcontroller::class, 'login_proses']);

Route::middleware(['auth', 'ceklevel:superadmin,admin'])->group(function(){

     /**
      * ini routing tombol logout!!!
      */
    Route::get('/logout', [Authcontroller::class, 'logout']);

    /**
     * ini routing dashboard controller
     */
    Route::get('/dashboard', [dashboardcontroller::class, 'index']);
    
       
    /**
     * ini routing untuk pegawai controller
     */
    Route::controller(pegawaicontroller::class )->group(function(){

        Route::get('/pegawai', 'index');
        Route::post('/pegawai/add', 'store')->name('savepegawai');

        Route::get('/pegawai/edit/{id}',  'edit');
        Route::post('/pegawai/edit/{id}', 'update');

        Route::get('/pegawai/{id}', 'destroy');

    });

    /**
     * ini route stok
     */

     /**
      * ini route barang masuk
      */

      /**
       * ini route barang keluar
       */

       /**
        * ini route pelanggan
        */

        /**
         * ini route suplier
         */
        Route::controller(supliercontroller::class)->group(function(){
            Route::get('/suplier', 'index');
            
            Route::get('/suplier/add', 'create');
        });





});