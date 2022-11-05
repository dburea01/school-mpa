<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Models\Subject;
use App\Repositories\SubjectRepository;

class SubjectController extends Controller
{
    private $subjectRepository;

    public function __construct(SubjectRepository $subjectRepository)
    {
        $this->authorizeResource(Subject::class);
        $this->subjectRepository = $subjectRepository;
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

    public function show(Subject $subject)
    {
        //
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
