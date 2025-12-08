<?php

namespace App\Http\Controllers;

use App\Models\GasItem;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\LogActivity;
use Illuminate\Support\Facades\Validator;

class GasItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Items = GasItem::paginate(10);
        $totalBarang = GasItem::count();
        $stokHabis = GasItem::where('qty', 0)->count();
        $stokMenipis = GasItem::where('qty', '<', 15)->where('qty', '>', 0)->count();
        $totalQty = GasItem::sum('qty');
        return view('gas.index', compact('Items', 'totalBarang', 'stokHabis', 'stokMenipis', 'totalQty'));
    }

    public function show($id)
{
    return GasItem::findOrFail($id);
}

    public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'nama_barang'  => 'required|string|max:255',
        'code_barang'  => 'required|string|max:255|unique:gas_items',
        'harga'        => 'required|integer|min:0',
        'qty'          => 'required|integer|min:0',
        'jenis'        => 'required|string|max:255',
    ]);

    DB::beginTransaction();

    try {
        // Tambah barang baru
        $barangBaru = GasItem::create([
            'nama_barang' => $validated['nama_barang'],
            'code_barang' => $validated['code_barang'],
            'harga'       => $validated['harga'],
            'qty'         => $validated['qty'],
            'jenis'       => $validated['jenis'],
            'saw_score'   => 0, // Inisialisasi saw_score
        ]);

        // User pembuat
        $pembuat = Auth::user()->username;

        // Log aktivitas
        LogActivity::create([
            'username' => $pembuat,
            'activity' => "Menambahkan barang baru: {$barangBaru->nama_barang} (Kode: {$barangBaru->code_barang})"
        ]);

        DB::commit();

        return response()->json(['success' => true, 'message' => 'Barang berhasil ditambahkan.']);

    } catch (\Throwable $e) {

        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => 'Gagal menambahkan barang.',
        ], 500);
    }
}

    public function update(Request $request, $id)
{
    $barang = GasItem::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'nama_barang' => 'required|string|max:255|unique:gas_items,nama_barang,' . $id,
        'code_barang'    => 'required|string|max:255|unique:gas_items,code_barang,' . $id,
        'harga'     => 'required|integer|min:0',
        'qty' => 'required|integer|min:0', 
        'jenis' => 'required|string|max:255',
    ]);

    DB::beginTransaction();

    try {

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $data = [
        'nama_barang' => $request->nama_barang,
        'code_barang'    => $request->code_barang,
        'harga'     => $request->harga,
        'qty' => $request->qty,
        'jenis' => $request->jenis,
    ];

    // Kalau password diisi, update
    if ($request->filled('password')) {
        $data['password'] = bcrypt($request->password);
    }

    $barang->update($data);

    // Ambil pembuat (yang login)
        $pembuat = Auth::user()->username;

        // Buat log aktivitas
        LogActivity::create([
            'username' => $pembuat,
            'activity' => "Mengupdate barang : {$barang->nama_barang} (Kode: {$barang->code_barang})"
        ]);

        DB::commit();

    return response()->json([
        'success' => true,
        'message' => 'Data pengguna berhasil diUpdate!'
    ]);

    } catch (\Throwable $e) {
        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => 'Gagal Update barang.',
        ], 500);
    }
}

    public function destroy($id)
{
    $Barang = GasItem::findOrFail($id);

    DB::beginTransaction();

    try {

    $Barang->delete();

    // Ambil pembuat (yang login)
        $pembuat = Auth::user()->username;

        // Buat log aktivitas
        LogActivity::create([
            'username' => $pembuat,
            'activity' => "Menghapus akun : {$Barang->username}"
        ]);

        DB::commit();

    return response()->json([
        'success' => true,
        'message' => 'Data Produk berhasil dihapus!'
    ]);

    } catch (\Throwable $e) {
        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => 'Gagal menghapus Produk.',
        ], 500);
    }
}

public function tambahStok(Request $request)
{
    $validator = Validator::make($request->all(), [
        'barang_id' => 'required|exists:gas_items,id',
        'qty'       => 'required|integer|min:1',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors()
        ], 422);
    }

    DB::beginTransaction();

    try {
        $barang = GasItem::findOrFail($request->barang_id);

        $barang->qty += $request->qty;
        $barang->save();

        LogActivity::create([
            'username' => Auth::user()->username,
            'activity' => "Menambah stok: {$request->qty} ke barang {$barang->nama_barang} (Kode: {$barang->code_barang})"
        ]);

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Stok berhasil ditambahkan!'
        ]);

    } catch (\Throwable $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Gagal menambahkan stok.',
        ], 500);
    }
}



}
