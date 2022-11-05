<?php
namespace App\Http\Controllers;

use App\Http\Requests\StorePeriodRequest;
use App\Models\Period;
use App\Models\School;
use App\Repositories\PeriodRepository;

class PeriodController extends Controller
{
    private $periodRepository;

    public function __construct(PeriodRepository $periodRepository)
    {
        $this->periodRepository = $periodRepository;
        $this->authorizeResource(Period::class);
    }

    public function index()
    {
        $periods = $this->periodRepository->all();
        $currentPeriod = $periods->filter(function ($period) {
            return $period->current === true;
        });

        return view('periods.periods', [
            'periods' => $periods,
            'currentPeriod' => $currentPeriod,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $period = new Period();

        return view('periods.period_form', [
            'period' => $period,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePeriodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePeriodRequest $request)
    {
        try {
            $period = $this->periodRepository->insert($request->all());

            return redirect('periods')
            ->with('success', trans('period.period_created', ['name' => $period->name]));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function show(Period $period)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function edit(Period $period)
    {
        return view('periods.period_form', [
            'period' => $period,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePeriodRequest  $request
     * @param  \App\Models\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function update(Period $period, StorePeriodRequest $request)
    {
        try {
            $this->periodRepository->update($period, $request->all());

            return redirect('periods')
            ->with('success', trans('period.period_updated', ['name' => $period->name]));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function destroy(Period $period)
    {
        try {
            $this->periodRepository->destroy($period);

            return redirect('periods')
            ->with('success', trans('period.period_deleted', ['name' => $period->name]));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
