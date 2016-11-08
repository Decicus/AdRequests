<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitAmaStreamerRequest extends FormRequest
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
            'partnered' => 'required|boolean',
            'viewers' => 'required|numeric',
            'host' => 'required',
            'why' => 'required',
            'focus' => 'present',
            'background' => 'required',
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
            'partnered.required' => 'Please specify if you are partnered or not.',
            'host.required' => 'Please specify why you think you would be a good host.',
            'why.required' => 'Please specify why you want to have an AMA.',
            'background.required' => 'Please give us a background about your stream and yourself.',
            'date.required' => 'Please specify when you want your AMA to start.',
            'days.required' => 'Please specify how long you want your AMA to last.'
        ];
    }
}
