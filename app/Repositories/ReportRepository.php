<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\School;
use Illuminate\Support\Facades\DB;

class ReportRepository
{

    public function summaryUsersByRole(School $school)
    {
        return DB::table('users')
            ->select(DB::raw('count(*) as user_count, role_id'))
            ->where('school_id', $school->id)
            ->groupBy('role_id')
            ->get();
    }

    public function summaryStudentsByGenre(School $school)
    {
        return DB::table('users')
            ->select(DB::raw('count(*) as user_count, gender_id'))
            ->where('school_id', $school->id)
            ->where('role_id', 'STUDENT')
            ->groupBy('gender_id')
            ->get();
    }
}
