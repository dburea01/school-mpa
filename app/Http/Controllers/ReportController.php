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

    public function reports()
    {
        $this->authorize('view', Report::class);

        return view('reports.report', [
            'summary_users_by_role' => $this->reportRepository->summaryUsersByRole(),
            'summary_students_by_gender' => $this->reportRepository->summaryStudentsByGenre(),
        ]);
    }
}
