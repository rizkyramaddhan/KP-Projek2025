<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SawKriteriaSeeder extends Seeder
{
     public function run(): void
    {
        DB::table('kriterias')->insert([
            [
                'nama_kriteria' => 'Harga',
                'attribut' => 'cost',
                'bobot' => 0.4, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Qty',
                'attribut' => 'benefit',
                'bobot' => 0.3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Jenis',
                'attribut' => 'benefit',
                'bobot' => 0.3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
