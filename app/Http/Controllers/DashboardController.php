<?php

namespace App\Http\Controllers;

use App\Models\GasItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        $total_barang = GasItem::count();
        $total_qty = GasItem::sum('qty');
        $stok_rendah = GasItem::where('qty', '<', 10)->count();
        $barang_terbaru = GasItem::orderBy('created_at', 'desc')->take(5)->get();

        $chart_labels = GasItem::pluck('nama_barang');
        $chart_data = GasItem::pluck('qty');

        return view('dashboard.index', compact(
            'user',
            'total_barang',
            'total_qty',
            'stok_rendah',
            'barang_terbaru',
            'chart_labels',
            'chart_data'
        ));
    }
}
