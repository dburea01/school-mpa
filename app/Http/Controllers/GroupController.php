<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Models\Group;
use App\Models\School;
use App\Repositories\GroupRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public $groupRepository;

    public function __construct(GroupRepository $groupRepository, UserRepository $userRepository)
    {
        $this->authorizeResource(Group::class);
        $this->groupRepository = $groupRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $groups = $this->groupRepository->all($request->all());

        return view('groups.groups', [
            'groups' => $groups,
            'group_name' => $request->query('group_name', ''),
            'group_city' => $request->query('group_city'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group = new Group();
        $group->status = 'INACTIVE';

        return view('groups.group_form', [
            'group' => $group,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupRequest $request)
    {
        try {
            $group = $this->groupRepository->insert($request->all());

            return redirect("/groups/$group->id/users")
            ->with('success', trans('group.group_created', ['name' => $group->name]));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        return view('groups.group_form', [
            'group' => $group,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGroupRequest  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGroupRequest $request, School $school, Group $group)
    {
        try {
            $group = $this->groupRepository->update($group, $request->all());

            return redirect('/groups')
            ->with('success', trans('group.group_updated', ['name' => $group->name]));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        try {
            $this->groupRepository->destroy($group);

            return redirect('groups')
            ->with('success', trans('group.group_deleted', ['name' => $group->name]));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
