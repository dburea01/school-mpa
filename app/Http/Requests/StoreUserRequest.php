<?php
namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'role_id' => 'required|exists:roles,id',
            'first_name' => 'required',
            'last_name' => 'required',
            'image_user' => 'mimes:jpg,bmp,png|max:1024',
            'email' => [
                'bail',
                'email',
                'nullable',
                'required_unless:role_id,STUDENT',
                Rule::unique('users', 'email')->ignore($this->user),
            ],
            'status' => 'required|in:ACTIVE,INACTIVE',
            'gender_id' => 'required_if:role_id,STUDENT|in:1,2',
            'civility_id' => 'nullable|required_unless:role_id,STUDENT|exists:civilities,id',
            'birth_date' => 'required_if:role_id,STUDENT|date_format:d/m/Y',
            'country_id' => 'exists:countries,id',
        ];
    }
}
