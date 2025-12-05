<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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



    public function store(Request $request)
{
    $validated = $request->validate([
        'username' => 'required|unique:users',
        'role' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
        'password_confirmation' => 'required|min:6',
    ]);

    User::create([
        'username' => $validated['username'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
        'role' => $validated['role'],

    ]);

    return response()->json(['success' => true]);
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

    return response()->json([
        'success' => true,
        'message' => 'Data pengguna berhasil diperbarui!'
    ]);
}

public function destroy($id)
{
    $user = User::findOrFail($id);

    $user->delete();

    return response()->json([
        'success' => true,
        'message' => 'Pengguna berhasil dihapus!'
    ]);
}



}
