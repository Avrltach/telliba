<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Tampilkan daftar user dengan pagination
    public function index()
    {
    $users = User::paginate(10); 
    $dokumens = Dokumen::with('category')->paginate(10);
    $totalDokumen = Dokumen::count();
    $totalKategori = Category::count();
    $totalUser = User::count();

    return view('users.index', compact('users','dokumens', 'totalDokumen', 'totalKategori', 'totalUser'));
    }

    // Form edit user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,'.$user->id,
            'usertype' => 'required|string|in:admin,user',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->usertype = $request->usertype;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    // Hapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
