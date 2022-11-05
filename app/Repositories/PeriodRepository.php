<?php

declare(strict_types=1);
namespace App\Repositories;

use App\Models\Period;
use App\Models\School;
use Illuminate\Support\Facades\DB;

class PeriodRepository
{
    public function all()
    {
        return Period::orderBy('start_date', 'desc')->get();
    }

    public function update(Period $period, array $data): Period
    {
        $period->fill($data);
        $period->current = array_key_exists('current', $data) ? true : false;
        $period->save();

        if (array_key_exists('current', $data)) {
            $this->setCurrentPeriod($period->id);
        }

        return $period;
    }

    public function destroy(Period $period): void
    {
        $period->delete();
    }

    public function insert(array $data): Period
    {
        $period = new Period();
        $period->fill($data);
        $period->save();

        if (array_key_exists('current', $data)) {
            $this->setCurrentPeriod($period->id);
        }

        return $period;
    }

    public function setCurrentPeriod(int $periodId): Period
    {
        DB::table('periods')->update(['current' => false]);

        $newCurrentPeriod = Period::find($periodId);
        $newCurrentPeriod->current = true;
        $newCurrentPeriod->save();

        return $newCurrentPeriod;
    }

    public function getCurrentPeriod(): ?Period
    {
        return Period::where('current', true)->first();
    }
}
