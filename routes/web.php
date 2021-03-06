<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClassroomController;
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

    // routes for the schools
    Route::resource('schools', SchoolController::class)->whereUuid('school');

    // routes for the users
    Route::resource('schools.users', UserController::class)->scoped()->whereUuid(['school', 'user']);

    // routes for the potential duplicated users
    Route::get('schools/{school}/users/potential-duplicated-user', [UserController::class, 'potentialDuplicatedUser'])->whereUuid('school');
    Route::post('schools/{school}/users/potential-duplicated-user', [UserController::class, 'savePotentialDuplicatedUser'])->whereUuid('school');

    // routes for the groups
    Route::resource('schools.groups', GroupController::class)->scoped()->whereUuid(['school', 'group']);

    // routes for the users of a group
    Route::get('schools/{school}/groups/{group}/users', [UserController::class, 'usersOfAGroup'])->whereUuid(['school', 'group']);
    Route::post('schools/{school}/groups/{group}/users', [UserController::class, 'AddUserForAGroup'])->whereUuid(['school', 'group']);
    Route::delete('schools/{school}/groups/{group}/users/{user}', [UserController::class, 'removeUserFromAGroup'])->whereUuid(['school', 'group', 'user']);

    // routes for the subjects of a school
    Route::resource('schools.subjects', SubjectController::class)->scoped()->whereUuid(['school', 'subject']);

    // routes for the periods of a school
    Route::resource('schools.periods', PeriodController::class)->scoped()->whereUuid(['school', 'period']);

    // routes for the classrooms of a school
    Route::resource('schools.classrooms', ClassroomController::class)->scoped()->whereUuid(['school', 'classroom']);

    // route for the report
    Route::get('schools/{school}/reports', [ReportController::class, 'report'])->whereUuid('school');
});
