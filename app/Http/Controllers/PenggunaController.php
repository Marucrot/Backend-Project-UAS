<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function register()
    {
        return view('pengguna.register');
    }

    public function prosesRegister(Request $request)
    {

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'gmail' => 'required|email|unique:penggunas,gmail',
            'password' => 'required|string|min:6',
            'nik' => 'required|string|unique:penggunas,nik',
        ]);
        Pengguna::create([
            'nama' => $validated['nama'],
            'gmail' => $validated['gmail'],
            'password' => Hash::make($validated['password']),
            'nik' => $validated['nik'],
            'role' => 'user',
        ]);

        return redirect()->route('pengguna.login')->with('success', 'Register berhasil. Silakan login.');
    }

    public function login()
    {
        return view('pengguna.login');
    }

    public function prosesLogin(Request $request)
    {
        $validated = $request->validate([
            'gmail' => 'required|email',
            'password' => 'required|string',
        ]);

        $pengguna = Pengguna::where('gmail', $validated['gmail'])->first();

        if (!$pengguna || !Hash::check($validated['password'], $pengguna->password)) {
            return redirect()->back()->with('error', 'Gmail atau password salah.');
        }

        session([
            'pengguna_id' => $pengguna->id,
            'pengguna_nama' => $pengguna->nama,
            'pengguna_role' => $pengguna->role,
        ]);

        return redirect()->route('home')->with('success', 'Login berhasil.');
    }

    public function forgotPassword()
    {
        return view('pengguna.forgot-password');
    }

    public function prosesForgotPassword(Request $request)
    {
        $validated = $request->validate([
            'gmail' => 'required|email',
            'nik' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $pengguna = Pengguna::where('gmail', $validated['gmail'])
            ->where('nik', $validated['nik'])
            ->first();

        if (!$pengguna) {
            return redirect()->back()->with('error', 'Gmail atau NIK tidak sesuai.');
        }

        $pengguna->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('pengguna.login')->with('success', 'Password berhasil diganti.');
    }

    public function logout()
    {
        session()->forget(['pengguna_id', 'pengguna_nama', 'pengguna_role']);

        return redirect()->route('pengguna.login')->with('success', 'Logout berhasil.');
    }
}
