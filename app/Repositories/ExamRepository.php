<?php

declare(strict_types=1);
namespace App\Repositories;

use App\Models\Exam;
use App\Models\School;
use Illuminate\Support\Str;

class ExamRepository
{
    public function all($request)
    {
        $periodRepository = new PeriodRepository();
        $currentPeriod = $periodRepository->getCurrentPeriod();

        $query = Exam::orderBy('start_date')
        ->join('classrooms', function ($join) use ($currentPeriod) {
            $join->on('classrooms.id', 'exams.classroom_id')
            ->where('classrooms.period_id', $currentPeriod->id);
        })
        ->with(['subject', 'classroom', 'exam_type', 'exam_status'])
        ->select('exams.*');

        if (\array_key_exists('filter_by_title', $request)) {
            $query->where(function ($query) use ($request) {
                $query->where('title', 'ilike', '%' . $request['filter_by_title'] . '%')
                ->orWhere('description', 'ilike', '%' . $request['filter_by_title'] . '%');
            });
        }

        if (\array_key_exists('filter_by_classroom_id', $request) && $request['filter_by_classroom_id'] != '') {
            $query->where('classroom_id', $request['filter_by_classroom_id']);
        }

        if (\array_key_exists('filter_by_subject_id', $request) && $request['filter_by_subject_id'] != '') {
            $query->where('subject_id', $request['filter_by_subject_id']);
        }

        if (\array_key_exists('filter_by_exam_type_id', $request) && $request['filter_by_exam_type_id'] != '') {
            $query->where('exam_type_id', $request['filter_by_exam_type_id']);
        }

        if (\array_key_exists('filter_by_exam_status_id', $request)
        && $request['filter_by_exam_status_id'] !== null
        && is_numeric(trim($request['filter_by_exam_status_id']))) {
            $query->where('exam_status_id', $request['filter_by_exam_status_id']);
        }

        return $query->paginate(10);
    }

    public function update(Exam $exam, array $data)
    {
        $exam->fill($data);
        $exam->save();

        return $exam;
    }

    public function destroy(Exam $exam): void
    {
        $exam->delete();
    }

    public function insert(array $data)
    {
        $exam = new Exam;
        $exam->fill($data);
        $exam->save();

        return $exam;
    }
}
