<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DetailTranskasi;
use App\Models\Makanan;
use App\Models\Pemesanan;
use App\Models\Ulasan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $total_category = Category::count() ? : 0;
        $total_makanan = Makanan::count() ? : 0;
        $total_user = User::count() ? : 0;
        if(auth()->user()->hasRole('admin')){
            $total_ulasan = Ulasan::count() ? : 0;
        }else{
            $total_ulasan = Ulasan::where('user_id', auth()->user()->id)->count() ? : 0;
        }
        $data_pemesanan = Pemesanan::where('user_id', auth()->user()->id)->count() ? : 0;
        $detail_transaksi = DetailTranskasi::where('user_id', auth()->user()->id)->count() ? : 0;
        return view('dashboard', compact('total_category',
         'total_makanan',
          'total_user',
        'total_ulasan', 'data_pemesanan', 'detail_transaksi'));
    }
}
