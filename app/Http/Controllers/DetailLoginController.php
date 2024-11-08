<?php

namespace App\Http\Controllers;

use App\Models\detail_login;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DetailLoginController extends Controller
{
    public function index(){
        $login_log = detail_login::latest()->get();
        return view('login_logs.index', compact('login_log'));
    }
}
