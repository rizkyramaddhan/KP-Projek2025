<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GasItem extends Model
{
    protected $fillable = [
        'nama_barang',
        'code_barang',
        'harga',
        'qty',
        'jenis',
        'saw_score',
    ];

        protected $appends = ['status_stok', 'warna_stok'];

public function getStatusStokAttribute()
{
    return match (true) {
        $this->qty == 0      => 'Habis',
        $this->qty < 15      => 'Menipis',
        default              => 'Tersedia',
    };
}

public function getWarnaStokAttribute()
{
    return match ($this->status_stok) {
        'Habis' => 'danger',
        'Menipis' => 'warning',
        default => 'success',
    };
}

    
}
