<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use App\Request as AdRequest;

class SubmitCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() && Auth::user()->can('comment', new AdRequest);
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
            'comment' => 'required',
            'public' => 'required|boolean'
        ];
    }
}
