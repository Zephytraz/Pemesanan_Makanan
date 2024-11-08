<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::latest()->get();
        return view('category.index', compact('data'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50'
        ],[
            'name.required' => 'name category harus di isi'
        ]);
        $category = Category::where('name', $data['name'])->exists();
        if($category){
            session()->flash('error', 'gagal update category');
        }
        
            Category::create($data);
            session()->flash('success', 'berhasil update category');
        return back();
    }
    
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50'
        ]);
        $category_id = Category::findOrFail($id);
        $category = Category::where('name', $data['name'])->where('id', '!=', $id)->exists();
        if($category){
            session()->flash('error', 'gagal update category');
        }else{
            $category_id->update($data);
            session()->flash('success', 'berhasil update category');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Category::findOrFail($id)->delete();
            session()->flash('success', 'berhasil di hapus category');
        } catch (\Throwable $th) {
            session()->flash('error', 'gagal di hapus karena berelasi dengan makanan');
        }
        
        return back();
    }
}
