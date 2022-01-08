<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Models\Group;
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
            'role_id' => $request->query('role_id', ''),
            'status' => $request->query('status', 'ACTIVE'),
            'summary_users_by_role' => $this->userRepository->summaryUsersByRole($school)
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
        $user->status="ACTIVE";
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
    public function store(StoreUserRequest $request, School $school)
    {
        try {
            $user = $this->userRepository->insert($school->id, null, $request->all());
            return redirect('/schools/'.$school->id.'/users')->with('success', 'User '.$user->full_name.' created.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
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
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school, User $user)
    {
        try {
            $this->userRepository->destroy($user);
            return redirect('/schools/'.$school->id.'/users')->with('success', 'User '.$user->full_name.' deleted.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function usersOfAGroup(School $school, Group $group)
    {
        $users = $this->userRepository->usersOfAGroup($school->id, $group->id);
        $user = new User();
        $user->last_name = $group->name;
        $user->status = 'ACTIVE';

        return view('users.users_of_a_group', [
            'school' => $school,
            'group' => $group,
            'users' => $users,
            'user' => $user
        ]);
    }

    public function addUserOfAGroup(School $school, Group $group, StoreUserRequest $request)
    {
        // dd($request->all());
        try {
            $user = $this->userRepository->insert($school->id, $group->id, $request->all());
            return redirect('/schools/'.$school->id.'/groups/'.$group->id.'/users')->with('success', 'User '.$user->full_name.' created for the family.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function editUserOfAGroup(School $school, Group $group, User $user)
    {
        $users = $this->userRepository->usersOfAGroup($school->id, $group->id);

        return view('users.users_of_a_group', [
            'school' => $school,
            'group' => $group,
            'users' => $users,
            'user' => $user
        ]);
    }

    public function updateUserOfAGroup(School $school, Group $group, User $user, StoreUserRequest $request)
    {
        // dd($request->all());
        try {
            $user = $this->userRepository->update($user, $request->all());
            return redirect('/schools/'.$school->id.'/groups/'.$group->id.'/users')->with('success', 'User '.$user->full_name.' updated for the family.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function deleteUserOfAGroup(School $school, Group $group, User $user)
    {
        // dd($request->all());
        try {
            $this->userRepository->destroy($user);
            return redirect('/schools/'.$school->id.'/groups/'.$group->id.'/users')->with('success', 'User '.$user->full_name.' deleted for the family.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
