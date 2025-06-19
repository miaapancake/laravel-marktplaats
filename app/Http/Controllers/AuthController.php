<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = User::create($validated);

        if (!$user->exists) {
            return back()->withErrors(['name' => "Something went wrong while creating your account, please try again later"]);
        }

        Auth::loginUsingId($user->id);

        return redirect()->route('welcome');
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        if (!Auth::attempt($validated)) {
            return back()->withErrors(['password' => "Invalid credentials"]);
        }

        return redirect()->route('welcome');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('welcome');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }
}
