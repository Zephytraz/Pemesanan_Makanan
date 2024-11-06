<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function index()
    {
        if(auth()->user()->hasRole('admin')){
            $data_ulasan = Ulasan::all();
        }else{
            $data_ulasan = Ulasan::where('user_id', auth()->user()->id)->get();
        }
        return view('ulasan.index', compact('data_ulasan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'makanan_id' => "required|exists:makanans,id",
            'ulasan' => 'required|string|max:100',
            'rating' => 'required|numeric|max:5'
        ]);
        $beri_ulasan = Ulasan::where('user_id', auth()->user()->id)->where('makanan_id', $request->makanan_id)->first();
        if($beri_ulasan){
            session()->flash('error','anda sudah memberikan ulasan pada produck makanan ini');
            return back()->withInput();
        }
        $ulasan = Ulasan::create([
            'user_id' => auth()->user()->id,
            'makanan_id' => $request->makanan_id,
            'ulasan' => $request->ulasan,
            'rating' => $request->rating
        ]);
        if($ulasan){
            session()->flash('success', 'berhasil memberi ulasan');
        }else{
            session()->flash('error', 'gagal memberi ulasan');
        }
        return redirect()->route('ulasan.index');
    }
    public function show(string $id)
    {   
        $item = Ulasan::with('user', 'makanan')->findOrFail($id);
        if(auth()->user()->hasRole('admin') || $item->user_id == auth()->user()->id){
            return view('ulasan.show', compact('item'));
        }else{
            abort(403);
        }
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'ulasan' => 'required|string|max:100',
            'rating' => 'required|numeric|max:5'
        ]);
        $ulasan_id = Ulasan::findOrFail($id);

        $ulasan_id->update([
            'ulasan' => $request->ulasan,
            'rating' => $request->rating
        ]);
        session()->flash('success', 'berhasil update ulasan');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Ulasan::findOrFail($id)->delete();
        session()->flash('success', 'berhasil hapus ulasan');
        return back();
    }
}
