<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaldoController extends Controller
{
    public function update(Request $request)
    {
        // Validasi input saldo
        $request->validate([
            'saldo' => 'required|numeric|min:0',  // Hanya angka dan tidak negatif
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Tambahkan saldo
        $user->saldo += $request->saldo;

        // Simpan perubahan
        $user->save();

        // Redirect ke halaman profile dengan pesan sukses
        return back()->with('success', 'Saldo berhasil ditambahkan!');
    }
}
