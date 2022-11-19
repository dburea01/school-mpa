<?php
namespace App\Http\Controllers;

use App\Models\Result;
use App\Http\Requests\StoreResultRequest;
use App\Http\Requests\UpdateResultRequest;
use App\Models\Exam;
use App\Repositories\AppreciationRepository;
use App\Repositories\ResultRepository;

class ResultController extends Controller
{
    public $resultRepository;
    public $appreciationRepository;

    public function __construct(ResultRepository $resultRepository, AppreciationRepository $appreciationRepository)
    {
        $this->resultRepository = $resultRepository;
        $this->appreciationRepository = $appreciationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Exam $exam)
    {
        return view('results.results', [
            'exam' => $exam,
            'students' => $this->resultRepository->index($exam),
            'appreciations' => $this->appreciationRepository->all()
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
     * @param  \App\Http\Requests\StoreResultRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Exam $exam, StoreResultRequest $request)
    {
        try {
            $this->resultRepository->delete($exam, $request->user_id);
            $this->resultRepository->insert($exam, $request->all());
            return redirect("exams/$exam->id/results")->with(
                'success',
                trans('results.result_saved')
            );
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateResultRequest  $request
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResultRequest $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
        //
    }
}
