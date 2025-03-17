<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('web.auth.login');
    }
    public function register()
    {
        return view('web.auth.register');
    }

     public function store(Request $request )
    {
        dd(1);
        $request->all();
            
    }
    
}
