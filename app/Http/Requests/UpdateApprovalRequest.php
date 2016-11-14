<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApprovalRequest extends FormRequest
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
        $max = count(config('requests.approval')) - 1;
        return [
            'approval' => 'required|integer|between:0,' . $max,
            'id' => 'required|exists:requests,id'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'approval.between' => 'Invalid approval type specified.',
            'approval.integer' => 'Invalid approval type specified.'
        ];
    }
}
