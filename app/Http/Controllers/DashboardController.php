<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\GasItem;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Container\Attributes\Log;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        $total_user = User::count();
        $total_barang = GasItem::count();
        $last_logActivity = LogActivity::with('user')
    ->latest()
    ->take(5)
    ->get();

        // $total_qty = GasItem::sum('qty');
        // $stok_rendah = GasItem::where('qty', '<', 10)->count();
        // $barang_terbaru = GasItem::orderBy('created_at', 'desc')->take(5)->get();
        // $chart_labels = GasItem::pluck('nama_barang');
        // $chart_data = GasItem::pluck('qty');
 
        return view('dashboard.index', compact(
            'user',
            'total_user',
            'total_barang',
            'last_logActivity',
        ));
    }
}
