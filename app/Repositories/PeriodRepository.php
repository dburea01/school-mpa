<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Period;
use App\Models\School;

class PeriodRepository
{
    public function all(School $school)
    {
        return Period::where('school_id', $school->id)->orderBy('start_date', 'desc')->get();
    }

    public function getPeriod(School $school, string $periodId)
    {
        return Period::where('school_id', $school->id)->where('id', $periodId)->first();
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

    public function getCurrentPeriod(School $school): ?Period
    {
        return Period::where('school_id', $school->id)
        ->where('current', true)
        ->first();
    }
}
