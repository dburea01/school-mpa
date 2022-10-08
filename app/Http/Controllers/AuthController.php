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

    public function homeConnected()
    {
        switch (Auth::user()->role_id) {
            case 'SUPERADMIN':
                return view('dashboards.dashboardSuperAdmin');
                break;

            case 'DIRECTOR':
                return view('dashboards.dashboardDirector');
                break;

            case 'TEACHER':
                return view('dashboards.dashboardTeacher');
                break;

            case 'PARENT':
                return view('dashboards.dashboardParent');
                break;

            case 'STUDENT':
                return view('dashboards.dashboardStudent');
                break;

            default:
                // code...
                break;
        }
    }
}
