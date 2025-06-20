<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

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

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function requestPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );


        return $status === Password::ResetLinkSent
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function resetPassword(Request $request, string $token)
    {
        $email = $request->query('email');
        return view('auth.reset-password', compact('email', 'token'));
    }

    public function updatePassword(ResetPasswordRequest $request)
    {
        $validated = $request->validated();

        $status = Password::reset($validated, function (User $user, string $password) {
            $user->forceFill([
                'password' => $password
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        });

        return $status === Password::PasswordReset
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
