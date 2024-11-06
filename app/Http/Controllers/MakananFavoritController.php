<?php

namespace App\Http\Controllers;

use App\Models\MakananFavorit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MakananFavoritController extends Controller
{
    public function index(){

        if(auth()->user()->hasRole('user')){
            $data = MakananFavorit::where('user_id', auth()->user()->id)->with('user', 'makanan')->get();
        }else{
            $data = MakananFavorit::select('makanan_id', DB::raw('MAX(id) as id'))
            ->groupBy('makanan_id')
            ->with('makanan', 'user')
            ->get();
        }

        $likes = MakananFavorit::select('makanan_id')->selectRaw('COUNT(*) as count')->groupBy('makanan_id')->pluck('count', 'makanan_id');
        return view('makanan_favorit.index', compact('data', 'likes'));
    }
    public function store(Request $request){
        $request->validate([
            'makanan_id' => 'required|integer|exists:makanans,id'
        ]);
        if(MakananFavorit::where('user_id', auth()->user()->id)->where('makanan_id', $request->makanan_id)->first()){
            session()->flash('error', 'anda sudah memberi like kepasa produk makanan ini');
            return back()->withInput();
        }
        MakananFavorit::create([
            'user_id' => auth()->user()->id,
            'makanan_id' => $request->makanan_id
        ]);
        return back();
    }
    public function destroy(string $id){
        MakananFavorit::findOrFail($id)->delete();
        return back();
    }

    
 
}
