<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Repositories\AssignmentTeacherRepository;
use App\Models\Subject;
use App\Repositories\SubjectRepository;

class SubjectController extends Controller
{
    private $subjectRepository;
    private $assignmentTeacherRepository;

    public function __construct(
        SubjectRepository $subjectRepository,
        AssignmentTeacherRepository $assignmentTeacherRepository
    ) {
        $this->authorizeResource(Subject::class);
        $this->subjectRepository = $subjectRepository;
        $this->assignmentTeacherRepository = $assignmentTeacherRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('subjects.subjects', [
            'subjects' => $this->subjectRepository->all(),
            'assignmentTeachers' => $this->assignmentTeacherRepository->index([])
        ]);
    }

    public function create()
    {
        $subject = new Subject();
        $subject->status = 'ACTIVE';

        return view('subjects.subject_form', [
            'subject' => $subject,
        ]);
    }

    public function store(StoreSubjectRequest $request)
    {
        try {
            $subject = $this->subjectRepository->insert($request->all());

            return redirect('/subjects')
            ->with('success', trans('subject.subject_created', ['name' => $subject->name]));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function edit(Subject $subject)
    {
        return view('subjects.subject_form', [
            'subject' => $subject,
        ]);
    }

    public function update(StoreSubjectRequest $request, Subject $subject)
    {
        try {
            $this->subjectRepository->update($subject, $request->all());

            return redirect('subjects')
            ->with('success', trans('subject.subject_updated', ['name' => $subject->name]));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Subject $subject)
    {
        try {
            $this->subjectRepository->destroy($subject);

            return redirect('subjects')
            ->with('success', trans('subject.subject_deleted', ['name' => $subject->name]));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
