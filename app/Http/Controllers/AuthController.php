<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function showRegister()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:users,nis',
            'nama' => 'required|string|max:100',
            'kelas' => 'required|string|max:50',
            'alamat' => 'required|string',
            'no_telp' => 'nullable|numeric|digits_between:10,13',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'role' => 'siswa',
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return redirect()->intended('/login')->with('success', 'Registrasi berhasil!');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('nis', $request->nis)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            if ($user->role === 'admin') {
                return redirect()->route('login')->with('error', 'Akses ini hanya untuk siswa, bukan untuk admin!');
            }

            Auth::login($user);

            if ($user->role === 'siswa') {
                return redirect()->route('dashboard')->with('success', 'Selamat datang, ' . $user->nama . '!');
            } else {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Akses ditolak! Role pengguna tidak dikenali.');
            }
        }

        return back()->with('error', 'NIS atau Password salah!');
    }



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil logout!');
    }
}
