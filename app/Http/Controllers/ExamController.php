<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Models\Exam;
use App\Models\School;
use App\Repositories\ExamRepository;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public $examRepository;

    public function __construct(ExamRepository $examRepository)
    {
        $this->examRepository = $examRepository;
        $this->authorizeResource(Exam::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(School $school, Request $request)
    {
        $exams = $this->examRepository->all($school, $request->all());

        return view('exams.exams', [
            'school' => $school,
            'exams' => $exams,
            'filter_by_title' => $request->query('filter_by_title', ''),
            'filter_by_classroom_id' => $request->query('filter_by_classroom_id', ''),
            'filter_by_subject_id' => $request->query('filter_by_subject_id', ''),
            'filter_by_exam_type_id' => $request->query('filter_by_exam_type_id', ''),
            'filter_by_exam_status_id' => $request->query('filter_by_exam_status_id', ''),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(School $school)
    {
        $exam = new Exam();
        $exam->exam_status_id = '10'; // draft

        return view('exams.exam_form', [
            'school' => $school,
            'exam' => $exam,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(School $school, StoreExamRequest $request)
    {
        try {
            $exam = $this->examRepository->insert($school, $request->all());
            return redirect("schools/$school->id/exams")->with('success', trans(
                'exams.exam_created',
                ['title' => $exam->title]
            ));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school, Exam $exam)
    {
        return view('exams.exam_form', [
            'school' => $school,
            'exam' => $exam,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExamRequest  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(School $school, StoreExamRequest $request, Exam $exam)
    {
        try {
            $examUpdated = $this->examRepository->update($school, $exam, $request->all());
            return redirect("schools/$school->id/exams")->with('success', trans(
                'exams.exam_updated',
                ['title' => $examUpdated->title]
            ));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        //
    }
}
