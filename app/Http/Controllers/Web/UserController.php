<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        return view('web.user.profile');
    }
    public function chat()
    {
        return view('web.user.chat');
    }
}
