<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $fillable = [
        'gas_item_id',
        'kriteria_id',
        'nilai'
    ];

    public function kriteria()
    {
        return $this->belongsTo(kriteria::class);
    }
}
