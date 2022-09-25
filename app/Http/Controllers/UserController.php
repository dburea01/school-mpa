<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Group;
use App\Models\School;
use App\Models\User;
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
            'status' => $request->query('status', ''),
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
        $user->status = 'ACTIVE';
        $user->role_id = 'STUDENT';

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
        // check if the user to create is a potential duplicated user.
        $existingUsers = $this->userRepository->getExistingUsers(
            $school->id,
            $request->last_name,
            $request->first_name,
            $request->birth_date
        );

        if ($existingUsers->count() !== 0) {
            $userToCreate = new User();
            $userToCreate->school_id = $school->id;
            $userToCreate->fill($request->all());

            return redirect("/schools/$school->id/users/potential-duplicated-user")->with([
                'existingUsers' => $existingUsers,
                'userToCreate' => $userToCreate,
            ]);
        }

        try {
            $user = $this->userRepository->insert($school->id, $request->all());
            if ($request->has('image_user')) {
                $this->processImage($user, $request->image_user, 'images_user');
            }

            return redirect("/schools/$school->id/users?user_name=$user->last_name")
            ->with('success', trans('user.user_created', ['name' => $user->full_name]));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function processImage(User $user, $imageUser, string $collection)
    {
        $user->clearMediaCollection($collection);
        $user->addMedia($imageUser)->toMediaCollection($collection);
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
            $user = $this->userRepository->update($user, $request->all());
            if ($request->has('image_user')) {
                $this->processImage($user, $request->image_user, 'images_user');
            }

            return back()->with('success', trans('user.user_updated', ['name' => $user->full_name]));
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

            return redirect("/schools/$school->id/users")
            ->with('success', trans('user.user_deleted', ['name' => $user->full_name]));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function potentialDuplicatedUser(School $school)
    {
        return view('users.potential_duplicated_user', [
            'school' => $school,
            'userToCreate' => session('userToCreate'),
            'existingUsers' => session('existingUsers'),
        ]);
    }

    /**
     * todo : security
     */
    public function savePotentialDuplicatedUser(School $school, Request $request)
    {
        try {
            $user = $this->userRepository->insert($school->id, $request->all());

            return redirect('/schools/'.$school->id.'/users')
            ->with('success', 'User '.$user->full_name.' created.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function usersOfAGroup(Request $request, School $school, Group $group)
    {
        $usersOfAGroup = $this->userRepository->usersOfAGroup($school->id, $group->id);
        $usersFiltered = $request->has('user_name') && $request->user_name !== '' ?
            $this->userRepository->all($school->id, $request->all())
            : [];

        return view('users.users_of_a_group', [
            'school' => $school,
            'group' => $group,
            'usersOfAGroup' => $usersOfAGroup,
            'usersFiltered' => $usersFiltered,
            'user_name' => $request->query('user_name', ''),
        ]);
    }

    public function addUserForAGroup(Request $request, School $school, Group $group)
    {
        $this->authorize('create', Group::class);
        try {
            $this->userRepository->addUserForAGroup($group->id, $request->user_id);
            $user = User::find($request->user_id);

            return redirect("/schools/$school->id/groups/$group->id/users?user_name=$request->user_name")
            ->with('success', trans('user.user_added_to_family', ['name' => $user->full_name]));
        } catch (\Throwable $th) {
            return back()->with('error', 'an error occured.');
        }
    }

    public function removeUserFromAGroup(School $school, Group $group, User $user)
    {
        $this->authorize('delete', [Group::class, $group]);

        try {
            $this->userRepository->removeUserFromAGroup($group->id, $user->id);

            return back()->with('success', trans('user.user_removed_from_family', ['name' => $user->full_name]));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function autocomplete(School $school, Request $request)
    {
        return User::where('school_id', $school->id)
        ->where(function ($query) use ($request) {
            $query->where('last_name', 'ilike', '%'.$request->search.'%')
            ->orWhere('first_name', 'ilike', '%'.$request->search.'%');
        })
        ->where('role_id', 'STUDENT')
        ->get(['id', 'first_name', 'last_name']);
    }
}
