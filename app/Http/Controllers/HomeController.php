<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        return response()->view('home');
    }

    public function changeLocale(string $locale)
    {
        if (! in_array($locale, ['en', 'fr'])) {
            $locale = 'en';
        }
    
        App::setLocale($locale);
        session()->put('locale', $locale);

        return redirect()->back()->cookie('locale', $locale);
        // return redirect('/');
    }
}
