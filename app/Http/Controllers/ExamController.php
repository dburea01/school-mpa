<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreExamRequest;
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
    public function index(Request $request)
    {
        $exams = $this->examRepository->all($request->all());

        return view('exams.exams', [
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
    public function create()
    {
        $exam = new Exam();
        $exam->exam_status_id = '10'; // draft

        return view('exams.exam_form', [
            'exam' => $exam,
        ]);
    }

    public function store(StoreExamRequest $request)
    {
        try {
            $exam = $this->examRepository->insert($request->all());

            return redirect("exams?filter_by_title=$exam->title")
            ->with('success', trans('exams.exam_created', ['title' => $exam->title]));
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
    public function edit(Exam $exam)
    {
        return view('exams.exam_form', [
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
    public function update(StoreExamRequest $request, Exam $exam)
    {
        try {
            $examUpdated = $this->examRepository->update($exam, $request->all());

            return redirect("exams?filter_by_title=$examUpdated->title")->with(
                'success',
                trans(
                    'exams.exam_updated',
                    ['title' => $examUpdated->title]
                )
            );
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
        try {
            $this->examRepository->destroy($exam);

            return redirect('exams')->with(
                'success',
                trans(
                    'exams.exam_deleted',
                    ['title' => $exam->title]
                )
            );
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
