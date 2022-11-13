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
    public function create(Request $request)
    {
        $assignmentTeacher = new AssignmentTeacher();
        $assignmentTeacher->user_id = $request->user_id;
        $assignmentTeacher->subject_id = $request->subject_id;

        return view('assignment_teachers.assignment_teacher_form', [
            'assignmentTeacher' => $assignmentTeacher
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAssignmentTeacherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssignmentTeacherRequest $request)
    {
        try {
            $this->assignmentTeacherRepository->insert(
                $request->classroom_id,
                $request->subject_id,
                $request->user_id,
                $request->comment
            );

            return redirect("/assignment-teachers?user_id=$request->user_id&subject_id=$request->subject_id")
            ->with('success', trans('assignment-teachers.teacher_assigned'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssignmentTeacher  $assignmentTeacher
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignmentTeacher $assignmentTeacher)
    {
        return view('assignment_teachers.assignment_teacher_form', [
            'assignmentTeacher' => $assignmentTeacher
        ]);
    }

    public function update(StoreAssignmentTeacherRequest $request, AssignmentTeacher $assignmentTeacher)
    {
        try {
            $assignmentTeacher = $this->assignmentTeacherRepository->update($assignmentTeacher, $request->all());

            return redirect("/assignment-teachers?user_id=$request->user_id&subject_id=$request->subject_id")
            ->with('success', trans('assignment-teachers.assignment_modified'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssignmentTeacher  $assignmentTeacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignmentTeacher $assignmentTeacher)
    {
        try {
            $this->assignmentTeacherRepository->destroy($assignmentTeacher);

            return redirect("/assignment-teachers?user_id=$assignmentTeacher->user_id")
            ->with('success', trans('assignment-teachers.assignment_deleted'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
