<?php

declare(strict_types=1);
namespace App\Repositories;

use App\Models\Exam;
use App\Models\School;
use Illuminate\Support\Str;

class ExamRepository
{
    public function all(School $school, $request)
    {
        $query = Exam::where('school_id', $school->id)->orderBy('start_date')
        ->with(['subject', 'classroom', 'exam_type', 'exam_status']);

        if (\array_key_exists('filter_by_title', $request)) {
            $query->where(function ($query) use ($request) {
                $query->where('title', 'ilike', '%' . $request['filter_by_title'] . '%')
                ->orWhere('description', 'ilike', '%' . $request['filter_by_title'] . '%');
            });
        }

        if (\array_key_exists('filter_by_classroom_id', $request)
        && Str::of($request['filter_by_classroom_id'])->isUuid()) {
            $query->where('classroom_id', $request['filter_by_classroom_id']);
        }

        if (\array_key_exists('filter_by_subject_id', $request)
        && Str::of($request['filter_by_subject_id'])->isUuid()) {
            $query->where('subject_id', $request['filter_by_subject_id']);
        }

        if (\array_key_exists('filter_by_exam_type_id', $request)
        && Str::of($request['filter_by_exam_type_id'])->isUuid()) {
            $query->where('exam_type_id', $request['filter_by_exam_type_id']);
        }

        if (\array_key_exists('filter_by_exam_status_id', $request)
        && $request['filter_by_exam_status_id'] !== null
        && is_numeric(trim($request['filter_by_exam_status_id']))) {
            $query->where('exam_status_id', $request['filter_by_exam_status_id']);
        }

        return $query->paginate(10);
    }

    public function update(School $school, Exam $exam, array $data)
    {
        $exam->fill($data);
        $exam->save();

        return $exam;
    }

    public function destroy($schoolId): void
    {
        School::destroy($schoolId);
    }

    public function insert(School $school, array $data)
    {
        $exam = new Exam;
        $exam->fill($data);
        $exam->school_id = $school->id;
        $exam->save();

        return $exam;
    }
}
