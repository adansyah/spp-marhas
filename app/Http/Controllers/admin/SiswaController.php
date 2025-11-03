<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{

    public function index()
    {
        $siswa = User::where('role', 'siswa')->get();
        return view('admin.siswa.siswa', compact('siswa'));
    }

    public function create()
    {
        return view('admin.siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:users,nis',
            'nama' => 'required|string|max:100',
            'kelas' => 'required|string|max:50',
            'alamat' => 'required|string',
            'no_telp' => 'nullable|string|max:25',
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

        return redirect()->route('admin.data-siswa.index')->with('success', 'Registrasi berhasil!');
    }


    public function show() {}
    public function edit($nis)
    {
        $siswa = User::where('nis', $nis)->firstOrFail();
        return view('admin.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $nis)
    {
        $siswa = User::where('nis', $nis)->firstOrFail();

        $request->validate([
            'nis' => 'required|unique:users,nis,' . $siswa->id,
            'nama' => 'required|string|max:100',
            'kelas' => 'required|string|max:50',
            'alamat' => 'required|string',
            'no_telp' => 'nullable|string|max:25',
            'email' => 'required|email|unique:users,email,' . $siswa->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data = [
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'role' => 'siswa',
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $siswa->update($data);

        return redirect()->route('admin.data-siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy($nis)
    {
        $siswa = User::where('nis', $nis)->firstOrFail();
        $siswa->delete();

        return redirect()->route('admin.data-siswa.index')
            ->with('success', 'Data siswa berhasil dihapus!');
    }
}
