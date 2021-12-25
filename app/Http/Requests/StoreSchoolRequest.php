<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSchoolRequest extends FormRequest
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
            'name' => 'required|max:60',
            'address1' => 'required|max:60',
            'address2' => 'max:60',
            'address3' => 'max:60',
            'city' => 'required|max:60',
            'country_id' => 'required|size:2',
            'zip_code' => 'required|max:10',
            'max_users' => 'required|int|gt:0'
        ];
    }
}
