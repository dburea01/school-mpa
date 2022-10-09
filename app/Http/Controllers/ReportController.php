<?php
namespace App\Http\Controllers;

use App\Models\School;
use App\Repositories\ReportRepository;

class ReportController extends Controller
{
    public $reportRepository;

    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    public function reports(School $school)
    {
        $this->authorize('view', [Report::class, $school]);

        return view('reports.report', [
            'summary_users_by_role' => $this->reportRepository->summaryUsersByRole($school),
            'summary_students_by_gender' => $this->reportRepository->summaryStudentsByGenre($school),
            'school' => $school,
        ]);
    }
}
