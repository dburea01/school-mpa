<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreAssignmentRequest;
use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\User;
use App\Repositories\AssignmentRepository;

class AssignmentController extends Controller
{
    public $assignmentRepository;

    public function __construct(AssignmentRepository $assignmentRepository)
    {
        $this->assignmentRepository = $assignmentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Classroom $classroom)
    {
        //@todo : permissions
        $assignments = $this->assignmentRepository->index($classroom);

        $assignmentStudents = $assignments->filter(function ($assignment) {
            return $assignment->user->role_id == 'STUDENT';
        });
        $assignmentTeachers = $assignments->filter(function ($assignment) {
            return $assignment->user->role_id == 'TEACHER';
        });
        return view('assignments.assignments', [
            'classroom' => $classroom,
            'assignmentStudents' => $assignmentStudents,
            'assignmentTeachers' => $assignmentTeachers,
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
