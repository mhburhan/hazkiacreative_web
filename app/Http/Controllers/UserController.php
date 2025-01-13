<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $users = User::findOrFail($id);
        // Validasi data yang diterima
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $users->id,
            'role' => 'required|string|max:255',
        ]);

        // Update data pengguna
        $users->update($request->only('name', 'email', 'role'));

        // Redirect setelah berhasil
        return response()->json(['message' => 'User updated successfully.']);
    }

    public function destroy($id)
    {
        // Hapus pengguna
        $user = User::findOrFail($id);
        $user->delete();

        // Redirect setelah berhasil
        return response()->json(['message' => 'User deleted successfully.'
    ]);
    }
}