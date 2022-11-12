<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreAssignmentStudentRequest;
use App\Models\AssignmentStudent;
use App\Models\Classroom;
use App\Models\User;
use App\Repositories\AssignmentStudentRepository;

class AssignmentStudentController extends Controller
{
    public $assignmentStudentRepository;

    public function __construct(AssignmentStudentRepository $assignmentStudentRepository)
    {
        $this->assignmentStudentRepository = $assignmentStudentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Classroom $classroom)
    {
        //@todo : permissions
        $assignmentStudents = $this->assignmentStudentRepository->index($classroom);

        return view('assignment_students.assignment_students', [
            'classroom' => $classroom,
            'assignmentStudents' => $assignmentStudents,
            // todo 'assignmentTeachers' => $assignmentTeachers,
        ]);
    }

    public function store(Classroom $classroom, StoreAssignmentStudentRequest $request)
    {
        // todo : permission
        try {
            $user = User::find($request->userIdToAssign);
            $this->assignmentStudentRepository->insert($classroom, $user);

            return back()->with('success', trans('assignment-students.student_assigned', ['user' => $user->full_name]));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Classroom $classroom, AssignmentStudent $assignmentStudent)
    {
        // todo : permission
        try {
            $user = User::find($assignmentStudent->user_id);
            $this->assignmentStudentRepository->destroy($assignmentStudent);

            return back()
            ->with('success', trans('assignment-students.assignment_deleted', ['user' => $user->full_name]));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
