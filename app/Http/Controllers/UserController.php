<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\School;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->authorizeResource(User::class);
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(School $school, Request $request)
    {
        $users = $this->userRepository->all($school->id, $request->all());
        
        return view('users.users', [
            'school' => $school,
            'users' => $users,
            'user_name' => $request->query('user_name', ''),
            'role_id' => $request->query('role_id', '')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(School $school)
    {
        $user = new User();
        $user->status="INACTIVE";
        $user->role_id = "STUDENT";

        return view('users.user_form', [
            'school' => $school,
            'user' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request, School $school, User $user)
    {
        try {
            $this->userRepository->insert($request->all());
            return redirect('/schools/'.$school->id.'/users')->with('success', 'User '.$user->full_name.' created.');
        } catch (\Throwable $th) {
            return redirect('/schools/'.$school->id.'/users')->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school, User $user)
    {
        return view('users.user_form', [
            'school' => $school,
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUserRequest $request, School $school, User $user)
    {
        try {
            $this->userRepository->update($user, $request->all());
            return redirect('/schools/'.$school->id.'/users')->with('success', 'User '.$user->full_name.' updated.');
        } catch (\Throwable $th) {
            return redirect('/schools/'.$school->id.'/users')->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
