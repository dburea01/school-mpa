<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreAssignmentRequest;
use App\Http\Requests\UpdateAssignmentRequest;
use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\Period;
use App\Models\School;
use App\Models\User;
use App\Repositories\AssignmentRepository;
use Illuminate\Http\Request;

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
    public function index(School $school, Classroom $classroom)
    {
        //@todo : permissions
        $assignments = $this->assignmentRepository->index($school, $classroom);

        $qtyBoys = $assignments->filter(function ($assignment) {
            return $assignment->user->gender_id === '1';
        })->count();

        $qtyGirls = $assignments->filter(function ($assignment) {
            return $assignment->user->gender_id === '2';
        })->count();

        return view('assignments.assignments', [
            'school' => $school,
            'classroom' => $classroom,
            'assignments' => $assignments,
            'qtyBoys' => $qtyBoys,
            'qtyGirls' => $qtyGirls
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
    public function store(School $school, Classroom $classroom, StoreAssignmentRequest $request)
    {
        // todo : permission
        try {
            $user = User::find($request->userIdToAssign);
            $this->assignmentRepository->insert($school, $classroom, $user);

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
    public function destroy(School $school, Classroom $classroom, Assignment $assignment)
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
