<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreClassroomRequest;
use App\Models\Classroom;
use App\Repositories\ClassroomRepository;
use App\Repositories\PeriodRepository;
use Illuminate\Http\Request;

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
    public function index(Request $request)
    {
        $currentPeriod = $this->periodRepository->getCurrentPeriod();
        $periodIdToDisplay = $request->query('period_id', $currentPeriod->id);

        $classrooms = $this->classroomRepository->all($periodIdToDisplay);

        return view('classrooms.classrooms', [
            'classrooms' => $classrooms,
            'currentPeriod' => $currentPeriod,
            'periodIdToDisplay' => $periodIdToDisplay,
        ]);
    }

    public function create()
    {
        $classroom = new Classroom();
        $classroom->status = 'ACTIVE';
        $classroom->period_id = $this->periodRepository->getCurrentPeriod()->id;

        return view('classrooms.classroom_form', [
            'classroom' => $classroom,
            'periods' => $this->periodRepository->all(),
        ]);
    }

    public function store(StoreClassroomRequest $request)
    {
        try {
            $classroom = $this->classroomRepository->insert($request->all());

            return redirect("/classrooms?period_id=$classroom->period_id")
            ->with('success', trans('classroom.classroom_created', ['name' => $classroom->name]));
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
    public function edit(Classroom $classroom)
    {
        return view('classrooms.classroom_form', [
            'classroom' => $classroom,
            'periods' => $this->periodRepository->all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClassroomRequest  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(StoreClassroomRequest $request, Classroom $classroom)
    {
        try {
            $classroomUpdated = $this->classroomRepository->update($classroom, $request->all());

            return redirect("classrooms?period_id=$classroomUpdated->period_id")
            ->with('success', trans('classroom.classroom_updated', ['name' => $classroomUpdated->name]));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Classroom $classroom)
    {
        try {
            $this->classroomRepository->destroy($classroom);

            return redirect("classrooms?period_id=$classroom->period_id")
            ->with('success', trans('classroom.classroom_deleted', ['name' => $classroom->name]));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
