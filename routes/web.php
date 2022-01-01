<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/change-locale/{lang}', [HomeController::class, 'changeLocale']);

Route::get('/login', function () {
    return view('auth.login');
})->name('login');


Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/home_connected', function () {
        return view('home_connected');
    })->name('home_connected');
    Route::resource('schools', SchoolController::class)->whereUuid('school');
    Route::resource('schools.users', UserController::class)->scoped()->whereUuid(['school', 'user']);

    // routes for the groups
    Route::get('schools/{school}/groups', [GroupController::class, 'index'])->whereUuid(['school']);
});
