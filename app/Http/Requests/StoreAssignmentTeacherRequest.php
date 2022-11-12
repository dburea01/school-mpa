<?php
namespace App\Http\Requests;

use App\Models\AssignmentTeacher;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreAssignmentTeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id,role_id,TEACHER',
            'subject_id' => 'required|exists:subjects,id',
            'classroom_id' => 'required|exists:classrooms,id'
        ];
    }

    // the teacher must not be assigned
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $assignmentTeacher = AssignmentTeacher::where('user_id', $this->user_id)
            ->where('classroom_id', $this->classroom_id)
            ->where('subject_id', $this->subject_id)
            ->first();

            if ($assignmentTeacher) {
                $user = User::find($assignmentTeacher->user_id)->full_name;
                $validator->errors()
                ->add('user_id', trans('assignment-teacher.teacher_already_assigned', ['user' => $user]));
            }
        });
    }
}
