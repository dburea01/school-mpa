<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreAssignmentRequest;
use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\User;
use App\Repositories\AssignmentRepository;
use App\Repositories\SubjectRepository;

class AssignmentController extends Controller
{
    public $assignmentRepository;
    public $subjectRepository;

    public function __construct(
        AssignmentRepository $assignmentRepository,
        SubjectRepository $subjectRepository
    ) {
        $this->assignmentRepository = $assignmentRepository;
        $this->subjectRepository = $subjectRepository;
    }

    public function indexStudent(Classroom $classroom)
    {
        //@todo : permissions
        $assignments = $this->assignmentRepository->index($classroom, 'STUDENT');

        return view('assignments.assignment-students', [
            'classroom' => $classroom,
            'assignments' => $assignments
        ]);
    }

    public function indexTeacher(Classroom $classroom)
    {
        //@todo : permissions

        return view('assignments.assignment-teachers', [
            'classroom' => $classroom,
            'assignments' => $this->assignmentRepository->index($classroom, 'TEACHER'),
            'subjects' => $this->subjectRepository->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAssignmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Classroom $classroom, StoreAssignmentRequest $request)
    {
        // todo : permission
        try {
            $user = User::find($request->userIdToAssign);
            $this->assignmentRepository->insert($classroom, $user);

            return back()->with('success', trans('assignments.user_assigned', ['user' => $user->full_name]));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom, Assignment $assignment)
    {
        // todo : permission
        try {
            $user = User::find($assignment->user_id);
            $this->assignmentRepository->destroy($assignment);

            return back()->with('success', trans('assignments.assignment_deleted', ['user' => $user->full_name]));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
