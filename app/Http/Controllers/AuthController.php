<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return back()->withErrors(['username' => 'Username tidak ditemukan']);
        }

        // Simpan data user di session
        $request->session()->put('user_id', $user->id);
        $request->session()->put('login_time', now());

        return redirect()->route('appointments.index');
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['user_id', 'login_time']);
        return redirect()->route('login');
    }
}
