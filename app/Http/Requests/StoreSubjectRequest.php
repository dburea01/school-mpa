<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Request;

class StoreSubjectRequest extends FormRequest
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
            'name_fr' => 'required|max:30',
            'name_en' => 'max:30',
            'short_name' => [
                'required',
                'min:2',
                Rule::unique('subjects', 'short_name')->ignore($this->subject),
            ],
            'status' => 'required|in:ACTIVE,INACTIVE',
        ];
    }
}
