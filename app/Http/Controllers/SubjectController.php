<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Models\School;
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
    public function index(School $school)
    {
        return view('subjects.subjects', [
            'school' => $school,
            'subjects' => $this->subjectRepository->all($school),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(School $school)
    {
        $subject = new Subject();
        $subject->status = 'ACTIVE';

        return view('subjects.subject_form', [
            'school' => $school,
            'subject' => $subject,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubjectRequest $request, School $school)
    {
        try {
            $subject = $this->subjectRepository->insert($school, $request->all());

            return redirect("/schools/$school->id/subjects")->with('success', trans('subject.subject_created', ['name' => $subject->name]));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school, Subject $subject)
    {
        return view('subjects.subject_form', [
            'school' => $school,
            'subject' => $subject,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubjectRequest  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSubjectRequest $request, School $school, Subject $subject)
    {
        try {
            $this->subjectRepository->update($subject, $request->all());

            return redirect("/schools/$school->id/subjects")->with('success', trans('subject.subject_updated', ['name' => $subject->name]));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school, Subject $subject)
    {
        try {
            $this->subjectRepository->destroy($subject);

            return redirect("/schools/$school->id/subjects")->with('success', trans('subject.subject_deleted', ['name' => $subject->name]));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
