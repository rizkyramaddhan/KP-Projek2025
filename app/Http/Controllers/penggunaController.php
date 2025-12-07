<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class penggunaController extends Controller
{
    public function index(){
        
        $AllUser = User::paginate(10);
        $totalUser = User::count();
        return view('pengguna.index', compact('AllUser', 'totalUser'));
    }

    public function show($id)
{
    return User::findOrFail($id);
}

public function detail($id)
{
    return response()->json(User::findOrFail($id));
}



//     public function store(Request $request)
// {
//     $validated = $request->validate([
//         'username' => 'required|unique:users',
//         'role' => 'required',
//         'email' => 'required|email|unique:users',
//         'password' => 'required|min:6|confirmed',
//         'password_confirmation' => 'required|min:6',
//     ]);

//     User::create([
//         'username' => $validated['username'],
//         'email' => $validated['email'],
//         'password' => bcrypt($validated['password']),
//         'role' => $validated['role'],

//     ]);
//         LogActivity::create([
//                 'username' => Auth::user()->username,
//                 'activity' => 'user Login ke Sistem'
//             ]);

//     return response()->json(['success' => true]);
// }

public function store(Request $request)
{
    // Validasi lebih rapih & jelas
    $validated = $request->validate([
        'username' => ['required', 'unique:users'],
        'role' => ['required'],
        'email' => ['required', 'email', 'unique:users'],
        'password' => ['required', 'min:6', 'confirmed'],
    ]);

    DB::beginTransaction();

    try {
        // Buat user baru
        $userBaru = User::create([
            'username' => $validated['username'],
            'email'    => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role'     => $validated['role'],
        ]);

        // Ambil pembuat (yang login)
        $pembuat = Auth::user()->username;

        // Buat log aktivitas
        LogActivity::create([
            'username' => $pembuat,
            'activity' => "Menambahkan akun baru: {$userBaru->username}"
        ]);

        DB::commit();

        return response()->json(['success' => true, 'message' => 'Data pengguna berhasil ditambahkan!']);

    } catch (\Throwable $e) {

        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => 'Gagal menambahkan data pengguna.',
        ], 500);
    }
}



public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'username' => 'required|unique:users,username,' . $id,
        'email'    => 'required|email|unique:users,email,' . $id,
        'role'     => 'required',
        'password' => 'nullable|min:6|confirmed', // password opsional
    ]);

    DB::beginTransaction();

    try {

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $data = [
        'username' => $request->username,
        'email'    => $request->email,
        'role'     => $request->role,
    ];

    // Kalau password diisi, update
    if ($request->filled('password')) {
        $data['password'] = bcrypt($request->password);
    }

    $user->update($data);

    // Ambil pembuat (yang login)
        $pembuat = Auth::user()->username;

        // Buat log aktivitas
        LogActivity::create([
            'username' => $pembuat,
            'activity' => "Mengupdate akun : {$user->username}"
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
            'message' => 'Gagal Update user.',
        ], 500);
    }
}

public function destroy($id)
{
    $user = User::findOrFail($id);

    DB::beginTransaction();

    try {

    $user->delete();

    // Ambil pembuat (yang login)
        $pembuat = Auth::user()->username;

        // Buat log aktivitas
        LogActivity::create([
            'username' => $pembuat,
            'activity' => "Menghapus akun : {$user->username}"
        ]);

        DB::commit();

    return response()->json([
        'success' => true,
        'message' => 'Pengguna berhasil dihapus!'
    ]);

    } catch (\Throwable $e) {
        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => 'Gagal menghapus user.',
        ], 500);
    }
}



}
