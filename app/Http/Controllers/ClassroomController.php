<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClassroomRequest;
use App\Models\Classroom;
use App\Models\School;
use App\Repositories\ClassroomRepository;
use App\Repositories\PeriodRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClassroomController extends Controller
{
    private $classroomRepository;

    private $periodRepository;

    public function __construct(
        ClassroomRepository $classroomRepository,
        PeriodRepository $periodRepository
    ) {
        $this->classroomRepository = $classroomRepository;
        $this->periodRepository = $periodRepository;
        $this->authorizeResource(Classroom::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, School $school)
    {
        $currentPeriod = $this->periodRepository->getCurrentPeriod($school);

        if (! $currentPeriod) {
            return view('errors.no_current_period');
        }

        $periodId = $request->query('period_id') && $request->query('period_id') !== '' && Str::isUuid($request->query('period_id')) ?
            $request->query('period_id') : $currentPeriod->id;
        $period = $this->periodRepository->getPeriod($school, $periodId);
        $periods = $this->periodRepository->all($school);

        $classrooms = $this->classroomRepository->all($school, $period);

        return view('classrooms.classrooms', [
            'school' => $school,
            'classrooms' => $classrooms,
            'periods' => $periods,
            'periodToDisplay' => $period,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(School $school)
    {
        $classroom = new Classroom();
        $classroom->status = 'ACTIVE';
        $classroom->school_id = $school->id;

        return view('classrooms.classroom_form', [
            'school' => $school,
            'classroom' => $classroom,
            'periods' => $this->periodRepository->all($school),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClassroomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(School $school, StoreClassroomRequest $request)
    {
        try {
            $classroom = $this->classroomRepository->insert($school, $request->all());

            return redirect("schools/$school->id/classrooms?period_id=$classroom->period_id")->with('success', trans('classroom.classroom_created', ['name' => $classroom->name]));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school, Classroom $classroom)
    {
        return view('classrooms.classroom_form', [
            'school' => $school,
            'classroom' => $classroom,
            'periods' => $this->periodRepository->all($school),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClassroomRequest  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(StoreClassroomRequest $request, School $school, Classroom $classroom)
    {
        try {
            $classroomUpdated = $this->classroomRepository->update($classroom, $request->all());

            return redirect("schools/$school->id/classrooms?period_id=$classroomUpdated->period_id")->with('success', trans('classroom.classroom_updated', ['name' => $classroomUpdated->name]));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school, Classroom $classroom)
    {
        try {
            $this->classroomRepository->destroy($classroom);

            return redirect("schools/$school->id/classrooms?period_id=$classroom->period_id")->with('success', trans('classroom.classroom_deleted', ['name' => $classroom->name]));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
