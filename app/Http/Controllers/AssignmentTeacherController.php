<?php
namespace App\Http\Controllers;

use App\Models\AssignmentTeacher;
use App\Http\Requests\StoreAssignmentTeacherRequest;
use App\Http\Requests\UpdateAssignmentTeacherRequest;
use App\Repositories\AssignmentTeacherRepository;
use Illuminate\Http\Request;

class AssignmentTeacherController extends Controller
{
    public $assignmentTeacherRepository;

    public function __construct(AssignmentTeacherRepository $assignmentTeacherRepository)
    {
        $this->assignmentTeacherRepository = $assignmentTeacherRepository;
        $this->authorizeResource(AssignmentTeacher::class);
    }

    public function index(Request $request)
    {
        $assignmentTeachers = $this->assignmentTeacherRepository->index($request->all());

        return view('assignment_teachers.assignment_teachers', [
            'assignmentTeachers' => $assignmentTeachers,
            'classroom_id' => $request->query('classroom_id', ''),
            'subject_id' => $request->query('subject_id', ''),
            'user_id' => $request->query('user_id', ''),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAssignmentTeacherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssignmentTeacherRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssignmentTeacher  $assignmentTeacher
     * @return \Illuminate\Http\Response
     */
    public function show(AssignmentTeacher $assignmentTeacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssignmentTeacher  $assignmentTeacher
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignmentTeacher $assignmentTeacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAssignmentTeacherRequest  $request
     * @param  \App\Models\AssignmentTeacher  $assignmentTeacher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAssignmentTeacherRequest $request, AssignmentTeacher $assignmentTeacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssignmentTeacher  $assignmentTeacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignmentTeacher $assignmentTeacher)
    {
        //
    }
}
