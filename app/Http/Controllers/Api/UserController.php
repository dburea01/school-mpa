<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(School $school)
    {
        return User::where('school_id', $school->id)->get();
    }
}
