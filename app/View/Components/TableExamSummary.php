<?php
namespace App\View\Components;

use App\Models\Classroom;
use App\Models\Exam;
use App\Models\ExamStatus;
use App\Models\ExamType;
use App\Models\Subject;
use App\Repositories\ResultRepository;
use Illuminate\View\Component;

class TableExamSummary extends Component
{
    public $exam;
    public $classroom;
    public $subject;
    public $examType;
    public $examStatus;

    public $reportExam;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Exam $exam)
    {
        $this->exam = $exam;
        $this->classroom = Classroom::find($exam->classroom_id);
        $this->subject = Subject::find($exam->subject_id);
        $this->examType = ExamType::find($exam->exam_type_id);
        $this->examStatus = ExamStatus::find($exam->exam_status_id);

        $resultRepository = new ResultRepository();
        $this->reportExam = $resultRepository->getReportExam($exam);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table-exam-summary');
    }
}
