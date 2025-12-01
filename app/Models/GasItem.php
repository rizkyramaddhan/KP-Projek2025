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
        'jenis'
    ];

    
}
