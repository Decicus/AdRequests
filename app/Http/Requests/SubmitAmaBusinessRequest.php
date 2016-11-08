<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitAmaBusinessRequest extends FormRequest
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
            'name' => 'required',
            'product_name' => 'required',
            'permissions' => 'required|boolean',
            'tos' => 'required|boolean',
            'tos_url' => 'required_if:tos,1',
            'user_data' => 'required',
            'date' => 'required|date|after:tomorrow',
            'days' => 'required|numeric'
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
            'name.required' => 'Please specify the name of your business.',
            'product_name.required' => 'Please specify the name of your product.',
            'tos.required' => 'Please specify if you have a Terms of Service.',
            'tos_url.required_if' => 'Please specify the URL for your Terms of Service.',
            'user_data.required' => 'Please specify what user data you require.',
            'date.required' => 'Please specify when you want your AMA to start.',
            'days.required' => 'Please specify how long you want your AMA to last.'
        ];
    }
}
