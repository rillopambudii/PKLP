<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index()
    {
        $data = User::all();

        return view('admin.users.index', compact('data'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect('/admin/users')
            ->with('success', 'User berhasil ditambah');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/admin/users')
            ->with('success', 'User berhasil dihapus');
    }
}