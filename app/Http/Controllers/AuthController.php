<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function logincode(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|max:20',
            'remember_me' => 'nullable|boolean'
        ]);

        $cred = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $remember_me = $request->remember_me ? true : false;
        if (Auth::attempt($cred, $remember_me)) {
            $request->session()->regenerate();

            return redirect()->route('dashboardAdmin')
            ->with('success', 'Logged in successfully.');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerate();
        return redirect()->route('login');
    }
}
