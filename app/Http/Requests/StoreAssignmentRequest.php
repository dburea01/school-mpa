<?php
namespace App\Http\Requests;

use App\Models\Assignment;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAssignmentRequest extends FormRequest
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
        // todo : affectations pour des STUDENTS et TEACHER only
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
            $assignment = Assignment::where('user_id', $this->userIdToAssign)
            ->where('classroom_id', $this->route('classroom')->id)
            ->first();

            if ($assignment) {
                $user = User::find($assignment->user_id)->full_name;
                $validator->errors()
                ->add('userIdToAssign', trans('assignments.user_already_assigned', ['user' => $user]));
            }
        });
    }
}
