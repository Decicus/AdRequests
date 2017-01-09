<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Request as AdRequest;

class SubmitVoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() && Auth::user()->can('vote', new AdRequest);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'request_id' => 'required|exists:requests,id',
            'result' => 'required|boolean'
        ];
    }
}
