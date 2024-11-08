<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Makanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MakananController extends Controller
{
    public function index(Request $request){
        $request->validate([
            'input' => 'nullable|string|max:40'
        ]);
        $input = $request->input('input');

        if($input){
            $data = Makanan::where('judul', 'LIKE', '%'.$input.'%')->get();
        }else{
            $data = Makanan::all();
        }
        return view('makanan.index', compact('data'));
    }
    public function create(){
        $data_category = Category::all();
        return view('makanan.create', compact('data_category'));
    }
    public function store(Request $request){
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'judul' => 'required|string|max:50',
            'photo' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'deskripsi' => 'required',
            'harga' => 'required|numeric|min:999',
            'stock' => 'required|numeric|min:0'
        ]);
        $photo = $request->file('photo');
        $photo->storeAs('uploads', $photo->hashName(), 'public');

        if($request->stock < 0){
            session()->flash('error', 'stock tidak boleh kurang dari 0');
            return back()->withInput();
        }

        try {
            Makanan::create([
                'category_id' => $request->category_id,
                'judul' => $request->judul,
                'photo' => $photo->hashName(),
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'stock' => $request->stock
            ]);
            session()->flash('success', 'berhasil tambah produk makanan');
        } catch (\Throwable $th) {
            session()->flash('error', 'gagal untuk nambah produk makanan');
        }
        return redirect()->route('makanan.index');
    }
    public function show(string $id){
        $item = Makanan::with('category')->findOrFail($id);
        return view('makanan.show', compact('item'));
    }
    public function edit(string $id){
        $item = Makanan::findOrFail($id);
        $data_category = Category::all();
        return view('makanan.edit',compact('item', 'data_category'));
    }
    public function update(Request $request, string $id){
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'judul' => 'required|string|max:50',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'deskripsi' => 'required',
            'harga' => 'required|numeric|min:999',
            'stock' => 'required|numeric|min:0'
        ]);
        if($request->stock < 0){
            session()->flash('error', 'stock cannot minus zero');
            return back()->withInput();
        }
        $makanan_id = Makanan::findOrFail($id);
        if($request->hasFile('photo')){
            $photo = $request->file('photo');
            $photo->storeAs('uploads', $photo->hashName(), 'public');
            Storage::disk('public')->delete('uploads/'.$makanan_id->photo);

            $makanan = $makanan_id->update([
                'category_id' => $request->category_id,
                'judul' => $request->judul,
                'photo' => $photo->hashName(),
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'stock' => $request->stock
            ]);
            if($makanan){
                session()->flash('success', 'berhasil update produck makanan');
            }else{
                session()->flash('error', 'gagal update produck makanan');
            }
        }else{
            $makanan = $makanan_id->update([
                'category_id' => $request->category_id,
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'stock' => $request->stock
            ]);
            if($makanan){
                session()->flash('success', 'berhasil update produck makanan');
            }else{
                session()->flash('error', 'gagal update produck makanan');
            }
        }
        return redirect()->route('makanan.index');
    }
    public function destroy(string $id){
        $makanan = Makanan::findOrFail($id);
        Storage::disk('public')->delete('uploads/'. $makanan->photo);
        $makanan->delete();
        session()->flash('success', 'berhasil hapus product makanan');
        return back();
    }
}
