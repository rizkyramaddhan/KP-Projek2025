<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class pengaturanController extends Controller
{
    public function index(){
        return view('pengaturan.index');
    }

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    // Validasi dulu sebelum transaksi
    $validator = Validator::make($request->all(), [
        'username' => 'required|unique:users,username,' . $id,
        'email'    => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|min:6|confirmed',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $validated = $validator->validated();

    DB::beginTransaction();

    try {
        $data = [
            'username' => $validated['username'],
            'email'    => $validated['email'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = bcrypt($validated['password']);
        }

        $user->update($data);

        $pembuat = Auth::user()->username;

        LogActivity::create([
            'username' => $pembuat,
            'activity' => "Mengupdate profile akun: {$user->username}"
        ]);

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Profile pengguna berhasil diperbarui!'
        ]);

    } catch (\Throwable $e) {

        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => 'Gagal memperbarui profile pengguna.',
        ], 500);
    }
}

}
