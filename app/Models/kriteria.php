<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kriteria extends Model
{
     protected $table = 'kriterias'; // biar Laravel gak sotoy milih sendiri
    protected $fillable = [
        'nama_kriteria',
        'attribut',
        'bobot'
    ];

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }
}
