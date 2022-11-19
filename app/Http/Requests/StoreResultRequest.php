<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResultRequest extends FormRequest
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
        // TODO : to complete
        return [
            'appreciation_id' => 'nullable|exists:appreciations,id',
            'comment' => 'max:500',
            'note_num' => 'required|numeric|gte:0'
        ];
    }
}
