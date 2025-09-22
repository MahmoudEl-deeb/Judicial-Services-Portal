<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLoginForm(){
        return view('login');
    }

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => [
            'required',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/'
        ],
    ]);

    if(Auth::attempt($credentials)){
        $request->session()->regenerate();
        return redirect()->intended('/');
    }
    return back()->withErrors([
        'email' => __('auth.failed')
    ]);
}

public function showRegisterationForm(){
    return view('register');
}

public function register(Request $request){
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => [
            'required',
            'confirmed',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/'
        ],
    ]);
    try{
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Auth::login($user);
        return redirect()->intended('/');
    } catch (\Exception $e) {
        \Log::error('Registration failed: ' . $e->getMessage());
        return back()->withErrors([
            'email' => __('auth.registrationFailed'),
        ]);
    }
}
public function logout(Request $request){
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
}

}

