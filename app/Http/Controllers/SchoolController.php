<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Http\Requests\StoreSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use App\Repositories\SchoolRepository;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    protected $schoolRepository;

    public function __construct(SchoolRepository $schoolRepository)
    {
        $this->authorizeResource(School::class);
        $this->schoolRepository = $schoolRepository;
    }

    public function index(Request $request)
    {
        $schools = $this->schoolRepository->all($request->all());

        return view('schools.schools', [
            'schools' => $schools,
            'school_name' => $request->query('school_name', ''),
            'city' => $request->query('city', '')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $school = new School();
        $school->status = "INACTIVE";

        return view('schools.school_form', [
            'school' => $school,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSchoolRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSchoolRequest $request)
    {
        try {
            $school = $this->schoolRepository->insert($request->all());
            return redirect("/schools")->with('success', trans('schools.school_created', ['name' => $school->name]));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        return view('schools.school_form', [
            'school' => $school,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSchoolRequest  $request
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSchoolRequest $request, School $school)
    {
        try {
            $school = $this->schoolRepository->update($school->id, $request->all());

            return redirect()->back()->with('success', trans('schools.school_updated', ['name' => $school->name]));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        try {
            $this->schoolRepository->destroy($school->id);
            return redirect("/schools")->with('success', trans('schools.school_deleted', ['name' => $school->name]));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
