<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class barangKeluar extends Model
{
    //getUser
    //getPelanggan
    //getStok

    public function getUser(): BelongsTo
    {
        return $this->belongsto(User::class, 'user_id', 'id');
    }
    public function getPelanggan(): BelongsTo
    {
        return $this->belongsto(pelanggan::class, 'pelanggan_id', 'id');
    }
    public function getStok(): BelongsTo
    {
        return $this->belongsto(stok::class, 'barang_id', 'id');
    }
    

}
