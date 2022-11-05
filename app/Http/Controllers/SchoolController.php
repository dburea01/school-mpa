<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreSchoolRequest;
use App\Models\School;
use App\Repositories\SchoolRepository;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    protected $schoolRepository;

    public function __construct(SchoolRepository $schoolRepository)
    {
        $this->schoolRepository = $schoolRepository;
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
    public function edit()
    {
        $this->authorize('update', School::class);

        return view('schools.school_form', [
            'school' => School::first(),
        ]);
    }

    public function update(StoreSchoolRequest $request)
    {
        try {
            $school = $this->schoolRepository->update($request->all());

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

            return redirect('/schools')->with('success', trans('schools.school_deleted', ['name' => $school->name]));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
