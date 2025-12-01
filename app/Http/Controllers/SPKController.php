<?php

namespace App\Http\Controllers;

use App\Models\GasItem;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class SPKController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::all();
        $items = GasItem::all();

        // Ambil nilai penilaian dari tabel Penilaian
        $matrix = [];
        foreach ($items as $item) {
            foreach ($kriteria as $k) {
                $nilai = Penilaian::where('gas_item_id', $item->id)
                    ->where('kriteria_id', $k->id)
                    ->value('nilai');

                // fallback jika null → 0
                $matrix[$item->id][$k->id] = $nilai ?? 0;
            }
        }

        // Normalisasi
        $normalisasi = [];
        foreach ($kriteria as $k) {
            // Ambil semua nilai kolom
            $col = array_column($matrix, $k->id);

            $max = max($col);
            $min = min($col);

            foreach ($items as $item) {
                $nilai = $matrix[$item->id][$k->id];

                if ($k->attribut === 'benefit') {
                    $normalisasi[$item->id][$k->id] = ($max > 0) ? $nilai / $max : 0;
                } else {
                    $normalisasi[$item->id][$k->id] = ($nilai > 0) ? $min / $nilai : 0;
                }
            }
        }

        // Hitung Total SAW dan simpan ke gas_items.saw_score
        $hasil = [];
        foreach ($items as $item) {
            $total = 0;

            foreach ($kriteria as $k) {
                $total += $normalisasi[$item->id][$k->id] * $k->bobot;
            }

            // Simpan langsung ke tabel gas_items
            $item->saw_score = $total;
            $item->save();

            $hasil[] = [
                'item'  => $item,
                'nilai' => $total
            ];
        }

        // Urutkan descending
        usort($hasil, fn($a, $b) => $b['nilai'] <=> $a['nilai']);

        return view('spk.hasil', compact('hasil', 'kriteria'));
    }
}
