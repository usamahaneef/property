<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    use AuthenticatesUsers , RegistersUsers , RedirectsUsers;
    // public function login()
    // {
    //     return view('web.auth.login');
    // }
    public function showRegisterForm()
    {
        return view('web.auth.register');
    }

    protected function guard()
    {
        return Auth::guard('member');
    }

    public function create(array $data) // Accepts an array instead of Request
    {
        return Member::create([
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),
            'zip'        => $data['zip'],
        ]);
    }

    public function validator(array $data)
    {
        return Validator::make($data, [
            "first_name" => ['required', 'string', 'max:255'],
            "last_name"  => ['required', 'string', 'max:255'],
            "email"      => ['required', 'email', 'unique:members,email'],
            "password"   => ['required', 'min:6'],
            "zip"        => ['required', 'string', 'max:10'],
        ]);
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $member = Member::where('email', $request->email)->first();
    
        if ($member) {
            Auth::guard('member')->loginUsingId($member->id);
            return redirect()->route('home');
        }
    
        return redirect()->back()->with('error', 'Email not found');
    }

    public function redirectTo()
    {
        return route('home');
    }
    public function forgotPassword()
    {
        return view('auth.admin.forgot-password' ,[
            'title' => 'Forgot Password',
        ]);
    }

    public function broker()
    {
        return Password::broker('member');
    }

    public function loggedOut(Request $request)
    {
        return redirect(route('home'));
    }
    
}
