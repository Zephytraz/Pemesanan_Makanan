<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListUserController extends Controller
{
    public function index(){
        $data = User::all();
        return view('list_user.index', compact('data'));
    }   
    public function destroy(string $id){
        User::findOrFail($id)->delete();
        session()->flash('success', ' berhasil hapus user');
        return back();
    }
}
