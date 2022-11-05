<?php
namespace App\Http\Requests;

use App\Models\School;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StoreSchoolRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', School::class);
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
            'address2' => 'max:60',
            'address3' => 'max:60',
            'city' => $this->requiredAndMax(),
            'country_id' => 'required|size:2',
            'zip_code' => 'required|max:10',
        ];
    }

    private function requiredAndMax()
    {
        return 'required|max:60';
    }
}
