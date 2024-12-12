<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthControllerWeb extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {

        // Validasi inputan
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Memeriksa peran pengguna setelah login
            $user = Auth::user();
            // dd($user->role);

            if ($user->role === 2) {
                // Logout jika role adalah 2
                Auth::logout();
                session()->flush();
                return back()->with('loginError', 'Akses tidak diizinkan untuk pengguna dengan peran ini.');
            }

            // Redirect berdasarkan role
            if ($user->role === 1) {
                return redirect()->intended('/user');
            }

            return redirect()->intended('/login');
        }

        return back()->with('loginError', 'Login gagal! Silakan periksa email dan password.');
    }


    // public function authenticate(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => ['required'],
    //         'password' => ['required'],
    //     ]);

    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();

    //         // Memeriksa peran pengguna setelah login
    //         if (Auth::user()->role === 1) {
    //             // Jika peran pengguna adalah 1, biarkan mereka masuk
    //             return redirect()->intended('/user');
    //         } elseif (Auth::user()->role === 2) {
    //             // Jika peran pengguna adalah 2, log out dan tampilkan pesan kesalahan
    //             Auth::logout();
    //             return back()->with('loginError', 'Akses tidak diizinkan untuk pengguna dengan peran ini.');
    //         } else {
    //             // Untuk peran lainnya, Anda bisa menambahkan penanganan lebih lanjut jika diperlukan
    //             return redirect()->intended('/login');
    //         }
    //     }

    //     return back()->with('loginError', 'Login gagal! Silakan periksa email dan password.');
    // }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
