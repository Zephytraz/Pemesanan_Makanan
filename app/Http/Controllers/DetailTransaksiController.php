<?php

namespace App\Http\Controllers;

use App\Models\DetailTranskasi;
use Illuminate\Http\Request;

class DetailTransaksiController extends Controller
{
    public function index(){
        $data = DetailTranskasi::where('user_id', auth()->user()->id)->get();
        return view('detail_transaksi.index', compact('data'));
    }
}
