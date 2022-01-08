<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Http\Requests\StoreGroupRequest;
use App\Models\School;
use App\Models\User;
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
    public function index(Request $request, School $school)
    {
        $groups = $this->groupRepository->all($school->id, $request->all());
        $summaryUsersByRole = $this->userRepository->summaryUsersByRole($school);
        
        return view('groups.groups', [
            'school' => $school,
            'groups' => $groups,
            'group_name' => $request->query('group_name', ''),
            'group_city' => $request->query('group_city'),
            'summary_users_by_role' => $summaryUsersByRole
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(School $school)
    {
        $group = new Group();
        $group->status="INACTIVE";

        return view('groups.group_form', [
            'school' => $school,
            'group' => $group,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupRequest $request, School $school)
    {
        try {
            $group = $this->groupRepository->insert($school->id, $request->all());
            return redirect('schools/'.$school->id.'/groups/'.$group->id.'/users')->with('success', 'Family '.$group->name.' created.');
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
    public function edit(School $school, Group $group)
    {
        return view('groups.group_form', [
            'school' => $school,
            'group' => $group
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
            return redirect('schools/'.$school->id.'/groups')->with('success', 'Family '.$group->name.' updated.');
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
    public function destroy(School $school, Group $group)
    {
        try {
            $this->groupRepository->destroy($group);
            return redirect('schools/'.$school->id.'/groups')->with('success', 'Family '.$group->name.' deleted.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
