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
        Pengguna::create([
            'nama' => $request->nama,
            'gmail' => $request->gmail,
            'password' => Hash::make($request->password),
            'nik' => $request->nik,
        ]);

        return redirect()->route('pengguna.login');
    }

    public function login()
    {
        return view('pengguna.login');
    }

    public function prosesLogin(Request $request)
    {
        $pengguna = Pengguna::where('gmail', $request->gmail)->first();

        if (!$pengguna || !Hash::check($request->password, $pengguna->password)) {
            return redirect()->back()->with('error', 'Gmail atau password salah');
        }

        session([
            'pengguna_id' => $pengguna->id,
            'pengguna_nama' => $pengguna->nama,
        ]);

        return redirect()->route('schedules.index');
    }

    public function forgotPassword()
    {
        return view('pengguna.forgot-password');
    }

    public function prosesForgotPassword(Request $request)
    {
        $pengguna = Pengguna::where('gmail', $request->gmail)
            ->where('nik', $request->nik)
            ->first();

        if (!$pengguna) {
            return redirect()->back()->with('error', 'Gmail atau NIK tidak sesuai');
        }

        $pengguna->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('pengguna.login');
    }

    public function logout()
    {
        session()->forget(['pengguna_id', 'pengguna_nama']);

        return redirect()->route('pengguna.login');
    }
}
