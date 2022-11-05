<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Group;
use App\Models\School;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\File;

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
    public function index(Request $request)
    {
        $users = $this->userRepository->all($request->all());

        if ($request->has('view')) {
            $view = $request->query('view');
        } elseif ($request->session()->has('view')) {
            $view = $request->session()->get('view');
        } else {
            $view = 'list';
        }

        session(['view' => $view]);

        return view('users.users', [
            'users' => $users,
            'user_name' => $request->query('user_name', ''),
            'role_id' => $request->query('role_id', ''),
            'status' => $request->query('status', ''),
            'view' => $view,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        $user->status = 'ACTIVE';
        $user->role_id = 'STUDENT';

        return view('users.user_form', [
            'user' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        // check if the user to create is a potential duplicated user.
        $existingUsers = $this->userRepository->getExistingUsers(
            $request->last_name,
            $request->first_name,
            $request->birth_date
        );

        if ($existingUsers->count() !== 0) {
            $userToCreate = new User();
            $userToCreate->fill($request->all());

            return redirect('/users/potential-duplicated-user')->with([
                'existingUsers' => $existingUsers,
                'userToCreate' => $userToCreate,
            ]);
        }

        try {
            $user = $this->userRepository->insert($request->all());
            if ($request->has('image_user')) {
                $pathImage = $this->uploadMedia($user, $request->image_user);
                $this->userRepository->updateUserImage($user, $pathImage);
            }

            return redirect("/users?user_name=$user->last_name")
            ->with('success', trans('user.user_created', ['name' => $user->full_name]));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function uploadMedia(User $user, $image)
    {
        Image::make($image)->resize(config('params.image_width_redim'), null, function ($constraint) {
            $constraint->aspectRatio();
        })->save('resizedFile');

        return Storage::disk('s3')->put('/users', new File('resizedFile'));
    }

    public function deleteMedia(User $user)
    {
        if ($user->user_image_url != null && Storage::disk('s3')->exists($user->user_image_url)) {
            Storage::disk('s3')->delete($user->user_image_url);
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
    public function edit(User $user)
    {
        return view('users.user_form', [
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
    public function update(StoreUserRequest $request, User $user)
    {
        try {
            $user = $this->userRepository->update($user, $request->all());
            if ($request->has('image_user')) {
                $this->deleteMedia($user);
                $pathImage = $this->uploadMedia($user, $request->image_user);
                $this->userRepository->updateUserImage($user, $pathImage);
            }

            return redirect('/users')
            ->with('success', trans('user.user_updated', ['name' => $user->full_name]));
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
    public function destroy(User $user)
    {
        try {
            $this->userRepository->destroy($user);
            $this->deleteMedia($user);
            return redirect('/users')
            ->with('success', trans('user.user_deleted', ['name' => $user->full_name]));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function potentialDuplicatedUser()
    {
        return view('users.potential_duplicated_user', [
            'userToCreate' => session('userToCreate'),
            'existingUsers' => session('existingUsers'),
        ]);
    }

    /**
     * todo : security
     */
    public function savePotentialDuplicatedUser(Request $request)
    {
        try {
            $user = $this->userRepository->insert($request->all());

            return redirect('/users')
            ->with('success', 'User ' . $user->full_name . ' created.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function usersOfAGroup(Request $request, Group $group)
    {
        $usersOfAGroup = $this->userRepository->usersOfAGroup($group->id);
        $usersFiltered = $request->has('user_name') && $request->user_name !== '' ?
            $this->userRepository->all($request->all())
            : [];

        return view('users.users_of_a_group', [
            'group' => $group,
            'usersOfAGroup' => $usersOfAGroup,
            'usersFiltered' => $usersFiltered,
            'user_name' => $request->query('user_name', ''),
        ]);
    }

    public function addUserForAGroup(Request $request, Group $group)
    {
        $this->authorize('create', Group::class);
        try {
            $this->userRepository->addUserForAGroup($group->id, $request->user_id);
            $user = User::find($request->user_id);

            return redirect("/groups/$group->id/users?user_name=$request->user_name")
            ->with('success', trans('user.user_added_to_family', ['name' => $user->full_name]));
        } catch (\Throwable $th) {
            return back()->with('error', 'an error occured.');
        }
    }

    public function removeUserFromAGroup(Group $group, User $user)
    {
        $this->authorize('delete', [Group::class, $group]);

        try {
            $this->userRepository->removeUserFromAGroup($group->id, $user->id);

            return back()->with('success', trans('user.user_removed_from_family', ['name' => $user->full_name]));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function autocomplete(Request $request)
    {
        return User::where(function ($query) use ($request) {
            $query->where('last_name', 'ilike', '%' . $request->search . '%')
            ->orWhere('first_name', 'ilike', '%' . $request->search . '%');
        })
        ->where('role_id', 'STUDENT')
        ->get(['id', 'first_name', 'last_name']);
    }
}
