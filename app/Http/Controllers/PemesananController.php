<?php

namespace App\Http\Controllers;

use App\Models\DetailTranskasi;
use App\Models\Makanan;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    public function index(){
        $data = Pemesanan::where('user_id', auth()->user()->id)->get();
        return view('pemesanan.index', compact('data'));
    }
    public function store(Request $request){
        $user = Auth::user(); // Get the logged-in user
        $makanan = Makanan::findOrFail($request->makanan_id); // Find the item by its ID
        
        $jumlah_pesanan = $request->jumlah_pesanan;
        $total_pembayaran = $jumlah_pesanan * $makanan->harga; // Assuming each item has a 'harga' column
    
        // Check if user's balance is enough
        if ($user->saldo < $total_pembayaran) {
            return redirect()->back()->with('error', 'Saldo tidak cukup untuk melakukan pembelian.');
        }
    
        // Check if there's enough stock
        if ($makanan->stock < $jumlah_pesanan) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi untuk jumlah pesanan ini.');
        }
    
        // Ambil nilai saldo pengguna sebelum pengurangan
        $uang_user = $user->saldo;
    
        // Deduct user's balance and update stock
        $user->saldo -= $total_pembayaran;
        $user->save();
    
        $makanan->stock -= $jumlah_pesanan;
        $makanan->save();
    
        // Create a new pemesanan record
        $pemesanan = Pemesanan::create([
            'user_id' => $user->id,
            'makanan_id' => $makanan->id,
            'status_pemesanan' => 'dibeli',
            'jumlah_pesanan' => $jumlah_pesanan,
            'total_pembayaran' => $total_pembayaran,
        ]);
    
        if ($pemesanan) {
            // Hitung kembalian
            $kembalian = $uang_user - $total_pembayaran;
    
            // Create a new detail transkasi record
            DetailTranskasi::create([
                'pemesanan_id' => $pemesanan->id,
                'user_id' => auth()->user()->id,
                'total_pembayaran' => $total_pembayaran,
                'uang_user' => $uang_user,
                'jumlah_kembalian' => $kembalian,
            ]);
    
            session()->flash('success', 'Berhasil melakukan pemesanan');
        } else {
            session()->flash('error', 'Gagal melakukan pemesanan');
        }
    
        return redirect()->back()->with('success', 'Pembelian berhasil. Terima kasih!');
    }
    
}
