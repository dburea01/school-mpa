<?php
namespace App\Http\Requests;

use App\Models\Assignment;
use App\Models\AssignmentStudent;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAssignmentStudentRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'userIdToAssign' => [
                'required',
                Rule::exists('users', 'id'),
            ],
        ];
    }

    // the user must not be assigned
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $assignmentStudent = AssignmentStudent::where('user_id', $this->userIdToAssign)
            ->where('classroom_id', $this->route('classroom')->id)
            ->first();

            if ($assignmentStudent) {
                $user = User::find($assignmentStudent->user_id)->full_name;
                $validator->errors()
                ->add('userIdToAssign', trans('assignment-students.student_already_assigned', ['user' => $user]));
            }
        });
    }
}
