<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'activity',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'username', 'username');
    }
}
