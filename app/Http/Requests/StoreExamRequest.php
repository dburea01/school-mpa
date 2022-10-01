<?php
namespace App\Http\Requests;

use App\Models\Exam;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreExamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Exam::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:100',
            'classroom_id' => [
                'required',
                'uuid',
                Rule::exists('classrooms', 'id')->where(function ($query) {
                    return $query->where('school_id', $this->school->id);
                })
            ],
            'exam_type_id' => [
                'required',
                'uuid',
                Rule::exists('exam_types', 'id')->where(function ($query) {
                    return $query->where('school_id', $this->school->id);
                })
            ],
            'subject_id' => [
                'required',
                'uuid',
                Rule::exists('subjects', 'id')->where(function ($query) {
                    return $query->where('school_id', $this->school->id);
                })
            ],
            'exam_status_id' => 'required|exists:exam_status,id',
            'start_date' => 'required|date_format:d/m/Y H:i',
            'end_date' => 'nullable|date_format:d/m/Y H:i|after:start_date',

        ];
    }
}
