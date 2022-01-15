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

    public function __construct(UserRepository $userRepository, School $school)
    {
        $this->authorizeResource(User::class);
        // $this->authorize('viewAny', [User::class, $school]);
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(School $school, Request $request)
    {
        // $this->authorize('viewAny', [User::class, $school]);
        $users = $this->userRepository->all($school->id, $request->all());
        
        return view('users.users', [
            'school' => $school,
            'users' => $users,
            'user_name' => $request->query('user_name', ''),
            'role_id' => $request->query('role_id', ''),
            'status' => $request->query('status', ''),
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
        // $this->authorize('create', [User::class, $school]);
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
        // $this->authorize('create', [User::class, $school]);
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
        // $this->authorize('update', [User::class, $user, $school]);
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
        // $this->authorize('delete', [User::class, $user]);
        try {
            $this->userRepository->destroy($user);
            return redirect('/schools/'.$school->id.'/users')->with('success', 'User '.$user->full_name.' deleted.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function usersOfAGroup(Request $request, School $school, Group $group)
    {
        $usersOfAGroup = $this->userRepository->usersOfAGroup($school->id, $group->id);
        $usersWithoutGroup = $this->userRepository->usersWithoutGroup($school->id, $request->all());

        return view('users.users_of_a_group', [
            'school' => $school,
            'group' => $group,
            'usersOfAGroup' => $usersOfAGroup,
            'usersWithoutGroup' => $usersWithoutGroup,
            'user_name' => $request->query('user_name', '')
        ]);
    }

    public function addUserForAGroup(Request $request, School $school, Group $group)
    {
        // @todo : authorization + validation
        try {
            $user = $this->userRepository->addUserForAGroup($group->id, $request->user_id);
            return redirect('/schools/'.$school->id.'/groups/'.$group->id.'/users?user_name='.$request->user_name)->with('success', 'User '.$user->full_name.' added for the family.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function removeUserFromAGroup(School $school, Group $group, User $user)
    {
        // @todo : security
        try {
            $this->userRepository->removeUserFromAGroup($school->id, $group->id, $user->id);
            return redirect('/schools/'.$school->id.'/groups/'.$group->id.'/users')->with('success', 'User '.$user->full_name.' removed for the family.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
