<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'status' => 'ACTIVE',
        ], $request->has('remember_me'))) {
            $request->session()->regenerate();
            
            
            return redirect('/home_connected');
        }

        return back()->with('error', 'Impossible de se connecter.')->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
