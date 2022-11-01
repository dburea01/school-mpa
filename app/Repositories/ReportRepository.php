<?php

declare(strict_types=1);
namespace App\Repositories;

use App\Models\School;
use Illuminate\Support\Facades\DB;

class ReportRepository
{
    public function summaryUsersByRole()
    {
        return DB::table('users')
            ->select(DB::raw('count(*) as user_count, role_id'))
            ->groupBy('role_id')
            ->get();
    }

    public function summaryStudentsByGenre()
    {
        return DB::table('users')
            ->select(DB::raw('count(*) as user_count, gender_id'))
            ->where('role_id', 'STUDENT')
            ->groupBy('gender_id')
            ->get();
    }
}
