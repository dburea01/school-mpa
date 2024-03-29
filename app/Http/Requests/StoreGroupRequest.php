<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StoreGroupRequest extends FormRequest
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
            'name' => $this->requiredAndMax(),
            'address1' => $this->requiredAndMax(),
            'address2' => 'max:50',
            'address3' => 'max:50',
            'city' => $this->requiredAndMax(),
            'country_id' => 'required|size:2',
            'zip_code' => 'required|max:10',
            'status' => [
                Rule::requiredIf($request->user()->isAdmin()),
                'in:ACTIVE,INACTIVE',
            ],
        ];
    }

    private function requiredAndMax()
    {
        return 'required|max:50';
    }
}
