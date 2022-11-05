<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // routes for the schools
    Route::get('schools/edit', [SchoolController::class, 'edit'])->name('edit_school');
    Route::put('schools', [SchoolController::class, 'update'])->name('update_school');

    // routes for the users
    Route::resource('users', UserController::class)->whereUuid(['user'])->names('users');
    Route::get('/users/autocomplete', [UserController::class, 'autocomplete']);

    // routes for the potential duplicated users
    Route::get('users/potential-duplicated-user', [UserController::class, 'potentialDuplicatedUser']);
    Route::post('/users/potential-duplicated-user', [UserController::class, 'savePotentialDuplicatedUser']);

    // routes for the groups
    Route::resource('groups', GroupController::class)->whereUuid(['group'])->names('groups');

    // routes for the users of a group
    Route::get('groups/{group}/users', [UserController::class, 'usersOfAGroup'])
        ->whereUuid(['group'])->name('users_group');
    Route::post('groups/{group}/users', [UserController::class, 'AddUserForAGroup'])
        ->whereUuid(['group']);
    Route::delete('groups/{group}/users/{user}', [UserController::class, 'removeUserFromAGroup'])
        ->whereUuid(['group', 'user']);

    // routes for the subjects of the school
    Route::resource('subjects', SubjectController::class)->names('subjects');

    // routes for the periods of a school
    Route::resource('periods', PeriodController::class)->names('periods');

    // routes for the classrooms of a school
    Route::middleware(['ensureAnActivePeriodExists'])->group(function () {
        Route::resource('classrooms', ClassroomController::class)->names('classrooms');
        Route::resource('classrooms.assignments', AssignmentController::class)->scoped();
        // routes for the exams of a school
        Route::resource('exams', ExamController::class)->names('exams');
    });

    // routes for the results of exam
    Route::get('exams/{exam}/results', [ResultController::class, 'index']);
    Route::post('exams/{exam}/results', [ResultController::class, 'store']);

    // route for the report
    Route::get('reports', [ReportController::class, 'reports'])->name('reports');
});
