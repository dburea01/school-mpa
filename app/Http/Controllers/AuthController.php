<?php

declare(strict_types=1);
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            return redirect('/dashboard');
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

    public function dashboard()
    {
        switch (Auth::user()->role_id) {
            case 'SUPERADMIN':
                $view = 'dashboardSuperAdmin';
                break;

            case 'DIRECTOR':
                $view = 'dashboardDirector';
                break;

            case 'TEACHER':
                $view = 'dashboardTeacher';
                break;

            case 'PARENT':
                $view = 'dashboardParent';
                break;

            case 'STUDENT':
                $view = 'dashboardStudent';
                break;
        }

        return view('dashboards.' . $view);
    }
}
