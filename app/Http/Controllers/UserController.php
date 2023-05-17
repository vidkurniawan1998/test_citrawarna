<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.login');
    }

    public function process_login(Request $request)
    {
        //Validasi Username dan Password
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        //Request Mengecek Username dan Password
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('barangmasuk.list');
        }

        return back()->withErrors([
            'password' => 'Password dan Username Anda Salah',
        ]);
    }

    public function logout(Request $request)
    {
        //Proses Keluar Dan Ke Halaman Login
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('user.login');
    }
}
