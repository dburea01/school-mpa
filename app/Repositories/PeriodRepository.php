<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Group;
use App\Models\Period;
use App\Models\School;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PeriodRepository
{
    public function all($school)
    {
        return Period::where('school_id', $school->id)->orderBy('start_date', 'desc')->get();
    }


    public function update(Period $period, array $data)
    {
        $period->fill($data);
        $period->current = array_key_exists('current', $data) ? true : false;
        $period->save();

        if (array_key_exists('current', $data)) {
            $this->setCurrentPeriod($period->school_id, $period->id);
        }

        return $period;
    }

    public function destroy(Period $period): void
    {
        $period->delete();
    }

    public function insert(School $school, array $data)
    {
        $period = new Period();
        $period->school_id = $school->id;
        $period->fill($data);
        $period->save();

        if (array_key_exists('current', $data)) {
            $this->setCurrentPeriod($school->id, $period->id);
        }

        return $period;
    }

    public function setCurrentPeriod(string $schoolId, string $periodId): Period
    {
        Period::where('school_id', $schoolId)->update(['current' => false]);

        $newCurrentPeriod = Period::where('school_id', $schoolId)->where('id', $periodId)->first();
        $newCurrentPeriod->current = true;
        $newCurrentPeriod->save();

        return $newCurrentPeriod;
    }
}
